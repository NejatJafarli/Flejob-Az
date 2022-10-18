<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomeController;
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

    Route::post('/registerUser', [HomeController::class, 'registerUser'])->name('RegisterUser');
    Route::post('/registerCompany', [HomeController::class, 'registerCompany'])->name('RegisterCompany');
    Route::post('/Signin', [HomeController::class, 'Signin'])->name('Signin');
    Route::post('/SigninCompany', [HomeController::class, 'SigninCompany'])->name('SigninCompany');

    Route::post('/Account/Edit/User', [HomeController::class, 'UpdateUser'])->name('UpdateUser');

    Route::post('/Account/Edit/Educations', [HomeController::class, 'UpdateUserEducation'])->name('UpdateUserEducation');
    Route::post('/Account/Edit/Companies', [HomeController::class, 'UpdateUserCompany'])->name('UpdateUserCompany');
    Route::post('/Account/Edit/Link', [HomeController::class, 'UpdateUserlink'])->name('UpdateUserlink');
    Route::post('/Account/Edit/User/Password', [HomeController::class, 'UpdateUserPassword'])->name('UpdateUserPassword');

    Route::post('/Account/Delete/Educations', [HomeController::class, 'DeleteUserEducation'])->name('DeleteUserEducation');
    Route::post('/Account/Delete/Companies', [HomeController::class, 'DeleteUserCompany'])->name('DeleteUserCompany');
    Route::post('/Account/Delete/Link', [HomeController::class, 'DeleteUserLink'])->name('DeleteUserLink');


    Route::post('/AccountCompany/Edit/User', [HomeController::class, 'UpdateCompanyUser'])->name('UpdateCompanyUser');
    Route::post('/AccountCompany/Edit/Phones', [HomeController::class, 'UpdateCompanyUserPhones'])->name('UpdateCompanyUserPhones');

    Route::get('/AccountCompany/Delete/Phones/{id}', [HomeController::class, 'DeletePhoneNumber'])->name('DeletePhoneNumber');
    Route::get('/AccountCompany/Edit/Password', [HomeController::class, 'UpdateCompanyUserPassword'])->name('UpdateCompanyUserPassword');



    Route::get('/LogoutCompany', [HomeController::class, 'LogoutCompany'])->name('LogoutCompany');
    Route::get('/Logout', [HomeController::class, 'Logout'])->name('Logout');


    Route::get('/', [HomeController::class, 'Hom'])->name('Hom');
    Route::get('/ApplyVacancy/{id}', [HomeController::class, 'ApplyVacancy'])->name('ApplyVacancy');
    Route::get('/Signup', [HomeController::class, 'Signup'])->name('Signup');

    Route::get('/Signin', [HomeController::class, 'SigninPage'])->name('Signin');

    Route::get('/Account', [HomeController::class, 'Account'])->name('Account');
    Route::get('/Account/Change/Password', [HomeController::class, 'ChangePass'])->name('ChangePass');
    Route::get('/Account/MyResume', [HomeController::class, 'MyResume'])->name('MyResume');
    Route::get('/Account/AppliedJobs', [HomeController::class, 'AppliedJobs'])->name('AppliedJobs');
    
    
    Route::get('/AccountCompany/Change/Password', [HomeController::class, 'ChangePassCompany'])->name('ChangePassCompany');
    Route::get('/AccountCompany', [HomeController::class, 'AccountCompany'])->name('AccountCompany');




    Route::get('/Job-Details/{id}', [HomeController::class, 'JobDetails'])->name('JobDetails');

    Route::post('/SignUpControllerAjax', [HomeController::class, 'SignUpControllerAjax'])->name('SignUpControllerAjax');
    Route::post('/SignUpCompanyControllerAjax', [HomeController::class, 'SignUpCompanyControllerAjax'])->name('SignUpCompanyControllerAjax');


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
