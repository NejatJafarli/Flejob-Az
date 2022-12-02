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


Route::group(['prefix' => '{language}'], function () {

    //check if session
    if (session()->has('user'))
        HomeController::MergeUsersTable(session()->get('user'));
    if (session()->has('CompanyUser'))
        HomeController::MergeCompanyUsersTable(session()->get('CompanyUser'));

    //Singup and Login Controller

    Route::post('/registerUser', [LoginRegisterController::class, 'registerUser'])->name('RegisterUser');
    Route::post('/registerCompany', [LoginRegisterController::class, 'registerCompany'])->name('RegisterCompany');
    Route::post('/Signin', [LoginRegisterController::class, 'Signin'])->name('Signin');
    Route::post('/SigninCompany', [LoginRegisterController::class, 'SigninCompany'])->name('SigninCompany');

    Route::get('/Signup', [LoginRegisterController::class, 'Signup'])->name('Signup');
    Route::get('/Signin', [LoginRegisterController::class, 'SigninPage'])->name('Signin');
    Route::get('/LogoutCompany', [LoginRegisterController::class, 'LogoutCompany'])->name('LogoutCompany');
    Route::get('/Logout', [LoginRegisterController::class, 'Logout'])->name('Logout');
    Route::get('/ResetPasswordUser', [LoginRegisterController::class, 'ResetPasswordUser'])->name('ResetPasswordUser');
    Route::get('/ResetPasswordCompany', [LoginRegisterController::class, 'ResetPasswordCompany'])->name('ResetPasswordCompany');

    Route::post('/ResetPasswordUserPost', [LoginRegisterController::class, 'ResetPasswordPostUser'])->name('ResetPasswordPostUser');
    Route::post('/ResetPasswordCompanyPost', [LoginRegisterController::class, 'ResetPasswordPostCompany'])->name('ResetPasswordPostCompany');

    Route::get('/EnterNewPassword/{id}', [LoginRegisterController::class, 'EnterNewPassword'])->name('EnterNewPassword');
    Route::post('/EnterNewPasswordPost', [LoginRegisterController::class, 'EnterNewPasswordPost'])->name('EnterNewPasswordPost');

    Route::post('/SignUpControllerAjax', [LoginRegisterController::class, 'SignUpControllerAjax'])->name('SignUpControllerAjax');
    Route::post('/SignUpCompanyControllerAjax', [LoginRegisterController::class, 'SignUpCompanyControllerAjax'])->name('SignUpCompanyControllerAjax');


    
    ////


    //ACCOUNT CONTROLLER
    Route::group(['prefix' => 'Account'], function () {

        Route::post('/Edit/User', [AccountController::class, 'UpdateUser'])->name('UpdateUser');
        Route::post('/Edit/Educations', [AccountController::class, 'UpdateUserEducation'])->name('UpdateUserEducation');
        Route::post('/Edit/Companies', [AccountController::class, 'UpdateUserCompany'])->name('UpdateUserCompany');
        Route::post('/Edit/Link', [AccountController::class, 'UpdateUserlink'])->name('UpdateUserlink');
        Route::post('/Edit/User/Password', [AccountController::class, 'UpdateUserPassword'])->name('UpdateUserPassword');


        Route::post('/Delete/Educations', [AccountController::class, 'DeleteUserEducation'])->name('DeleteUserEducation');
        Route::post('/Delete/Companies', [AccountController::class, 'DeleteUserCompany'])->name('DeleteUserCompany');
        Route::post('/Delete/Link', [AccountController::class, 'DeleteUserLink'])->name('DeleteUserLink');

        Route::get('', [AccountController::class, 'Account'])->name('Account');
        Route::get('/Change/Password', [AccountController::class, 'ChangePass'])->name('ChangePass');
        Route::get('/MyResume', [AccountController::class, 'MyResume'])->name('MyResume');
        Route::get('/AppliedJobs', [AccountController::class, 'AppliedJobs'])->name('AppliedJobs');

        Route::get('/Messages', [AccountController::class, 'Messages'])->name('Messages');
    });
    Route::group(['prefix' => 'AccountCompany'], function () {

        Route::post('/Edit/User', [AccountController::class, 'UpdateCompanyUser'])->name('UpdateCompanyUser');
        Route::post('/Edit/Phones', [AccountController::class, 'UpdateCompanyUserPhones'])->name('UpdateCompanyUserPhones');

        Route::get('/Delete/Phones/{id}', [AccountController::class, 'DeletePhoneNumber'])->name('DeletePhoneNumber');
        Route::get('/Edit/Password', [AccountController::class, 'UpdateCompanyUserPassword'])->name('UpdateCompanyUserPassword');


        Route::get('/Change/Password', [AccountController::class, 'ChangePassCompany'])->name('ChangePassCompany');
        Route::get('', [AccountController::class, 'AccountCompany'])->name('AccountCompany');
        Route::get('/Vacancies', [AccountController::class, 'AccountCompanyVacancies'])->name('AccountCompanyVacancies');


        Route::get('/AppliedCandidates/{id}', [AccountController::class, 'AppliedCandidates'])->name('AppliedCandidates');
    });
    ////

    //HOME CONTROLLER
    Route::get('/', [HomeController::class, 'Hom'])->name('Hom');
    Route::get('/ApplyVacancy/{id}', [HomeController::class, 'ApplyVacancy'])->name('ApplyVacancy');
    Route::get('/CandidateDetails/{id}', [HomeController::class, 'CandidateDetails'])->name('CandidateDetails');

    Route::get('/Companies', [HomeController::class, 'Companies'])->name('Companies');

    Route::get('/Candidates', [HomeController::class, 'Candidates'])->name('Candidates');

    Route::get('/Categories', [HomeController::class, 'Categories'])->name('Categories');
    Route::get('/Blogs', [HomeController::class, 'Blogs'])->name('Blog');
    Route::get('/BlogDetails/{id}', [HomeController::class, 'BlogDetail'])->name('BlogDetail');

    Route::get('/Contact', [HomeController::class, 'Contact'])->name('Contact');
    Route::post('/ContactUs', [HomeController::class, 'ContactUs'])->name('ContactUs');

    Route::get('/FindAJob', [HomeController::class, 'FindAJob'])->name('FindAJob');

    Route::get('/About', [HomeController::class, 'About'])->name('About');

    Route::get('/terms-condition', [HomeController::class, 'terms'])->name('terms');
    Route::get('/Faq', [HomeController::class, 'Faq'])->name('Faq');
    Route::get('/Privacy-Policy', [HomeController::class, 'Privacy'])->name('Privacy');

    Route::get('/PostAJob', [HomeController::class, 'PostAJob'])->name('PostAJob');
    Route::post('/PostAJob', [HomeController::class, 'PostAJobPost'])->name('PostAJobPost');

    Route::get('/404', [HomeController::class, 'NotFound'])->name('NotFound');
    Route::get('/SendMessage/{id}', [HomeController::class, 'SendMessage'])->name('SendMessage');
    Route::post('/SendMessage', [HomeController::class, 'SendMessagePost'])->name('SendMessagePost');

    Route::get('/Job-Details/{id}', [HomeController::class, 'JobDetails'])->name('JobDetails');

    //route admin group
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [AdminPanelController::class, 'Login'])->name('Login');
        Route::get('/login', [AdminPanelController::class, 'Login'])->name('Login');
        Route::get('/logout', [AdminPanelController::class, 'Logout'])->name('AdminLogout');

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
        Route::post('/Config/add', [AdminPanelController::class, 'SetPaymentDataAddPost'])->name('SetPaymentDataAddPost');

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
