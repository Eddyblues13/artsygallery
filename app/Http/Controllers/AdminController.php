<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Nft;
use App\Models\Transaction;
use App\Models\PopupMessage;
use App\Models\WithdrawalModalSetting;
use App\Models\WithdrawalModalUserOverride;
use GuzzleHttp\Client;
use App\Mail\nftUserEmail;
use App\Mail\nftApprovedEmail;
use App\Mail\sendUserEmail;
use App\Mail\ApproveKyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Get the authenticated admin.
     */
    protected function admin()
    {
        return Auth::guard('admin')->user();
    }

    public function home()
    {


        // Admin Dashboard Stats - Overall Platform Statistics
        $data['total_users'] = User::count();
        $data['active_users'] = User::where('is_activated', '1')->count();
        $data['total_artworks'] = \App\Models\Nft::count();
        $data['approved_artworks'] = \App\Models\Nft::where('status', 1)->count();
        
        // Financial Stats
        $data['total_deposits'] = Transaction::where('transaction_type', 'Deposit')->where('status', '1')->sum('transaction_amount');
        $data['total_withdrawals'] = Transaction::where('transaction_type', 'Withdrawal')->where('status', '1')->sum('transaction_amount');
        $data['total_profit'] = Transaction::where('transaction_type', 'Profit')->where('status', '1')->sum('transaction_amount') 
                                - Transaction::where('transaction_type', 'DebitProfit')->where('status', '1')->sum('transaction_amount');
        $data['total_balance'] = $data['total_deposits'] + $data['total_profit'] - $data['total_withdrawals'];
        

        
        // Pending Transactions
        $data['pending_deposits'] = Transaction::where('transaction_type', 'Deposit')->where('status', '0')->count();
        $data['pending_withdrawals'] = Transaction::where('transaction_type', 'Withdrawal')->where('status', '0')->count();
        
        // Recent Activity
        $data['recent_transactions'] = Transaction::orderBy('created_at', 'desc')->limit(10)->get();
        
        return view('admin.home', $data);
    }
    public function users(Request $request)
    {
        $query = User::orderBy('created_at', 'desc');

        // Improved search functionality - case insensitive and more accurate
        if ($request->has('search') && $request->search) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('id', '=', $search);
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_activated', $request->status);
        }

        // Filter by wallet verification
        if ($request->has('wallet_verify') && $request->wallet_verify !== '') {
            $query->where('wallet_verify', $request->wallet_verify);
        }

        // Filter by KYC status
        if ($request->has('kyc_status') && $request->kyc_status !== '') {
            $query->where('id_card_status', $request->kyc_status);
        }

        // Date range filter
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $users = $query->paginate(20)->appends($request->query());

        // Statistics
        $stats = [
            'total' => User::count(),
            'active' => User::where('is_activated', '1')->count(),
            'inactive' => User::where('is_activated', '0')->count(),
            'wallet_verified' => User::where('wallet_verify', true)->count(),
            'kyc_approved' => User::where('id_card_status', '1')->count(),
            'kyc_pending' => User::where('id_card_status', '0')->count(),
        ];

        return view('admin.users', compact('users', 'stats'));
    }

    public function eth()
    {
        return view('admin.ethereum');
    }

    public function updateWhatsAppApi()
    {
        return view('admin.whatsapp');
    }
    public function updateWallet(Request $request)
    {
        $request->validate([
            'wallet_address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'wallet_address.required' => 'Ethereum wallet address is required.',
            'wallet_address.max' => 'Wallet address must not exceed 255 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'The image must not be larger than 2MB.',
        ]);

        try {
            $admin = Auth::guard('admin')->user();
            $admin->wallet_address = $request->wallet_address;
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = 'wallet_' . time() . '.' . $ext;
                
                // Create directory if it doesn't exist
                $uploadPath = public_path('admin/uploads/admin');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $file->move($uploadPath, $filename);
                
                // Delete old bar code image if exists
                if ($admin->bar_code && file_exists($uploadPath . '/' . $admin->bar_code)) {
                    @unlink($uploadPath . '/' . $admin->bar_code);
                }
                
                $admin->bar_code = $filename;
            }

            $admin->save();
            return back()->with('status', 'Wallet details updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update wallet details. Please try again.');
        }
    }


    public function updateWhatsapp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ], [
            'phone.required' => 'WhatsApp phone number is required.',
            'phone.max' => 'Phone number must not exceed 20 characters.',
        ]);

        try {
            $admin = Auth::guard('admin')->user();
            $admin->phone = $request->phone;
            $admin->save();
            
            return back()->with('status', 'WhatsApp phone number updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update WhatsApp phone number. Please try again.');
        }
    }

    public function sendUserEmail()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.user-email');
        }

        return redirect()->route('admin.login')->withSuccess('You are not allowed to access');
    }

    public function sendMail(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            // Validate the request
            $request->validate([
                'email' => 'required|email',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            try {
                $email = $request->input('email');
                $data = [
                    'message' => $request->message,
                    'subject' => $request->subject,
                ];

                Mail::to($email)->send(new sendUserEmail($data));

                return back()->with('status', 'Email successfully sent to ' . $email);
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to send email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.login')->withSuccess('You are not allowed to access');
    }

    public function uploadNft()
    {
        $activeCurrency = \App\Models\CurrencySetting::getActive();
        return view('admin.nft', compact('activeCurrency'));
    }

    // public function adminApproveNft(Request $request)
    // {
    //     // Query the NFTs without pagination
    //     $query = User::join('nfts', 'users.id', '=', 'nfts.user_id')
    //         // ->orderBy('nfts.id', 'asc')
    //         ->orderBy('nfts.created_at', 'desc')
    //         ->select('users.email', 'users.name as user_name', 'nfts.*');

    //     // Apply search filters if provided
    //     if ($request->has('search')) {
    //         $search = $request->input('search');
    //         $query->where(function($q) use ($search) {
    //             $q->where('nfts.name', 'like', '%' . $search . '%')
    //               ->orWhere('nfts.ntf_description', 'like', '%' . $search . '%')
    //               ->orWhere('nfts.created_at', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $users_nfts = $query->get(); // Retrieve all records without pagination

    //     return view('admin.approve_nft', compact('users_nfts'));
    // }


    public function adminApproveNft(Request $request)
    {
        // Query the NFTs with pagination in descending order of creation date
        $query = User::join('nfts', 'users.id', '=', 'nfts.user_id')
            ->orderBy('nfts.created_at', 'desc')
            ->select('users.email', 'users.name as user_name', 'nfts.*');

        // Apply search filters if provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nfts.name', 'like', '%' . $search . '%')
                    ->orWhere('nfts.ntf_owner', 'like', '%' . $search . '%')
                    ->orWhere('nfts.ntf_description', 'like', '%' . $search . '%')
                    ->orWhere('nfts.created_at', 'like', '%' . $search . '%');
            });
        }

        $users_nfts = $query->paginate(10); // Adjust the number as needed

        return view('admin.approve_nft', compact('users_nfts'));
    }


    public function searchNft(Request $request)
    {
        // Query the NFTs with search functionality
        $query = User::join('nfts', 'users.id', '=', 'nfts.user_id')
            ->orderBy('nfts.id', 'desc')
            ->select('users.email', 'users.name as user_name', 'nfts.*');

        // Apply search filters if provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nfts.ntf_name', 'like', '%' . $search . '%')
                    ->orWhere('nfts.ntf_owner', 'like', '%' . $search . '%')
                    ->orWhere('nfts.ntf_description', 'like', '%' . $search . '%')
                    ->orWhere('nfts.created_at', 'like', '%' . $search . '%');
            });
        }

        $users_nfts = $query->paginate(10);

        return view('admin.approve_nft', compact('users_nfts'));
    }




    public function nftMarket(Request $request)
    {
        $query = Nft::with('user')
            ->where('status', '1')
            ->orderBy('updated_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ntf_name', 'like', '%' . $search . '%')
                  ->orWhere('ntf_owner', 'like', '%' . $search . '%')
                  ->orWhere('ntf_description', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by price range
        if ($request->has('price_min') && $request->price_min) {
            $query->where('nft_price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max) {
            $query->where('nft_price', '<=', $request->price_max);
        }

        // Sort options
        $sortBy = $request->get('sort', 'updated_at');
        $sortOrder = $request->get('order', 'desc');
        
        if ($sortBy === 'price_low') {
            $query->orderBy('nft_price', 'asc');
        } elseif ($sortBy === 'price_high') {
            $query->orderBy('nft_price', 'desc');
        } elseif ($sortBy === 'name') {
            $query->orderBy('ntf_name', $sortOrder);
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        $buy_nft = $query->paginate(12)->appends($request->query());
        $nft = $buy_nft;
        $eth = $nft;

        // Statistics
        $stats = [
            'total' => Nft::where('status', '1')->count(),
            'total_value' => Nft::where('status', '1')->sum('nft_price'),
            'average_price' => Nft::where('status', '1')->avg('nft_price'),
        ];

        return view('admin.nftmarkets', ['buy_nft' => $eth, 'stats' => $stats]);
    }


    public function usersTransaction(Request $request)
    {
        $query = Transaction::with('user')
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_amount', 'like', '%' . $search . '%')
                  ->orWhere('transaction_type', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by transaction type
        if ($request->has('type') && $request->type) {
            $query->where('transaction_type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->paginate(20)->appends($request->query());

        // Statistics
        $stats = [
            'total' => Transaction::count(),
            'pending' => Transaction::where('status', '0')->count(),
            'approved' => Transaction::where('status', '1')->count(),
            'declined' => Transaction::where('status', '2')->count(),
            'total_amount' => Transaction::where('status', '1')->sum('transaction_amount'),
            'pending_amount' => Transaction::where('status', '0')->sum('transaction_amount'),
        ];

        return view('admin.transactions', compact('transactions', 'stats'));
    }

    public function deleteUser($id)
    {

        $user  = User::findOrFail($id);
        $user->delete();
        return back()->with('status', 'User deleted Successfully');
    }

    public function approveDeposit(Request $request, $id)
    {
        $deposit = array();
        $deposit['status'] = 1;
        $update = DB::table('transactions')->where('id', $id)->update($deposit);
        return redirect()->back()->with('message', 'Deposit Has Been Approved Successfully');
    }

    public function declineDeposit(Request $request, $id)
    {
        $deposit = array();
        $deposit['status'] = 2;
        $update = DB::table('transactions')->where('id', $id)->update($deposit);
        return redirect()->back()->with('message', 'Deposit Declined');
    }

    public function approveWithdrawal(Request $request, $id)
    {
        $deposit = array();
        $deposit['status'] = $request->status;
        $update = DB::table('transactions')->where('id', $id)->update($deposit);
        return redirect()->back()->with('message', 'Withdrawal Has Been Approved Successfully');
    }

    public function declineWithdrawal(Request $request, $id)
    {
        $deposit = array();
        $deposit['status'] = $request->status;
        $update = DB::table('transactions')->where('id', $id)->update($deposit);
        return redirect()->back()->with('message', 'Withdrawal Declined');
    }

    public function allNfts(Request $request)
    {
        $query = Nft::with('user')
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ntf_name', 'like', '%' . $search . '%')
                  ->orWhere('ntf_owner', 'like', '%' . $search . '%')
                  ->orWhere('ntf_description', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by price range
        if ($request->has('price_min') && $request->price_min) {
            $query->where('nft_price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max) {
            $query->where('nft_price', '<=', $request->price_max);
        }

        $nfts = $query->paginate(20)->appends($request->query());
        $nft = $nfts;
        $eth = $nft;

        // Statistics
        $stats = [
            'total' => Nft::count(),
            'approved' => Nft::where('status', '1')->count(),
            'pending' => Nft::where('status', '0')->count(),
            'sold' => Nft::where('status', '2')->count(),
        ];

        return view('admin.all_nft', ['nfts' => $eth, 'stats' => $stats]);
    }



    public function userProfile($id)
    {
        // 1. Retrieve the user profile using User model to get Carbon dates
        $userProfile = User::find($id);

        if (!$userProfile) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // 2. Retrieve user transactions
        $user_deposit = Transaction::where('user_id', $id)
            ->where('transaction_type', 'Deposit')
            ->orderBy('id', 'asc')
            ->get();

        $user_withdrawal = Transaction::where('user_id', $id)
            ->where('transaction_type', 'Withdrawal')
            ->orderBy('id', 'asc')
            ->get();

        $user_profit = Transaction::where('user_id', $id)
            ->where('transaction_type', 'Profit')
            ->orderBy('id', 'asc')
            ->get();

        // 3. Get file path and extension from userProfile
        // Ensure the file exists and the path is valid
        $filePath = $userProfile->id_card ? asset($userProfile->id_card) : null;
        $extension = $filePath ? strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) : null;


        // 5. Calculate transaction sums
        $deposit = Transaction::where('user_id', $id)
            ->where('transaction_type', 'Deposit')
            ->where('status', '1')
            ->sum('transaction_amount');

        $deposit_eth = 0;

        $withdrawal = Transaction::where('user_id', $id)
            ->where('transaction_type', 'Withdrawal')
            ->where('status', '1')
            ->sum('transaction_amount');

        $withdrawal_eth = 0;

        $add_profit = Transaction::where('user_id', $id)
            ->where('transaction_type', 'Profit')
            ->where('status', '1')
            ->sum('transaction_amount');

        $debit_profit = Transaction::where('user_id', $id)
            ->where('transaction_type', 'DebitProfit')
            ->where('status', '1')
            ->sum('transaction_amount');

        $profit = $add_profit - $debit_profit;
        $profit_eth = 0;

        $balance = $deposit + $profit - $withdrawal;
        $balance_eth = 0;

        // 6. Prepare data array
        $data = [
            'deposit' => $deposit,
            'deposit_eth' => $deposit_eth,
            'withdrawal' => $withdrawal,
            'withdrawal_eth' => $withdrawal_eth,
            'add_profit' => $add_profit,
            'debit_profit' => $debit_profit,
            'profit' => $profit,
            'profit_eth' => $profit_eth,
            'balance' => $balance,
            'balance_eth' => $balance_eth,
            'extension' => $extension,

        ];

        // 7. Pass data to the view
        return view('admin.user', array_merge($data, [
            'userProfile' => $userProfile,
            'user_deposit' => $user_deposit,
            'user_withdrawal' => $user_withdrawal,
            'filePath' => $filePath,
            'user_profit' => $user_profit,
        ]));
    }


    public function adminSaveNft(Request $request)
    {
        $request->validate([
            'nft_name' => 'required|string|max:255',
            'nft_price' => 'required|numeric|min:0',
            'ntf_description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'nft_name.required' => 'Artwork name is required.',
            'nft_price.required' => 'Price is required.',
            'nft_price.numeric' => 'Price must be a valid number.',
            'nft_price.min' => 'Price must be at least 0.',
            'ntf_description.required' => 'Description is required.',
            'image.required' => 'Artwork image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'The image must not be larger than 5MB.',
        ]);

        $price = $request->input('nft_price');
        $nft_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

        // Get the first user ID from the database
        $firstUser = \App\Models\User::orderBy('id')->first();
        if (!$firstUser) {
            return back()->with('error', 'No users found. Please create a user account first.');
        }

        $nft = new Nft;
        $nft->user_id = $firstUser->id; // Use first available user ID
        $nft->ntf_name = $request->nft_name;
        $nft->nft_price = $nft_price;
        $nft->ntf_description = $request->ntf_description;
        $nft->ntf_owner = $request->nft_owner ?? Auth::guard('admin')->user()->name ?? 'Admin';
        $nft->status = 1; // Auto-approve admin uploads

        // Cloudinary upload using the recommended method
        $nftImageUrl = null;
        $cloudinaryPublicId = null;

        if ($request->hasFile('image')) {
            try {
                $cloudinary = new \Cloudinary\Cloudinary();
                $uploadApi = $cloudinary->uploadApi();

                $uploadResult = $uploadApi->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'nfts',
                        'transformation' => [
                            'width' => 800,
                            'height' => 800,
                            'crop' => 'limit',
                            'quality' => 'auto:best'
                        ],
                    ]
                );

                $nftImageUrl = $uploadResult['secure_url'] ?? null;
                $cloudinaryPublicId = $uploadResult['public_id'] ?? null;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Cloudinary upload failed: ' . $e->getMessage());

                // Fallback to local storage
                $file = $request->file('image');
                $filename = 'admin_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('user/uploads/nfts'), $filename);
                $nftImageUrl = 'user/uploads/nfts/' . $filename;
            }

            $nft->ntf_image = $nftImageUrl;
            $nft->cloudinary_public_id = $cloudinaryPublicId;
        }

        $nft->save();

        return back()->with('status', 'NFT uploaded successfully!');
    }

    public function adminChangePassword()
    {
        return view('admin.change_password');
    }

    public function adminUpdatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        #Match The Old Password
        $admin = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->withInput()->with("error", "Current password doesn't match! Please enter your correct current password.");
        }

        # Check if new password is same as old password
        if (Hash::check($request->new_password, $admin->password)) {
            return back()->withInput()->with("error", "New password must be different from your current password.");
        }

        #Update the new Password
        try {
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            
            Session::flush();
            Auth::guard('admin')->logout();
            
            return redirect()->route('admin.login')->with('status', 'Password updated successfully! Please log in with your new password.');
        } catch (\Exception $e) {
            return back()->withInput()->with("error", "Failed to update password. Please try again.");
        }
        return redirect('login')->with('status', 'Password Updated Successfully, Please login with your new password');
    }

    public function ApproveNft(Request $request, $id)
    {

        $price =   $request->input('nft_price');
        $full_name =   $request->input('full_name');
        $nft_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
        $email = $request->email;
        $nft = array();
        $nft['status'] = $request->status;
        $update = DB::table('nfts')->where('id', $id)->update($nft);

        $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
            'query' => [
                'ids' => 'ethereum',
                'vs_currencies' => 'usd',
            ],
        ]);

        // Decode the JSON response
        $data = json_decode($response->getBody(), true);
        $price = $data['ethereum']['usd'];




        $amount = $nft_price;
        $data['amount'] = $amount;
        $data['eth'] = $data['amount'] / $price;


        $ref = rand(76503737, 12344994);



        $user = [
            'amount' => $request['nft_price'],
            'eth' => $data['eth'],
            'name' => $request['nft_name'],
            'status' => 'Approved',
            'ref' => $ref,
            'full_name' => $full_name,
        ];


        Mail::to($email)->send(new nftApprovedEmail($user));

        if ($update)  return response()->json([
            'success' => true,
            'message' => 'NFT has been approved successfully.',
        ]);
        // return back()->with('message', 'Nft Has Been Approved Successfully, An email has been sent to the owner');
    }



    public function ApproveId(Request $request, $id)
    {




        $user = array();
        $user['id_card_status'] = $request->status;
        $update = DB::table('users')->where('id', $id)->update($user);
        $full_name =  $request->name;
        $email = $request->email;


        $user = [

            'status' => 'Approved',
            'full_name' => $request->name

        ];


        Mail::to($email)->send(new ApproveKyc($user));



        return back()->with('status', 'Kyc Details Updated Successfully');
    }

    public function addProfit(Request $request)
    {




        $transaction = new Transaction;
        $transaction->user_id = $request['id'];
        $transaction->transaction_type = "Profit";
        $transaction->transaction_amount = $request['amount'];
        $transaction->status = 1;
        $transaction->save();





        return back()->with('status', 'profit added successfully');
    }

    public function withdrawalCode(Request $request, $id)
    {



        $user = array();
        $user['withdrawal_code'] = $request->code;
        $update = DB::table('users')->where('id', $id)->update($user);





        return back()->with('status', 'Withdrawal Code Updated Successfully');
    }

    public function debitProfit(Request $request)
    {




        $transaction = new Transaction;
        $transaction->user_id = $request['id'];
        $transaction->transaction_type = "DebitProfit";
        $transaction->transaction_amount = $request['amount'];
        $transaction->status = 1;
        $transaction->save();





        return back()->with('status', 'profit Reduced successfully');
    }

    public function useLinking($id)
    {


        $user = array();
        $user['is_linking'] = 0;
        $update = DB::table('users')->where('id', $id)->update($user);

        return back()->with('status', 'Linking Withdrawal Activated');
    }

    public function noneLinking($id)
    {


        $user = array();
        $user['is_linking'] = 1;
        $update = DB::table('users')->where('id', $id)->update($user);

        return back()->with('status', 'None Linking Withdrawal Activated');
    }

    private function processData($nft)
    {


        $client = new Client();
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
            'query' => [
                'ids' => 'ethereum',
                'vs_currencies' => 'usd',
            ],
        ]);
        // Decode the JSON response
        $data = json_decode($response->getBody(), true);
        $price = $data['ethereum']['usd'];
        // Perform any data processing or manipulation here
        // For example, you can add new attributes, format data, etc.

        foreach ($nft as $data) {
            $data->nft_eth_price = $data->nft_price / $price;
        }

        return $nft;
    }


    public function userApprovedNft($id)
    {


        $data['my_nft'] =  Nft::where('user_id', $id)->where('status', '1')->orderBy('id', 'asc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('admin.approved_nft', ['my_nft' => $eth]);
    }

    public function userUnapprovedNft($id)
    {


        $data['my_nft'] =  Nft::where('user_id', $id)->where('status', '0')->orderBy('id', 'asc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('admin.unapproved_nft', ['my_nft' => $eth]);
    }

    public function userSoldNft($id)
    {


        $data['my_nft'] =  Nft::where('user_id', $id)->where('status', '0')->orderBy('id', 'asc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('admin.sold_nft', ['my_nft' => $eth]);
    }
    public function updateActivationFee(Request $request, $id)
    {




        $user = array();
        $user['activation_fee'] = $request->activation_fee;
        $update = DB::table('users')->where('id', $id)->update($user);



        return back()->with('status', 'user activation_fee Updated Successfully');
    }

    public function toggleWalletVerify(User $user)
    {
        $user->update([
            'wallet_verify' => !$user->wallet_verify
        ]);

        // // Optional: Send notification email to user
        // if ($user->wallet_verify) {
        //     Mail::to($user->email)->send(new WalletVerifiedNotification($user));
        // } else {
        //     Mail::to($user->email)->send(new WalletUnverifiedNotification($user));
        // }

        return back()->with('success', 'Wallet verification status updated!');
    }

    // Popup Message Management
    public function popupMessages(Request $request)
    {
        $query = PopupMessage::with('user')->orderBy('created_at', 'desc');

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $popups = $query->paginate(20)->appends($request->query());

        $stats = [
            'total' => PopupMessage::count(),
            'active' => PopupMessage::where('is_active', true)->count(),
            'general' => PopupMessage::where('type', 'general')->count(),
            'user_specific' => PopupMessage::where('type', 'user_specific')->count(),
        ];

        return view('admin.popup_messages.index', compact('popups', 'stats'));
    }

    public function createPopupMessage()
    {
        $users = User::orderBy('name')->get();
        return view('admin.popup_messages.create', compact('users'));
    }

    public function storePopupMessage(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:general,user_specific',
            'position' => 'required|in:top,bottom',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];

        // Only require user_id if type is user_specific
        if ($request->type === 'user_specific') {
            $rules['user_id'] = 'required|exists:users,id';
        } else {
            $rules['user_id'] = 'nullable';
        }

        $request->validate($rules);

        PopupMessage::create([
            'user_id' => $request->type === 'user_specific' ? $request->user_id : null,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'position' => $request->position,
            'is_active' => $request->has('is_active') ? true : false,
            'start_date' => $request->start_date ?: null,
            'end_date' => $request->end_date ?: null,
        ]);

        return redirect()->route('admin.popup.messages')->with('success', 'Popup message created successfully!');
    }

    public function editPopupMessage($id)
    {
        $popup = PopupMessage::findOrFail($id);
        $users = User::orderBy('name')->get();
        return view('admin.popup_messages.edit', compact('popup', 'users'));
    }

    public function updatePopupMessage(Request $request, $id)
    {
        $popup = PopupMessage::findOrFail($id);

        $rules = [
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:general,user_specific',
            'position' => 'required|in:top,bottom',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];

        // Only require user_id if type is user_specific
        if ($request->type === 'user_specific') {
            $rules['user_id'] = 'required|exists:users,id';
        } else {
            $rules['user_id'] = 'nullable';
        }

        $request->validate($rules);

        $popup->update([
            'user_id' => $request->type === 'user_specific' ? $request->user_id : null,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'position' => $request->position,
            'is_active' => $request->has('is_active') ? true : false,
            'start_date' => $request->start_date ?: null,
            'end_date' => $request->end_date ?: null,
        ]);

        return redirect()->route('admin.popup.messages')->with('success', 'Popup message updated successfully!');
    }

    public function deletePopupMessage($id)
    {
        $popup = PopupMessage::findOrFail($id);
        $popup->delete();

        return redirect()->route('admin.popup.messages')->with('success', 'Popup message deleted successfully!');
    }

    public function togglePopupMessage($id)
    {
        $popup = PopupMessage::findOrFail($id);
        $popup->is_active = !$popup->is_active;
        $popup->save();

        return back()->with('success', 'Popup message status updated!');
    }

    // Withdrawal Success Modal (global message + on/off + user-specific overrides)
    public function withdrawalModalSettings()
    {
        $setting = WithdrawalModalSetting::global();
        if (!$setting) {
            $setting = WithdrawalModalSetting::create([
                'message' => 'Your withdrawal request has been submitted and is pending review.',
                'is_enabled' => true,
            ]);
        }
        $overrides = WithdrawalModalUserOverride::with('user')->orderBy('id', 'desc')->get();
        $users = User::orderBy('name')->get();
        return view('admin.withdrawal_modal.index', compact('setting', 'overrides', 'users'));
    }

    public function updateWithdrawalModalSettings(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|max:2000',
            'is_enabled' => 'nullable',
        ]);
        $setting = WithdrawalModalSetting::first();
        if (!$setting) {
            $setting = WithdrawalModalSetting::create([
                'message' => 'Your withdrawal request has been submitted and is pending review.',
                'is_enabled' => true,
            ]);
        }
        $setting->message = $request->input('message') !== null ? $request->input('message') : $setting->message;
        $setting->is_enabled = $request->boolean('is_enabled');
        $setting->save();
        return redirect()->route('admin.withdrawal.modal')->with('success', 'Withdrawal modal settings updated.');
    }

    public function storeWithdrawalModalOverride(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'show_modal' => 'required|in:0,1',
        ]);
        WithdrawalModalUserOverride::updateOrCreate(
            ['user_id' => $request->user_id],
            ['show_modal' => (bool) $request->show_modal]
        );
        return redirect()->route('admin.withdrawal.modal')->with('success', 'User override saved.');
    }

    public function deleteWithdrawalModalOverride($id)
    {
        WithdrawalModalUserOverride::findOrFail($id)->delete();
        return redirect()->route('admin.withdrawal.modal')->with('success', 'User override removed.');
    }

    // Currency Management Methods
    public function currencySettings()
    {
        $currencies = \App\Models\CurrencySetting::orderBy('position')->orderBy('currency_code')->get();
        $activeCurrency = \App\Models\CurrencySetting::getActive();
        return view('admin.currency.index', compact('currencies', 'activeCurrency'));
    }

    public function createCurrency()
    {
        $currencies = $this->getCurrencyList();
        return view('admin.currency.create', compact('currencies'));
    }

    private function getCurrencyList()
    {
        return [
            ['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$'],
            ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€'],
            ['code' => 'GBP', 'name' => 'British Pound', 'symbol' => '£'],
            ['code' => 'JPY', 'name' => 'Japanese Yen', 'symbol' => '¥'],
            ['code' => 'AUD', 'name' => 'Australian Dollar', 'symbol' => 'A$'],
            ['code' => 'CAD', 'name' => 'Canadian Dollar', 'symbol' => 'C$'],
            ['code' => 'CHF', 'name' => 'Swiss Franc', 'symbol' => 'CHF'],
            ['code' => 'CNY', 'name' => 'Chinese Yuan', 'symbol' => '¥'],
            ['code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹'],
            ['code' => 'SGD', 'name' => 'Singapore Dollar', 'symbol' => 'S$'],
            ['code' => 'HKD', 'name' => 'Hong Kong Dollar', 'symbol' => 'HK$'],
            ['code' => 'NZD', 'name' => 'New Zealand Dollar', 'symbol' => 'NZ$'],
            ['code' => 'MXN', 'name' => 'Mexican Peso', 'symbol' => 'MX$'],
            ['code' => 'BRL', 'name' => 'Brazilian Real', 'symbol' => 'R$'],
            ['code' => 'ZAR', 'name' => 'South African Rand', 'symbol' => 'R'],
            ['code' => 'RUB', 'name' => 'Russian Ruble', 'symbol' => '₽'],
            ['code' => 'KRW', 'name' => 'South Korean Won', 'symbol' => '₩'],
            ['code' => 'TRY', 'name' => 'Turkish Lira', 'symbol' => '₺'],
            ['code' => 'SEK', 'name' => 'Swedish Krona', 'symbol' => 'kr'],
            ['code' => 'NOK', 'name' => 'Norwegian Krone', 'symbol' => 'kr'],
            ['code' => 'DKK', 'name' => 'Danish Krone', 'symbol' => 'kr'],
            ['code' => 'PLN', 'name' => 'Polish Zloty', 'symbol' => 'zł'],
            ['code' => 'THB', 'name' => 'Thai Baht', 'symbol' => '฿'],
            ['code' => 'IDR', 'name' => 'Indonesian Rupiah', 'symbol' => 'Rp'],
            ['code' => 'PHP', 'name' => 'Philippine Peso', 'symbol' => '₱'],
            ['code' => 'MYR', 'name' => 'Malaysian Ringgit', 'symbol' => 'RM'],
            ['code' => 'AED', 'name' => 'UAE Dirham', 'symbol' => 'د.إ'],
            ['code' => 'SAR', 'name' => 'Saudi Riyal', 'symbol' => '﷼'],
            ['code' => 'ILS', 'name' => 'Israeli Shekel', 'symbol' => '₪'],
            ['code' => 'EGP', 'name' => 'Egyptian Pound', 'symbol' => 'E£'],
            ['code' => 'NGN', 'name' => 'Nigerian Naira', 'symbol' => '₦'],
        ];
    }

    public function storeCurrency(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|string|max:3|unique:currency_settings,currency_code',
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric|min:0.00000001',
            'position' => 'nullable|integer|min:0',
        ]);

        \App\Models\CurrencySetting::create([
            'currency_code' => strtoupper($request->currency_code),
            'currency_name' => $request->currency_name,
            'currency_symbol' => $request->currency_symbol,
            'exchange_rate' => $request->exchange_rate,
            'position' => $request->position ?? 0,
            'is_active' => false,
        ]);

        return redirect()->route('admin.currency.settings')->with('success', 'Currency created successfully!');
    }

    public function editCurrency($id)
    {
        $currency = \App\Models\CurrencySetting::findOrFail($id);
        $currencies = $this->getCurrencyList();
        return view('admin.currency.edit', compact('currency', 'currencies'));
    }

    public function updateCurrency(Request $request, $id)
    {
        $currency = \App\Models\CurrencySetting::findOrFail($id);

        $request->validate([
            'currency_code' => 'required|string|max:3|unique:currency_settings,currency_code,' . $id,
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric|min:0.00000001',
            'position' => 'nullable|integer|min:0',
        ]);

        $currency->update([
            'currency_code' => strtoupper($request->currency_code),
            'currency_name' => $request->currency_name,
            'currency_symbol' => $request->currency_symbol,
            'exchange_rate' => $request->exchange_rate,
            'position' => $request->position ?? 0,
        ]);

        return redirect()->route('admin.currency.settings')->with('success', 'Currency updated successfully!');
    }

    public function setActiveCurrency($id)
    {
        // Deactivate all currencies
        \App\Models\CurrencySetting::where('is_active', true)->update(['is_active' => false]);
        
        // Activate selected currency
        $currency = \App\Models\CurrencySetting::findOrFail($id);
        $currency->is_active = true;
        $currency->save();

        return back()->with('success', 'Currency activated successfully! All prices will now be displayed in ' . $currency->currency_code);
    }

    public function deleteCurrency($id)
    {
        $currency = \App\Models\CurrencySetting::findOrFail($id);
        
        // Prevent deleting active currency
        if ($currency->is_active) {
            return back()->with('error', 'Cannot delete active currency. Please activate another currency first.');
        }

        // Prevent deleting USD if it's the only currency
        if ($currency->currency_code === 'USD' && \App\Models\CurrencySetting::count() <= 1) {
            return back()->with('error', 'Cannot delete USD currency. At least one currency must exist.');
        }

        $currency->delete();

        return back()->with('success', 'Currency deleted successfully!');
    }

    public function updateExchangeRates()
    {
        try {
            $client = new \GuzzleHttp\Client(['timeout' => 10]);
            
            // Get all currencies except USD
            $currencies = \App\Models\CurrencySetting::where('currency_code', '!=', 'USD')->get();
            
            if ($currencies->isEmpty()) {
                return back()->with('info', 'No currencies to update (excluding USD).');
            }

            // Build currency codes for API
            $currencyCodes = $currencies->pluck('currency_code')->map(function($code) {
                return strtolower($code);
            })->implode(',');

            // Fetch exchange rates from CoinGecko (free API)
            $response = $client->get('https://api.coingecko.com/api/v3/simple/supported_vs_currencies');
            $supportedCurrencies = json_decode($response->getBody(), true);

            $updated = 0;
            foreach ($currencies as $currency) {
                $code = strtolower($currency->currency_code);
                
                // Check if currency is supported by CoinGecko
                if (in_array($code, $supportedCurrencies)) {
                    try {
                        // Get exchange rate (USD to currency)
                        $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
                            'query' => [
                                'ids' => 'usd-coin',
                                'vs_currencies' => $code,
                            ],
                        ]);
                        
                        $data = json_decode($response->getBody(), true);
                        
                        // This gives us USDC price in the target currency
                        // We need to invert it to get USD to currency rate
                        if (isset($data['usd-coin'][$code])) {
                            // USDC is pegged to USD, so we can use this
                            $rate = 1 / $data['usd-coin'][$code];
                            $currency->exchange_rate = $rate;
                            $currency->save();
                            $updated++;
                        }
                    } catch (\Exception $e) {
                        // Skip currencies that fail
                        continue;
                    }
                }
            }

            if ($updated > 0) {
                return back()->with('success', "Exchange rates updated for {$updated} currency(ies)!");
            } else {
                return back()->with('warning', 'Could not update exchange rates. Please update manually.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update exchange rates: ' . $e->getMessage());
        }
    }

    public function fetchExchangeRate($code)
    {
        try {
            if (strtoupper($code) === 'USD') {
                return response()->json(['rate' => 1.0, 'success' => true]);
            }

            $client = new \GuzzleHttp\Client(['timeout' => 10]);
            $currencyCode = strtoupper($code);
            
            // Use free ExchangeRate-API (no API key required)
            // This API provides USD to other currencies
            try {
                $response = $client->get('https://api.exchangerate-api.com/v4/latest/USD', [
                    'timeout' => 10,
                ]);
                $data = json_decode($response->getBody(), true);
                
                if (isset($data['rates'][$currencyCode])) {
                    $rate = $data['rates'][$currencyCode];
                    return response()->json(['rate' => round($rate, 8), 'success' => true]);
                }
            } catch (\Exception $e) {
                // Fallback to alternative free API
            }
            
            // Fallback: Use exchangerate.host (free, no API key)
            try {
                $response = $client->get("https://api.exchangerate.host/latest", [
                    'query' => [
                        'base' => 'USD',
                        'symbols' => $currencyCode,
                    ],
                    'timeout' => 10,
                ]);
                $data = json_decode($response->getBody(), true);
                
                if (isset($data['rates'][$currencyCode])) {
                    $rate = $data['rates'][$currencyCode];
                    return response()->json(['rate' => round($rate, 8), 'success' => true]);
                }
            } catch (\Exception $e) {
                // Try one more free API
            }
            
            // Final fallback: Use fixer.io free tier (requires free account but works)
            // Note: This is just a backup, the above should work
            return response()->json(['success' => false, 'message' => 'Exchange rate not found. Please enter manually.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch exchange rate. Please enter manually.'], 500);
        }
    }
    public function deleteNft($id)
    {
        $nft = Nft::findOrFail($id);
        
        // Delete image if local
        if ($nft->ntf_image && file_exists(public_path($nft->ntf_image))) {
            @unlink(public_path($nft->ntf_image));
        }

        // Delete from Cloudinary if applicable
        if ($nft->cloudinary_public_id) {
            try {
                $cloudinary = new Cloudinary();
                $uploadApi = $cloudinary->uploadApi();
                $uploadApi->destroy($nft->cloudinary_public_id);
            } catch (\Exception $e) {
                // Log error but continue
            }
        }

        $nft->delete();
        return back()->with('status', 'NFT deleted successfully');
    }

    public function editNft($id)
    {
        $nft = Nft::findOrFail($id);
        return view('admin.edit_nft', compact('nft'));
    }

    public function updateNft(Request $request, $id)
    {
        $nft = Nft::findOrFail($id);

        $request->validate([
            'ntf_name' => 'required|string|max:255',
            'nft_price' => 'required|numeric|min:0',
            'ntf_description' => 'required|string',
        ]);

        $nft->ntf_name = $request->ntf_name;
        $nft->nft_price = $request->nft_price;
        $nft->ntf_description = $request->ntf_description;
        
        if ($request->has('status')) {
            $nft->status = $request->status;
        }

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ]);

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('user/uploads/nfts'), $filename);
            
            // Delete old local image if it exists and isn't a URL
            if ($nft->ntf_image && !Str::startsWith($nft->ntf_image, ['http', 'https'])) {
                $oldPath = public_path('user/uploads/nfts/' . $nft->ntf_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $nft->ntf_image = $filename;
            $nft->cloudinary_public_id = null;
        }

        $nft->save();

        return redirect()->route('users.uploaded.nft')->with('status', 'NFT updated successfully');
    }
}
