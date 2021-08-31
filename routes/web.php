<?php

// use App\Mail\RequestCompleted;
use Illuminate\Support\Facades\Auth;
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
// if (Route::current()) {
//     abort(404);
// }

// Route::get('/mail', function () {
//     return new RequestCompleted('1', '2', '1');
// });

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('faq', 'HomeController@faq')->name('faq');
Route::get('career', 'HomeController@career')->name('career');
Route::get('terms-of-service', 'HomeController@tos')->name('tos');
Route::get('privacy-policy', 'HomeController@ppy')->name('ppy');
Route::get('talent-profile/{username}', 'HomeController@talent_profile')->name('talent.profile');
Route::post('inquiry', 'HomeController@inquiry')->name('inquiry');
Route::post('talent-search', 'HomeController@search_talent')->name('search_talent');
Route::post('talent-reviews', 'HomeController@show_review')->name('reviews');
Route::post('category', 'HomeController@category')->name('category');

Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');
Route::get('register-talent', 'Auth\TalentRegisterController@showRegistrationForm')->name('talent.register');
Route::post('register-talent', 'Auth\TalentRegisterController@register')->name('talent.register.submit');

Route::get('backend-login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('backend-login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::group(['middleware' => 'verified', 'prefix' => 'user'], function () {
    Route::redirect('/', 'user/home');
    /* Common */
    Route::get('/home', 'UserController@index')->name('user.home');
    Route::get('/notifications', 'UserController@notification')->name('user.notification');
    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::post('/profile/account-deactivate', 'UserController@account_deactivate')->name('user.account.deactivate');
    Route::post('/profile/info-update', 'UserController@profile_update')->name('user.profile.info.update');
    Route::post('/profile/password-update', 'UserController@password_update')->name('user.profile.password.update');
    Route::post('/profile/avatar-update', 'UserController@avatar_update')->name('user.profile.avatar.update');
    // Route::post('/profile/{id}/request-send', 'RequestController@request_send');
    Route::get('/talent-following', 'UserController@following')->name('user.following');
    Route::post('/talent-profile/{id}/follow', 'UserController@follow');
    Route::post('/talent-profile/{id}/unfollow', 'UserController@unfollow');
    Route::post('/talent-profile/{id}/notify', 'UserController@notify');
    Route::post('/talent-profile/{id}/unotify', 'UserController@unotify');
    Route::post('/talent-profile/{id}/rate', 'UserController@talent_rating')->name('rate.service');
    Route::get('/talent-book/{username}', 'RequestController@booking')->name('user.book.talent');
    /* User */
    Route::get('/videos', 'UserController@video_list')->name('user.videos');
    /* Talent */
    Route::post('/profile/availability', 'TalentProfileController@availability')->name('user.profile.availability');
    Route::post('/profile/designation-create', 'TalentProfileController@designation_create')->name('user.profile.category.select');
    Route::post('/profile/banking', 'TalentProfileController@banking')->name('user.profile.bank.update');
    Route::post('/profile/about_me', 'TalentProfileController@about_me')->name('user.profile.about.update');
    Route::post('/profile/set-video_price', 'TalentProfileController@set_video_price')->name('user.profile.set.video.price');
    Route::post('/profile/set-response_time', 'TalentProfileController@set_response_time')->name('user.profile.set.response.time');
    Route::post('/profile/intro-video', 'TalentProfileController@intro_vid')->name('user.profile.add.intro_video');
    Route::post('/profile/intro-update', 'TalentProfileController@intro_vid_update')->name('user.profile.update.intro_video');
    Route::post('/profile/intro_video-delete', 'TalentProfileController@intro_delete')->name('user.profile.delete.intro_video');
    Route::post('/profile/handler-create', 'TalentProfileController@handler_create')->name('user.profile.handler.create');
    Route::post('/profile/handler-edit/{accid}', 'TalentProfileController@handler_edit');
    Route::post('/profile/handler-delete/{accid}', 'TalentProfileController@handler_delete');
    Route::get('/request-list', 'UserController@request_list')->name('user.request_list');
    Route::post('/request/{reqid}/video-upload', 'RequestController@requested_video')->name('user.video_upload');
    Route::post('/request/{reqid}/edit-upload', 'RequestController@requested_video_edit')->name('user.video_edit');
    Route::post('/request/{reqid}/reject', 'RequestController@reject_request')->name('user.video_reject');
    
    Route::get('/archive', 'UserController@talent_video_archive')->name('user.talent_video_archive');
    Route::post('/archive/{id}/video-upload', 'RequestController@video_upload');
    Route::post('/archive/{id}/video-delete/{vidid}', 'RequestController@video_delete');

    // Payment Gateway Start
    Route::post('/transaction-pay/{username}', 'PaymentController@index')->name('user.transaction.pay');
    Route::get('/transaction-sammary/{uid}/{tid}', 'PaymentController@transaction_sammary')->name('user.transaction.sammary');
    Route::post('/modify-order/{request_id}', 'PaymentController@modify_order')->name('user.modify.order');
    // Payment Gateway END
});


Route::group(['prefix' => 'backend'], function () {
    Route::redirect('/', 'backend/dashboard');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::post('/profile/info-update', 'AdminController@profile_update')->name('admin.profile.info.update');
    Route::post('/profile/avatar-update', 'AdminController@avatar_update')->name('admin.profile.avatar.update');
    Route::post('/profile/password-update', 'AdminController@password_update')->name('admin.profile.password.update');

    Route::get('/settings-accounts', 'AdminController@accounts')->name('admin.setting.accounts');
    Route::post('/settings-accounts/print-excel', 'AdminController@accountsPrintExcel')->name('admin.setting.accounts.print-excel');
    Route::post('/settings-accounts/print-csv', 'AdminController@accountsPrintCsv')->name('admin.setting.accounts.print-csv');
    Route::get('/settings-promotion', 'AdminController@promotion')->name('admin.setting.promotion');
    Route::post('/settings-promotion/create', 'AdminController@promotion_create')->name('admin.setting.promotion.create');
    Route::get('/settings-company', 'AdminController@setting')->name('admin.setting.company');
    Route::post('/settings/about-update', 'AdminController@updateCompanyAbout')->name('admin.company.about.update');
    Route::post('/settings/tnc-update', 'AdminController@updateCompanyTnc')->name('admin.company.tnc.update');
    Route::post('/settings/ppy-update', 'AdminController@updateCompanyPpy')->name('admin.company.ppy.update');
    Route::post('/settings/faq-update', 'AdminController@updateCompanyFaq')->name('admin.company.faq.update');
    Route::post('/settings/banner-add', 'AdminController@setting_banner_add')->name('admin.setting.banner.add');
    Route::post('/settings/banner-remove/{id}', 'AdminController@setting_banner_remove')->name('admin.setting.banner.remove');
    Route::post('/settings/social_link-add', 'AdminController@setting_social_link_add')->name('admin.setting.social_link.add');
    Route::post('/settings/vacancy-add', 'AdminController@settingCreateVacancy')->name('admin.setting.vacancy.add');
    Route::post('/settings/vacancy-update/{id}', 'AdminController@settingUpdateVacancy')->name('admin.setting.vacancy.update');
    // Route::post('/settings/vacancy-update', 'AdminController@settingUpdateVacancy')->name('admin.setting.vacancy.update');
    Route::post('/settings/social_link-update/{id}', 'AdminController@setting_social_link_update')->name('admin.setting.social_link.update');
    Route::post('/settings/social_link-remove/{id}', 'AdminController@setting_social_link_remove')->name('admin.setting.social_link.remove');
    Route::get('/settings-company/category', 'AdminController@setting_category')->name('admin.setting.company.category');
    Route::post('/settings-company/tag-create', 'AdminController@setting_tag_create')->name('admin.setting.company.tag.create');
    Route::post('/settings-company/tag-edit/{id}', 'AdminController@setting_tag_edit')->name('admin.setting.company.tag.edit');
    Route::post('/settings-company/tag-delete/{id}', 'AdminController@setting_tag_delete')->name('admin.setting.company.tag.delete');
    Route::post('/settings-company/category-create', 'AdminController@setting_category_create')->name('admin.setting.company.category.create');
    Route::post('/settings-company/category-edit/{id}', 'AdminController@setting_category_edit')->name('admin.setting.company.category.edit');
    Route::post('/settings-company/category-delete/{id}', 'AdminController@setting_category_delete')->name('admin.setting.company.category.delete');

    Route::get('/client-request', 'AdminController@client_request')->name('admin.request');
    Route::post('/client-request/{id}/verify', 'AdminController@request_verify');
    Route::post('/client-request/{id}/unverify', 'AdminController@request_unverify');
    Route::post('/client-request/{id}/cancle', 'AdminController@request_cancle');

    // clients
    Route::get('/user-clients', 'AdminController@userClients')->name('admin.userAcc.clients');
    Route::post('/user-clients/{id}/email-verify', 'AdminController@user_email_verify');
    Route::post('/user-clients/{id}/phone-verify', 'AdminController@user_phone_verify');
    Route::post('/user-clients/{id}/acc-verify', 'AdminController@user_acc_verify');
    Route::post('/user-clients/{id}/acc-ban', 'AdminController@user_acc_ban');

    // Talents
    Route::get('/user-talents', 'AdminController@userTalents')->name('admin.userAcc.talents');
    Route::get('/talent-details/{id}', 'AdminController@talent_details')->name('admin.talent.details');
    Route::post('/user-talents/featured', 'AdminController@feature_category')->name('admin.userTalents.featureCategory');
    Route::post('/user-talents/avatar-update', 'AdminController@talent_avatar_update')->name('admin.talent_avatar.update');
    Route::post('/user-talents/{id}/profile-edit', 'AdminController@talent_profile_edit')->name('admin.talents.profile-edit');
    Route::post('/user-talents/{id}/profile-update', 'AdminController@talent_profile_update')->name('admin.talents.profile-update');
    Route::post('/user-talents/{id}/bank-update', 'AdminController@talent_bank_update')->name('admin.talents.bank-update');
    Route::post('/user-talents/{id}/email-verify', 'AdminController@talent_email_verify')->name('admin.talents.email-verify');
    Route::post('/user-talents/{id}/phone-verify', 'AdminController@talent_phone_verify')->name('admin.talents.phone-verify');
    Route::post('/user-talents/{id}/acc-verify', 'AdminController@talent_acc_verify')->name('admin.talents.acc-verify');
    Route::post('/user-talents/{id}/acc-ban', 'AdminController@talent_acc_ban')->name('admin.talents.acc-ban');
    Route::post('/user-talents/talent-create', 'AdminController@talent_create')->name('admin.userTalents.talent_create');

    // Admins
    Route::get('/user-admins', 'AdminController@userAdmins')->name('admin.userAcc.admins');
    Route::post('/user-admins/{id}/email-verify', 'AdminController@admin_email_verify');
    Route::post('/user-admins/{id}/phone-verify', 'AdminController@admin_phone_verify');
    Route::post('/user-admins/{id}/acc-verify', 'AdminController@admin_acc_verify');
    Route::post('/user-admins/{id}/acc-ban', 'AdminController@admin_acc_ban');
    Route::post('/user-admins/admin-create', 'AdminController@admin_create')->name('admin.userAdmins.admin_create');
});
