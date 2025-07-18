<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Admin\NftDropController;



Auth::routes();


Route::get('/', [HomePageController::class, 'homepage'])->name('homepage');
Route::get('about', [HomePageController::class, 'about'])->name('about');
Route::get('contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('drop', [HomePageController::class, 'drop'])->name('drop');
Route::get('what-are-nfts', [HomePageController::class, 'what'])->name('what');
Route::get('how-to-buy-nft', [HomePageController::class, 'how'])->name('how');
Route::get('what-are-nft-drops', [HomePageController::class, 'drops'])->name('drops');
Route::get('what-is-cryptocurrency', [HomePageController::class, 'whatIsCryptocurrency'])->name('what-is-cryptocurrency');
Route::get('what-is-crypto-wallet', [HomePageController::class, 'whatIsCryptoWallet'])->name('what-is-crypto-wallet');
Route::get('what-is-blockchain', [HomePageController::class, 'whatIsBlockchain'])->name('what-is-blockchain');
Route::get('nft-gas-fees', [HomePageController::class, 'nftGasFees'])->name('nft-gas-fees');
Route::get('what-is-web3', [HomePageController::class, 'whatIsWeb3'])->name('what-is-web3');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('verify', [CustomAuthController::class, 'verify'])->name('verify');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('user_auth')->name('dashboard');
Route::get('home', [CustomAuthController::class, 'dashboard'])->middleware('user_auth')->name('home');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('verify/{id}', [CustomAuthController::class, 'verify'])->name('verify');
Route::post('email-verify', [CustomAuthController::class, 'emailVerify'])->name('code');
Route::get('resend-code/{id}', [CustomAuthController::class, 'resendCode'])->name('resendCode');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register-user');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('log_out', [CustomAuthController::class, 'signOut'])->name('logout');
Route::get('/logout', [CustomAuthController::class, 'logOut'])->name('logOut');
Route::post('support-email', [CustomAuthController::class, 'supportEmail'])->name('support.email');






//User Dashboard routes
Route::get('deposit', [DashboardController::class, 'getDeposit'])->middleware('user_auth')->name('get.deposit');
Route::get('deposit_', [DashboardController::class, 'getDeposit_'])->middleware('user_auth')->name('get.deposit_');
Route::post('make-deposit', [DashboardController::class, 'makeDeposit'])->middleware('user_auth')->name('make.deposit');
Route::post('make-payment', [DashboardController::class, 'makePayment'])->middleware('user_auth')->name('make.payment');
Route::get('upload_nft', [DashboardController::class, 'uploadNft'])->middleware('user_auth')->name('upload.nft');
Route::post('save_nft', [DashboardController::class, 'saveNft'])->middleware('user_auth')->name('save.nft');
Route::get('my_nft', [DashboardController::class, 'myNft'])->middleware('user_auth')->name('my.nft');
Route::get('approved_nft', [DashboardController::class, 'approvedNft'])->middleware('user_auth')->name('approved.nft');
Route::get('unapproved_nft', [DashboardController::class, 'unapprovedNft'])->middleware('user_auth')->name('unapproved.nft');
Route::get('sold_nft', [DashboardController::class, 'soldNft'])->middleware('user_auth')->name('sold.nft');
Route::match(['get', 'post'], 'buy_nft', [DashboardController::class, 'buyNft'])->middleware('user_auth')->name('buy.nft');
Route::get('purchase_nft/{id}/', [DashboardController::class, 'purchaseNft'])->middleware('user_auth')->name('purchase.nft');
Route::get('kyc_page', [DashboardController::class, 'kycPage'])->middleware('user_auth')->name('kyc.page');
Route::post('/upload-kyc', [DashboardController::class, 'uploadKyc']);
Route::post('purchase_nft', [DashboardController::class, 'purchaseNF']);
Route::post('change-password', [DashboardController::class, 'updatePassword'])->name('update-password');
Route::get('notification', [DashboardController::class, 'notification'])->middleware('user_auth')->name('notification');
Route::get('transactions', [DashboardController::class, 'transactions'])->middleware('user_auth')->name('transactions');
Route::get('pending-transfer', [DashboardController::class, 'pendingTransfer'])->middleware('user_auth')->name('pending-transfer');
Route::get('settings', [DashboardController::class, 'settings'])->middleware('user_auth')->name('settings');
Route::get('make_withdrawal', [DashboardController::class, 'getWithdrawal'])->middleware('user_auth')->name('withdrawal');
Route::get('linked', [DashboardController::class, 'linked'])->middleware('user_auth')->name('linked');
Route::match(['get', 'post'], 'make-withdrawal', [DashboardController::class, 'makeWithdrawal'])->name('make.withdrawal');
Route::post('verify-withdrawal', [DashboardController::class, 'verifyWithdrawal'])->name('verify.withdrawal');
Route::post('process-withdrawal', [DashboardController::class, 'processWithdrawal'])->name('process.withdraw');
Route::get('proceed-withdrawal', [DashboardController::class, 'proceedWithdrawal'])->middleware('user_auth')->name('proceed.withdraw');
Route::get('cancelled', [DashboardController::class, 'cancelled'])->middleware('user_auth')->name('cancelled');
Route::get('profile', [DashboardController::class, 'profile'])->middleware('user_auth')->name('profile');
Route::match(['get', 'post'], 'upload-kyc', [DashboardController::class, 'kycDetails'])->name('kyc.details');
Route::match(['get', 'post'], 'final_purchase_nft/{id}/', [DashboardController::class, 'finalPurchaseNft'])->name('final.purchase.nft');
Route::put('/nft/update/{id}', [DashboardController::class, 'update'])->name('update-nft');
Route::match(['get', 'post'], 'delete-nft/{id}/', [DashboardController::class, 'deleteNft'])->name('delete.nft');
Route::match(['get', 'post'], 'update-nft/{id}/', [DashboardController::class, 'updateNft'])->name('update.nft');
Route::put('nft/update/{id}', [DashboardController::class, 'updateMyNft'])->name('nft.update');
Route::get('nft-purchase/{id}', [DashboardController::class, 'showPublic'])->name('nft.public');
Route::get('user-nft-drops', [DashboardController::class, 'userNftDrops'])->name('user.nft.drops');
Route::post('/nft-drops/{id}/unstack', [DashboardController::class, 'unstack'])->name('nft-drops.unstack');
Route::post('/nft-drops/{id}/continuation', [DashboardController::class, 'continuation'])->name('nft-drops.continuation');
Route::get('account-functionality', [DashboardController::class, 'accountFunctionality'])->name('account.functionality');
Route::get('/wallet/update', [WalletController::class, 'edit'])->name('wallet.edit');
Route::put('/wallet/update', [WalletController::class, 'update'])->name('wallet.update');


// Admin Controller

Route::get('users', [AdminController::class, 'users'])->middleware('user_auth')->name('view.users');
Route::get('update_wallet', [AdminController::class, 'eth'])->middleware('user_auth')->name('update.wallet');
Route::get('update_WhatsAppApi', [AdminController::class, 'updateWhatsAppApi'])->middleware('user_auth')->name('update.whatsapp');
Route::get('admin_upload_nft', [AdminController::class, 'uploadNft'])->middleware('user_auth')->name('admin.upload.nft');
Route::get('uploaded-nfts', [AdminController::class, 'allNfts'])->middleware('user_auth')->name('users.uploaded.nft');
Route::post('admin_save_nft', [AdminController::class, 'adminSaveNft'])->name('admin.save.nft');
Route::get('user_transactions', [AdminController::class, 'usersTransaction'])->name('user.transaction');
Route::get('admin_nft_market', [AdminController::class, 'nftMarket'])->middleware('user_auth')->name('admin.buy.nft');
Route::post('admin_update_wallet', [AdminController::class, 'updateWallet'])->name('admin.save.wallet');
Route::post('admin_update_whatsapp', [AdminController::class, 'updateWhatsapp'])->name('admin.save.whatsapp');
Route::post('transfer', [AdminController::class, 'transferFunds'])->name('transfer-fund');
Route::post('reflection-pin', [AdminController::class, 'reflectionPin'])->name('reflection');
Route::get('/profile/{id}/', [AdminController::class, 'userProfile'])->middleware('user_auth');
Route::get('/delete/{id}', [AdminController::class, 'deleteUser'])->middleware('user_auth');
Route::get('admin-change-password', [AdminController::class, 'adminChangePassword'])->middleware('user_auth')->name('admin.change.password');
Route::post('admin-change-password', [AdminController::class, 'adminUpdatePassword'])->middleware('user_auth')->name('admin.update.password');
Route::get('admin-approve-nft', [AdminController::class, 'adminApproveNft'])->middleware('user_auth')->name('admin.approve.nft');
Route::get('user_approved_nft/{id}/', [AdminController::class, 'userApprovedNft'])->middleware('user_auth')->name('user.approved.nft');
Route::get('user_unapproved_nft/{id}/', [AdminController::class, 'userUnapprovedNft'])->middleware('user_auth')->name('user.unapproved.nft');
Route::get('user_sold_nft/{id}/', [AdminController::class, 'userSoldNft'])->middleware('user_auth')->name('user.sold.nft');
Route::match(['get', 'post'], 'approve-nft/{id}/', [AdminController::class, 'ApproveNft'])->name('approve.nft');
Route::match(['get', 'post'], 'approve-withdrawal/{id}/', [AdminController::class, 'ApproveWithdrawal'])->name('approve.withdrawal');
Route::match(['get', 'post'], 'approve-deposit/{id}/', [AdminController::class, 'ApproveDeposit'])->name('approve.deposit');
Route::match(['get', 'post'], 'decline-withdrawal/{id}/', [AdminController::class, 'declineWithdrawal'])->name('decline.withdrawal');
Route::match(['get', 'post'], 'decline-deposit/{id}/', [AdminController::class, 'declineDeposit'])->name('decline.deposit');

Route::match(['get', 'post'], 'approve-id_card/{id}/', [AdminController::class, 'ApproveId'])->name('approve.id');

Route::match(['get', 'post'], 'add-profit', [AdminController::class, 'addProfit'])->name('add.profit');
Route::match(['get', 'post'], 'withdrawal-code/{id}/', [AdminController::class, 'withdrawalCode'])->name('withdrawal.code');
Route::match(['get', 'post'], 'debit-profit', [AdminController::class, 'debitProfit'])->name('debit.profit');
Route::get('send-user-email', [AdminController::class, 'sendUserEmail'])->middleware('user_auth')->name('send.user.email');
Route::match(['get', 'post'], 'send-mail', [AdminController::class, 'sendMail'])->name('send.mail');
Route::match(['get', 'post'], 'use_linking_withdrawal/{id}/', [AdminController::class, 'useLinking'])->name('use_linking_withdrawal');
Route::match(['get', 'post'], 'none_linking_withdrawal/{id}/', [AdminController::class, 'noneLinking'])->name('none_linking_withdrawal');
Route::get('search-nft', [AdminController::class, 'searchNft'])->name('search-nfts');
Route::match(['get', 'post'], 'update_activation_fee/{id}/', [AdminController::class, 'updateActivationFee'])->name('update.activation_fee');
Route::put('/users/{user}/toggle-wallet-verify', [AdminController::class, 'toggleWalletVerify'])
    ->name('toggle.wallet.verify'); // Ensure proper middleware


// Admin Routes Group
Route::prefix('admin')->name('admin.')->middleware(['auth', 'user_auth'])->group(function () {
    Route::resource('nft-drops', NftDropController::class);
    // web.php
    Route::get('/user-search', [NftDropController::class, 'search'])->name('user.search');
});
