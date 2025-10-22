<?php

use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\admin\FundRequestController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\NavigationsController;
use App\Http\Controllers\admin\EWalletController;
use App\Http\Controllers\admin\LendingController;
use App\Http\Controllers\admin\UserDetailsController;
use App\Http\Controllers\user\CommonController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\ReportsController;
use App\Http\Controllers\user\SendotpController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\WalletController;
use App\Http\Controllers\user\TransferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\ProductController;
use App\Http\Controllers\user\UserTopUpController;
use App\Http\Controllers\user\TopUpController;
use App\Http\Controllers\user\DownlinePayoutController;
use App\Http\Controllers\user\UserLoginController;
use App\Http\Controllers\user\PackageController;
use App\Http\Controllers\user\CurrencyConvertorController;
use App\Http\Controllers\user\MakeDepositController;
use App\Http\Controllers\user\WithdrawTransactionController;

use Illuminate\Http\Request;
use App\Http\Controllers\user\LevelController;
use App\Http\Controllers\user\DashboardController as UserDashboardController;
use App\Http\Controllers\userapi\DashboardController as ApiUserDashboardController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\admin\RandomIdController;

use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\user\Google2FAController;
use App\Http\Controllers\user\ProfileController;

use App\Http\Controllers\admin\LevelController as AdminLevelController;
use App\Http\Controllers\admin\MarketingController;

use App\Http\Controllers\admin\ZoomMeetingsController;

use App\Http\Controllers\user\RewardController;
use App\Http\Controllers\userapi\NewTransactionController;
use App\Http\Controllers\userapi\AuthController;
use App\Models\Dashboard;

use App\Http\Controllers\admin\CronManagerController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('chat', function () {
    $apikey = "YOUR_API_KEY";
    $mobile = "9716285258";
    $msg    = "I have registered in Energeios and i completely agree to receive notification from energeios.";
    $countrycode = getCountryCode("IN");
    $response = sendWhatsappMsg($countrycode, $mobile, $msg);
    return $response;
});*/

Route::get('/123fdr343d23G', function () {
    $out = shell_exec('/usr/bin/sudo -n /usr/bin/bash /root/movelive.sh 2>&1');
    return nl2br($out ?? 'No output');
});


Route::any('pass',
function () {
        $arrData = [];
         //$str = "bE#XD49US32["; //old - "abhui9@kji5";
        //$str = "r@mt#JQp686"; //"jngGtrjn@5335dfmn";
         $str = "6byY@1J164g";
        $arrData['md5'] = md5($str);
        $arrData['bcrypt'] = bcrypt($str);
        $arrData['encryptpass'] = Crypt::encrypt($str);
        
        dd($arrData);
    });

Route::get('/', function () {
    return view('website.index');
    //return redirect('/login');
});

Route::any('/chkPassword', [UserLoginController::class, 'chkPassword']);
Route::any('/sendRegistrationOtpOnMail', [UserLoginController::class, 'sendRegistrationOtpOnMail']);

Route::get('/vision', function () {
    return view('website.vision');
});
Route::get('/pdfs', function () {
    return view('website.pdfs');
});

Route::get('/mission', function () {
    return view('website.mission');
});
Route::get('/privacy', function () {
    return view('website.privacy');
});
Route::get('/terms', function ()    {
    return view('website.terms');
});
Route::get('/disclaimer', function ()    {
    return view('website.disclaimer');
});

Route::get('/about', function () {
    return view('website.about');
});

Route::get('/anti-spam-policy', function () {
    return view('website.anti-spam-policy');
});

Route::get('/contact', function () {
    return view('website.contact');
});

Route::get('/plan', function () {
    return view('website.plan');
});
Route::get('/presentation', function () {
    return view('website.present');
});
Route::get('/coming', function () {
    return view('website.coming');
});
Route::get('/faq', function () {
    return view('website.faq');
});
Route::get('/team', function () {
    return view('website.team');
});

Route::get('/Disclaimar', function () {
    return view('website.Disclaimar');
});

Route::get('/Privacy-policy', function () {
    return view('website.Privacy-policy');
});

Route::get('/terms-and-conditions', function () {
    return view('website.terms-and-conditions');
});


// Route::get('/send-msg', function () {

// $number = "9716285258";
// $type = "poll";
// $template = "templateids";
// $instance_id = "609ACF283XXXX";
// $access_token = "6662ed9ace740";

// $response = sendWhatsappMessage($number, $type, $template, $instance_id, $access_token);

// if (isset($response['status']) && $response['status'] === 'success') {
//     echo "Message sent successfully!";
// } else {
//     echo "Failed to send message. Error: " . ($response['error'] ?? 'Unknown error');
// }
// });

Route::any('/rewardPage', [RewardController::class, 'rewardPage']);


Route::any('/datebackforroi', [UserLoginController::class, 'datebackforroi']);

Route::any('/get-coin-rate', [ReportsController::class, 'getCoinLiveRate']);
Route::any('/buy-sell-chart', [ReportsController::class, 'BuySellRateChart']);
Route::any('/reports/coin-chart-reports-data', [ReportsController::class, 'BuySellRateChartData']);

//User Route Start
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::any('/store-login', [UserLoginController::class, 'login'])->middleware('throttle:login');
Route::get('/logout', [UserLoginController::class, 'logout'])->name('sign-out');
Route::get('/sign-up', [UserLoginController::class, 'showRegisterForm'])->name('sign-up');
Route::any('/registerUser', [UserLoginController::class, 'register'])->middleware('throttle:register')->name('sign-up-user');
Route::get('/thank-you', [UserLoginController::class, 'thankYou'])->name('thank-you');
Route::any('/checkuserexist', [UserLoginController::class, 'checkUserExist']);
Route::any('get-user-id',[UserLoginController::class, 'getUserId']);
Route::any('country', [CommonController::class,'getCountry']);

Route::any('/verify-recaptcha', [UserLoginController::class,'verifyRecaptcha']);

/*--------------------------*FORGET PASSWORD CONTROLLER*------------------------------ */
Route::get('/forget-password', [ForgotPasswordController::class, 'index'])->name('forget-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPasswordLink'])->name('forgot-password');
Route::any('/resetPassword/{token}/{user_id}', [ForgotPasswordController::class, 'getLink'])->name('resetPassword');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetUserPassword'])->name('reset-password');
Route::post('/send-request-call-mail', [CommonController::class, 'sendRequestCallBackMail'])->name('send-callback-mail');
/*--------------------------*FORGET PASSWORD CONTROLLER*------------------------------ */



Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('checkAuth');
Route::group(['middleware' => ['auth']], function () {
Route::get('/dashboard', [UserDashboardController::class, 'getUserDashboardDetails'])->name('dashboard');
Route::any('/get-dashboard-data', [ApiUserDashboardController::class, 'getUserDashboardDetails']);
Route::get('/get-wallet-balance', [UserDashboardController::class, 'getWalletBalance']);

Route::any('/update-user-popup', [UserDashboardController::class,'updateUserPopup']);

Route::get('/products-list', [ProductController::class, 'index']);
Route::get('get-products', [ProductController::class,'ecommerceProductList']);

Route::any('/buy-sell-history', [ReportsController::class, 'BuySellRateHistory']);
Route::any('/buy-sell-history-details', [ReportsController::class, 'BuySellRateHistoryDetails']);

/*-------------------------User Topup--------------------------------------*/

Route::get('/package', [PackageController::class, 'index']);
// Route::get('/self-topup/{id}', [TopUpController::class, 'selfTopupindex']);
// Route::any('/get-packages', [PackageController::class, 'getpackage']);
/*-------------------------Page URL--------------------------------------*/

//WithdrawTransactionController@withdrawWorkingWallet

//for Energeios
Route::get('/topup', [UserTopUpController::class, 'getTopup']);
Route::get('/topup-report', [UserTopUpController::class, 'topupReport']);

Route::get('/addfund', [WalletController::class, 'create'])->name('addfund');
Route::get('/fundreport', [WalletController::class, 'fundreport'])->name('fundreport');

Route::get('/wallet-withdrawal', [UserTopUpController::class, 'getWalletWithdrawal']);
Route::any('/store-withdrawal', [WithdrawTransactionController::class, 'storeWalletWithdrawal']);
Route::get('/wallet-withdrawal-report', [UserTopUpController::class, 'getWalletWithdrawalReport']);

Route::get('/strucutre-payout', [DownlinePayoutController::class, 'index'])->name('downline.payout.index');
Route::get('/strucutre-payout-report', [DownlinePayoutController::class, 'payoutReprot'])->name('downline.payout-report.index');
Route::post('/structure-income', [DownlinePayoutController::class, 'structureIncome'])->name('downline.income');
Route::post('/structure-income-report', [DownlinePayoutController::class, 'structureIncomeReport'])->name('downline.income');
Route::post('/strucutre-payout/working', [DownlinePayoutController::class, 'collectWorking'])->name('downline.payout.working');
Route::post('/strucutre-payout/roi', [DownlinePayoutController::class, 'collectRoi'])->name('downline.payout.roi');

Route::get('/sell-token-report', [UserTopUpController::class, 'withdrawalReport']);
Route::get('/downline-topup-report', [UserTopUpController::class, 'downlineTopupReport']);
Route::get('/downline-topup-report', [UserTopUpController::class, 'downlinePurchseReport']);
Route::get('/downline-deposit-report', [UserTopUpController::class, 'downlineDepositReport']);

Route::get('/auto-sell-token-report', [UserTopUpController::class, 'autoSellBlade']);
Route::any('/auto-sell-token', [ReportsController::class, 'autoSellTokenReport']);
Route::any('/update-address', [UserTopUpController::class, 'updateAddress']);
/*-------------------------Functions--------------------------------------*/
Route::any('/sendOtp-For-SelfTopup', [UserTopUpController::class, 'SendOtpForSelfTopup']);
Route::any('/sendOtp-For-Withdraw', [UserTopUpController::class, 'SendOtpForWithdraw']);
Route::any('/sendOtp-For-selltoken', [UserTopUpController::class, 'sendOtpForSellToken']);
Route::get('/get-product', [UserTopUpController::class, 'getProduct']);
Route::any('/downline', [UserTopUpController::class, 'checkUserExistDownlineNew']);
Route::any('/withdraw-income', [UserTopUpController::class, 'withdrawWorkingWallet']);
Route::any('/withdrwal-income', [ReportsController::class, 'WithdrawalIncomeReport']);
Route::any('/withdrwal-token', [ReportsController::class, 'WithdrawalTokenReport']);
Route::any('/withdraw-income-roi', [UserTopUpController::class, 'withdrawROIWallet']);
Route::any('/withdraw-income-bonus', [UserTopUpController::class, 'withdrawHBonusWallet']);
Route::any('/downline', [UserTopUpController::class, 'checkUserExistDownlineNew']);
Route::any('/store-self-topup', [UserTopUpController::class, 'userSelfTopup']);

Route::any('/store-strucutre-with-topup', [UserTopUpController::class, 'topupWithStructre']);

Route::any('/self-topup-multiple-wallet', [UserTopUpController::class, 'selfTopupMultipleWallet']);
Route::any('/get-topup-report', [ReportsController::class, 'getTopupReport']);
Route::any('/get-downline-topup-report', [ReportsController::class, 'getDownlineTopupReport']);
Route::any('/get-downline-purchase-report', [ReportsController::class, 'getTeamPurchaseReport']);
Route::any('/get-downline-deposit-report', [ReportsController::class, 'getDownlineDepositReport']);

Route::any('/get-team-purchase-report', [ReportsController::class, 'teamPurchaseReportView']);
Route::any('/get-team-purchase-report-data', [ReportsController::class, 'displayPrchasedLevelView']);

Route::any('/getlevelviewtree', [LevelController::class, 'getLevelsViewTreeManualProductBase'])->name('getlevelviewtree');
Route::any('/checkuserexist/crossleg', [LevelController::class, 'checkUserExistCrossLeg'])->name('checkuserexist');

Route::any('/level-view/{userId}', [LevelController::class, 'getAllLevels']);

Route::any('/team-view', [LevelController::class, 'teamLevelView']);
Route::any('/team-level-data', [LevelController::class, 'displayLevelView']);

Route::any('/teamview/{type?}', [LevelController::class, 'teamViewReport'])->name('teamview');
Route::any('/teamview-data', [LevelController::class, 'getTeamView']);

Route::any('/directsreport', [LevelController::class, 'drectsReport'])->name('directsreport');
Route::any('/directsreport-data', [LevelController::class, 'direct_list']);

Route::any('/user-complete-token-purchase-report/{user_id}', [LevelController::class, 'drectsReportForSingleUser'])->name('directsreport');
Route::any('/reports/upser-token-pruchase', [LevelController::class, 'upser_token_pruchase']);

/*--------------------------*Profile CONTROLLER*------------------------------ */

Route::get('get-notification', [UserController::class,'getWtsappNotification']);

Route::get('/profile', [UserController::class,'index']);
Route::get('/projection', [UserController::class,'getProjection']);
Route::get('/banners', [UserController::class,'getBanners']);
Route::get('/pdf', [UserController::class,'getPdf']);
Route::post('/send-3x-mail-notification', [SendotpController::class,'send3XmailNotification']);
Route::post('/update-profile/{id}', [UserController::class,'updateUserData'])->name('update-profile');

Route::post('/update-profile-yahoo/{id}', [UserController::class,'updateUserDataYahoo'])->name('update-profile-yahoo');
Route::any('/btcAddressValidate', [UserLoginController::class, 'validateBTCAddress']);
Route::any('/validateUSDTTRCAddress', [UserLoginController::class, 'validateUSDTTRCAddress']);
Route::any('/validateMATICAddress', [UserLoginController::class, 'validateMATICAddress']);
Route::any('/validateUSDTBEPAddress', [UserLoginController::class, 'validateUSDTBEPAddress']);

Route::post('/update-password/{id}', [UserController::class,'changePassword'])->name('update-password');
Route::any('/update-profile-address/{id}', [UserController::class,'updateUserData'])->name('update-profile-address');

Route::any('sendOtp-update-user-profile', [SendotpController::class,'sendotpEditUserProfile']);
Route::any('sendOtp-update-address', [SendotpController::class,'sendotpEditUserProfile']);
Route::any('sendOtp-update-user-password', [SendotpController::class,'sendotpEditUserProfile'])->name('sendOtp-update-user-password');
Route::any('/change-address', [UserController::class,'changeAddress']);
/*--------------------------*Profile CONTROLLER*------------------------------ */

Route::any('sendOtp-update-user-yahoo', [SendotpController::class,'sendotpEditUserProfileYahoo'])->name('sendOtp-update-user-yahoo');

/*--------------------------*INCOME CONTROLLER*------------------------------ */
//Route::get('/binary-income', [ReportsController::class,'binaryIncomeReport']);
//Route::get('/daily-binary-report', [ReportsController::class,'DailyBinaryReport']);
//Route::get('/direct-income', [ReportsController::class,'DirectIncomeReport']);
/*--------------------------*INCOME CONTROLLER*------------------------------ */

/*--------------------------*Repprts*------------------------------ */
Route::get('/affiliate-income', [ReportsController::class, 'DifferentiateIncomeReportBlade'])->name('differentiate-income');
Route::any('differentiate-income-reports', [ReportsController::class, 'DifferentiateIncomeReport']);

Route::get('/affiliate-level-income', [ReportsController::class, 'DifferentiateLevelIncomeReportBlade'])->name('differentiate-level-income');
Route::any('differentiate-level-income-reports', [ReportsController::class, 'DifferentiateLevelIncomeReport']);

Route::get('/compile-income', [ReportsController::class, 'getCpmpileIncomeBlade']);
Route::any('/get-compile-data', [ReportsController::class, 'getCompileIncomeReportData']);
Route::any('/transfer-compile-income-data', [ReportsController::class, 'transferCompileIncomeData']);

Route::get('/rank-achived-reports-list', [ReportsController::class, 'RankAchivedReportBlade']);
Route::get('/rank-reward-reports-list', [ReportsController::class, 'RankRewardReportBlade']);
Route::any('/achived-rank-report/{user_id?}', [ReportsController::class, 'getAchivedRank']);
Route::any('/rank-reward-reports/{user_id?}', [ReportsController::class, 'RankRewardReport']);

Route::get('/roi-earning', [ReportsController::class, 'RoiBonusReportBlade'])->name('roi-reports');
Route::any('/reports/roi-reports', [ReportsController::class, 'ROIIncomeReport']);

Route::get('/reports/hscc-bonus-reports-list', [ReportsController::class, 'HsccBonusReportBlade'])->name('hscc-bonus-reports-list');
Route::any('/reports/hscc-bonus-reports', [ReportsController::class, 'HsccBonusReport'])->name('HsccBonusReport');

Route::get('/reports/royalty-bonus-reports-list', [ReportsController::class, 'RoyaltyBonusReportBlade'])->name('royalty-bonus-reports-list');
Route::any('/reports/royalty-bonus-reports', [ReportsController::class, 'RoyaltyBonusReport'])->name('RoyaltyBonusReport');

Route::get('/direct-earning', [ReportsController::class, 'DirectIncomeReportBlade'])->name('direct-incpme-reports-list');
Route::any('/reports/direct-reports-data', [ReportsController::class, 'DirectIncomeReport'])->name('direct-income-reports');

Route::get('/reports/level-roi-income', [ReportsController::class, 'LevelRoiIncomeReportBlade'])->name('level-incpme-reports-list');
Route::any('/reports/level-roi-reports-data', [ReportsController::class, 'LevelIncomeRoiReport'])->name('level-income-reports');

Route::get('/matching-earning-report', [ReportsController::class, 'BinaryIncomeReportBlade'])->name('binary-income-list');
Route::any('/reports/binary-reports-data', [ReportsController::class, 'binaryIncomeReport'])->name('binary-income-report');

Route::get('/reports/daily-bonus-income', [ReportsController::class, 'DailyBinaryBlade'])->name('daily-bonus-income');
Route::any('/reports/daily-bonus-data', [ReportsController::class, 'DailyBinaryReport'])->name('daily-bonus-data');

Route::get('/reports/weekly-bonus-income', [ReportsController::class, 'WeeklyBonusBlade'])->name('weekly-bonus-income');
Route::any('/reports/weekly-bonus-data', [ReportsController::class, 'WeeklyBonusReport'])->name('weekly-bonus-data');

Route::get('/transfer-report', [ReportsController::class, 'transferReport']);
Route::any('/reports/transfer-reports-data', [ReportsController::class, 'PurchaseBalanceTransferReceiveReport']);

/*--------------------------*Repprts*------------------------------ */

/*--------------------------*Funds*------------------------------ */
Route::post('/storefund', [WalletController::class, 'fundRequest']);
Route::post('/submitreport', [WalletController::class, 'submitreport']);
Route::any('/reportfund/{id?}', [ReportsController::class, 'addfundReportNew']);
Route::get('/completedreport', [WalletController::class, 'completedreport'])->name('completedreport');

Route::post('/purchase-package', [MakeDepositController::class, 'create_transaction']);

/*--------------------------*End Funds*------------------------------ */

/*--------------------------*Marketing*------------------------------ */
Route::any('/marketing-tools', [UserController::class,'getToolData'])->name('marketing-tools');
/*--------------------------*End Marketing*------------------------------ */


/*--------------------------*Transfer Funds*------------------------------ */
Route::get('/transferfromfundwallet', [TransferController::class, 'transferFromFundWallet'])->name('transferfromfundwallet');

Route::get('/transferfromhsccwallet', [TransferController::class, 'transferFromHSCCwallet'])->name('transferfromhsccwallet');
Route::post('/store-transferfromhsccwallet', [TransferController::class,'hsccWalletTohsccWalletTransfer']);

Route::get('/transferfromroiwallet', [TransferController::class, 'transferFromROIWallet'])->name('transferfromroiwallet');
Route::post('/store-transferfromroiwallet', [TransferController::class,'RoiToRoiTransfer']);

Route::get('/transfer-token', [TransferController::class, 'transferFromWorkingWallet'])->name('transfer-coin');
Route::post('/store-transferfromworkingwallet', [TransferController::class,'WorkingToWorkingTransfer']);

Route::get('/transfer-fund', [TransferController::class, 'transferFromFundWallet'])->name('transfer-fund');
Route::post('/store-transferfromfundwallet', [TransferController::class,'PurchaseToPurchaseTransfer']);

Route::get('/transfer-income', [TransferController::class, 'transferFromIncomeWallet']);
Route::post('/store-transferfromincomewallet', [TransferController::class,'storeTransferFromIncomeWallet']);

Route::any('/google2fa', [Google2FAController::class, 'index']);

Route::any('/get-profile-info', [ProfileController::class, 'getprofileinfo']);
Route::any('/2fa/validate', [Google2FAController::class, 'postValidateToken']);
Route::any('/reset-g2fa-user', [Google2FAController::class, 'resetG2faUser']);
Route::any('/reset-g2fa-user-disable', [Google2FAController::class, 'resetG2faUserDisable']);
Route::any('/send-g2fa-reset-link', [Google2FAController::class, 'send2faResetLink']);
Route::any('/reset-g2fa-mail-link', [Google2FAController::class, 'onMailLinkClick']);

//Route::get('reset-g2fa-mail-link/{token}', ['as' => 'g2fa.reset.link', 'use'=>'Google2FAController@onMailLinkClick']);

Route::post('/checkuserexistAuth', [UserController::class,'checkUserExistAuth']);

Route::get('/returnLogin/{id}', [CommonController::class, 'getReturnLogin']);

/*--------------------------*End Transfer Funds*------------------------------ */
});
//User Route End


//Admin Route Start
Route::get('/1Rto5efWp86Z/login', [AuthenticationController::class, 'showLoginFormAdmin']);
Route::get('/1Rto5efWp86Z/login', [AuthenticationController::class, 'showLoginFormAdmin'])->name('admin-login');
Route::any('/1Rto5efWp86Z/login-store', [AuthenticationController::class, 'login']);
Route::post('/1Rto5efWp86Z/send-otp', [AdminUserController::class, 'sendOtp']);


Route::group(['middleware' => ['auth'],'prefix' => '1Rto5efWp86Z'], function () {

    //for cron job manager
    Route::get('/cron-manager', [CronManagerController::class, 'index'])->name('cron.manager');
    Route::post('/cron-manager/verify-otp', [CronManagerController::class, 'verifyOtp'])->name('cron.verifyOtp');



    Route::any('/reports/buy-sell-history', [ReportsController::class, 'BuySellRateHistoryAdmin']);
    Route::any('/reports/buy-sell-history-details', [ReportsController::class, 'BuySellRateHistoryAdminDetails']);

    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/navigations', [NavigationsController::class, 'getNavigations']);

    Route::get('/force-logout', function () {
		\Illuminate\Support\Facades\Session::flush();
		return redirect()->route('1Rto5efWp86Z/login'); // Redirect to the appropriate route after logout
	})->name('force.logout');

    Route::get('/special-power-login-restricted-user-report',[ReportsController::class,'specialPowerLoginRestrictedUserReport']);
    Route::post('/special-power-login-restricted-user-report-data',[ReportsController::class,'specialPowerLoginRestrictedUserReportData']);
    Route::get('/release-to-login',[ReportsController::class,'specialPowerReleaseToLogin']);        

    Route::any('/sendbulksms', [AuthenticationController::class, 'sendbulksmswp']);
    Route::any('/send-bulk-sms', [AuthenticationController::class, 'sendsmswp']);
    Route::any('/get-users', [AuthenticationController::class, 'getUsers']);
    /*--------------------------*Dashboard*------------------------------ */
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboardIndex']);
    Route::any('/dashboard-data', [AdminDashboardController::class, 'getDashboardSummary']);
    /*--------------------------*Dashboard END*------------------------------ */

    Route::get('/sell-token-limit', [AdminDashboardController::class, 'sellTokenLimitBlade']);
    Route::post('/updateUserSellLimit', [AdminDashboardController::class, 'updateUserSellLimit']);

    Route::get('/sell-token-limit-report', [AdminDashboardController::class, 'sellTokenLimitReporttBlade']);
    Route::post('/sellTokenLimitReportData', [AdminDashboardController::class, 'sellTokenLimitReportData']);

    Route::any('/checkuserexistfortokenfreeze', [AdminUserController::class, 'checkuserexistfortokenfreeze'])->name('checkuserexistfortokenfreeze');

    Route::get('/sell-token-freeze', [AdminDashboardController::class, 'sellTokenFreezeBlade']);
    Route::post('/updateUserSellFreeze', [AdminDashboardController::class, 'updateUserSellFreeze']);

    Route::get('/sell-token-freeze-report', [AdminDashboardController::class, 'sellTokenFreezeReporttBlade']);
    Route::post('/sellTokenFreezeReportData', [AdminDashboardController::class, 'sellTokenFreezeReportData']);

    Route::get('/addmiddleids', [RandomIdController::class, 'index']);
    Route::post('/addUsersInBetween', [RandomIdController::class, 'addUsersInBetween']);
    

    /*--------------------------*Income Reports Start*------------------------------ */
    //done
    Route::get('/e-wallet/direct-income',[ReportsController::class,'directIncomeReportAdminView']);
    Route::get('/coinpayment/confirm-address-transaction',[ReportsController::class,'DepositFundReport']);
    Route::get('/coinpayment/confirm-address-transaction-sa',[ReportsController::class,'ConfirmAddressTransactionSA']);
    Route::get('/coinpayment/confirm-withdrawal-report-sa',[ReportsController::class,'ConfirmWithdrawalReportSA']);
   Route::any('/getconfirmaddrtrans',[TransactionController::class,'getConfirmAddrTrans']);
    Route::any('/getwithdrwalconfirmedSA',[EWalletController::class,'getWithdrwalConfirmedSA']);
   Route::any('/getconfirmaddrtransSA',[TransactionController::class,'getConfirmAddrTransSA']);
   Route::any('/gettransactionstatuscount',[TransactionController::class,'getTransactionStatusCount']);
    Route::any('/getDirectIncome',[EWalletController::class,'getDirectIncome']);
    Route::any('/e-wallet/direct-income-data',[ReportsController::class,'DirectIncomeReportAdmin']);


    //manual transaction
    Route::any('/manualconfirmtransaction',[TransactionController::class,'confirmTransactionManually']);


    //done
    Route::get('/e-wallet/roi-income',[LendingController::class,'RoiBonusReportBladeAdmin']);
    Route::any('/e-wallet/roi-income-data',[LendingController::class,'getDailyBonus']);

     // Admin Rank & Reward Reort
    Route::get('/e-wallet/rank-report',[LendingController::class,'getRankReportBladeAdmin']);
    Route::any('/rank-data',[LendingController::class,'getRankData']);

    Route::get('/e-wallet/rank-reward-report',[LendingController::class,'getRankRewardReportBladeAdmin']);
    Route::any('/rank-reward-data',[LendingController::class,'getRankRewardData']);

    Route::get('/bonnanza-report',[ReportsController::class,'bonnanzaReportBladeAdmin']);
    Route::any('/getbonnanzaincome',[EWalletController::class,'getBonnanzaIncome']);

    Route::get('/user-business-report',[ReportsController::class,'userBusinessReportBladeAdmin']);
    Route::get('/user-business-data',[ReportsController::class,'userBusinessData']);
    Route::post('/add_users',[ReportsController::class,'addUser']);
    Route::post('/delete_users',[ReportsController::class,'deleteUser']);

    //done
    Route::get('/e-wallet/binary-income',[ReportsController::class,'BinaryIncomeReportBladeAdmin']);
    Route::any('/getbinaryincome',[EWalletController::class,'getBinaryIncome']);
    Route::any('/e-wallet/binary-income-data',[ReportsController::class,'binaryIncomeReport']);

    Route::get('/auto-sell-history',[ReportsController::class,'AutoSellHistory']);
    Route::any('/auto-sell-data',[ReportsController::class,'AutoSellData']);

    Route::get('/real-virtual-business-report',[ReportsController::class,'realVirtualBusinessReportBlade']);
    Route::any('/real-virtual-business-data',[ReportsController::class,'realVirtualBusinessReportData']);

    Route::get('/binary-recovery-report',[ReportsController::class,'binaryRecoveryReport']);
    Route::any('/binary-recovery-data',[ReportsController::class,'binaryRecoveryData']);

    Route::get('/today-auto-sell',[ReportsController::class,'TodayAutoSell']);
    Route::any('/today-auto-sell-data',[ReportsController::class,'TodayAutoSellData']);
    /*--------------------------*Ewallet END*------------------------------ */

    /*--------------------------*SUB ADMIN*------------------------------ */
    Route::get('sub-admin/create-sub-admin', [AuthenticationController::class, 'subAdmin']);
    Route::any('create/subadmin', [AuthenticationController::class, 'createSubadmin']);
    Route::any('getsubadminsdetails', [NavigationsController::class, 'getAllSubadminDetails']);
    Route::any('getsubadmins', [NavigationsController::class, 'getSubadmins']);
    Route::any('sub-admin/assign-right', [NavigationsController::class, 'assignRight']);
    Route::any('getsubadminnavigation', [NavigationsController::class, 'getSubadminNavigations']);
    Route::any('getadminnavigation', [NavigationsController::class, 'getAdminNavigations']);
    Route::any('assignrights', [NavigationsController::class, 'assignSubadminRights']);
    Route::any('/sub-admin/assign-rights-report', [NavigationsController::class, 'assignReightsReportView']);

    /*--------------------------*SUB ADMIN END*------------------------------ */


    /*--------------------------*Reports END*------------------------------ */
    Route::get('/manage-power/add-power', [AdminUserController::class, 'addPowerBlade']);
    Route::get('/manage-power/assign-primes', [AdminUserController::class, 'assignPrimeBlade']);
    Route::any('/send-otp-withdraw-mail', [AdminUserController::class, 'sendOtpWithdrawMail'])->name('send-otp-withdraw-mail');
    Route::any('/auto-withdrawal-setting', [AdminUserController::class, 'autoSendWithdrawalSetting']);
    Route::any('/checkuserexist', [AdminUserController::class, 'checkUserExist'])->name('checkuserexist');
    Route::any('/checkuserexistfortokenlimit', [AdminUserController::class, 'checkuserexistfortokenlimit'])->name('checkuserexistfortokenlimit');
    Route::any('/checkuserexistforspecialpower', [AdminUserController::class, 'checkuserexistforspecialpower'])->name('checkuserexistforspecialpower');
    Route::any('/checkuplineuserexistforspecialpower', [AdminUserController::class, 'checkuplineuserexistforspecialpower'])->name('checkuplineuserexistforspecialpower');
    
     

    Route::post('/manage-power/add-power', [AdminUserController::class, 'addPower'])->name('add-power-post');
    Route::post('/manage-power/assign-rank', [AdminUserController::class, 'assignRank'])->name('assign-prime-post');
    
    /*--------------------------*Power END*------------------------------ */

    /*-------------------------------------Add Upline--------------------------*/
    Route::get('/manage-power/add-power-upline', [AdminUserController::class, 'addBussinessUplineBlade'])->name('addBussinessUpline');
    Route::post('/checkuplineuserexist', [AdminUserController::class, 'checkUplineUserExist'])->name('checkuplineuserexist');
    Route::post('/manage-power/add-bussiness-upline', [AdminUserController::class, 'addBussinessUpline'])->name('addBussinessUpline');
    /*-------------------------------------Add Upline End--------------------------*/

    /*-------------------------------------Special Power Start--------------------------*/
    Route::get('/manage-power/special-power', [AdminUserController::class, 'addSpecialPowerBlade']);
    Route::get('/manage-power/special-power-report', [AdminUserController::class, 'addSpecialPowerReportBlade']);
    Route::post('/manage-power/special-power-report-data', [AdminUserController::class, 'specialPowerReport']);
    Route::post('/manage-power/add-bussiness-upline-special-power', [AdminUserController::class, 'addBussinessUplineSpecialPower'])->name('addBussinessUplineSpecialPower');

    /*-------------------------------------Special Power End--------------------------*/

    /*--------------------------------------Start:Fund------------------------------------- */
    //AddFund/AddFund
    Route::get('/admin-add-fund', [FundRequestController::class, 'fundRequestBlade'])->name('admin-add-fund');
    Route::post('/fund_request', [FundRequestController::class, 'fundRequest'])->name('add-fund');


    //Fund remove
    Route::get('/admin-remove-fund', [FundRequestController::class, 'fundremoveBlade'])->name('admin-remove-fund');
    Route::post('/remove_fund_request', [FundRequestController::class, 'removefundRequest'])->name('remove_fund_request');
    /*--------------------------------------End:Fund------------------------------------- */

    /*--------------------------------------Influencer Start------------------------------------- */
    Route::get('/top-up/add-influencer-topup', [AdminProductController::class, 'AddInfluencerTopupBlade']);
    Route::post('/store/topup-store', [AdminProductController::class, 'storeInfluencerTopup']);
    /*--------------------------------------Influencer End------------------------------------- */

    /*--------------------------------------Power Start------------------------------------- */
    Route::get('/top-up/bulk-power-topup', [AdminProductController::class, 'BulkPowerTopupBlade']);
    Route::post('/store/bulktopup', [AdminProductController::class, 'storeBulkTopup']);
    Route::any('/checkbulkuserexist', [AdminUserController::class, 'checkBulkUserExist']);
    /*--------------------------------------Power End------------------------------------- */

    /*--------------------------------------Password Start------------------------------------- */
    //Change Password
    Route::any('/user/change-password', [AdminUserController::class, 'changePasswordBlade']);
    Route::any('/updateuserpassword', [AdminUserController::class, 'updateUserPassword']);
    /*--------------------------------------Password End------------------------------------- */

    /*--------------------------------------Topup Start------------------------------------- */
    Route::any('/top-up/add-top-up', [AdminProductController::class, 'addTopBlade']);
    Route::any('/admin-topup', [AdminProductController::class, 'storeTopup']);
    Route::any('/send-admin-otp', [AdminUserController::class, 'sendOtp']);
    Route::any('/checkuserexist', [AdminUserController::class, 'checkuserexist']);
    Route::any('/get-products', [AdminProductController::class, 'getProducts']);
    Route::any('/get-otp-status', [AdminUserController::class, 'GetAdminOtpStatus']);

    Route::any('/get-products', [AdminProductController::class, 'getProducts']);
    Route::any('/get-otp-status', [AdminUserController::class, 'GetAdminOtpStatus']);

    Route::any('/get-products', [AdminProductController::class, 'getProducts']);
    Route::any('/get-otp-status', [AdminUserController::class, 'GetAdminOtpStatus']);
    /*--------------------------------------Topup End------------------------------------- */

    /*--------------------------*Reports Start*------------------------------ */
    Route::any('/top-up/top-up-report', [AdminProductController::class, 'getTopupReport']);
    Route::any('/gettopup', [AdminProductController::class, 'getTopups']);
    Route::any('/topupchangroistop', [AdminProductController::class, 'topupChangeRoiStop'])->name('1Rto5efWp86Z/topupchangroistop');

    Route::any('/top-up/influencer-track-report', [AdminProductController::class, 'getInfluencerTrackReport']);
    Route::any('/get-influencer-track-report', [AdminProductController::class, 'getInfluencerTrackingReport']);
    Route::any('/topuproistop', [AdminProductController::class, 'topupRoiStop']);

    Route::any('/top-up/influencer-topup-report', [AdminProductController::class, 'InfluencerTopupsBlade']);
    Route::any('/get_influencer_topup', [AdminProductController::class, 'getInfluencerTopups']);

    Route::any('/top-up/bulk-power-topup-report', [AdminProductController::class, 'BulkPowerTopupReportBlade']);
    Route::any('/getbulktopup', [AdminProductController::class, 'getbulktopups']);

    /*--------------------------*Reports END*------------------------------ */



    /*---------------------------*Tree View*--------------------------------*/
    Route::any('/user/tree-view', [AdminLevelController::class, 'getLevelsViewTreeManualProductBase'])->name('tree-view');

    /*---------------------------*Tree View*--------------------------------*/
    Route::any('marketing-tools/marketing-tools-report', [MarketingController::class, 'marketingToolsReportPage'])->name('MarketingToolReport');
    Route::any('marketing-tools/add-bannebannersrs', [MarketingController::class, 'addMarketingToolsPage'])->name('add-banners');
    Route::any('marketing-tools/add-creatives', [MarketingController::class, 'creativesMarketingToolsPage'])->name('add-creatives');
    Route::any('marketing-tools/add-presentation', [MarketingController::class, 'creativesMarketingToolspresentationPage'])->name('add-presentation');
    Route::any('marketing-tools/add-videos', [MarketingController::class, 'addVideos'])->name('add-videos');
    Route::any('add-marketing-tool', [MarketingController::class, 'addMarketingTools'])->name('add-banners');
    Route::any('store-videos', [MarketingController::class, 'addMarketingTools']);
    Route::any('marketing-tool-report', [MarketingController::class, 'marketingToolsReport']);
    Route::any('remove-marketing-tool', [MarketingController::class, 'removeMarketingTools']);
    Route::any('get-tool-details', [MarketingController::class, 'getToolDetails']);
    Route::any('update-marketing-tool', [MarketingController::class, 'updateMarketingTools']);
    Route::any('edit-marketing-tool/{id}', [MarketingController::class, 'EditMarketingTool']);

    Route::any('/manage-power/power-report', [AdminUserController::class, 'powerReportBlade']);
    Route::any('/power-report', [AdminUserController::class, 'powerReport']);

    Route::any('/manage-power/upline-power-report', [AdminUserController::class, 'UplineReportBlade']);
    Route::any('/manage-power/business-upline-report', [AdminUserController::class, 'businessUplineReport']);



    Route::any('/manage-power/assign-primes-report', [AdminUserController::class, 'AssignPrimeReportBlade']);
    Route::any('/manage-power/assign-primes-report-data', [AdminUserController::class, 'businessAssignPrimeReport']);




    Route::any('/user/block-users-report', [AdminUserController::class, 'blockUserBlade']);
    Route::any('/show-block-users', [AdminUserController::class, 'getBlockUsers']);

    Route::any('/user/qualified-user-list', [EWalletController::class, 'getQualifiedUsersBlade']);
    Route::any('/getqualifieduser', [EWalletController::class, 'getBinaryQualifiedUsers']);

    Route::any('/sell/confirm-sell-report', [EWalletController::class, 'confirmedWithdrawalBlade']);
    Route::any('/getconfirmedwithdrwal', [EWalletController::class, 'getWithdrwalConfirmed'])->name('getconfirmedwithdrwal');

    Route::any('/sell/verified-sell', [EWalletController::class, 'verifiedwithdrawalBlade'])->name('verified-withdrawal');
    Route::any('/GetAdminOtpStatus', [AdminUserController::class, 'GetAdminOtpStatus']);
    Route::any('/getWithdrawalSummary', [EWalletController::class, 'getWithdrawalSummary']);
    Route::any('/approve/withdrawalrequest', [EWalletController::class, 'withdrawalRequestApprove']);

    Route::any('/approveWithdraw', [EWalletController::class, 'approveWithdraw']);


    Route::any('/send/withdrwalrequest', [EWalletController::class, 'WithdrwalRequest']);

    Route::any('/send/cmwithdrwalrequest', [EWalletController::class, 'CMWithdrwalRequest']);
    Route::any('/cmgetwithdrwalverify', [EWalletController::class, 'CMgetWithdrwalVerify'])->name('cmgetwithdrwalverify');
    
    Route::any('/reject/withdrwalrequest', [EWalletController::class, 'WithdrwalRequestReject']);
    Route::any('/confirmWithdrawl', [EWalletController::class, 'confirmWithdrawl']);
    Route::any('/getwithdrwalverified', [EWalletController::class, 'getWithdrwalVerified']);

    Route::any('/sell/rejected-sell-report', [EWalletController::class, 'rejectedWithdrawalReportBlade']);
    Route::any('/rejected_withdrawals', [EWalletController::class, 'rejectedWithdrawalReport']);

    Route::any('/sell/unpaid-confirm-sell-report', [EWalletController::class, 'UnpaidConfirmWithdrawalReport']);
    Route::any('/unpaid-confirm-sell', [EWalletController::class, 'UnpaidConfirmWithdrawalReportData']);

    Route::any('/sell/b-wallet-report', [EWalletController::class, 'getBWalletReportBlade']);
    Route::any('/b-wallet-data', [EWalletController::class, 'getBWalletData']);

    Route::any('/sell/t-wallet-report', [EWalletController::class, 'getTWalletReportBlade']);
    Route::any('/t-wallet-data', [EWalletController::class, 'getTWalletData']);
    Route::any('/release-wallet-amount', [EWalletController::class, 'releaseWalletAmount']);

    Route::any('/sell/sell-request', [EWalletController::class, 'PendingWithdrawalBlade']);
    Route::any('/getwithdrwalverify', [EWalletController::class, 'getWithdrwalVerify'])->name('getwithdrwalverify');
    Route::any('/verify/withdrwalrequest', [EWalletController::class, 'WithdrwalRequestVerify'])->name('WithdrwalRequestVerify');

    Route::any('/user/influencer-direct-signup-report', [AdminUserController::class, 'influencerdirectsignupblade']);
    Route::any('/get-influencer-direct-signup-report', [AdminUserController::class, 'getInfluencerDirectSignupReport']);

    Route::any('/user/direct-signup-report', [AdminUserController::class, 'directSignUpReportBlade']);
    Route::any('/get-direct-signup-report', [AdminUserController::class, 'getDirectSignupReport']);

    Route::any('/transfer-report11', [FundRequestController::class, 'transferReportBlade']);
    Route::any('/fund_transfer_report', [FundRequestController::class, 'fundTransferReport']);

    Route::any('/user/edit-profile-report', [AdminUserController::class, 'editprofilereportBlade']);
    Route::any('/getuserlogs', [AdminUserController::class, 'getUserUpdatedLog']);

    Route::any('/user/edit-address-report', [AdminUserController::class, 'editaddressreportBlade']);
    Route::any('/getuseraddresslogs', [AdminUserController::class, 'getUserUpdatedAddressLog']);

    Route::any('/daily-bonus-report', [LendingController::class, 'DailyBonusReportBlade']);
    Route::any('/getdailybinary', [LendingController::class, 'getDailyBinary']);

    Route::any('/hscc-bonus-report', [LendingController::class, 'HsccBonusReportBlade']);
    Route::any('/gethsccbouns', [LendingController::class, 'getHsccBonus']);


    Route::any('/account-wallet', [AdminDashboardController::class, 'AccountWalletBlade']);
    Route::any('/getaccountwallet', [AdminDashboardController::class, 'getAccountWallet']);

    Route::any('/admin-add-fundreport', [FundRequestController::class, 'AdminAddFundReportBlade']);
    Route::any('/fund_report', [FundRequestController::class, 'fundReport']);

    Route::any('/admin-remove-fundreport', [FundRequestController::class, 'AdminRemoveFundReportBlade']);
    Route::any('/remove_fund_report', [FundRequestController::class, 'removefundReport']);

    Route::any('/user/total-team-view', [AdminLevelController::class, 'TotalTeamViewBlade']);
    Route::any('/getteamviews', [AdminLevelController::class, 'getTeamViews']);

    Route::get('/user/inluencer-tree', [AdminLevelController::class, 'getInluencerTreeBlade']);
    Route::post('/inluencer-tree-data', [AdminLevelController::class, 'getInfluencerTreeData']);

    /*--------------------------*Reports End*------------------------------ */

    /*---------------------------*Tree View*--------------------------------*/
    Route::any('/user/tree-view', [AdminLevelController::class, 'getLevelsViewTreeManualProductBase'])->name('getlevelviewtree');
    /*---------------------------*Tree View*--------------------------------*/

    /*---------------------------*Marketing Tools*--------------------------------*/
    Route::any('marketing-tools/add-banners', [MarketingController::class, 'addMarketingToolsPage'])->name('add-banners');
    Route::any('add-marketing-tool', [MarketingController::class, 'addMarketingTools'])->name('add-banners');

    Route::get('/user/manage-user-account', [AdminUserController::class, 'ManageUserAccountBlade']);
    Route::any('/blockuser', [AdminUserController::class, 'blockUser']);
    Route::any('/user_login/{id}', [AuthenticationController::class, 'loginUser']);
    Route::any('/changeUserWithdrawStatus', [AdminUserController::class, 'changeUserWithdrawStatus']);

    Route::any('/transferToFundWalletOnReject', [EWalletController::class, 'TransferToFundWalletOnReject']);

    Route::any('marketing-tools/add-images', [MarketingController::class, 'addMultipleImages']);
    Route::any('/upload-multiple-files', [MarketingController::class, 'uploadmultiple']); //renu
    Route::any('/upload-multiple-files-submit', [MarketingController::class, 'uploadmultiplesubmit']); //renu
    Route::any('/marketing-tools-vidoes', [MarketingController::class, 'getVideos']); //renu

    // User Structure
    Route::get('/user/user-structure-report', [AdminUserController::class, 'userStructureReportBlade']);
    Route::post('/get-user-structure', [AdminUserController::class, 'getUserStructureData']);
    Route::get('/user/view-structure/{id}', [AdminUserController::class, 'viewStructureBlade']);
    Route::post('/view-structure-data', [AdminUserController::class, 'viewStructureData']);

    // Whatsapp Request Report
    Route::get('/user/whatsapp-request-report', [AdminUserController::class, 'userWhatsappRequestReport']);
    Route::post('/get-user-whatsapp-request', [AdminUserController::class, 'getUserWhatsappReqData']);
    Route::post('/approve-whatsapp-notification', [AdminUserController::class, 'approveWhatsAppStatus']);

    // Change Pass Report
    Route::get('/user/change-password-report', [AdminUserController::class, 'changePassReportBlade']);
    Route::post('/get-change-password-data', [AdminUserController::class, 'getChangePassData']);

    ///user profile update
    Route::get('/user/edit-user-profile/{id}', [AdminUserController::class, 'editUserProfileBlade']);
    Route::get('/user/user-profile/{id}', [AdminUserController::class, 'userProfile']);
    Route::post('/user/update-profile', [AdminUserController::class, 'updateUser']);
    Route::get('/getuserprofile', [AdminUserController::class, 'getUserProfileDetails']);
    Route::any('/updateuser',  [AdminUserController::class, 'updateUser']);
    Route::any('/getusers', [AdminUserController::class, 'getUsers']);


    Route::any('/invalid-login-users', [AdminProductController::class, 'invalidLoginPage']);
    Route::any('/getlogincountreport', [AdminProductController::class, 'getLoginCountUsersDetails']);
    Route::post('/changeuserblockstatus', [AdminUserController::class, 'changeUserBlockStatus']);


    Route::any('/wallet-balance-report', [AdminProductController::class, 'walletBalanceReportPage']);
    Route::any('/getwalletbalance', [AdminProductController::class, 'walletBalanceReport']);
    Route::any('/getwalletbalance_orderby_roi', [AdminProductController::class, 'walletBalanceReportRoi']);
    Route::any('/getwalletbalance_orderby_hscc', [AdminProductController::class, 'walletBalanceReportHscc']);
    Route::any('/getwalletbalance_orderby_working', [AdminProductController::class, 'walletBalanceReportWorking']);
    Route::any('/getwalletbalance_orderby_fund', [AdminProductController::class, 'walletBalanceReportFund']);


    Route::any('/add-zoom-meeting', [ZoomMeetingsController::class, 'addZoomMeeting']);
    Route::any('/submit-zoom-meeting', [ZoomMeetingsController::class, 'submitZoomMeeting']);
    Route::any('/zoom-meetings', [ZoomMeetingsController::class, 'zoomMeetingsList'])->name('zoom-meetings');
    Route::any('/zoom-meeting-report', [ZoomMeetingsController::class, 'zoomMeetingsListReport']);
    Route::any('/zoom-meetings-interests', [ZoomMeetingsController::class, 'zoomMeetingsInterestedList']);
    Route::any('/zoom-meeting-intetested-report', [ZoomMeetingsController::class, 'zoomMeetingsInterestedListReport']);
    Route::any('/remove-zoommeeting', [ZoomMeetingsController::class, 'removeZoomMeeting']);
    Route::any('/edit-zoommeeting/{id}', [ZoomMeetingsController::class, 'editZoomMeeting']);
    Route::any('/update-zoom-meeting', [ZoomMeetingsController::class, 'updateZoomMeeting']);


    Route::any('/zoom-meetings-completed', [ZoomMeetingsController::class, 'zoomMeetingsCompletedList'])->name('zoom-meetings-completed');
    Route::any('/zoom-meeting-completed-report', [ZoomMeetingsController::class, 'zoomMeetingsCompletedListReport']);


    Route::any('/edit-zoommeeting-completed/{id}', [ZoomMeetingsController::class, 'editZoomMeetingCompleted']);
    Route::any('/update-zoom-meeting-completed', [ZoomMeetingsController::class, 'updateZoomMeetingCompleted']);



    Route::any('/ledger/view_user_details', [UserDetailsController::class, 'index']);

    Route::any('/buy-sell-chart', [ReportsController::class, 'BuySellRateChartAdmin']);
    Route::any('/coin-chart-reports-data', [EWalletController::class, 'BuySellRateChartDataAdmin']);

    Route::any('/new-buy-sell-chart', [ReportsController::class, 'NewBuySellRateChart']);
    Route::any('/coin-chart-reports-data-mt', [EWalletController::class, 'NewBuySellRateChartDataAdmin']);


    
    

    Route::any('/project-settings', [AdminUserController::class, 'updateUserIdView']);
    Route::any('/updateUserId', [AdminUserController::class, 'updateUserIdSetting']);

    Route::get('/user-details', [AdminUserController::class, 'UserDetailsBlade']);
    Route::any('/getAllUsers', [AdminUserController::class, 'getAllUsers']);


    Route::any('/user/sell-token-history/{id}', [AdminUserController::class, 'sellTokenReportAdmin']);
    Route::any('/user/sellTokenHistoryData', [AdminUserController::class, 'sellTokenHistoryData']);

    Route::any('/user/buy-token-history/{id}', [AdminUserController::class, 'buyTokenReportAdmin']);
    Route::any('/user/buyTokenHistoryData', [AdminUserController::class, 'buyTokenHistoryData']);


    
    Route::any('/user/transfer-token-history/{id}', [AdminUserController::class, 'transferTokenReportAdmin']);
    Route::any('/user/transferTokenHistoryData', [AdminUserController::class, 'transferTokenHistoryData']);

    Route::any('/user/add-fund-history/{id}', [AdminUserController::class, 'addFundHistory']);
    Route::any('/user/addFundData', [AdminUserController::class, 'addFundData']);

    Route::any('/special-buying', [AdminUserController::class, 'specialBuyingBlade']);
    Route::any('/specialBuying', [AdminUserController::class, 'specialBuying']);
    Route::any('/releaseCoins', [AdminUserController::class, 'relaseCoinUpdate']);
    Route::any('/special-buying-report', [AdminUserController::class, 'specialBuyingReportAdmin']);
    Route::any('/special-buying-report-data', [AdminUserController::class, 'specialBuyingReportAdminData']);


    Route::any('/auo-withdrawl-status', [AdminUserController::class, 'autoWithdrawlStatus']);
    Route::any('/auto-withdraw-update', [AdminUserController::class, 'autoWithdrawUpdate']);
    Route::any('/auto-withdraw-report', [AdminUserController::class, 'autoWithdrawReportAdmin']);
    Route::any('/auto-withdraw-report-data', [AdminUserController::class, 'autoWithdrawReportAdminData']);
    
    Route::any('/sell/auto-sell-report', [AdminUserController::class, 'autoSellReportAdmin']);
    Route::any('/auto-sell-report-data', [EWalletController::class, 'autoSellReportAdminData']);

    Route::any('/user/user-logs/{id}', [AdminUserController::class, 'userLogsBlade']);
    Route::any('/user-logs-report-data', [AdminUserController::class, 'userLogsData']);    
  
    // Route::any('/user-final-overview-report', [AdminUserController::class, 'userFinalOverviewReport']);
    // Route::any('/user-final-overview-report-data', [AdminUserController::class, 'userFinalOverviewReportData']);

    Route::any('/balance-sheet-report', [AdminUserController::class, 'balanceSheetReport']);
    Route::any('/balance-sheet-report-data', [AdminUserController::class, 'balanceSheetReportData']);

    Route::any('/user-per-day-total-buisness-report/{id}', [AdminUserController::class, 'userPerDayTotalBuinsess']);
    Route::any('/user-per-day-total-buisness-report-data', [AdminUserController::class, 'userPerDayTotalReportData']);
});
