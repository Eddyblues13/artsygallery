<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Nft;
use App\Models\Transaction;
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
    public function users()
    {
        return view('admin.users');
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


        $update = Auth::user();
        $update->wallet_address = $request['wallet_address'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('admin/uploads/admin', $filename);
            $update->bar_code =  $filename;
        }

        $update->save();
        return back()->with('status', 'Wallet Details Updated Successfully');
    }
    
    
        public function updateWhatsapp(Request $request)
    {


        $update = Auth::user();
        $update->phone = $request['phone'];
        $update->save();
        return back()->with('status', 'Phone Number Updated Successfully');
    }

    public function sendUserEmail()
    {
        if (Auth::check()) {

            return view('admin.user-email');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function sendMail(Request $request)

    {

        if (Auth::check()) {

            $email = $request->input('email');
            //$subject = $request->input('subject');
            $data = [
                'message' => $request->message,
                'subject' => $request->subject,
            ];


            Mail::to($email)->send(new sendUserEmail($data));

            return back()->with('status', 'Email Successfully sent');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function uploadNft()
    {


        return view('admin.nft');
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
        $query->where(function($q) use ($search) {
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
            $query->where(function($q) use ($search) {
                $q->where('nfts.ntf_name', 'like', '%' . $search . '%')
                  ->orWhere('nfts.ntf_owner', 'like', '%' . $search . '%')
                  ->orWhere('nfts.ntf_description', 'like', '%' . $search . '%')
                  ->orWhere('nfts.created_at', 'like', '%' . $search . '%');
            });
        }

        $users_nfts = $query->paginate(10);

        return view('admin.approve_nft', compact('users_nfts'));
    }




    public function nftMarket()
    {
        $data['buy_nft'] =Nft::where('status', '1')->orderBy('updated_at', 'desc')->paginate(12);
        $nft = $data['buy_nft'];
        $eth = $this->procesData($nft);
        return view('admin.nftmarkets', ['buy_nft' => $eth]);
    }
    private function procesData($nft)
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

    public function usersTransaction()
    {
        return view('admin.transactions');
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

    public function allNfts($id)
    {

        $data['nfts']    = DB::table('nfts')->get();
        return view('admin.all_nft', $data);
    }



public function userProfile($id)
{
    // 1. Retrieve the user profile using DB::table and execute the query with `first()`
    $userProfile = DB::table('users')->where('id', $id)->first();

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


    // 4. Fetch Ethereum price from CoinGecko API
    $client = new Client();
    try {
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
            'query' => [
                'ids' => 'ethereum',
                'vs_currencies' => 'usd',
            ],
            'timeout' => 10, // Optional: Set a timeout
        ]);

        $data_price = json_decode($response->getBody(), true);
        $price = $data_price['ethereum']['usd'] ?? 0;

        if ($price == 0) {
            throw new \Exception('Ethereum price not found.');
        }
    } catch (\Exception $e) {
        // Handle API errors gracefully
        return redirect()->back()->with('error', 'Failed to fetch Ethereum price.');
    }

    // 5. Calculate transaction sums
    $deposit = Transaction::where('user_id', $id)
                         ->where('transaction_type', 'Deposit')
                         ->where('status', '1')
                         ->sum('transaction_amount');

    $deposit_eth = $deposit / $price;

    $withdrawal = Transaction::where('user_id', $id)
                             ->where('transaction_type', 'Withdrawal')
                             ->where('status', '1')
                             ->sum('transaction_amount');

    $withdrawal_eth = $withdrawal / $price;

    $add_profit = Transaction::where('user_id', $id)
                             ->where('transaction_type', 'Profit')
                             ->where('status', '1')
                             ->sum('transaction_amount');

    $debit_profit = Transaction::where('user_id', $id)
                               ->where('transaction_type', 'DebitProfit')
                               ->where('status', '1')
                               ->sum('transaction_amount');

    $profit = $add_profit - $debit_profit;
    $profit_eth = $profit / $price;

    $balance = $deposit + $profit - $withdrawal;
    $balance_eth = $balance / $price;

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

        $deposit = new Nft;
        $deposit->user_id = Auth::user()->id;
        $deposit->ntf_name = $request['nft_name'];
        $deposit->nft_price = $request['nft_price'];
        $deposit->ntf_description  = $request['ntf_description'];
        $deposit->ntf_owner = $request['nft_owner'];
        $deposit->status = 1;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('user/uploads/nfts', $filename);
            $deposit->ntf_image =  $filename;
        }

        $full_name =  Auth::user()->name;
        $email =  Auth::user()->email;
        $amount = $request->input('amount');
        $message =  $full_name . " " . $email . " has  just uploaded a new nft, Please Login to your admin dashboard to confirm the transaction ";
        $deposit->save();


        $ref = rand(76503737, 12344994);



        $user = [
            'amount' => $request['nft_price'],
            'name' => $request['nft_name'],
            'status' => 'Pending..',
            'ref' => $ref,
            'message' => $message,
            'full_name' => $full_name,
        ];

        //Mail::to('support@artsygalley.com ')->send(new nftEmail($user)); 
        //Mail::to($email)->send(new nftUserEmail ($user)); 

        return back()->with('status', 'NFT Uploaded Successfully');
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
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $data['message'] = 'old password not correct';
            return back()->with("error", "Old Password Doesn't match! Please input your correct old password");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        Session::flush();
        Auth::guard('web')->logout();
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
        
          if($update)  return response()->json([
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
    $update = DB::table('users')->where('id',$id)->update($user);

   
   
    return back()->with('status', 'user activation_fee Updated Successfully');  
    
}
}
