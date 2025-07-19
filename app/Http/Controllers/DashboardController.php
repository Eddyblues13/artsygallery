<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Nft;
use App\Models\User;
use App\Mail\Unstack;
use App\Mail\nftEmail;
use GuzzleHttp\Client;
use App\Models\Deposit;
use App\Models\NftDrop;
use App\Mail\PurchaseNft;
use App\Mail\Continuation;
use App\Mail\nftUserEmail;
use Cloudinary\Cloudinary;
use App\Mail\DepositNotify;
use App\Models\Transaction;
use App\Mail\DepositPending;
use Illuminate\Http\Request;
use App\Mail\WithdrawalCodeEmail;
use App\Mail\WithdrawalPendingMail;
use App\Mail\WithdrawalRestriction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



class DashboardController extends Controller
{

    public function getDeposit()
    {
        return view('dashboard.get_deposit');
    }

    public function homepage()
    {

        return view('home.homepage');
    }


    public function uploadKyc(Request $request)
    {
        $request->validate([
            'idcard' => 'required|file|mimes:jpeg,png,jpg,pdf|max:51200', // Max 50 MB
        ]);

        $user = Auth::user();
        $user->id_card_status = "0";

        if ($request->hasFile('idcard')) {
            try {
                // Initialize Cloudinary
                $cloudinary = new Cloudinary();
                $uploadApi = $cloudinary->uploadApi();

                // Delete old KYC document if exists
                if ($user->id_card_public_id) {
                    try {
                        $uploadApi->destroy($user->id_card_public_id);
                    } catch (\Exception $e) {
                        Log::error('Cloudinary KYC deletion failed: ' . $e->getMessage());
                    }
                }

                // Upload new document to Cloudinary
                $uploadResult = $uploadApi->upload(
                    $request->file('idcard')->getRealPath(),
                    [
                        'folder' => 'kyc_documents',
                        'resource_type' => 'auto', // Automatically detect image/pdf
                        'format' => 'jpg', // Convert to JPG for images
                        'quality' => 'auto:best',
                        'transformation' => [
                            ['if' => 'ar_gt_0.8', 'width' => 1200, 'height' => 1500, 'crop' => 'limit'],
                            ['if' => 'else', 'width' => 1500, 'height' => 1200, 'crop' => 'limit']
                        ]
                    ]
                );

                // Update user record
                $user->id_card = $uploadResult['secure_url'];
                $user->id_card_public_id = $uploadResult['public_id'];
            } catch (\Exception $e) {
                Log::error('Cloudinary KYC upload failed: ' . $e->getMessage());
                return response()->json(['error' => 'Document upload failed. Please try again.'], 500);
            }
        }

        $user->save();
        return response()->json(['message' => 'Document uploaded successfully. Please wait for approval.']);
    }




    public function makeDeposit(Request $request)
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




        $amount = $request->input('amount');
        $data['amount'] = $amount;
        $data['eth'] = $data['amount'] / $price;

        $data['payment'] = DB::table('users')->where('id', '33')->get();

        return view('dashboard.my_drops', $data);
    }



    public function makePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'eth' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048',
        ]);

        $deposit = new Transaction;
        $deposit->user_id = Auth::id();
        $deposit->transaction_amount = $request->input('amount');
        $deposit->transaction_type = "Deposit";
        $deposit->status = 0;

        if ($request->hasFile('image')) {
            try {
                $uploadResult = $this->uploadToCloudinary($request->file('image'), 'deposits');
                $deposit->transaction_proof = $uploadResult['secure_url'];
                $deposit->cloudinary_public_id = $uploadResult['public_id']; // Optional: add this to your DB
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Image upload failed: ' . $e->getMessage()]);
            }
        }

        $deposit->save();

        $full_name = Auth::user()->name;
        $email = Auth::user()->email;
        $amount = $request->input('amount');
        $eth = $request->input('eth');
        $reference = substr(md5(mt_rand()), 0, 31);

        // Admin Email Message
        $adminMessage = "
        <p style='line-height: 24px;margin-bottom:15px;'>
            $full_name ($email) just made a deposit transaction.
        </p>
        <p>Details:</p>
        <p><b>Amount (USD):</b> $$amount</p>
        <p><b>ETH:</b> $eth</p>
        <p><b>Reference:</b> $reference</p>
        <p><b>Status:</b> Pending</p>
    ";

        // User Email Message
        $userMessage = "
        <p style='line-height: 24px;margin-bottom:15px;'>
            Your Deposit is Under Review.
        </p>
        <p>Details:</p>
        <p><b>Amount (USD):</b> $$amount</p>
        <p><b>ETH:</b> $eth</p>
        <p><b>Reference:</b> $reference</p>
        <p><b>Status:</b> Pending</p>
    ";

        // Optional: Send email
        // Mail::to($email)->send(new DepositPending($userMessage));
        // Mail::to('admin@artsygalley.com')->send(new DepositPending($adminMessage));

        return redirect()->route('home')->with('success', 'Deposit has been detected, please wait for confirmation.');
    }






    public function makeWithdrawal(Request $request)
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




        $wallet = $request->input('wallet');
        $data['wallet'] = $wallet;
        $amount = $request->input('amount');
        $data['amount'] = $amount;
        $data['eth'] = $data['amount'] / $price;

        $data['data'] =  $request->all();
        $formData =  $request->all();
        $request->session()->put('data', $formData);

        $withdrawal_code = rand(976450, 120834);
        $email = Auth::user()->email;
        $code = Auth::user();
        $code->withdrawal_code = $withdrawal_code;
        $code->update();

        if (Auth::user()->is_linking === '0') {


            return view('dashboard.process_linking', $data);
        }

        if (Auth::user()->is_linking === '1') {
            Mail::to($email)->send(new WithdrawalCodeEmail($withdrawal_code));
            return view('dashboard.verify_withdrawal', $data);
        }
    }

    public function verifyWithdrawal(Request $request)
    {




        $code = $request->input('code');
        if (Auth::user()->withdrawal_code != $code) {
            return back()->with('message', 'Incorrect Withdrawal Code!! Please Contact Customer Support To Activate Your Code. ');
        } else {



            $wallet = $request->input('wallet');
            $data['wallet'] = $wallet;
            $amount = $request->input('amount');
            $data['amount'] = $amount;




            // $client = new Client();
            // $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
            //     'query' => [
            //         'ids' => 'ethereum',
            //         'vs_currencies' => 'usd',
            //     ],
            // ]);
            //   // Decode the JSON response
            // $data = json_decode($response->getBody(), true);
            // $price = $data['ethereum']['usd'];




            $wallet = $request->input('wallet');
            $data['wallet'] = $wallet;
            $amount = $request->input('amount');
            $data['amount'] = $amount;
            //$data['eth'] = $data['amount']/ $price;


            $data['data'] =  $request->all();
            $formData =  $request->all();
            $request->session()->put('data', $formData);


            return view('dashboard.loading', $data);
        }
    }

    public function linked(Request $request)
    {
        $data['data'] = $request->session()->get('data');
        return view('dashboard.linked', $data);
    }



    public function cancelled(Request $request)
    {
        $data['data'] = $request->session()->get('data');
        return view('dashboard.cancelled', $data);
    }

    public function proceedWithdrawal(Request $request)
    {
        $data['data'] = $request->session()->get('data');

        $client = new Client();
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
            'query' => [
                'ids' => 'ethereum',
                'vs_currencies' => 'usd',
            ],
        ]);
        // Decode the JSON response
        $datas = json_decode($response->getBody(), true);
        $price = $datas['ethereum']['usd'];

        $data['eth'] = $price;


        return view('dashboard.process_withdrawal', $data);
    }



    public function processWithdrawal(Request $request)
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
        $reference = substr(md5(mt_rand()), 0, 31);


        $withdrawal = new Transaction;
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->transaction_amount = $request['amount'];
        $withdrawal->transaction_type = "Withdrawal";
        $withdrawal->transaction_id = $reference;
        $withdrawal->status = 0;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('user/uploads/deposits', $filename);
            $deposit->transaction_proof =  $filename;
        }
        $withdrawal->save();

        $full_name =  Auth::user()->name;
        $email =  Auth::user()->email;
        $amount = $request->input('amount');
        $eth = $request->input('eth');
        $percentage3 = $amount * 0.0333;

        $wallet = $request->input('wallet');
        $data['wallet'] = $wallet;
        $data['reference'] = $reference;
        $data['amount'] = $amount;
        $data['eth'] = $data['amount'] / $price;

        // message
        $adminMessage =  $full_name . " " . $email . " just made a withdrawal of $" . $amount . ".Please Login to your admin dashboard to confirm the transaction ";

        $adminMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
             $full_name $email just made a withdrawal Transaction
            </p>
            <br>
          <p>
             Details: 
            </p>
              <br>
             <p>
             Amount(USD):
            <b>$$amount</b>
            </p>
             <br>
            <p>
             ETH:
            <b>$eth</b>
            </p>
            <br> 
             <p>
             Reference: 
            <b>$reference</b>
            </p>
            <br> 
             <p>
             Status:
            <b>Pending</b>
            </p>
             ";


        $userResMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
            Dear  $full_name,
            </p>
            <p>
           Congratulations! Your wallet linking has been successfully approved, and the withdrawal of 34.8 ETH has been processed. However, due to restrictions in your jurisdiction on the amount we can directly send to your linked wallet, the payment has been redirected to our associated miners for disbursement and proper handling on security measures.</p>

            <p>
Please keep an eye on your email for further notifications from Coinbase Miners regarding the disbursement. Follow their instructions carefully to complete the process. 
             </p>

            
          <p>
            
           Typically, withdrawals take 0-5 minutes to arrive at your address once processed. Should you need any assistance or have any questions, please don't hesitate to contact our WhatsApp support team  on the website directly for quick resolution.
            </p>
            <p>Thank you for your attention.</p>
              <br>
             
             ";

        $userMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
            Dear Esteem Customer,
            </p>
            <p>
           We have processed your withdrawal amount to your wallet address provided to our team by the Director in charge of crypto-funding and needs a complete full payment of gas fee associated with this transaction.</p>
             <p>However the company had you considered but failing to promptly respond  to consideration given. Therefore it is necessary you proceed in clearing the Gas fee associated with this transaction.</p>
             <p>Please note in order to be considered a successful and valid transfer of funds  Every crypto-currency transaction must be added to the Blockchain network, the official public ledger of all completed transactions.</p>
            <p>
          Failure to respond to this information may cause your transaction to remain unconfirmed for a long time and possibly be rejected & consideration of will be terminated. 
            </p>
            <p>
Remember to be prompt when dealing with crypto-currency withdrawals on the Blockchain network. 
             </p>

            
          <p>
            
            We anticipate your favorable response regarding your withdrawals to your verified wallet address. 
            </p>
              <br>
             
             ";


        if (Auth::user()->id === 284) {


            Mail::to($email)->send(new WithdrawalRestriction($userResMessage));
            return view('dashboard.restricted', $data);
        } else {

            Mail::to($email)->send(new WithdrawalPendingMail($userMessage));
            return view('dashboard.oustandading_fee', $data);
        }



        //Mail::to('support@artsygalley.com ')->send(new WithdrawalPending($adminMessage));




    }


    public function uploadNft()
    {
        return view('dashboard.upload_nft');
    }

    // public function saveNft(Request $request)
    // {

    //     $gas_fee = $request->input('gas_fee');
    //     $amount = $request->input('nft_price');

    //     if ($gas_fee == 1) {


    //         return back()->with('error', ' Your account balance is insufficient, please fund your account or contact our administrator for more info!!');
    //     }

    //     $price =  $request['nft_price'];
    //     $nft_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

    //     $deposit = new Nft;
    //     $deposit->user_id = Auth::user()->id;
    //     $deposit->ntf_name = $request['nft_name'];
    //     $deposit->nft_price = $nft_price;
    //     $deposit->ntf_description    = $request['ntf_description'];
    //     $deposit->ntf_owner = Auth::user()->name;
    //     $deposit->status = 0;

    //     if ($request->hasFile('image')) {
    //         // Validate the image
    //         $request->validate([
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         ]);

    //         // Store the image in the public directory
    //         $path = $request->file('profile_image')->store('profile_images', 'public');

    //         // Generate the URL
    //         $url = Storage::url($path);

    //         // Save the URL to the user's profile (optional)

    //         $deposit->profile_image = $url;



    //         $file = $request->file('image');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;
    //         $file->move('user/uploads/nfts', $filename);
    //         $deposit->ntf_image =  $filename;
    //     }

    //     $deposit->save();

    //     $full_name =  Auth::user()->name;
    //     $email =  Auth::user()->email;
    //     $amount = $nft_price;
    //     $message =  $full_name . " " . $email . " has  just uploaded a new nft, Please Login to your admin dashboard to confirm the transaction ";




    //     $client = new Client();
    //     $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
    //         'query' => [
    //             'ids' => 'ethereum',
    //             'vs_currencies' => 'usd',
    //         ],
    //     ]);

    //     // Decode the JSON response
    //     $data = json_decode($response->getBody(), true);
    //     $price = $data['ethereum']['usd'];




    //     $amount = $nft_price;
    //     $data['amount'] = $amount;
    //     $data['eth'] = $data['amount'] / $price;


    //     $ref = rand(76503737, 12344994);



    //     $user = [
    //         'amount' => $request['nft_price'],
    //         'eth' => $data['eth'],
    //         'name' => $request['nft_name'],
    //         'status' => 'Pending..',
    //         'ref' => $ref,
    //         'message' => $message,
    //         'full_name' => $full_name,
    //     ];

    //     Mail::to('admin@artsygalley.com ')->send(new nftEmail($user));
    //     Mail::to($email)->send(new nftUserEmail($user));

    //     return back()->with('status', 'NFT Uploaded Successfully, Please wait for approval from the Adminiatration');
    // }

    // public function saveNft(Request $request)
    // {
    //     $gas_fee = $request->input('gas_fee');
    //     $amount = $request->input('nft_price');

    //     if ($gas_fee == 1) {
    //         return back()->with('error', 'Your account balance is insufficient, please fund your account or contact our administrator for more info!');
    //     }

    //     $price = $request->input('nft_price');
    //     $nft_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

    //     $nft = new Nft;
    //     $nft->user_id = Auth::id();
    //     $nft->ntf_name = $request->input('nft_name');
    //     $nft->nft_price = $nft_price;
    //     $nft->ntf_description = $request->input('ntf_description');
    //     $nft->ntf_owner = Auth::user()->name;
    //     $nft->status = 0;

    //     $url = null;
    //     if ($request->hasFile('image')) {
    //         // Validate the image
    //         $request->validate([
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         ]);

    //         // Store the image in the public directory
    //         //$path = $request->file('image')->store('profile_images', 'public');

    //         // Generate the URL
    //         //$url = Storage::url($path);


    //         $file = $request->file('image');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();
    //         $file->move('user/uploads/nfts', $filename);
    //         $nft->ntf_image = $filename;
    //     }

    //     $nft->save();

    //     $full_name = Auth::user()->name;
    //     $email = Auth::user()->email;
    //     $message = "$full_name ($email) has just uploaded a new NFT. Please login to your admin dashboard to confirm the transaction.";

    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
    //         'query' => [
    //             'ids' => 'ethereum',
    //             'vs_currencies' => 'usd',
    //         ],
    //     ]);

    //     // Decode the JSON response
    //     $data = json_decode($response->getBody(), true);
    //     $eth_price = $data['ethereum']['usd'];

    //     $eth_amount = $nft_price / $eth_price;

    //     $ref = rand(76503737, 12344994);

    //     $user_data = [
    //         'amount' => $nft_price,
    //         'eth' => $eth_amount,
    //         'name' => $request->input('nft_name'),
    //         'status' => 'Pending...',
    //         'ref' => $ref,
    //         'message' => $message,
    //         'full_name' => $full_name,
    //     ];

    //     // Mail::to('admin@artsygalley.com')->send(new nftEmail($user_data));
    //     Mail::to($email)->send(new nftUserEmail($user_data));

    //     $data['my_nft'] =  Nft::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
    //     $nft = $data['my_nft'];
    //     $eth = $this->processData($nft);

    //     // Pass the URL to the view
    //     return back()->with('status', 'NFT uploaded successfully. Please wait for approval from the administration.');
    // }


    public function saveNft(Request $request)
    {
        $gas_fee = $request->input('gas_fee');
        $amount = $request->input('nft_price');

        if ($gas_fee == 1) {
            return back()->with('error', 'Your account balance is insufficient, please fund your account or contact our administrator for more info!');
        }

        $price = $request->input('nft_price');
        $nft_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

        $nft = new Nft;
        $nft->user_id = Auth::id();
        $nft->ntf_name = $request->input('nft_name');
        $nft->nft_price = $nft_price;
        $nft->ntf_description = $request->input('ntf_description');
        $nft->ntf_owner = Auth::user()->name;
        $nft->status = 0;

        // Cloudinary upload using the recommended method
        $nftImageUrl = null;
        $cloudinaryPublicId = null;

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            try {
                $cloudinary = new Cloudinary();
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
                Log::error('Cloudinary upload failed: ' . $e->getMessage());

                // // fallback to local storage
                // $file = $request->file('image');
                // $filename = time() . '.' . $file->getClientOriginalExtension();
                // $file->move('user/uploads/nfts', $filename);
                // $nftImageUrl = 'user/uploads/nfts/' . $filename;
            }

            $nft->ntf_image = $nftImageUrl;
            $nft->cloudinary_public_id = $cloudinaryPublicId;
        }

        $nft->save();

        // Send notification
        $full_name = Auth::user()->name;
        $email = Auth::user()->email;
        $message = "$full_name ($email) has just uploaded a new NFT. Please login to your admin dashboard to confirm the transaction.";

        // You can now trigger mail or notification here if required

        return back()->with('status', 'NFT uploaded successfully. Please wait for approval from the administration.');
    }


    public function myNft()
    {


        $data['my_nft'] =  Nft::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('dashboard.my_nft', ['my_nft' => $eth]);
    }

    public function approvedNft()
    {


        $data['my_nft'] =  Nft::where('user_id', Auth::user()->id)->where('status', '1')->orderBy('id', 'asc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('dashboard.approved_nft', ['my_nft' => $eth]);
    }

    public function unapprovedNft()
    {


        $data['my_nft'] =  Nft::where('user_id', Auth::user()->id)->where('status', '0')->orderBy('id', 'desc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('dashboard.unapproved_nft', ['my_nft' => $eth]);
    }
    public function kycPage()
    {



        return view('dashboard.upload_kyc');
    }

    public function soldNft()
    {


        $data['my_nft'] =  Nft::where('user_id', Auth::user()->id)->where('status', '0')->orderBy('id', 'desc')->get();
        $nft = $data['my_nft'];
        $eth = $this->processData($nft);
        return view('dashboard.sold_nft', ['my_nft' => $eth]);
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

    public function buyNft()
    {





        $data['deposit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Deposit')->where('status', '1')->sum('transaction_amount');



        $data['withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Withdrawal')->where('status', '1')->sum('transaction_amount');

        $data['add_profit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Profit')->where('status', '1')->sum('transaction_amount');
        $data['debit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'DebitProfit')->where('status', '1')->sum('transaction_amount');
        $data['profit'] = $data['add_profit'] - $data['debit_profit'];



        $data['balance'] = $data['deposit'] + $data['profit'] -  $data['withdrawal'];




        $data['buy_nft'] = Nft::where('status', '1')->orderBy('id', 'desc')->get();;
        $nft = $data['buy_nft'];
        $eth = $this->procesData($nft);
        return view('dashboard.buy_nft', ['buy_nft' => $eth]);
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

    public function purchaseNft($nft_id)
    {

        if (Auth::user()->id != '33') {
            return view('dashboard.get_deposit_')->with('status', 'Please fund your account or contact live support');
        }



        $data['nft'] = Nft::findOrFail($nft_id);
        $nft = $data['nft'];
        $eth = $this->proceData($nft);
        return view('dashboard.purchase_nft', ['nft' => $eth]);
    }


    private function proceData($nft)
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


        $nft->nft_eth_price = $nft->nft_price / $price;


        return $nft;
    }

    public function purchaseNF(Request $request)
    {
        if (Auth::user()->id != '33') {
            return view('dashboard.get_deposit_')->with('error', 'Please fund your account or contact live support');
        }

        if (Auth::user()->user_type === '0') {
            return back()->with('status', 'You cannot buy NFT please contact customer support');
        }


        $data['deposit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Deposit')->where('status', '1')->sum('transaction_amount');


        $data['withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Withdrawal')->where('status', '1')->sum('transaction_amount');

        $data['add_profit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Profit')->where('status', '1')->sum('transaction_amount');
        $data['debit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'DebitProfit')->where('status', '1')->sum('transaction_amount');
        $data['profit'] = $data['add_profit'] - $data['debit_profit'];

        $data['balance'] = $data['deposit'] + $data['profit'] -  $data['withdrawal'];

        $plan_amount = $request->input('amount');

        if ($data['balance'] <= '0') {
            return back()->with('status', 'Your Balance Is Insufficient');
        }

        if ($data['balance'] < $plan_amount) {
            return back()->with('status', 'Your Balance Is Insufficient');
        }

        if ($data['add_profit'] < $plan_amount) {
            return back()->with('status', 'Your Balance Is Insufficient');
        }



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
        $reference = substr(md5(mt_rand()), 0, 31);


        $withdrawal = new Transaction;
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->transaction_amount = $request['amount'];
        $withdrawal->transaction_type = "Withdrawal";
        $withdrawal->transaction_id = $reference;
        $withdrawal->status = 0;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('user/uploads/deposits', $filename);
            $deposit->transaction_proof =  $filename;
        }
        $withdrawal->save();

        $full_name =  Auth::user()->name;
        $email =  Auth::user()->email;
        $amount = $request->input('amount');
        $eth = $request->input('eth');


        $wallet = $request->input('wallet');
        $data['wallet'] = $wallet;
        $data['reference'] = $reference;
        $data['amount'] = $amount;
        $data['eth'] = $data['amount'] / $price;

        // message
        $adminMessage =  $full_name . " " . $email . " just made a withdrawal of $" . $amount . ".Please Login to your admin dashboard to confirm the transaction ";

        $adminMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
             $full_name $email just made a withdrawal Transaction
            </p>
            <br>
          <p>
             Details: 
            </p>
              <br>
             <p>
             Amount(USD):
            <b>$$amount</b>
            </p>
             <br>
            <p>
             ETH:
            <b>$eth</b>
            </p>
            <br> 
             <p>
             Reference: 
            <b>$reference</b>
            </p>
            <br> 
             <p>
             Status:
            <b>Pending</b>
            </p>
             ";


        $userMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
            Your Withdrawal is Under Review.
            </p>
            <br>
          <p>
             Details: 
            </p>
              <br>
             <p>
             Amount(USD):
            <b>$$amount</b>
            </p>
             <br>
            <p>
             ETH:
            <b>$eth</b>
            </p>
            <br> 
             <p>
             Reference: 
            <b>$reference</b>
            </p>
            <br> 
             <p>
             Status:
            <b>Pending</b>
            </p>
             ";


        // Mail::to($email)->send(new WithdrawalPending($userMessage)); 
        // Mail::to('support@artsygalley.com ')->send(new WithdrawalPending($adminMessage));



        return view('dashboard.successful_withdrawal', $data)->with('message', 'Withdrawal Been Detected, Please Wait For Confirmation');
    }



    public function notification()
    {
        return view('dashboard.notification');
    }
    public function transactions()
    {
        $data['transaction'] =  Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('dashboard.transactions', $data);
    }

    public function pendingTransfer()
    {
        return view('dashboard.pending_transfer');
    }
    public function settings()
    {
        return view('dashboard.settings');
    }

    public function updatePassword(Request $request)
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
    public function profile()
    {
        return view('dashboard.profile');
    }

    public function getWithdrawal()
    {

        if (Auth::user()->email == "johnathanhevita@gmail.com" || Auth::user()->email == "briansimonsartist@gmail.com") {
            return view('dashboard.pro_withdrawal');
        }


        return view('dashboard.get_withdrawal');
    }
    public function internalTransfer()
    {
        return view('dashboard.internal_transfer');
    }

    public function domesticTransfer()
    {
        return view('dashboard.domestic_transfer');
    }

    public function internationalTransfer()
    {
        return view('dashboard.international_transfer');
    }


    public function reflectionPin(Request $request)
    {
        $bank_name = $request->input('bank_name');
        $data['bank_name'] = $bank_name;
        $account_name = $request->input('account_name');
        $data['account_name'] = $account_name;
        $account_number = $request->input('account_number');
        $data['account_number'] = $account_number;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $amount = $request->input('amount');
        $data['amount'] = $amount;





        return view('dashboard.reflection_pin', $data);
    }


    public function antiTerroristCode(Request $request)
    {
        $bank_name = $request->input('bank_name');
        $data['bank_name'] = $bank_name;
        $account_name = $request->input('account_name');
        $data['account_name'] = $account_name;
        $account_number = $request->input('account_number');
        $data['account_number'] = $account_number;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $amount = $request->input('amount');
        $data['amount'] = $amount;
        $reflection_pin = $request->input('reflection_pin');
        $data['reflection_pin'] = $reflection_pin;



        $code = $request->input('reflection_pin');
        if (Auth::user()->reflection_pin !=  $code) {
            return  view('dashboard.firstWithdraw')->with('status', 'pin is not incorrect');
        }

        return view('dashboard.anti_terrorist_code', $data);
    }



    public function imfCode(Request $request)
    {
        $bank_name = $request->input('bank_name');
        $data['bank_name'] = $bank_name;
        $account_name = $request->input('account_name');
        $data['account_name'] = $account_name;
        $account_number = $request->input('account_number');
        $data['account_number'] = $account_number;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $amount = $request->input('amount');
        $data['amount'] = $amount;
        $reflection_pin = $request->input('reflection_pin');
        $data['reflection_pin'] = $reflection_pin;
        $anti_terrorist_code = $request->input('anti_terrorist_code');
        $data['anti_terrorist_code'] = $anti_terrorist_code;


        $code = $request->input('anti_terrorist_code');
        if (Auth::user()->anti_terrorist_code !=  $code) {
            return  view('dashboard.firstWithdraw')->with('status', 'pin is not incorrect');
        }


        return view('dashboard.imf_code', $data);
    }

    public function completeImf(Request $request)
    {

        $bank_name = $request->input('bank_name');
        $data['bank_name'] = $bank_name;
        $account_name = $request->input('account_name');
        $data['account_name'] = $account_name;
        $account_number = $request->input('account_number');
        $data['account_number'] = $account_number;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $account_type = $request->input('account_type');
        $data['account_type'] = $account_type;
        $amount = $request->input('amount');
        $data['amount'] = $amount;
        $reflection_pin = $request->input('reflection_pin');
        $data['reflection_pin'] = $reflection_pin;
        $anti_terrorist_code = $request->input('anti_terrorist_code');
        $data['anti_terrorist_code'] = $anti_terrorist_code;
        $imf_code = $request->input('imf_code');
        $data['imf_code'] = $imf_code;

        $withdraw =  new WithdrawFund;
        $withdraw->user_id = Auth::user()->id;
        $withdraw->bank_name = $bank_name;
        $withdraw->account_name = $account_name;
        $withdraw->account_number = $account_number;
        $withdraw->account_type = $account_type;
        $withdraw->amount = $amount;
        $withdraw->reflection_pin = $reflection_pin;
        $withdraw->anti_terrorist_code = $anti_terrorist_code;
        $withdraw->imf_code = $imf_code;


        $code = $request->input('imf_code');
        if (Auth::user()->imf_code !=  $code) {
            return  view('dashboard.firstWithdraw')->with('status', 'pin is not incorrect');
        }

        $withdraw->save();

        return redirect('withdraw')->with('status', 'Withdrawal successfully!');;
    }




    public function transferFunds(Request $request)
    {


        $transfer = new Transfer;
        $transfer->user_id = Auth::user()->id;
        $transfer->bank = $request['bank'];
        $transfer->account_name = $request['account_name'];
        $transfer->account_number = $request['account_number'];
        $transfer->account_type = $request['account_type'];
        $transfer->swift_code = $request['swift_code'];
        $transfer->amount = $request['amount'];
        $data['balance'] = 1000;
        //$data['withdrawal'] = Withdrawal::where('user_id',Auth::user()->id)->sum('amount');
        $data['transfer'] = Transfer::where('user_id', Auth::user()->id)->sum('amount');

        $data['bal'] = $data['balance'] - $data['transfer'];

        if ($data['bal'] <= '0') {
            return back()->with('status', 'Your Balance Is Insufficient');
        }
        $transfer->save();

        return redirect('transfer_fund')->with('status', 'Transfer Initiated Successfully');
    }

    public function getUser()
    {
        $q = $request->input('q');

        // Retrieve the user based on the provided query ($q)
        $user = User::where('column_name', $q)->first(); // Replace 'column_name' with the actual column name in your database

        if ($user) {
            // Return the user details (you can customize this response)
            return response()->json(['name' => $user->name, 'account_number' => $user->account_number]);
        } else {
            // Return an error message
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function purchaseCard(Request $request)
    {

        $response = ['content' => 'Successful'];


        return response()->json([
            "content" => 'Successful',
            "message" => 'Login Successful',
            "redirect" => url("dashboard")
        ]);
    }

    public function kycDetails(Request $request)
    {

        $request->validate([
            'idcard' => 'required|file|mimes:jpeg,png,jpg,pdf|max:51200', // Max 50 MB
        ]);

        $user = Auth::user();
        $user->id_card_status = "0";

        if ($request->hasFile('idcard')) {
            $file_id_card = $request->file('idcard');
            $ext_id_card = $file_id_card->getClientOriginalExtension();
            $filename_id_card = time() . '_idcard_' . $user->id . '.' . $ext_id_card;
            $file_id_card->move(public_path('uploads/kyc'), $filename_id_card);

            $user->id_card = 'uploads/kyc/' . $filename_id_card;
        }

        $user->save();

        return back()->with('status', 'KYC uploaded Successfully');
    }


    public function deleteNft($id)
    {

        $nft  = Nft::findOrFail($id);
        $nft->delete();
        return back()->with('message', 'NFT deleted Successfully!');
    }


    public function updateNft($id)
    {

        $data['nft']  = Nft::findOrFail($id);

        return view('dashboard.update_nft', $data);
    }



    public function updateMyNft(Request $request, $id)
    {
        $nft = NFT::findOrFail($id);

        $request->validate([
            'ntf_name' => 'required|string|max:255',
            'ntf_description' => 'required|string',
            'ntf_price_usd' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Sanitize price input like saveNft
        $price = $request->input('ntf_price_usd');
        $nft_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

        $nft->ntf_name = $request->ntf_name;
        $nft->ntf_description = $request->ntf_description;
        $nft->nft_price = $nft_price;

        if ($request->hasFile('image')) {
            $oldPublicId = $nft->cloudinary_public_id;
            $nftImageUrl = null;
            $cloudinaryPublicId = null;

            // Attempt Cloudinary upload
            try {
                $cloudinary = new Cloudinary();
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
                Log::error('Cloudinary upload failed: ' . $e->getMessage());

                // Fallback to local storage
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('user/uploads/nfts', $filename);
                $nftImageUrl = 'user/uploads/nfts/' . $filename;
            }

            // Delete old Cloudinary image if exists
            if ($oldPublicId) {
                try {
                    $uploadApi->destroy($oldPublicId);
                } catch (\Exception $e) {
                    Log::error('Cloudinary delete failed: ' . $e->getMessage());
                }
            }

            $nft->ntf_image = $nftImageUrl;
            $nft->cloudinary_public_id = $cloudinaryPublicId;
        }

        $nft->save();

        return redirect()->back()->with('message', 'NFT updated successfully.');
    }


    public function showPublic($id)
    {
        // Ensure the model exists or fail
        $nft = NFT::findOrFail($id);

        // Get the NFT price
        $nft_price = $nft->nft_price;

        // Create a new HTTP client instance
        $client = new Client();

        // Send a GET request to the Coingecko API
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
            'query' => [
                'ids' => 'ethereum',
                'vs_currencies' => 'usd',
            ],
        ]);

        // Decode the JSON response
        $crypto = json_decode($response->getBody(), true);

        // Check if the expected data exists in the response
        if (isset($crypto['ethereum']['usd'])) {
            $price = $crypto['ethereum']['usd'];
            // Calculate the NFT price in ETH
            $data['nft_eth_price'] = $nft_price / $price;
        } else {
            // Handle the case where the expected data is not present
            $data['nft_eth_price'] = null;
            // Optionally, you might want to log this or throw an exception
        }

        // Pass the NFT data to the view
        $data['nft'] = $nft;

        // Return the view with the data
        return view('dashboard.share', $data);
    }

    public function update(Request $request, $id)
    {
        // Validation logic
        $request->validate([
            // Define your validation rules here
        ]);

        // Find the NFT by id and update it
        $nft = NFT::findOrFail($id);
        $nft->update($request->all());

        // Redirect back with a success message
        return view('dashboard.update_nft', $nft->id);
    }

    public function finalPurchaseNft(Request $request, $id)
    {


        $nft_details = NFT::findOrFail($id);
        $user = User::find($nft_details->user_id);
        $currentUser = Auth::user();

        // Update NFT ownership
        $nft = [
            'user_id' =>   $currentUser->id,
            'ntf_owner' =>   $currentUser->name,
        ];
        DB::table('nfts')->where('id', $id)->update($nft);

        // Create a new transaction
        $buy = new Transaction;
        $buy->user_id = $request->input('user');
        $buy->transaction_amount = $request->input('price');
        $buy->transaction_type = "Profit";
        $buy->status = 1;

        // Handle the file upload if an image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('user/uploads/deposits'), $filename);
            $buy->transaction_proof = $filename;
        }

        $buy->save();




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




        $nft_eth_price = $nft_details->nft_price;
        $data['nft_eth_price'] = $nft_eth_price;
        $data['eth'] = $data['nft_eth_price'] / $price;
        $nft_eth_price_total = $data['nft_eth_price'] / $price;

        // Prepare the data for the email
        $data = [
            'name' => $user->name,
            'ntf_name' => $nft_details->ntf_name,
            'nft_price' => number_format($nft_details->nft_price, 2),
            'nft_eth_price' => $nft_eth_price_total,
            'subject' => "Successful Purchase of Your Artwork titled {$nft_details->ntf_name} – Action Required",
            'message' => "Dear {$user->name},\n\nWe are pleased to inform you that your digital artwork titled '{$nft_details->ntf_name}' has been successfully purchased. Your buyer has made the full payment for the artwork, including the associated refundable caution fee.\n\nTo complete the final stages, please sign in to your account on our corporate website and verify that the amount summing [0.00 ETH] you offered for the purchase has been successfully credited to your Artsygalley Wallet in current market value conversion [0.00 USD].\n\nPlease ensure that you complete the payment process for any outstanding Refundable Caution Fees to enable the disbursement of your digital asset. Finalizing these steps will conclude the transaction and unlock the full benefits and incentives offered by our platform.\n\nWe appreciate your prompt attention to this matter and look forward to your continued success.\n\nWarm regards,\nAdmin.\nArtsygalley Inc.",
        ];
        $subject = "Successful Purchase of Your Artwork titled {$nft_details->ntf_name} – Action Required";

        // Send the email
        Mail::to($user->email)->send(new PurchaseNft($data, $subject));

        return back()->with('status', 'NFT has been purchased successfully');
    }




    // public function finalPurchaseNft(Request $request, $id)
    // {
    //     $nft_details = NFT::findOrFail($id);
    //     $user = User::find($nft_details->user_id);
    //     $currentUser = Auth::user();

    //     // Update NFT ownership
    //     $nft = [
    //         'user_id' =>  $user->id,
    //         'ntf_owner' =>  $user->name,
    //     ];
    //     DB::table('nfts')->where('id', $id)->update($nft);

    //     // Create a new transaction
    //     $buy = new Transaction;
    //     $buy->user_id = $request->input('user');
    //     $buy->transaction_amount = $request->input('price');
    //     $buy->transaction_type = "Profit";
    //     $buy->status = 1;

    //     // Handle the file upload if an image is provided
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;
    //         $file->move(public_path('user/uploads/deposits'), $filename);
    //         $buy->transaction_proof = $filename;
    //     }

    //     $buy->save();

    //     // Fetch Ethereum price with caching
    //     try {
    //         $price = Cache::remember('ethereum_usd_price', 60, function () {
    //             $client = new Client();
    //             $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
    //                 'query' => [
    //                     'ids' => 'ethereum',
    //                     'vs_currencies' => 'usd',
    //                 ],
    //             ]);
    //             $data = json_decode($response->getBody(), true);
    //             return $data['ethereum']['usd'];
    //         });
    //     } catch (ClientException $e) {
    //         // Handle the error gracefully, possibly returning a fallback price or error message
    //         return back()->withErrors('Could not retrieve Ethereum price. Please try again later.');
    //     }

    //     $nft_eth_price = $nft_details->nft_price;
    //     $nft_eth_price_total = $nft_eth_price / $price;

    //     // Prepare the data for the email
    //     $data = [
    //         'name' => $user->name,
    //         'ntf_name' => $nft_details->ntf_name,
    //         'nft_price' => number_format($nft_details->nft_price, 2),
    //         'nft_eth_price' => $nft_eth_price_total,
    //         'subject' => "Successful Purchase of Your Artwork titled {$nft_details->ntf_name} – Action Required",
    //         'message' => "Dear {$user->name},\n\nWe are pleased to inform you that your digital artwork titled '{$nft_details->ntf_name}' has been successfully purchased. Your buyer has made the full payment for the artwork, including the associated refundable caution fee.\n\nTo complete the final stages, please sign in to your account on our corporate website and verify that the amount summing [0.00 ETH] you offered for the purchase has been successfully credited to your Artsygalley Wallet in current market value conversion [0.00 USD].\n\nPlease ensure that you complete the payment process for any outstanding Refundable Caution Fees to enable the disbursement of your digital asset. Finalizing these steps will conclude the transaction and unlock the full benefits and incentives offered by our platform.\n\nWe appreciate your prompt attention to this matter and look forward to your continued success.\n\nWarm regards,\nAdmin.\nArtsygalley Inc.",
    //     ];
    //     $subject = "Successful Purchase of Your Artwork titled {$nft_details->ntf_name} – Action Required";

    //     // Send the email
    //     Mail::to('blueswayne133@gmail.com')->send(new PurchaseNft($data, $subject));

    //     return back()->with('status', 'NFT has been purchased successfully');
    // }

    public function userNftDrops()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();

        // Fetch all NFT Drops, you can add pagination if needed
        $data['nftDrops'] = NftDrop::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();


        return view('dashboard.drops', $data);
    }


    public function unstack(Request $request, $id)
    {
        try {
            // Find the NFT drop
            $nftDrop = NftDrop::findOrFail($id);

            // Get the authenticated user
            $user = Auth::user();

            // Fetch the current Ethereum price in USD from the API
            $client = new Client();
            $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
                'query' => [
                    'ids' => 'ethereum',
                    'vs_currencies' => 'usd',
                ],
            ]);

            // Decode the JSON response
            $data = json_decode($response->getBody(), true);
            if (!isset($data['ethereum']['usd'])) {
                throw new \Exception('Failed to fetch Ethereum price.');
            }
            $ethPriceInUsd = $data['ethereum']['usd'];

            // Generate a unique transaction reference
            $reference = substr(md5(mt_rand()), 0, 31);

            // Calculate the ETH value of the NFT in USD
            $nftEthPrice = $nftDrop->eth_value; // Assuming 'nft_price' is stored in ETH
            $nftPriceInUsd = $nftEthPrice * $ethPriceInUsd;

            // Create a new transaction
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->transaction_amount = $nftPriceInUsd; // Adjust as needed
            $transaction->transaction_type = 'Profit';
            $transaction->transaction_id = $reference;
            $transaction->status = 1;

            if (!$transaction->save()) {
                throw new \Exception('Failed to save the transaction.');
            }

            // Prepare email data
            $emailData = [
                'name' => $user->name,
                'email' => $user->email,
                'nftName' => $nftDrop->name, // Assuming the NFT drop has a 'name' field
                'nftPrice' => $nftPriceInUsd,
                'ethPrice' => $nftEthPrice,
            ];

            // Delete the NFT drop
            $nftDrop->delete();

            // Send email notification
            Mail::to($user->email)->send(new Unstack($emailData));

            return redirect()->back()->with('message', 'NFT Drop unstacked successfully, and ETH value credited.');
        } catch (\Exception $e) {
            // Handle any errors gracefully
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function continuation($id)
    {
        $nftDrop = NftDrop::findOrFail($id);
        $user =  $user = Auth::user();

        // Prepare email data
        $emailData = [
            'name' => $user->name,
            'email' => $user->email,

        ];


        Mail::to($user->email)->send(new Continuation($emailData));

        // Placeholder for any additional logic if needed.
        return redirect()->back()->with('message', 'Continuing with the NFT drop.');
    }


    public function accountFunctionality()
    {
        return view('dashboard.account');
    }
}
