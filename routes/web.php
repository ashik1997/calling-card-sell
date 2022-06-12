<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('public.home');
// });

/*
|--------------------------------------------------------------------------
| Frontend Route
|--------------------------------------------------------------------------
*/
// Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::get('home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('terms-conditions', [App\Http\Controllers\Frontend\HomeController::class, 'terms_conditions'])->name('terms-conditions');
Route::get('privacy-policy', [App\Http\Controllers\Frontend\HomeController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('contact-us', [App\Http\Controllers\Frontend\HomeController::class, 'contact_us'])->name('contact-us');
Route::get('about-us', [App\Http\Controllers\Frontend\HomeController::class, 'about_us'])->name('about-us');
Route::get('faq', [App\Http\Controllers\Frontend\HomeController::class, 'faq'])->name('faq');
Route::post('contact', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('contact-send-message');

Route::match(array('GET','POST'),'2fa',[App\Http\Controllers\Backend\TwoFAController::class, 'veryfication'])->name('2fa');
Route::match(array('GET','POST'),'custom-login',[App\Http\Controllers\Backend\LoginController::class, 'customLogin'])->name('custom-login');

Route::match(array('GET','POST'),'rate/{slug}',[App\Http\Controllers\Frontend\HomeController::class, 'rate_page'])->name('rate');
Route::get('rates', [App\Http\Controllers\Frontend\HomeController::class, 'rates'])->name('rates');
Route::get('download', [App\Http\Controllers\Frontend\HomeController::class, 'download'])->name('download');

/*
|--------------------------------------------------------------------------
| Backend Route
|--------------------------------------------------------------------------
*/

Auth::routes();
Route::prefix('admin')->group(function(){
	Route::group(['middleware' => ['admin']], function () {

		Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
		Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin');

		// --- profile ----------------------------
		Route::match(array('GET','POST'),'profile',[App\Http\Controllers\Backend\DashboardController::class, 'profile'])->name('profile');
		Route::post('/password-update', [App\Http\Controllers\Backend\DashboardController::class, 'password_update'])->name('password-update');

		// ---site info----------------------------
		Route::match(array('GET','POST'),'site-info',[App\Http\Controllers\Backend\SiteInfoController::class, 'index'])->name('site-info');

		// ---about----------------------------
		Route::match(array('GET','POST'),'about-info',[App\Http\Controllers\Backend\AboutController::class,'store'])->name('about-info');

		// report
		Route::match(array('GET','POST'),'report', [App\Http\Controllers\Backend\DashboardController::class, 'report'])->name('admin.report');

		// admin
		Route::get('/list', [App\Http\Controllers\Backend\ResellerController::class, 'admin_list'])->name('admin.list');

		// --- notice---------------------------------
		Route::match(array('GET','POST'),'notice/add', [App\Http\Controllers\Backend\NoticeController::class, 'add'])->name('admin.notice.add');
		Route::get('notice/list', [App\Http\Controllers\Backend\NoticeController::class, 'list'])->name('admin.notice.list');
		Route::match(array('GET','POST'),'notice/edit/{id}', [App\Http\Controllers\Backend\NoticeController::class, 'edit'])->name('admin.notice.edit');
		Route::get('notice/delete/{id}', [App\Http\Controllers\Backend\NoticeController::class, 'destroy'])->name('admin.notice.delete');

		// reseller
		Route::match(array('GET','POST'),'reseller/add', [App\Http\Controllers\Backend\ResellerController::class, 'add'])->name('admin.reseller.add');
		Route::match(array('GET','POST'),'reseller/edit/{id}', [App\Http\Controllers\Backend\ResellerController::class, 'edit'])->name('admin.reseller.edit');
		Route::get('reseller/list', [App\Http\Controllers\Backend\ResellerController::class, 'list'])->name('admin.reseller.list');
		Route::get('reseller/all-list', [App\Http\Controllers\Backend\ResellerController::class, 'all_list'])->name('admin.reseller.all-list');
		Route::get('reseller/delete/{id}', [App\Http\Controllers\Backend\ResellerController::class, 'destroy'])->name('admin.reseller.delete');
		Route::match(array('GET','POST'),'reseller/report/{id}', [App\Http\Controllers\Backend\ResellerController::class, 'reseller_report'])->name('admin.reseller.report');
		Route::post('r-update-status', [App\Http\Controllers\Backend\ResellerController::class, 'update_status'])->name('admin.reseller.status.update');

		// rate plan
		Route::match(array('GET','POST'),'rate_plan/add', [App\Http\Controllers\Backend\RatePlanController::class, 'add'])->name('admin.rate_plan.add');
		Route::match(array('GET','POST'),'rate_plan/edit/{id}', [App\Http\Controllers\Backend\RatePlanController::class, 'edit'])->name('admin.rate_plan.edit');
		Route::get('rate_plan/list', [App\Http\Controllers\Backend\RatePlanController::class, 'list'])->name('admin.rate_plan.list');
		Route::get('rate_plan/delete/{id}', [App\Http\Controllers\Backend\RatePlanController::class, 'destroy'])->name('admin.rate_plan.delete');
		Route::post('update/status', [App\Http\Controllers\Backend\RatePlanController::class, 'update_status'])->name('admin.rate_plan.status.update');

		// sell_rate plan
		Route::match(array('GET','POST'),'sell_rate_plan/add', [App\Http\Controllers\Backend\SellRatePlanController::class, 'add'])->name('admin.sell_rate_plan.add');
		Route::match(array('GET','POST'),'sell_rate_plan/edit/{id}', [App\Http\Controllers\Backend\SellRatePlanController::class, 'edit'])->name('admin.sell_rate_plan.edit');
		Route::get('sell_rate_plan/list', [App\Http\Controllers\Backend\SellRatePlanController::class, 'list'])->name('admin.sell_rate_plan.list');
		Route::get('sell_rate_plan/delete/{id}', [App\Http\Controllers\Backend\SellRatePlanController::class, 'destroy'])->name('admin.sell_rate_plan.delete');
		Route::post('update-status', [App\Http\Controllers\Backend\SellRatePlanController::class, 'update_status'])->name('admin.sell_rate_plan.status.update');
		Route::get('sell_rate_plan/sell_voip_rate_add/{id}', [App\Http\Controllers\Backend\SellRatePlanController::class, 'sell_voip_rate_add'])->name('admin.sell_rate_plan.sell_voip_rate_add');
		Route::post('sell_rate_plan/sell_voip_rate/update', [App\Http\Controllers\Backend\SellRatePlanController::class, 'sell_voip_rate_update'])->name('admin.sell_rate_plan.sell_voip_rate_update');
		
		// minute for country
		Route::match(array('GET','POST'),'minute/add', [App\Http\Controllers\Backend\MinuteForCountryController::class, 'add'])->name('admin.minute.add');
		Route::match(array('GET','POST'),'minute/edit/{id}', [App\Http\Controllers\Backend\MinuteForCountryController::class, 'edit'])->name('admin.minute.edit');
		Route::get('minute/list', [App\Http\Controllers\Backend\MinuteForCountryController::class, 'list'])->name('admin.minute.list');
		Route::get('minute/delete/{id}', [App\Http\Controllers\Backend\MinuteForCountryController::class, 'destroy'])->name('admin.minute.delete');
		
		// card
		Route::match(array('GET','POST'),'card/add', [App\Http\Controllers\Backend\CardController::class, 'add'])->name('admin.card.add');
		Route::match(array('GET','POST'),'card/edit/{id}', [App\Http\Controllers\Backend\CardController::class, 'edit'])->name('admin.card.edit');
		Route::get('card/list', [App\Http\Controllers\Backend\CardController::class, 'list'])->name('admin.card.list');
		Route::get('card/delete/{id}', [App\Http\Controllers\Backend\CardController::class, 'destroy'])->name('admin.card.delete');
		Route::get('batch/list', [App\Http\Controllers\Backend\CardController::class, 'batch_list'])->name('admin.batch.list');
		Route::get('batch/delete/{id}', [App\Http\Controllers\Backend\CardController::class, 'batch_destroy'])->name('admin.batch.delete');

		// for sell
		Route::get('card/sell_rate_plan', [App\Http\Controllers\Backend\CardController::class, 'sell_rate_plan'])->name('admin.card.sell_rate_plan');
		Route::get('card/stock', [App\Http\Controllers\Backend\CardController::class, 'stock_list'])->name('admin.card.stock');
		Route::get('card/sell/{id}', [App\Http\Controllers\Backend\CardController::class, 'new_card_sell'])->name('admin.card.sell');
		Route::get('card/{id}', [App\Http\Controllers\Backend\CardController::class, 'card_by_id'])->name('admin.card_by_id');

		Route::match(array('GET','POST'),'card-sell/history', [App\Http\Controllers\Backend\CardController::class, 'card_sell_list'])->name('admin.card.sell.history');

		// reseller card
		Route::match(array('GET','POST'),'reseller_card/add', [App\Http\Controllers\Backend\ResellerCardController::class, 'add'])->name('admin.reseller_card.add');
		Route::match(array('GET','POST'),'reseller_card/edit/{id}', [App\Http\Controllers\Backend\ResellerCardController::class, 'edit'])->name('admin.reseller_card.edit');
		Route::get('reseller_card/list', [App\Http\Controllers\Backend\ResellerCardController::class, 'list'])->name('admin.reseller_card.list');
		Route::get('reseller_card/delete/{id}', [App\Http\Controllers\Backend\ResellerCardController::class, 'destroy'])->name('admin.reseller_card.delete');
		Route::post('get/rate_plan', [App\Http\Controllers\Backend\ResellerCardController::class, 'get_rate_plan_by_id'])->name('admin.get_rate_plan_by_id');
		Route::post('available/card', [App\Http\Controllers\Backend\ResellerCardController::class, 'avialable_card'])->name('admin.available.card');

		// reseller payment
		Route::match(array('GET','POST'),'reseller_payment/add', [App\Http\Controllers\Backend\ResellerPaymentController::class, 'add'])->name('admin.reseller_payment.add');
		Route::match(array('GET','POST'),'reseller_payment/list', [App\Http\Controllers\Backend\ResellerPaymentController::class, 'list'])->name('admin.reseller_payment.list');

		// reseller balance
		Route::match(array('GET','POST'),'reseller_balance/add', [App\Http\Controllers\Backend\ResellerBalanceController::class, 'add'])->name('admin.reseller_balance.add');
		Route::match(array('GET','POST'),'reseller_balance/list', [App\Http\Controllers\Backend\ResellerBalanceController::class, 'list'])->name('admin.reseller_balance.list');
		Route::post('get/reseller-due-balance', [App\Http\Controllers\Backend\ResellerBalanceController::class, 'due_by_reseller_id'])->name('admin.due_balance_by_reseller_id');

		// --- service----------------------------
		Route::match(array('GET','POST'),'service/new', [App\Http\Controllers\Backend\ServiceController::class, 'add'])->name('admin.service.add');
		Route::get('service/list', [App\Http\Controllers\Backend\ServiceController::class, 'list'])->name('admin.service.list');
		Route::match(array('GET','POST'),'service/edit/{id}', [App\Http\Controllers\Backend\ServiceController::class, 'edit'])->name('admin.service.edit');
		Route::get('service/delete/{id}', [App\Http\Controllers\Backend\ServiceController::class, 'destroy'])->name('admin.service.delete');

		// --- portfolio----------------------------
		Route::match(array('GET','POST'),'portfolio/new', [App\Http\Controllers\Backend\PortfolioController::class, 'add'])->name('admin.portfolio.add');
		Route::get('portfolio/list', [App\Http\Controllers\Backend\PortfolioController::class, 'list'])->name('admin.portfolio.list');
		Route::match(array('GET','POST'),'portfolio/edit/{id}', [App\Http\Controllers\Backend\PortfolioController::class, 'edit'])->name('admin.portfolio.edit');
		Route::get('portfolio/delete/{id}', [App\Http\Controllers\Backend\PortfolioController::class, 'destroy'])->name('admin.portfolio.delete');

		// --- voip rate---------------------------------
		Route::match(array('GET','POST'),'voip-rate/new', [App\Http\Controllers\Backend\VoipRateController::class, 'add'])->name('admin.voip.rate.add');
		Route::get('voip-rate/list', [App\Http\Controllers\Backend\VoipRateController::class, 'list'])->name('admin.voip.rate.list');
		Route::match(array('GET','POST'),'voip-rate/edit/{id}', [App\Http\Controllers\Backend\VoipRateController::class, 'edit'])->name('admin.voip.rate.edit');
		Route::get('voip-rate/delete/{id}', [App\Http\Controllers\Backend\VoipRateController::class, 'destroy'])->name('admin.voip.rate.delete');

		// ---banner-------------------------------------
		Route::match(array('GET','POST'),'banner/add', [App\Http\Controllers\Backend\BannerController::class, 'add'])->name('admin.banner.add');
		Route::match(array('GET','POST'),'banner/edit/{id}', [App\Http\Controllers\Backend\BannerController::class, 'edit'])->name('admin.banner.edit');
		Route::get('banner/list', [App\Http\Controllers\Backend\BannerController::class, 'list'])->name('admin.banner.list');
		Route::get('banner/delete/{id}', [App\Http\Controllers\Backend\BannerController::class, 'destroy'])->name('admin.banner.delete');

		// ---popup-banner-------------------------------------
		Route::match(array('GET','POST'),'popup-banner/add', [App\Http\Controllers\Backend\PopupBannerController::class, 'add'])->name('admin.popup-banner.add');
		Route::match(array('GET','POST'),'popup-banner/edit/{id}', [App\Http\Controllers\Backend\PopupBannerController::class, 'edit'])->name('admin.popup-banner.edit');
		Route::get('popup-banner/list', [App\Http\Controllers\Backend\PopupBannerController::class, 'list'])->name('admin.popup-banner.list');
		Route::get('popup-banner/delete/{id}', [App\Http\Controllers\Backend\PopupBannerController::class, 'destroy'])->name('admin.popup-banner.delete');

		// ---contact--------------------------------------
		Route::get('contact/list', [App\Http\Controllers\Backend\ContactController::class, 'list'])->name('contact-list');
		Route::get('contact/delete/{id}', [App\Http\Controllers\Backend\ContactController::class, 'destroy'])->name('contact-delete');

		// --- country----------------------------
		Route::match(array('GET','POST'),'country/new', [App\Http\Controllers\Backend\CountryController::class, 'add'])->name('admin.country.add');
		Route::get('country/list', [App\Http\Controllers\Backend\CountryController::class, 'list'])->name('admin.country.list');
		Route::match(array('GET','POST'),'country/edit/{id}', [App\Http\Controllers\Backend\CountryController::class, 'edit'])->name('admin.country.edit');
		Route::get('country/delete/{id}', [App\Http\Controllers\Backend\CountryController::class, 'destroy'])->name('admin.country.delete');

		// --- demo-dailler---------------------------------
		Route::match(array('GET','POST'),'demo-dailler/new', [App\Http\Controllers\Backend\DemoDaillerController::class, 'add'])->name('demo-dailler-new');
		Route::get('/demo-dailler/list', [App\Http\Controllers\Backend\DemoDaillerController::class, 'list'])->name('demo-dailler-list');
		Route::match(array('GET','POST'),'/demo-dailler/edit/{id}', [App\Http\Controllers\Backend\DemoDaillerController::class, 'edit'])->name('demo-dailler-edit');
		Route::get('/demo-dailler/delete/{id}', [App\Http\Controllers\Backend\DemoDaillerController::class, 'destroy'])->name('demo-dailler-delete');
		// --- dailler----------------------------
		Route::match(array('GET','POST'),'dailler/new', [App\Http\Controllers\Backend\DaillerController::class, 'add'])->name('dailler-new');
		Route::get('/dailler/list', [App\Http\Controllers\Backend\DaillerController::class, 'list'])->name('dailler-list');
		Route::match(array('GET','POST'),'dailler/edit/{id}', [App\Http\Controllers\Backend\DaillerController::class, 'edit'])->name('dailler-edit');
		Route::get('/dailler/delete/{id}', [App\Http\Controllers\Backend\DaillerController::class, 'destroy'])->name('dailler-delete');


	});
});
Route::prefix('reseller')->group(function(){
	Route::group(['middleware' => ['reseller']], function () {

		Route::get('/', [App\Http\Controllers\Backend\Reseller\DashboardController::class, 'index'])->name('reseller.dashboard');
		// --- notice ----------------------------
		Route::get('notice/list', [App\Http\Controllers\Backend\Reseller\NoticeController::class, 'list'])->name('reseller.notice.list');
		// --- profile ----------------------------
		Route::get('/profile', [App\Http\Controllers\Backend\Reseller\DashboardController::class, 'profile'])->name('reseller.profile');
		Route::post('/profile', [App\Http\Controllers\Backend\Reseller\DashboardController::class, 'profile'])->name('reseller.profile-update');
		
		Route::post('/password-update', [App\Http\Controllers\Backend\Reseller\DashboardController::class, 'password_update'])->name('reseller.password-update');
		// check password
		Route::post('password-check', [App\Http\Controllers\Backend\Reseller\CardController::class, 'pass_check'])->name('reseller.password.check');

		// report
		Route::match(array('GET','POST'),'report', [App\Http\Controllers\Backend\Reseller\DashboardController::class, 'report'])->name('reseller.report');

		// reseller
		Route::match(array('GET','POST'),'reseller/add', [App\Http\Controllers\Backend\Reseller\ResellerController::class, 'add'])->name('reseller.reseller.add');
		Route::match(array('GET','POST'),'reseller/edit/{id}', [App\Http\Controllers\Backend\Reseller\ResellerController::class, 'edit'])->name('reseller.reseller.edit');
		Route::get('reseller/list', [App\Http\Controllers\Backend\Reseller\ResellerController::class, 'list'])->name('reseller.reseller.list');
		Route::get('reseller/delete/{id}', [App\Http\Controllers\Backend\Reseller\ResellerController::class, 'destroy'])->name('reseller.reseller.delete');
		Route::match(array('GET','POST'),'reseller/report/{id}', [App\Http\Controllers\Backend\Reseller\ResellerController::class, 'reseller_report'])->name('reseller.reseller.report');
		Route::post('update/status', [App\Http\Controllers\Backend\Reseller\ResellerController::class, 'update_status'])->name('reseller.reseller.status.update');

		// reseller card
		Route::match(array('GET','POST'),'reseller_card/add', [App\Http\Controllers\Backend\Reseller\ResellerCardController::class, 'add'])->name('reseller.reseller_card.add');
		Route::match(array('GET','POST'),'reseller_card/edit/{id}', [App\Http\Controllers\Backend\Reseller\ResellerCardController::class, 'edit'])->name('reseller.reseller_card.edit');
		Route::get('reseller_card/list', [App\Http\Controllers\Backend\Reseller\ResellerCardController::class, 'list'])->name('reseller.reseller_card.list');
		Route::get('reseller_card/delete/{id}', [App\Http\Controllers\Backend\Reseller\ResellerCardController::class, 'destroy'])->name('reseller.reseller_card.delete');
		Route::post('get/rate_plan', [App\Http\Controllers\Backend\Reseller\ResellerCardController::class, 'get_rate_plan_by_id'])->name('reseller.get_rate_plan_by_id');
		Route::post('available/card', [App\Http\Controllers\Backend\Reseller\ResellerCardController::class, 'avialable_card'])->name('reseller.available.card');

		// for sell
		Route::get('card/sell_rate_plan', [App\Http\Controllers\Backend\Reseller\CardController::class, 'sell_rate_plan'])->name('reseller.card.sell_rate_plan');
		Route::get('card/stock', [App\Http\Controllers\Backend\Reseller\CardController::class, 'stock_list'])->name('reseller.card.stock');
		Route::get('card/sell/{id}', [App\Http\Controllers\Backend\Reseller\CardController::class, 'new_card_sell'])->name('reseller.card.sell');
		Route::get('card/{id}', [App\Http\Controllers\Backend\Reseller\CardController::class, 'card_by_id'])->name('reseller.card_by_id');
		Route::get('card-sell/history', [App\Http\Controllers\Backend\Reseller\CardController::class, 'card_sell_list'])->name('reseller.card.sell.history');

		// reseller payment
		Route::match(array('GET','POST'),'reseller_payment/add', [App\Http\Controllers\Backend\Reseller\ResellerPaymentController::class, 'add'])->name('reseller.reseller_payment.add');
		Route::get('reseller_payment/list', [App\Http\Controllers\Backend\Reseller\ResellerPaymentController::class, 'list'])->name('reseller.reseller_payment.list');
		Route::get('reseller_payment/delete/{id}', [App\Http\Controllers\Backend\Reseller\ResellerPaymentController::class, 'destroy'])->name('reseller.reseller_payment.delete');

		// reseller balance
		Route::match(array('GET','POST'),'reseller_balance/add', [App\Http\Controllers\Backend\Reseller\ResellerBalanceController::class, 'add'])->name('reseller.reseller_balance.add');
		Route::match(array('GET','POST'),'reseller_balance/list', [App\Http\Controllers\Backend\Reseller\ResellerBalanceController::class, 'list'])->name('reseller.reseller_balance.list');
		Route::post('get/reseller-due-balance', [App\Http\Controllers\Backend\Reseller\ResellerBalanceController::class, 'due_by_reseller_id'])->name('reseller.due_balance_by_reseller_id');
		
	});
});
