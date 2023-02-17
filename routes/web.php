<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginRegisterController;
use Illuminate\Support\Facades\App;
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
//     return redirect()->route('Hom', 'az');
// });
Route::get('/', [HomeController::class, 'Hom2'])->name('Hom2');


Route::group(['prefix' => '{language}'], function () {
    //check if session
    if (session()->has('user'))
        HomeController::MergeUsersTable(session()->get('user'));
    if (session()->has('CompanyUser'))
        HomeController::MergeCompanyUsersTable(session()->get('CompanyUser'));


        Route::post('/payment/success/premium', [HomeController::class, 'paymentSuccessForPremium'])->name('paymentSuccessForPremium');
        Route::post('/payment/success/CompanyUser', [HomeController::class, 'paymentSuccessForCompanyPremium'])->name('paymentSuccessForCompanyPremium');
        Route::post('/payment/success/User', [HomeController::class, 'paymentSuccessForPremiumUser'])->name('paymentSuccessForPremiumUser');

        Route::post('/payment/success', [HomeController::class, 'paymentSuccess'])->name('paymentSuccess');
        Route::post('/payment/decline', [HomeController::class, 'paymentDecline'])->name('paymentDecline');
        Route::post('/payment/canceled', [HomeController::class, 'paymentCanceled'])->name('paymentCanceled');
    //Singup and Login Controller

    Route::post('/registerUser', [LoginRegisterController::class, 'registerUser'])->name('RegisterUser');
    Route::post('/registerCompany', [LoginRegisterController::class, 'registerCompany'])->name('RegisterCompany');
    Route::post('/SigninCompany', [LoginRegisterController::class, 'SigninCompany'])->name('SigninCompany');

    Route::get('/sign-up', [LoginRegisterController::class, 'Signup'])->name('Signup');
    Route::get('/sign-in', [LoginRegisterController::class, 'SigninPage'])->name('Signin');
    Route::post('/signinPost', [LoginRegisterController::class, 'SigninPost'])->name('SigninPost');
    Route::get('/logout-company', [LoginRegisterController::class, 'LogoutCompany'])->name('LogoutCompany');
    Route::get('/logout', [LoginRegisterController::class, 'Logout'])->name('Logout');
    Route::get('/reset-password-user', [LoginRegisterController::class, 'ResetPasswordUser'])->name('ResetPasswordUser');
    Route::get('/reset-password-company', [LoginRegisterController::class, 'ResetPasswordCompany'])->name('ResetPasswordCompany');

    Route::post('/reset-password-userPost', [LoginRegisterController::class, 'ResetPasswordPostUser'])->name('ResetPasswordPostUser');
    Route::post('/reset-password-companyPost', [LoginRegisterController::class, 'ResetPasswordPostCompany'])->name('ResetPasswordPostCompany');

    Route::get('/enter-new-password/{id}', [LoginRegisterController::class, 'EnterNewPassword'])->name('EnterNewPassword');
    Route::post('/enter-new-passwordPost', [LoginRegisterController::class, 'EnterNewPasswordPost'])->name('EnterNewPasswordPost');

    Route::post('/sign-up-controller-ajax', [LoginRegisterController::class, 'SignUpControllerAjax'])->name('SignUpControllerAjax');
    Route::post('/sign-up-company-controller-ajax', [LoginRegisterController::class, 'SignUpCompanyControllerAjax'])->name('SignUpCompanyControllerAjax');


    //// Payment Section
    Route::get('ads', [HomeController::class, 'ads'])->name('adsAdd');

    Route::post('payment', [HomeController::class, 'payment'])->name('payment');
    Route::post('payment2', [HomeController::class, 'payment2'])->name('payment2');
    Route::get('payment3', [HomeController::class, 'paymentForPremiumCompanyUser'])->name('paymentForPremiumCompanyUser');
    Route::get('payment4', [HomeController::class, 'paymentForPremiumUser'])->name('paymentForPremiumUser');


    //ACCOUNT CONTROLLER
    Route::group(['prefix' => 'account'], function () {

        Route::post('/edit/user', [AccountController::class, 'UpdateUser'])->name('UpdateUser');
        Route::post('/edit/educations', [AccountController::class, 'UpdateUserEducation'])->name('UpdateUserEducation');
        Route::post('/edit/companies', [AccountController::class, 'UpdateUserCompany'])->name('UpdateUserCompany');
        Route::post('/edit/link', [AccountController::class, 'UpdateUserlink'])->name('UpdateUserlink');
        Route::post('/edit/user/password', [AccountController::class, 'UpdateUserPassword'])->name('UpdateUserPassword');


        Route::post('/delete/educations', [AccountController::class, 'DeleteUserEducation'])->name('DeleteUserEducation');
        Route::post('/delete/companies', [AccountController::class, 'DeleteUserCompany'])->name('DeleteUserCompany');
        Route::post('/delete/link', [AccountController::class, 'DeleteUserLink'])->name('DeleteUserLink');

        Route::get('', [AccountController::class, 'Account'])->name('Account');
        Route::get('/change/password', [AccountController::class, 'ChangePass'])->name('ChangePass');
        Route::get('/my-resume', [AccountController::class, 'MyResume'])->name('MyResume');
        Route::get('/applied-jobs', [AccountController::class, 'AppliedJobs'])->name('AppliedJobs');

        Route::get('/messages', [AccountController::class, 'Messages'])->name('Messages');
    });
    Route::group(['prefix' => 'account-company'], function () {

        Route::post('/edit/user', [AccountController::class, 'UpdateCompanyUser'])->name('UpdateCompanyUser');
        Route::post('/edit/phones', [AccountController::class, 'UpdateCompanyUserPhones'])->name('UpdateCompanyUserPhones');

        Route::get('/delete/phones/{id}', [AccountController::class, 'DeletePhoneNumber'])->name('DeletePhoneNumber');
        Route::get('/edit/password', [AccountController::class, 'UpdateCompanyUserPassword'])->name('UpdateCompanyUserPassword');


        Route::get('/change/password', [AccountController::class, 'ChangePassCompany'])->name('ChangePassCompany');
        Route::get('', [AccountController::class, 'AccountCompany'])->name('AccountCompany');
        Route::get('/vacancies', [AccountController::class, 'AccountCompanyVacancies'])->name('AccountCompanyVacancies');


        Route::get('/applied-candidates/{id}', [AccountController::class, 'AppliedCandidates'])->name('AppliedCandidates');
    });
    ////

    //HOME CONTROLLER
    Route::get('/', [HomeController::class, 'Hom'])->name('Hom');
    Route::get('/apply-vacancy/{id}', [HomeController::class, 'ApplyVacancy'])->name('ApplyVacancy');
    Route::get('/candidate-details/{id}', [HomeController::class, 'CandidateDetails'])->name('CandidateDetails');

    Route::get('/companies', [HomeController::class, 'Companies'])->name('Companies');

    Route::get('/candidates', [HomeController::class, 'Candidates'])->name('Candidates');

    Route::get('/categories', [HomeController::class, 'Categories'])->name('Categories');
    Route::get('/blogs', [HomeController::class, 'Blogs'])->name('Blog');
    Route::get('/blog-details/{id}', [HomeController::class, 'BlogDetail'])->name('BlogDetail');

    Route::get('/contact', [HomeController::class, 'Contact'])->name('Contact');
    Route::post('/contact-us', [HomeController::class, 'ContactUs'])->name('ContactUs');

    Route::get('/find-a-job', [HomeController::class, 'FindAJob'])->name('FindAJob');

    Route::get('/about', [HomeController::class, 'About'])->name('About');

    Route::get('/terms-condition', [HomeController::class, 'terms'])->name('terms');
    Route::get('/faq', [HomeController::class, 'Faq'])->name('Faq');
    Route::get('/privacy-policy', [HomeController::class, 'Privacy'])->name('Privacy');

    Route::get('/edit-a-job/{id}', [HomeController::class, 'EditAJob'])->name('EditAJob');
    Route::post('/edit-a-jobPost', [HomeController::class, 'EditAJobPost'])->name('EditAJobPost');

    Route::get('/post-a-job', [HomeController::class, 'PostAJob'])->name('PostAJob');
    Route::post('/post-a-job', [HomeController::class, 'PostAJobPost'])->name('PostAJobPost');

    Route::get('/404', [HomeController::class, 'NotFound'])->name('NotFound');
    Route::get('/send-message/{id}', [HomeController::class, 'SendMessage'])->name('SendMessage');
    Route::post('/send-message', [HomeController::class, 'SendMessagePost'])->name('SendMessagePost');

    Route::get('/vacancies', [HomeController::class, 'vacancies'])->name('vacancies');
    // Route::get('/job-details/{id}', [HomeController::class, 'JobDetails'])->name('JobDetails');
    Route::get('/vacancies/{categorySlug}', [HomeController::class, 'vacancyCategories'])->name('vacancyCategories');
    Route::get('/vacancies/{categorySlug}/{slug}', [HomeController::class, 'vacancyDetails'])->name('vacancyDetails');

    //route admin group
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [AdminPanelController::class, 'Login'])->name('Login');
        //Route::get('/login', [AdminPanelController::class, 'Login'])->name('Login');
        Route::get('/logout', [AdminPanelController::class, 'Logout'])->name('AdminLogout');
        
        Route::get('/AdsManager', [AdminPanelController::class, 'GetAds'])->name('GetAds');
        Route::post('/AdsManager/add', [AdminPanelController::class, 'AddAdsPost'])->name('AddAdsPost');
        Route::get('/AdsManager/edit/{id}', [AdminPanelController::class, 'EditAds'])->name('EditAds');
        Route::post('/AdsManager/UpdateAds', [AdminPanelController::class, 'UpdateAds'])->name('UpdateAds');
        
        Route::get('/index', [AdminPanelController::class, 'index'])->name('Panel');

        Route::get('/category', [AdminPanelController::class, 'category'])->name('Category');
        Route::get('/category/delete/{id}', [AdminPanelController::class, 'DeleteCategory'])->name('DeleteCategory');
        Route::get('/category/edit/{id}', [AdminPanelController::class, 'EditCategory'])->name('EditCategory');

        Route::get('/languages', [AdminPanelController::class, 'languages'])->name('language');
        Route::get('/languages/delete/{id}', [AdminPanelController::class, 'DeleteLanguage'])->name('DeleteLanguage');
        Route::get('/languages/edit/{id}', [AdminPanelController::class, 'EditLanguage'])->name('EditLanguage');

        Route::get('/City', [AdminPanelController::class, 'City'])->name('City');
        Route::get('/City/delete/{id}', [AdminPanelController::class, 'DeleteCity'])->name('DeleteCity');
        Route::get('/City/edit/{id}', [AdminPanelController::class, 'EditCity'])->name('EditCity');

        Route::get('/educationlevel', [AdminPanelController::class, 'Educationlevel'])->name('Educationlevel');
        Route::get('/educationlevel/delete/{id}', [AdminPanelController::class, 'DeleteEducationLevel'])->name('DeleteEducationLevel');
        Route::get('/educationlevel/edit/{id}', [AdminPanelController::class, 'EditEducationLevel'])->name('EditEducationLevel');

        Route::get('/MultiLanguage', [AdminPanelController::class, 'MultiLanguage'])->name('MultiLanguage');
        Route::get('/MultiLanguage/delete/{id}', [AdminPanelController::class, 'DeleteMultiLanguage'])->name('DeleteMultiLanguage');
        Route::get('/MultiLanguage/edit/{id}', [AdminPanelController::class, 'EditMultiLanguage'])->name('EditMultiLanguage');
        
        Route::get('/CompanyUser', [AdminPanelController::class, 'CompanyUser'])->name('CompanyUser');
        Route::get('/User', [AdminPanelController::class, 'User'])->name('User');
        Route::get('/Vacancy', [AdminPanelController::class, 'Vacancy'])->name('Vacancy');
        Route::get('/Vacancy/edit/{id}', [AdminPanelController::class, 'EditVacancy'])->name('EditVacancy');
        Route::post('/Vacancy/UpdateVacancy', [AdminPanelController::class, 'UpdateVacancy'])->name('UpdateVacancy');

        Route::get('/Config', [AdminPanelController::class, 'SetPaymentData'])->name('SetPaymentData');
        Route::get('/Config/Set', [AdminPanelController::class, 'SetPaymentDataPost'])->name('SetPaymentDataPost');
        Route::post('/UpdateConfigAjax', [AdminPanelController::class, 'UpdateConfigAjax'])->name('UpdateConfig');
        Route::post('/DeleteConfigAjax', [AdminPanelController::class, 'DeleteConfigAjax'])->name('DeleteConfig');
        Route::post('/DeleteConfig', [AdminPanelController::class, 'DeleteConfig'])->name('DeleteConfigNormal');
        Route::post('/AddConfig', [AdminPanelController::class, 'SetPaymentDataAddPost'])->name('SetPaymentDataAddPost');

        Route::get('/Vacancy/Requests', [AdminPanelController::class, 'VacancyRequest'])->name('VacancyRequest');
        Route::get('/Vacancy/View/{id}', [AdminPanelController::class, 'VacancyRequestView'])->name('VacancyRequestView');

        Route::get('/Vacancy/Request/Accept/{id}', [AdminPanelController::class, 'VacancyRequestAccept'])->name('VacancyRequestAccept');
        Route::get('/Vacancy/Request/Reject/{id}', [AdminPanelController::class, 'VacancyRequestReject'])->name('VacancyRequestReject');

        Route::get('/Vacancy/RequestView/Accept/{id}', [AdminPanelController::class, 'VacancyRequestAcceptView'])->name('VacancyRequestAcceptView');
        Route::get('/Vacancy/RequestView/Reject/{id}', [AdminPanelController::class, 'VacancyRequestRejectView'])->name('VacancyRequestRejectView');
        
        Route::get('/Blogs', [AdminPanelController::class, 'Blogs'])->name('Blogs');
        Route::post('/Blogs/Add', [AdminPanelController::class, 'AddBlogs'])->name('AddBlogs');
        Route::get('/Blogs/Edit/{id}', [AdminPanelController::class, 'EditBlogs'])->name('EditBlogs');
        Route::get('/Blogs/Delete/{id}', [AdminPanelController::class, 'DeleteBlogs'])->name('DeleteBlogs');

        Route::post('/Blogs/Update', [AdminPanelController::class, 'UpdateBlogs'])->name('UpdateBlogs');
        
        Route::get('/HtmlEditor', [AdminPanelController::class, 'Editor'])->name('HtmlEditor');
        // Route::get('/index', [AdminPanelController::class, 'index'])->name('City');
        // Route::get('/index', [AdminPanelController::class, 'index'])->name('Education Level');
        // Route::get('/index', [AdminPanelController::class, 'index'])->name('Company User');
        // Route::get('/index', [AdminPanelController::class, 'index'])->name('Vacancy');
        // Route::get('/index', [AdminPanelController::class, 'index'])->name('Users');
        Route::post('/Vacancy/Status', [AdminPanelController::class, 'ChangeStatusOfVacancy'])->name('ChangeStatusOfVacancy');
        Route::post('/CompanyUser/Status', [AdminPanelController::class, 'ChangeStatusOfCompany'])->name('ChangeStatusOfCompany');
        Route::post('/User/Status', [AdminPanelController::class, 'ChangeStatusOfUser'])->name('ChangeStatusOfUser');

        Route::post('/MultiLanguage/add', [AdminPanelController::class, 'AddMultiLanguage'])->name('AddMultiLanguage');
        Route::post('/MultiLanguage/UpdateMultiLanguage', [AdminPanelController::class, 'UpdateMultiLanguage'])->name('UpdateMultiLanguage');

        Route::post('/educationlevel/add', [AdminPanelController::class, 'AddEducationLevel'])->name('AddEducationLevel');
        Route::post('/educationlevel/UpdateEducationLevel', [AdminPanelController::class, 'UpdateEducationLevel'])->name('UpdateEducationLevel');

        Route::post('/City/add', [AdminPanelController::class, 'AddCity'])->name('AddCity');
        Route::post('/City/UpdateCity', [AdminPanelController::class, 'UpdateCity'])->name('UpdateCity');

        Route::post('/languages/add', [AdminPanelController::class, 'AddLanguage'])->name('AddLanguage');
        Route::post('/languages/Updatelanguage', [AdminPanelController::class, 'UpdateLanguage'])->name('UpdateLanguage');

        Route::post('/category/add', [AdminPanelController::class, 'AddCategory'])->name('AddCategory');
        Route::post('/category/UpdateCategory', [AdminPanelController::class, 'UpdateCategory'])->name('UpdateCategory');

        Route::post('/CheckLogin', [AdminPanelController::class, 'LoginAdminPanel'])->name('LoginAdmin');
    });
});
