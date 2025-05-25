<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontEnd\MemberController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\MerchantManageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WhyChooseController;
use App\Http\Controllers\Admin\WhyChooseInfoController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BannerCategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CreatePageController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryCatController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\OurGalleryController;
use App\Http\Controllers\Admin\BussinessGalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MissionVissionController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HowItWorkController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\CeomessegeController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\BestFeatureController;
use App\Http\Controllers\Admin\SuccessController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\BookOrderController;
use App\Http\Controllers\Admin\NewstickerController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\SuccessRateController;
use App\Http\Controllers\Admin\ServiceItemController;
use App\Http\Controllers\Admin\ServiceQualityController;
use App\Http\Controllers\Admin\OurPromiseController;

Auth::routes();

Route::get('/cc', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return '<h1>Make Migration</h1>';
});


Route::group(['namespace' => 'Frontend', 'middleware' => ['check_refer']], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('appointment', [FrontendController::class, 'appointment'])->name('appointment');
    Route::post('appointment-submit', [FrontendController::class, 'appointment_submit'])->name('appointment_submit');

    Route::get('company-profile', [FrontendController::class, 'profile'])->name('profile');

    Route::get('about-us', [FrontendController::class, 'about_us'])->name('about_us');
    Route::get('our-technology', [FrontendController::class, 'technology'])->name('technology');
    Route::get('search', [FrontendController::class, 'search'])->name('search');

    Route::get('hr-compliance', [FrontendController::class, 'compliance'])->name('compliance');

    Route::get('utilities', [FrontendController::class, 'utilities'])->name('utilities');
    Route::get('it', [FrontendController::class, 'it'])->name('it');
    Route::get('csr', [FrontendController::class, 'csr'])->name('csr');
    Route::get('machine-list', [FrontendController::class, 'machine'])->name('machine-list');

    Route::get('our-clients', [FrontendController::class, 'clients'])->name('clients');
    Route::get('sustainability', [FrontendController::class, 'sustainability'])->name('sustainability');

    Route::get('product/{id}', [FrontendController::class, 'details'])->name('product');
    Route::get('category/{slug}', [FrontendController::class, 'category'])->name('category');
    Route::get('subcategory/{slug}', [FrontendController::class, 'subcategory'])->name('subcategory');
    Route::get('product-details/{slug}', [FrontendController::class, 'country_details'])->name('country_details');
    Route::post('booking/save', [FrontendController::class, 'booking_save'])->name('booking.save');
    Route::get('scholarship-category/{slug}', [FrontendController::class, 'scholarship_category'])->name('scholarship.category');
    Route::get('scholarship-details/{slug}', [FrontendController::class, 'scholarship_details'])->name('scholarship_details');

    Route::get('immigration-category/{slug}', [FrontendController::class, 'immigration_category'])->name('immigration.category');
    Route::get('immigration-details/{slug}', [FrontendController::class, 'immigration_details'])->name('immigration_details');


    Route::get('information/{slug}', [FrontendController::class, 'information'])->name('information');

    Route::get('certificate', [FrontendController::class, 'certificate'])->name('certificate');

    Route::get('information-details/{slug}', [FrontendController::class, 'information_details'])->name('information_details');


    Route::get('articale', [FrontendController::class, 'articale'])->name('articale');
    Route::get('course', [FrontendController::class, 'course'])->name('course');
    Route::get('/ceomessage', [FrontEndController::class, 'ceomessage'])->name('ceomessage');
    Route::get('blog-category/{slug}', [FrontendController::class, 'blog_category'])->name('blog_category');
    Route::get('blogs', [FrontendController::class, 'blogs'])->name('blogs');
    Route::get('expo', [FrontendController::class, 'expo'])->name('expo');
    Route::get('blog-details/{slug}', [FrontendController::class, 'blog_details'])->name('blog.details');

    Route::get('/our-gallery', [FrontEndController::class, 'gallery'])->name('gallery');


    Route::get('/video', [FrontEndController::class, 'video'])->name('video');
    Route::get('summerydetails/{id}', [FrontendController::class, 'summerydetails'])->name('summerydetails');

    Route::get('event-register/{id}', [FrontendController::class, 'event_register'])->name('event.register');
    Route::post('event-data/save', [FrontendController::class, 'event_data_save'])->name('event.data.save');
    Route::post('booksummeryorder/save', [FrontendController::class, 'booksummeryorder_save'])->name('booksummeryorder.save');

    Route::get('news-&-publications', [FrontendController::class, 'news'])->name('news');
    Route::get('news-&-publications-details/{slug}', [FrontendController::class, 'news_details'])->name('news.details');

    Route::get('portfolios', [FrontendController::class, 'portfolios'])->name('portfolios');
    Route::get('services', [FrontendController::class, 'services'])->name('services');
    Route::get('service-details/{slug}', [FrontendController::class, 'service_details'])->name('service.details');
    Route::get('faqs', [FrontendController::class, 'faqs'])->name('faqs');
    Route::get('pricing', [FrontendController::class, 'pricings'])->name('pricings');
    Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('ourclient', [FrontendController::class, 'ourclient'])->name('ourclient');
    Route::get('ourteam', [FrontendController::class, 'ourteam'])->name('ourteam');
    Route::get('page/{slug}', [FrontendController::class, 'page'])->name('page');
    Route::post('bookingcontact', [FrontendController::class, 'bookingcontact'])->name('bookingcontact');
    Route::post('visitorcontact', [FrontendController::class, 'visitorcontact'])->name('visitorcontact');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['customer', 'ipcheck', 'check_refer']], function () {
    Route::get('locked', [DashboardController::class, 'locked'])->name('locked');
    Route::post('unlocked', [DashboardController::class, 'unlocked'])->name('unlocked');
});
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['check_refer']], function () {
    Route::get('ajax-district', [FrontendController::class, 'ajax_district'])->name('ajax.districts');
    Route::get('ajax-area', [FrontendController::class, 'ajax_area'])->name('ajax.areas');
    Route::get('ajax-zone', [FrontendController::class, 'ajax_zone'])->name('ajax.zones');
    Route::post('member/logout', [MemberController::class, 'logout'])->name('member.logout');
    Route::get('/twofa-verify', [MemberController::class, 'twofa_verify'])->name('member.twofactor');
    Route::post('/verify-account', [MemberController::class, 'account_verify'])->name('member.account.verify');
    Route::post('/two-verify', [MemberController::class, 'twoverify_verify'])->name('member.account.twoverify');
});

//buyer manage route
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['check_refer']], function () {
    Route::get('/login', [MemberController::class, 'login'])->name('member.login');
    Route::post('/signin', [MemberController::class, 'signin'])->name('member.signin');
    Route::get('/register', [MemberController::class, 'register'])->name('member.register');
    Route::post('/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/verify', [MemberController::class, 'verify'])->name('member.verify');

    Route::post('/resend-otp', [MemberController::class, 'resendotp'])->name('member.resendotp');
    Route::get('/forgot-password', [MemberController::class, 'forgot_password'])->name('member.forgot.password');
    Route::post('/forgot-verify', [MemberController::class, 'forgot_verify'])->name('member.forgot.verify');
    Route::get('/forgot-password/reset', [MemberController::class, 'forgot_reset'])->name('member.forgot.reset');
    Route::post('/forgot-password/store', [MemberController::class, 'forgot_store'])->name('member.forgot.store');
    Route::post('/forgot-password/resendotp', [MemberController::class, 'forgot_resend'])->name('member.forgot.resendotp');
});
// member auth
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['member', 'check_refer']], function () {

    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::get('/profile', [MemberController::class, 'profile'])->name('member.profile');
    Route::get('/settings', [MemberController::class, 'settings'])->name('member.settings');
    Route::post('/basic-update', [MemberController::class, 'basic_update'])->name('member.basic_update');
    Route::post('/payment-method', [MemberController::class, 'payment_method'])->name('member.payment_method');
    Route::get('/change-password', [MemberController::class, 'change_pass'])->name('member.change_pass');
    Route::post('/password-update', [MemberController::class, 'password_update'])->name('member.password_update');
    Route::get('/buyer/payment', [MemberController::class, 'member_payment'])->name('member.parcel.payment');
    Route::get('/parcel/payable', [MemberController::class, 'payable_parcel'])->name('member.parcel.payable');
    Route::post('/payment/request', [MemberController::class, 'payment_request'])->name('member.payment.request');
    Route::get('/payment/invoice/{id}', [MemberController::class, 'payment_invoice'])->name('member.payment.invoice');
    Route::get('/parcel/fraud-checker', [MemberController::class, 'fraud_checker'])->name('member.parcel.fraud_checker');
    Route::get('/buyer/notice', [MemberController::class, 'notice'])->name('member.notice');
    Route::get('/buyer/notification', [MemberController::class, 'notification'])->name('member.notification');
    Route::get('/buyer/pricing', [MemberController::class, 'pricing'])->name('member.parcel.pricing');
    Route::get('consignment-search', [MemberController::class, 'consignment_search'])->name('member.consignment.search');

});

Route::get('/ajax-product-subcategory', [ProductController::class, 'getSubcategory']);
// auth route
Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'lock', 'check_refer'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('change-password', [DashboardController::class, 'changepassword'])->name('change_password');
    Route::post('new-password', [DashboardController::class, 'newpassword'])->name('new_password');

    // users route
    Route::get('users/manage', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/save', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::post('users/active', [UserController::class, 'active'])->name('users.active');
    Route::post('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    // roles
    Route::get('roles/manage', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/save', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::post('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // permissions
    Route::get('permissions/manage', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/{id}/show', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/save', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // categories
    Route::get('categories/manage', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/save', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('categories/inactive', [CategoryController::class, 'inactive'])->name('categories.inactive');
    Route::post('categories/active', [CategoryController::class, 'active'])->name('categories.active');
    Route::post('categories/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // about us routes
    Route::get('about/manage', [AboutController::class, 'index'])->name('abouts.index');
    Route::get('about/create', [AboutController::class, 'create'])->name('abouts.create');
    Route::post('about/save', [AboutController::class, 'store'])->name('abouts.store');
    Route::get('about/{id}/edit', [AboutController::class, 'edit'])->name('abouts.edit');
    Route::post('about/update', [AboutController::class, 'update'])->name('abouts.update');
    Route::post('about/inactive', [AboutController::class, 'inactive'])->name('abouts.inactive');
    Route::post('about/active', [AboutController::class, 'active'])->name('abouts.active');
    Route::post('about/destroy', [AboutController::class, 'destroy'])->name('abouts.destroy');


    // advertisement us routes
    Route::get('advertisement/manage', [AdvertisementController::class, 'index'])->name('advertisements.index');
    Route::get('advertisement/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
    Route::post('advertisement/save', [AdvertisementController::class, 'store'])->name('advertisements.store');
    Route::get('advertisement/{id}/edit', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
    Route::post('advertisement/update', [AdvertisementController::class, 'update'])->name('advertisements.update');
    Route::post('advertisement/inactive', [AdvertisementController::class, 'inactive'])->name('advertisements.inactive');
    Route::post('advertisement/active', [AdvertisementController::class, 'active'])->name('advertisements.active');
    Route::post('advertisement/destroy', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');


    Route::get('booking/manage', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('booking/profile', [BookingController::class, 'profile'])->name('bookings.profile');

    // mission vision
    Route::get('missionvission/manage', [MissionVissionController::class, 'index'])->name('missionvission.index');
    Route::get('missionvission/create', [MissionVissionController::class, 'create'])->name('missionvission.create');
    Route::post('missionvission/save', [MissionVissionController::class, 'store'])->name('missionvission.store');
    Route::get('missionvission/{id}/edit', [MissionVissionController::class, 'edit'])->name('missionvission.edit');
    Route::post('missionvission/update', [MissionVissionController::class, 'update'])->name('missionvission.update');
    Route::post('missionvission/inactive', [MissionVissionController::class, 'inactive'])->name('missionvission.inactive');
    Route::post('missionvission/active', [MissionVissionController::class, 'active'])->name('missionvission.active');
    Route::post('missionvission/destroy', [MissionVissionController::class, 'destroy'])->name('missionvission.destroy');


    // buyer manage route
    Route::get('buyer/payment/{status}', [MerchantManageController::class, 'payment'])->name('merchants.payment');
    Route::get('buyer/invoice/{id}', [MerchantManageController::class, 'invoice'])->name('merchants.invoice');
    Route::post('buyer/payment/status', [MerchantManageController::class, 'payment_status'])->name('merchants.payment.status');
    Route::get('buyer/create', [MerchantManageController::class, 'create'])->name('merchants.create');
    Route::post('buyer/store', [MerchantManageController::class, 'store'])->name('merchants.store');
    Route::get('buyer/manage', [MerchantManageController::class, 'index'])->name('merchants.index');
    Route::get('buyer/{id}/edit', [MerchantManageController::class, 'edit'])->name('merchants.edit');
    Route::post('buyer/update', [MerchantManageController::class, 'update'])->name('merchants.update');
    Route::post('buyer/inactive', [MerchantManageController::class, 'inactive'])->name('merchants.inactive');
    Route::post('buyer/active', [MerchantManageController::class, 'active'])->name('merchants.active');
    Route::get('buyer/profile', [MerchantManageController::class, 'profile'])->name('merchants.profile');
    Route::post('buyer/adminlog', [MerchantManageController::class, 'adminlog'])->name('merchants.adminlog');
    Route::get('buyer/manual-payment', [MerchantManageController::class, 'menual_payment'])->name('merchants.menual_payment');
    Route::post('buyer/manual-payment/paid', [MerchantManageController::class, 'menual_payment_paid'])->name('merchants.menual_payment.paid');

    // company photo gallery route
    Route::get('trusted-partner/manage', [BrandController::class, 'index'])->name('companyphotos.index');
    Route::get('trusted-partner/{id}/show', [BrandController::class, 'show'])->name('companyphotos.show');
    Route::get('trusted-partner/create', [BrandController::class, 'create'])->name('companyphotos.create');
    Route::post('trusted-partner/save', [BrandController::class, 'store'])->name('companyphotos.store');
    Route::get('trusted-partner/{id}/edit', [BrandController::class, 'edit'])->name('companyphotos.edit');
    Route::post('trusted-partner/update', [BrandController::class, 'update'])->name('companyphotos.update');
    Route::post('trusted-partner/inactive', [BrandController::class, 'inactive'])->name('companyphotos.inactive');
    Route::post('trusted-partner/active', [BrandController::class, 'active'])->name('companyphotos.active');
    Route::post('trusted-partner/destroy', [BrandController::class, 'destroy'])->name('companyphotos.destroy');



    // Ceomessage routes
    Route::get('ceomessage/manage', [CeomessegeController::class, 'index'])->name('ceomessages.index');
    Route::get('ceomessage/create', [CeomessegeController::class, 'create'])->name('ceomessages.create');
    Route::post('ceomessage/save', [CeomessegeController::class, 'store'])->name('ceomessages.store');
    Route::get('ceomessage/{id}/edit', [CeomessegeController::class, 'edit'])->name('ceomessages.edit');
    Route::post('ceomessage/update', [CeomessegeController::class, 'update'])->name('ceomessages.update');
    Route::post('ceomessage/inactive', [CeomessegeController::class, 'inactive'])->name('ceomessages.inactive');
    Route::post('ceomessage/active', [CeomessegeController::class, 'active'])->name('ceomessages.active');
    Route::post('ceomessage/destroy', [CeomessegeController::class, 'destroy'])->name('ceomessages.destroy');



    // Achievement gallery route
    Route::get('achievement/manage', [AchievementController::class, 'index'])->name('achievement.index');
    Route::get('achievement/{id}/show', [AchievementController::class, 'show'])->name('achievement.show');
    Route::get('achievement/create', [AchievementController::class, 'create'])->name('achievement.create');
    Route::post('achievement/save', [AchievementController::class, 'store'])->name('achievement.store');
    Route::get('achievement/{id}/edit', [AchievementController::class, 'edit'])->name('achievement.edit');
    Route::post('achievement/update', [AchievementController::class, 'update'])->name('achievement.update');
    Route::post('achievement/inactive', [AchievementController::class, 'inactive'])->name('achievement.inactive');
    Route::post('achievement/active', [AchievementController::class, 'active'])->name('achievement.active');
    Route::post('achievement/destroy', [AchievementController::class, 'destroy'])->name('achievement.destroy');


    // Our gallery cat route
    Route::get('gallery-category/manage', [GalleryCatController::class, 'index'])->name('gallerycategory.index');
    Route::get('gallery-category/{id}/show', [GalleryCatController::class, 'show'])->name('gallerycategory.show');
    Route::get('gallery-category/create', [GalleryCatController::class, 'create'])->name('gallerycategory.create');
    Route::post('gallery-category/save', [GalleryCatController::class, 'store'])->name('gallerycategory.store');
    Route::get('gallery-category/{id}/edit', [GalleryCatController::class, 'edit'])->name('gallerycategory.edit');
    Route::post('gallery-category/update', [GalleryCatController::class, 'update'])->name('gallerycategory.update');
    Route::post('gallery-category/inactive', [GalleryCatController::class, 'inactive'])->name('gallerycategory.inactive');
    Route::post('gallery-category/active', [GalleryCatController::class, 'active'])->name('gallerycategory.active');
    Route::post('gallery-category/destroy', [GalleryCatController::class, 'destroy'])->name('gallerycategory.destroy');

    // Our gallery route
    Route::get('ourgallery/manage', [OurGalleryController::class, 'index'])->name('ourgallery.index');
    Route::get('ourgallery/{id}/show', [OurGalleryController::class, 'show'])->name('ourgallery.show');
    Route::get('ourgallery/create', [OurGalleryController::class, 'create'])->name('ourgallery.create');
    Route::post('ourgallery/save', [OurGalleryController::class, 'store'])->name('ourgallery.store');
    Route::get('ourgallery/{id}/edit', [OurGalleryController::class, 'edit'])->name('ourgallery.edit');
    Route::post('ourgallery/update', [OurGalleryController::class, 'update'])->name('ourgallery.update');
    Route::post('ourgallery/inactive', [OurGalleryController::class, 'inactive'])->name('ourgallery.inactive');
    Route::post('ourgallery/active', [OurGalleryController::class, 'active'])->name('ourgallery.active');
    Route::post('ourgallery/destroy', [OurGalleryController::class, 'destroy'])->name('ourgallery.destroy');


    // Bussiness Gallery  route
    Route::get('our-technology/manage', [BussinessGalleryController::class, 'index'])->name('bussinessgallery.index');
    Route::get('our-technology/{id}/show', [BussinessGalleryController::class, 'show'])->name('bussinessgallery.show');
    Route::get('our-technology/create', [BussinessGalleryController::class, 'create'])->name('bussinessgallery.create');
    Route::post('our-technology/save', [BussinessGalleryController::class, 'store'])->name('bussinessgallery.store');
    Route::get('our-technology/{id}/edit', [BussinessGalleryController::class, 'edit'])->name('bussinessgallery.edit');
    Route::post('our-technology/update', [BussinessGalleryController::class, 'update'])->name('bussinessgallery.update');
    Route::post('our-technology/inactive', [BussinessGalleryController::class, 'inactive'])->name('bussinessgallery.inactive');
    Route::post('our-technology/active', [BussinessGalleryController::class, 'active'])->name('bussinessgallery.active');
    Route::post('our-technology/destroy', [BussinessGalleryController::class, 'destroy'])->name('bussinessgallery.destroy');


    // Newsticker
    Route::get('newsticker/manage', [NewstickerController::class, 'index'])->name('newsticker.index');
    Route::get('newsticker/{id}/show', [NewstickerController::class, 'show'])->name('newsticker.show');
    Route::get('newsticker/create', [NewstickerController::class, 'create'])->name('newsticker.create');
    Route::post('newsticker/save', [NewstickerController::class, 'store'])->name('newsticker.store');
    Route::get('newsticker/{id}/edit', [NewstickerController::class, 'edit'])->name('newsticker.edit');
    Route::post('newsticker/update', [NewstickerController::class, 'update'])->name('newsticker.update');
    Route::post('newsticker/inactive', [NewstickerController::class, 'inactive'])->name('newsticker.inactive');
    Route::post('newsticker/active', [NewstickerController::class, 'active'])->name('newsticker.active');
    Route::post('newsticker/destroy', [NewstickerController::class, 'destroy'])->name('newsticker.destroy');

    // client route
    Route::get('clients/manage', [ClientController::class, 'index'])->name('clients.index');
    Route::get('clients/{id}/show', [ClientController::class, 'show'])->name('clients.show');
    Route::get('clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('clients/save', [ClientController::class, 'store'])->name('clients.store');
    Route::get('clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('clients/update', [ClientController::class, 'update'])->name('clients.update');
    Route::post('clients/inactive', [ClientController::class, 'inactive'])->name('clients.inactive');
    Route::post('clients/active', [ClientController::class, 'active'])->name('clients.active');
    Route::post('clients/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');


    // Teams category route
    Route::get('teams/manage', [TeamsController::class, 'index'])->name('teams.index');
    Route::get('teams/create', [TeamsController::class, 'create'])->name('teams.create');
    Route::post('teams/save', [TeamsController::class, 'store'])->name('teams.store');
    Route::get('teams/{id}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
    Route::post('teams/update', [TeamsController::class, 'update'])->name('teams.update');
    Route::post('teams/inactive', [TeamsController::class, 'inactive'])->name('teams.inactive');
    Route::post('teams/active', [TeamsController::class, 'active'])->name('teams.active');
    Route::post('teams/destroy', [TeamsController::class, 'destroy'])->name('teams.destroy');


    // testimonials
    Route::get('sustainability/manage', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('sustainability/{id}/show', [TestimonialController::class, 'show'])->name('testimonials.show');
    Route::get('sustainability/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('sustainability/save', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('sustainability/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::post('sustainability/update', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::post('sustainability/inactive', [TestimonialController::class, 'inactive'])->name('testimonials.inactive');
    Route::post('sustainability/active', [TestimonialController::class, 'active'])->name('testimonials.active');
    Route::post('sustainability/destroy', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // course service
    Route::get('service/manage', [ServiceController::class, 'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/save', [ServiceController::class, 'store'])->name('service.store');
    Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('service/update', [ServiceController::class, 'update'])->name('service.update');
    Route::post('service/inactive', [ServiceController::class, 'inactive'])->name('service.inactive');
    Route::post('service/active', [ServiceController::class, 'active'])->name('service.active');
    Route::post('service/destroy', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::get('service/pricing/{id}', [ServiceController::class, 'price_destroy'])->name('service.price.destroy');



    // news & publication route
    Route::get('news-publication/manage', [NewsController::class, 'index'])->name('news.index');
    Route::get('news-publication/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('news-publication/save', [NewsController::class, 'store'])->name('news.store');
    Route::get('news-publication/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('news-publication/update', [NewsController::class, 'update'])->name('news.update');
    Route::post('news-publication/inactive', [NewsController::class, 'inactive'])->name('news.inactive');
    Route::post('news-publication/active', [NewsController::class, 'active'])->name('news.active');
    Route::post('news-publication/destroy', [NewsController::class, 'destroy'])->name('news.destroy');

    // news & publication route
    Route::get('events-register/manage', [NewsController::class, 'events_index'])->name('events.index');
    Route::get('events-register/{id}/view', [NewsController::class, 'events_view'])->name('events.view');


    // Order route
    Route::get('bookorder/{slug}', [BookOrderController::class, 'index'])->name('admin.bookorders');
    Route::get('bookorder/edit/{id}', [BookOrderController::class, 'bookorder_edit'])->name('admin.bookorder.edit');
    Route::post('bookorder/update', [BookOrderController::class, 'bookorder_update'])->name('admin.bookorder.update');
    Route::get('bookorder/process/{id}', [BookOrderController::class, 'process'])->name('admin.bookorder.process');
    Route::post('bookorder/change', [BookOrderController::class, 'bookorder_process'])->name('admin.order_change');
    Route::post('bookorder/destroy', [BookOrderController::class, 'destroy'])->name('admin.bookorder.destroy');
    Route::get('bookorder-status', [BookOrderController::class, 'bookorder_status'])->name('admin.bookorder.status');


    // Video routes
    Route::get('video/manage', [VideoController::class, 'index'])->name('videos.index');
    Route::get('video/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('video/save', [VideoController::class, 'store'])->name('videos.store');
    Route::get('video/{id}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::post('video/update', [VideoController::class, 'update'])->name('videos.update');
    Route::post('video/inactive', [VideoController::class, 'inactive'])->name('videos.inactive');
    Route::post('video/active', [VideoController::class, 'active'])->name('videos.active');
    Route::post('video/destroy', [VideoController::class, 'destroy'])->name('videos.destroy');

    // Gallery routes
    Route::get('certificate/manage', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('certificate/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('certificate/save', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('certificate/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::post('certificate/update', [GalleryController::class, 'update'])->name('galleries.update');
    Route::post('certificate/inactive', [GalleryController::class, 'inactive'])->name('galleries.inactive');
    Route::post('certificate/active', [GalleryController::class, 'active'])->name('galleries.active');
    Route::post('certificate/destroy', [GalleryController::class, 'destroy'])->name('galleries.destroy');

    // whychoose
    Route::get('whychoose/manage', [WhyChooseController::class, 'index'])->name('whychoose.index');
    Route::get('whychoose/create', [WhyChooseController::class, 'create'])->name('whychoose.create');
    Route::post('whychoose/save', [WhyChooseController::class, 'store'])->name('whychoose.store');
    Route::get('whychoose/{id}/edit', [WhyChooseController::class, 'edit'])->name('whychoose.edit');
    Route::post('whychoose/update', [WhyChooseController::class, 'update'])->name('whychoose.update');
    Route::post('whychoose/inactive', [WhyChooseController::class, 'inactive'])->name('whychoose.inactive');
    Route::post('whychoose/active', [WhyChooseController::class, 'active'])->name('whychoose.active');
    Route::post('whychoose/destroy', [WhyChooseController::class, 'destroy'])->name('whychoose.destroy');

    // whychoose info
    Route::get('whychoose-infos/manage', [WhyChooseInfoController::class, 'index'])->name('whychooseinfos.index');
    Route::get('whychoose-infos/create', [WhyChooseInfoController::class, 'create'])->name('whychooseinfos.create');
    Route::post('whychoose-infos/save', [WhyChooseInfoController::class, 'store'])->name('whychooseinfos.store');
    Route::get('whychoose-infos/{id}/edit', [WhyChooseInfoController::class, 'edit'])->name('whychooseinfos.edit');
    Route::post('whychoose-infos/update', [WhyChooseInfoController::class, 'update'])->name('whychooseinfos.update');
    Route::post('whychoose-infos/inactive', [WhyChooseInfoController::class, 'inactive'])->name('whychooseinfos.inactive');
    Route::post('whychoose-infos/active', [WhyChooseInfoController::class, 'active'])->name('whychooseinfos.active');
    Route::post('whychoose-infos/destroy', [WhyChooseInfoController::class, 'destroy'])->name('whychooseinfos.destroy');

    // service
    Route::get('counter/manage', [CounterController::class, 'index'])->name('counter.index');
    Route::get('counter/create', [CounterController::class, 'create'])->name('counter.create');
    Route::post('counter/save', [CounterController::class, 'store'])->name('counter.store');
    Route::get('counter/{id}/edit', [CounterController::class, 'edit'])->name('counter.edit');
    Route::post('counter/update', [CounterController::class, 'update'])->name('counter.update');
    Route::post('counter/inactive', [CounterController::class, 'inactive'])->name('counter.inactive');
    Route::post('counter/active', [CounterController::class, 'active'])->name('counter.active');
    Route::post('counter/destroy', [CounterController::class, 'destroy'])->name('counter.destroy');

    // profile
    Route::get('company-profile/manage', [CompanyProfileController::class, 'index'])->name('profile.index');
    Route::get('company-profile/create', [CompanyProfileController::class, 'create'])->name('profile.create');
    Route::post('company-profile/save', [CompanyProfileController::class, 'store'])->name('profile.store');
    Route::get('company-profile/{id}/edit', [CompanyProfileController::class, 'edit'])->name('profile.edit');
    Route::post('company-profile/update', [CompanyProfileController::class, 'update'])->name('profile.update');
    Route::post('company-profile/inactive', [CompanyProfileController::class, 'inactive'])->name('profile.inactive');
    Route::post('company-profile/active', [CompanyProfileController::class, 'active'])->name('profile.active');
    Route::post('company-profile/destroy', [CompanyProfileController::class, 'destroy'])->name('profile.destroy');

    // categories
    Route::get('slider/manage', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/save', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/update', [SliderController::class, 'update'])->name('slider.update');
    Route::post('slider/inactive', [SliderController::class, 'inactive'])->name('slider.inactive');
    Route::post('slider/active', [SliderController::class, 'active'])->name('slider.active');
    Route::post('slider/destroy', [SliderController::class, 'destroy'])->name('slider.destroy');


    // category route
    Route::get('blog-category/manage', [BlogCategoryController::class, 'index'])->name('blog_category.index');
    Route::get('blog-category/create', [BlogCategoryController::class, 'create'])->name('blog_category.create');
    Route::post('blog-category/save', [BlogCategoryController::class, 'store'])->name('blog_category.store');
    Route::get('blog-category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('blog_category.edit');
    Route::post('blog-category/update', [BlogCategoryController::class, 'update'])->name('blog_category.update');
    Route::post('blog-category/inactive', [BlogCategoryController::class, 'inactive'])->name('blog_category.inactive');
    Route::post('blog-category/active', [BlogCategoryController::class, 'active'])->name('blog_category.active');
    Route::post('blog-category/destroy', [BlogCategoryController::class, 'destroy'])->name('blog_category.destroy');

    Route::get('products/image/destroy', [BlogCategoryController::class, 'imgdestroy'])->name('products.image.destroy');

    // banner  route
    Route::get('blog/manage', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blog/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blog/save', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('blog/update', [BlogController::class, 'update'])->name('blogs.update');
    Route::post('blog/inactive', [BlogController::class, 'inactive'])->name('blogs.inactive');
    Route::post('blog/active', [BlogController::class, 'active'])->name('blogs.active');
    Route::post('blog/destroy', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // settings route
    Route::get('settings/manage', [GeneralSettingController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [GeneralSettingController::class, 'create'])->name('settings.create');
    Route::post('settings/save', [GeneralSettingController::class, 'store'])->name('settings.store');
    Route::get('settings/{id}/edit', [GeneralSettingController::class, 'edit'])->name('settings.edit');
    Route::post('settings/update', [GeneralSettingController::class, 'update'])->name('settings.update');
    Route::post('settings/inactive', [GeneralSettingController::class, 'inactive'])->name('settings.inactive');
    Route::post('settings/active', [GeneralSettingController::class, 'active'])->name('settings.active');
    Route::post('settings/destroy', [GeneralSettingController::class, 'destroy'])->name('settings.destroy');

    // settings route
    Route::get('social-media/manage', [SocialMediaController::class, 'index'])->name('socialmedias.index');
    Route::get('social-media/create', [SocialMediaController::class, 'create'])->name('socialmedias.create');
    Route::post('social-media/save', [SocialMediaController::class, 'store'])->name('socialmedias.store');
    Route::get('social-media/{id}/edit', [SocialMediaController::class, 'edit'])->name('socialmedias.edit');
    Route::post('social-media/update', [SocialMediaController::class, 'update'])->name('socialmedias.update');
    Route::post('social-media/inactive', [SocialMediaController::class, 'inactive'])->name('socialmedias.inactive');
    Route::post('social-media/active', [SocialMediaController::class, 'active'])->name('socialmedias.active');
    Route::post('social-media/destroy', [SocialMediaController::class, 'destroy'])->name('socialmedias.destroy');

    // Agency  route
    Route::get('agency/manage', [AgencyController::class, 'index'])->name('agency.index');
    Route::get('agency/create', [AgencyController::class, 'create'])->name('agency.create');
    Route::post('agency/save', [AgencyController::class, 'store'])->name('agency.store');
    Route::get('agency/{id}/edit', [AgencyController::class, 'edit'])->name('agency.edit');
    Route::post('agency/update', [AgencyController::class, 'update'])->name('agency.update');
    Route::post('agency/inactive', [AgencyController::class, 'inactive'])->name('agency.inactive');
    Route::post('agency/active', [AgencyController::class, 'active'])->name('agency.active');
    Route::post('agency/destroy', [AgencyController::class, 'destroy'])->name('agency.destroy');


    // Success ration route
    Route::get('success/manage', [SuccessController::class, 'index'])->name('success.index');
    Route::get('success/create', [SuccessController::class, 'create'])->name('success.create');
    Route::post('success/save', [SuccessController::class, 'store'])->name('success.store');
    Route::get('success/{id}/edit', [SuccessController::class, 'edit'])->name('success.edit');
    Route::post('success/update', [SuccessController::class, 'update'])->name('success.update');
    Route::post('success/inactive', [SuccessController::class, 'inactive'])->name('success.inactive');
    Route::post('success/active', [SuccessController::class, 'active'])->name('success.active');
    Route::post('success/destroy', [SuccessController::class, 'destroy'])->name('success.destroy');

    // weoffer ration route
    Route::get('offer/manage', [OfferController::class, 'index'])->name('offer.index');
    Route::get('offer/create', [OfferController::class, 'create'])->name('offer.create');
    Route::post('offer/save', [OfferController::class, 'store'])->name('offer.store');
    Route::get('offer/{id}/edit', [OfferController::class, 'edit'])->name('offer.edit');
    Route::post('offer/update', [OfferController::class, 'update'])->name('offer.update');
    Route::post('offer/inactive', [OfferController::class, 'inactive'])->name('offer.inactive');
    Route::post('offer/active', [OfferController::class, 'active'])->name('offer.active');
    Route::post('offer/destroy', [OfferController::class, 'destroy'])->name('offer.destroy');


    // flavor  route
    Route::get('shipping-charge/manage', [ShippingChargeController::class, 'index'])->name('shippingcharges.index');
    Route::get('shipping-charge/create', [ShippingChargeController::class, 'create'])->name('shippingcharges.create');
    Route::post('shipping-charge/save', [ShippingChargeController::class, 'store'])->name('shippingcharges.store');
    Route::get('shipping-charge/{id}/edit', [ShippingChargeController::class, 'edit'])->name('shippingcharges.edit');
    Route::post('shipping-charge/update', [ShippingChargeController::class, 'update'])->name('shippingcharges.update');
    Route::post('shipping-charge/inactive', [ShippingChargeController::class, 'inactive'])->name('shippingcharges.inactive');
    Route::post('shipping-charge/active', [ShippingChargeController::class, 'active'])->name('shippingcharges.active');
    Route::post('shipping-charge/destroy', [ShippingChargeController::class, 'destroy'])->name('shippingcharges.destroy');


    // contact routes
    Route::get('contact/manage', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::post('contact/save', [ContactController::class, 'store'])->name('contact.store');
    Route::get('contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('contact/update', [ContactController::class, 'update'])->name('contact.update');
    Route::post('contact/inactive', [ContactController::class, 'inactive'])->name('contact.inactive');
    Route::post('contact/active', [ContactController::class, 'active'])->name('contact.active');
    Route::post('contact/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');

    // banner category routes
    Route::get('banner-category/manage', [BannerCategoryController::class, 'index'])->name('banner_category.index');
    Route::get('banner-category/create', [BannerCategoryController::class, 'create'])->name('banner_category.create');
    Route::post('banner-category/save', [BannerCategoryController::class, 'store'])->name('banner_category.store');
    Route::get('banner-category/{id}/edit', [BannerCategoryController::class, 'edit'])->name('banner_category.edit');
    Route::post('banner-category/update', [BannerCategoryController::class, 'update'])->name('banner_category.update');
    Route::post('banner-category/inactive', [BannerCategoryController::class, 'inactive'])->name('banner_category.inactive');
    Route::post('banner-category/active', [BannerCategoryController::class, 'active'])->name('banner_category.active');
    Route::post('banner-category/destroy', [BannerCategoryController::class, 'destroy'])->name('banner_category.destroy');

    // banner  routes
    Route::get('banner/manage', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banner/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banner/save', [BannerController::class, 'store'])->name('banners.store');
    Route::get('banner/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('banner/update', [BannerController::class, 'update'])->name('banners.update');
    Route::post('banner/inactive', [BannerController::class, 'inactive'])->name('banners.inactive');
    Route::post('banner/active', [BannerController::class, 'active'])->name('banners.active');
    Route::post('banner/destroy', [BannerController::class, 'destroy'])->name('banners.destroy');

    // contact routes
    Route::get('page/manage', [CreatePageController::class, 'index'])->name('pages.index');
    Route::get('page/create', [CreatePageController::class, 'create'])->name('pages.create');
    Route::post('page/save', [CreatePageController::class, 'store'])->name('pages.store');
    Route::get('page/{id}/edit', [CreatePageController::class, 'edit'])->name('pages.edit');
    Route::post('page/update', [CreatePageController::class, 'update'])->name('pages.update');
    Route::post('page/inactive', [CreatePageController::class, 'inactive'])->name('pages.inactive');
    Route::post('page/active', [CreatePageController::class, 'active'])->name('pages.active');
    Route::post('page/destroy', [CreatePageController::class, 'destroy'])->name('pages.destroy');

    // portfolio routes
    Route::get('portfolio/manage', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('portfolio/{id}/show', [PortfolioController::class, 'show'])->name('portfolios.show');
    Route::get('portfolio/create', [PortfolioController::class, 'create'])->name('portfolios.create');
    Route::post('portfolio/save', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
    Route::post('portfolio/update', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::post('portfolio/inactive', [PortfolioController::class, 'inactive'])->name('portfolios.inactive');
    Route::post('portfolio/active', [PortfolioController::class, 'active'])->name('portfolios.active');
    Route::post('portfolio/destroy', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

    // faq routes
    Route::get('faq/manage', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('faq/{id}/show', [FaqController::class, 'show'])->name('faqs.show');
    Route::get('faq/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('faq/save', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('faq/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::post('faq/update', [FaqController::class, 'update'])->name('faqs.update');
    Route::post('faq/inactive', [FaqController::class, 'inactive'])->name('faqs.inactive');
    Route::post('faq/active', [FaqController::class, 'active'])->name('faqs.active');
    Route::post('faq/destroy', [FaqController::class, 'destroy'])->name('faqs.destroy');

    // upcomming events routes
    Route::get('howitwork/manage', [HowItWorkController::class, 'index'])->name('howitworks.index');
    Route::get('howitwork/{id}/show', [HowItWorkController::class, 'show'])->name('howitworks.show');
    Route::get('howitwork/create', [HowItWorkController::class, 'create'])->name('howitworks.create');
    Route::post('howitwork/save', [HowItWorkController::class, 'store'])->name('howitworks.store');
    Route::get('howitwork/{id}/edit', [HowItWorkController::class, 'edit'])->name('howitworks.edit');
    Route::post('howitwork/update', [HowItWorkController::class, 'update'])->name('howitworks.update');
    Route::post('howitwork/inactive', [HowItWorkController::class, 'inactive'])->name('howitworks.inactive');
    Route::post('howitwork/active', [HowItWorkController::class, 'active'])->name('howitworks.active');
    Route::post('howitwork/destroy', [HowItWorkController::class, 'destroy'])->name('howitworks.destroy');

    // portfolio categories
    Route::get('portfolio-category/manage', [PortfolioCategoryController::class, 'index'])->name('portfolio_category.index');
    Route::get('portfolio-category/create', [PortfolioCategoryController::class, 'create'])->name('portfolio_category.create');
    Route::post('portfolio-category/save', [PortfolioCategoryController::class, 'store'])->name('portfolio_category.store');
    Route::get('portfolio-category/{id}/edit', [PortfolioCategoryController::class, 'edit'])->name('portfolio_category.edit');
    Route::post('portfolio-category/update', [PortfolioCategoryController::class, 'update'])->name('portfolio_category.update');
    Route::post('portfolio-category/inactive', [PortfolioCategoryController::class, 'inactive'])->name('portfolio_category.inactive');
    Route::post('portfolio-category/active', [PortfolioCategoryController::class, 'active'])->name('portfolio_category.active');
    Route::post('portfolio-category/destroy', [PortfolioCategoryController::class, 'destroy'])->name('portfolio_category.destroy');


    //  categories
    Route::get('category/manage', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/save', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('category/inactive', [CategoryController::class, 'inactive'])->name('category.inactive');
    Route::post('category/active', [CategoryController::class, 'active'])->name('category.active');
    Route::post('category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

    //  subcategories
    Route::get('subcategory/manage', [SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('subcategory/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('subcategory/save', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('subcategory/{id}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::post('subcategory/update', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::post('subcategory/inactive', [SubcategoryController::class, 'inactive'])->name('subcategories.inactive');
    Route::post('subcategory/active', [SubcategoryController::class, 'active'])->name('subcategories.active');
    Route::post('subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

    //  subcategories
    Route::get('product/manage', [ProductController::class, 'index'])->name('products.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('product/save', [ProductController::class, 'store'])->name('products.store');
    Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('product/update', [ProductController::class, 'update'])->name('products.update');
    Route::post('product/inactive', [ProductController::class, 'inactive'])->name('products.inactive');
    Route::post('product/active', [ProductController::class, 'active'])->name('products.active');
    Route::post('product/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('products/update-deals', [ProductController::class, 'update_deals'])->name('products.update_deals');
    Route::get('products/update-feature', [ProductController::class, 'update_feature'])->name('products.update_feature');
    Route::get('products/update-status', [ProductController::class, 'update_status'])->name('products.update_status');

    // Appointment
    Route::get('appointment/manage', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('appointment/save', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::post('appointment/update', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::post('appointment/inactive', [AppointmentController::class, 'inactive'])->name('appointment.inactive');
    Route::post('appointment/active', [AppointmentController::class, 'active'])->name('appointment.active');
    Route::post('appointment/destroy', [AppointmentController::class, 'destroy'])->name('appointment.destroy');

    // our promise info
    Route::get('our-promise/manage', [OurPromiseController::class, 'index'])->name('ourpromises.index');
    Route::get('our-promise/create', [OurPromiseController::class, 'create'])->name('ourpromises.create');
    Route::post('our-promise/save', [OurPromiseController::class, 'store'])->name('ourpromises.store');
    Route::get('our-promise/{id}/edit', [OurPromiseController::class, 'edit'])->name('ourpromises.edit');
    Route::post('our-promise/update', [OurPromiseController::class, 'update'])->name('ourpromises.update');
    Route::post('our-promise/inactive', [OurPromiseController::class, 'inactive'])->name('ourpromises.inactive');
    Route::post('our-promise/active', [OurPromiseController::class, 'active'])->name('ourpromises.active');
    Route::post('our-promise/destroy', [OurPromiseController::class, 'destroy'])->name('ourpromises.destroy');

    // service item info
    Route::get('service-item/manage', [ServiceItemController::class, 'index'])->name('serviceitems.index');
    Route::get('service-item/create', [ServiceItemController::class, 'create'])->name('serviceitems.create');
    Route::post('service-item/save', [ServiceItemController::class, 'store'])->name('serviceitems.store');
    Route::get('service-item/{id}/edit', [ServiceItemController::class, 'edit'])->name('serviceitems.edit');
    Route::post('service-item/update', [ServiceItemController::class, 'update'])->name('serviceitems.update');
    Route::post('service-item/inactive', [ServiceItemController::class, 'inactive'])->name('serviceitems.inactive');
    Route::post('service-item/active', [ServiceItemController::class, 'active'])->name('serviceitems.active');
    Route::post('service-item/destroy', [ServiceItemController::class, 'destroy'])->name('serviceitems.destroy');

    // service quality info
    Route::get('service-quality/manage', [ServiceQualityController::class, 'index'])->name('servicequalities.index');
    Route::get('service-quality/create', [ServiceQualityController::class, 'create'])->name('servicequalities.create');
    Route::post('service-quality/save', [ServiceQualityController::class, 'store'])->name('servicequalities.store');
    Route::get('service-quality/{id}/edit', [ServiceQualityController::class, 'edit'])->name('servicequalities.edit');
    Route::post('service-quality/update', [ServiceQualityController::class, 'update'])->name('servicequalities.update');
    Route::post('service-quality/inactive', [ServiceQualityController::class, 'inactive'])->name('servicequalities.inactive');
    Route::post('service-quality/active', [ServiceQualityController::class, 'active'])->name('servicequalities.active');
    Route::post('service-quality/destroy', [ServiceQualityController::class, 'destroy'])->name('servicequalities.destroy');

    // success rate info
    Route::get('success-rate/manage', [SuccessRateController::class, 'index'])->name('successrates.index');
    Route::get('success-rate/create', [SuccessRateController::class, 'create'])->name('successrates.create');
    Route::post('success-rate/save', [SuccessRateController::class, 'store'])->name('successrates.store');
    Route::get('success-rate/{id}/edit', [SuccessRateController::class, 'edit'])->name('successrates.edit');
    Route::post('success-rate/update', [SuccessRateController::class, 'update'])->name('successrates.update');
    Route::post('success-rate/inactive', [SuccessRateController::class, 'inactive'])->name('successrates.inactive');
    Route::post('success-rate/active', [SuccessRateController::class, 'active'])->name('successrates.active');
    Route::post('success-rate/destroy', [SuccessRateController::class, 'destroy'])->name('successrates.destroy');

        // upcomming events routes
    Route::get('bestfeature/manage', [BestFeatureController::class, 'index'])->name('bestfeatures.index');
    Route::get('bestfeature/{id}/show', [BestFeatureController::class, 'show'])->name('bestfeatures.show');
    Route::get('bestfeature/create', [BestFeatureController::class, 'create'])->name('bestfeatures.create');
    Route::post('bestfeature/save', [BestFeatureController::class, 'store'])->name('bestfeatures.store');
    Route::get('bestfeature/{id}/edit', [BestFeatureController::class, 'edit'])->name('bestfeatures.edit');
    Route::post('bestfeature/update', [BestFeatureController::class, 'update'])->name('bestfeatures.update');
    Route::post('bestfeature/inactive', [BestFeatureController::class, 'inactive'])->name('bestfeatures.inactive');
    Route::post('bestfeature/active', [BestFeatureController::class, 'active'])->name('bestfeatures.active');
    Route::post('bestfeature/destroy', [BestFeatureController::class, 'destroy'])->name('bestfeatures.destroy');
});
