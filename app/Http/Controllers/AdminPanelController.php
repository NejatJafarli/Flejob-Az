<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\VacancyAddRequest;
use App\Models\Category;
use App\Models\category_lang;
use App\Models\City;
use App\Models\city_lang;
use App\Models\CompanyUser;
use App\Models\Education;
use App\Models\education_level_langs;
use App\Models\EducationLevel;
use App\Models\lang as ModelsLang;
use App\Models\Language;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminPanelController extends Controller
{
    //Login Logout Checks
    public function LoginAdminPanel(AdminLoginRequest $req)
    {
        $user = $req->username;
        $pass = $req->password;
        if ($user == 'admin' && $pass == 'admin') {
            session()->put('AdminUser', $user);
            return redirect()->route('Panel', app()->getLocale());
        } else
            return
                redirect()->back()->withErrors(['fail' => 'Invalid username or password']);
    }
    public function Login()
    {
        if (session()->has('AdminUser'))
            return view('adminPanel/AdminIndex');
        else
            return view('adminPanel/AdminLogin');
    }
    public function Logout()
    {
        if (session()->has('AdminUser')) {
            session()->pull('AdminUser');
            return redirect()->route('Login', app()->getLocale());
        } else
            return view('adminPanel/AdminLogin');
    }


    //index pages
    public function index()
    {
        if (session()->has('AdminUser'))
            return view('adminPanel/AdminIndex');
        else
            return redirect()->route('Login', app()->getLocale());
    }
    public function category()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        //get all category from database
        $Langs = ModelsLang::all();
        $cat_lang = category_lang::all();

        return  view('AdminPanel/Category/AdminCategory')->with(['categories' => $cat_lang, 'languages' => $Langs]);
    }
    public function Languages()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $languages = Language::all();
        return view('AdminPanel/Language/AdminLanguage')->with('Languages', $languages);
    }
    public function City()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $Langs = ModelsLang::all();
        $city_lang = city_lang::all();

        return  view('AdminPanel/City/AdminCity')->with(['cities' => $city_lang, 'languages' => $Langs]);
    }
    public function EducationLevel()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $Langs = ModelsLang::all();
        $edl = education_level_langs::all();

        return  view('AdminPanel/EducationLevel/AdminEducationLevel')->with(['EducationLevels' => $edl, 'languages' => $Langs]);
    }
    public function MultiLanguage()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $Langs = ModelsLang::all();

        return  view('AdminPanel/MultiLanguage/AdminMultiLanguage')->with(['Languages' => $Langs]);
    }
    public function CompanyUser()
    {

        //get all company users from database
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());
        $companyUsers = CompanyUser::all();

        return  view('AdminPanel/CompanyUser/AdminCompanyUser')->with(['Companies' => $companyUsers]);
    }
    public function User()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $users = User::all();

        return  view('AdminPanel/User/AdminUser')->with(['Users' => $users]);
    }
    public function Vacancy()
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $vacancies = Vacancy::all();

        return  view('AdminPanel/Vacancy/AdminVacancy')->with(['Vacancies' => $vacancies]);
    }



    //Add Pages
    public function AddCategory(CategoryRequest $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        // dd($req);
        $cat = new Category();
        $cat->StyleClass = $req->StyleClass;
        $cat->SortOrder = $req->SortOrder;
        $cat->save();
        $i = 0;
        foreach ($req->LanguageCode as $key) {
            $cat_lang = new category_lang();
            $cat_lang->CategoryName = $req->CategoryName[$key];
            $cat_lang->MetaTitle = $req->MetaTitle[$key];
            $cat_lang->MetaDescription = $req->MetaDescription[$key];
            $cat_lang->MetaKeywords = $req->MetaKeywords[$key];
            $cat_lang->category_id = $cat->id;
            $cat_lang->lang_id = $req->LanguageCodeId[$i];
            $cat_lang->save();
            $i++;
        }

        return redirect()->back()->with('success', 'Category Added Successfully');
    }
    public function AddLanguage(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req->validate([
            'LanguageName' => 'required'
        ]);

        $req = $req->all();

        $lang = Language::create($req);

        $lang->save();

        return redirect()->back()->with('success', 'Language Added Successfully');
    }
    public function AddCity(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $City = new City();
        $City->save();
        $i = 0;
        foreach ($req->LanguageCode as $key) {
            $city_lang = new city_lang();
            $city_lang->CityName = $req->CityName[$key];
            $city_lang->city_id = $City->id;
            $city_lang->lang_id = $req->LanguageCodeId[$i];
            $city_lang->save();
            $i++;
        }

        return redirect()->back()->with('success', 'City Added Successfully');
    }
    public function AddEducationLevel(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $i = 0;
        //create education
        $education = new EducationLevel();
        $education->save();
        foreach ($req->LanguageCode as $key) {
            $edl = new education_level_langs();
            $edl->EducationLevelName = $req->EducationLevelName[$key];
            $edl->lang_id = $req->LanguageCodeId[$i];
            $edl->education_level_id = $education->id;
            $edl->save();
            $i++;
        }

        return redirect()->back()->with('success', 'Education Level Added Successfully');
    }
    public function AddMultiLanguage(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req = $req->all();
        $lang = new ModelsLang();
        $lang->LanguageName = $req['LanguageName'];
        $lang->LanguageCode = $req['LanguageCode'];
        $lang->LanguageFlag = $req['LanguageFlag'];
        $lang->save();

        return redirect()->back()->with('success', 'Multi Language Added Successfully');
    }

    //Delete Pages
    public function DeleteCategory($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $cat = Category::find($id);
        //delete category lang
        $cat_lang = category_lang::where('category_id', $id)->get();
        foreach ($cat_lang as $key) {
            $key->delete();
        }
        //delete category
        $cat->delete();


        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
    public function DeleteLanguage($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $lang = Language::find($id);
        $lang->delete();

        return redirect()->back()->with('success', 'Language Deleted Successfully');
    }
    public function DeleteCity($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $city = City::find($id);
        $city_lang = city_lang::where('city_id', $id)->get();
        foreach ($city_lang as $key) {
            $key->delete();
        }
        $city->delete();

        return redirect()->back()->with('success', 'City Deleted Successfully');
    }
    public function DeleteEducationLevel($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $edl = EducationLevel::find($id);
        //get education level langs
        $edl_lang = education_level_langs::where('education_level_id', $id)->get();
        foreach ($edl_lang as $key) {
            $key->delete();
        }
        $edl->delete();

        return redirect()->back()->with('success', 'Education Level Deleted Successfully');
    }
    public function DeleteMultiLanguage($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $lang = ModelsLang::find($id);
        $lang->delete();

        return redirect()->back()->with('success', 'Multi Language Deleted Successfully');
    }



    //Edit Pages
    public function EditCategory($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        //get all category from database
        $Langs = ModelsLang::all();
        $cat = Category::find($id);
        $cat_lang = category_lang::where('category_id', $id)->get();

        //get cat lang array
        $arr = $cat_lang->toArray();
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]['StyleClass'] = $cat->StyleClass;
            $arr[$i]['SortOrder'] = $cat->SortOrder;
        }
        return  view('AdminPanel/Category/AdminCategoryEdit')->with(['categories' => $arr, 'languages' => $Langs]);
    }
    public function EditLanguage($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $lang = Language::find($id);
        return view('AdminPanel/Language/AdminLanguageEdit')->with('Language', $lang);
    }
    public function EditCity($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $Langs = ModelsLang::all();
        $city_lang = city_lang::where('city_id', $id)->get();


        return view('AdminPanel/City/AdminCityEdit')->with(['cities' => $city_lang, 'languages' => $Langs]);
    }
    public function EditEducationLevel($lang, $id)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $Langs = ModelsLang::all();
        $edl_lang = education_level_langs::where('education_level_id', $id)->get();

        return view('AdminPanel/EducationLevel/AdminEducationLevelEdit')->with(['education_levels' => $edl_lang, 'languages' => $Langs]);
    }
    //edit vacancy
    public function EditVacancy($lang, $id)
    {

        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $vacancy = Vacancy::find($id);
        //get all city
        $allcity = City::all();
        //merge city_lang with city
        
        //Merge Vacancies with Owner Company User
        $lang_id = ModelsLang::where('LanguageCode', $lang)->first()->id;

        //merge vacancies with category
        $allcity = $allcity->map(function ($city)use ($lang_id) {
            $cat=City::where('id', $city->id)->first();
            $city->CityName = $cat->cityLang()->where('lang_id', $lang_id)->first()->CityName;
            return $city;
        });
        

        return view('AdminPanel/Vacancy/AdminVacancyEdit')->with(['vac'=>$vacancy,'cities'=>$allcity]);
    }




    //Update Pages
    public function UpdateCategory(CategoryRequest $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        // dd($req);
        $cat = Category::find($req->CatId);
        $cat->StyleClass = $req->styleClass;
        $cat->SortOrder = $req->SortOrder;
        $cat->save();

        //get category lang id from $cat
        $cat_lang = category_lang::where('category_id', $cat->id)->get();
        $cat_lang = $cat_lang->toArray();
        $catId = Arr::pluck($cat_lang, 'id');
        $i = 0;
        foreach ($req->LanguageCode as $key) {
            $cat_lang = category_lang::find($catId[$i]);
            $cat_lang->CategoryName = $req->CategoryName[$key];
            $cat_lang->MetaTitle = $req->MetaTitle[$key];
            $cat_lang->MetaDescription = $req->MetaDescription[$key];
            $cat_lang->MetaKeywords = $req->MetaKeywords[$key];
            $cat_lang->category_id = $cat->id;
            $cat_lang->lang_id = $req->LanguageCodeId[$i];
            $cat_lang->save();
            $i++;
        }

        return redirect()->back()->withErrors('Category Updated Successfully');
    }
    public function UpdateLanguage(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req->validate([
            'LanguageName' => 'required'
        ]);

        //get req assosiate array
        $req = $req->all();

        //insert data to database
        $lang = Language::find($req['id']);
        $lang->update($req);

        //insert data to lang table
        $lang->save();

        return redirect()->back()->withErrors('Language Updated Successfully');
    }
    public function UpdateCity(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $city = City::find($req->CityId);
        $city->save();

        //get category lang id from $cat
        $city_lang = city_lang::where('city_id', $city->id)->get();
        $city_lang = $city_lang->toArray();
        $cityId = Arr::pluck($city_lang, 'id');
        $i = 0;
        foreach ($req->LanguageCode as $key) {
            $city_lang = city_lang::find($cityId[$i]);
            $city_lang->CityName = $req->CityName[$key];
            $city_lang->city_id = $city->id;
            $city_lang->lang_id = $req->LanguageCodeId[$i];
            $city_lang->save();
            $i++;
        }
        return redirect()->back()->withErrors('City Updated Successfully');
    }
    public function UpdateEducationLevel(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $edl = EducationLevel::find($req->EdlId);

        //get category lang id from $cat
        $edl_lang = education_level_langs::where('education_level_id', $edl->id)->get();
        $edl_lang = $edl_lang->toArray();
        $edlId = Arr::pluck($edl_lang, 'id');
        $i = 0;
        foreach ($req->LanguageCode as $key) {
            $edl_lang = education_level_langs::find($edlId[$i]);
            $edl_lang->EducationLevelName = $req->EducationLevelName[$key];
            $edl_lang->education_level_id = $edl->id;
            $edl_lang->lang_id = $req->LanguageCodeId[$i];
            $edl_lang->save();
            $i++;
        }
        return redirect()->back()->withErrors('Education Level Updated Successfully');
    }
    public function UpdateMultiLanguage(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req->validate([
            'LanguageName' => 'required',
            'LanguageCode' => 'required',
        ]);

        $req = $req->all();

        $lang = Language::find($req['id']);
        $lang->update($req);

        $lang->save();

        return redirect()->back()->withErrors('Language Updated Successfully');
    }
    public function UpdateVacancy(VacancyAddRequest $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $vac = Vacancy::find($req->id);
        $vac->Category_id = $req->Category_id;
        $vac->CompanyUser_id = $req->CompanyUser_id;
        $vac->VacancyName = $req->VacancyName;
        $vac->VacancyDescription = $req->VacancyDescription;
        $vac->PersonPhone = $req->PersonPhone;
        $vac->PersonName = $req->PersonName;
        $vac->Email = $req->Email;
        $vac->PersonPhone = $req->PersonPhone;
        $vac->VacancySalary = $req->VacancySalary;
        $vac->Status = $req->Status;
        $vac->City_id = $req->City_id;
        $vac->save();
        
        return redirect()->back()->withErrors(['success' => 'Vacancy Updated Successfully']);
    }






    //status
    public function ChangeStatusOfCompany(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req = $req->all();
        $company = CompanyUser::find($req['id']);
        if (isset($req['status']))
            $company->Status = 1;
        else
            $company->Status = 0;
        $company->save();

        return redirect()->back()->with('success', 'Company Status Changed Successfully');
    }
    public function ChangeStatusOfUser(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req = $req->all();
        $company = User::find($req['id']);
        if (isset($req['status']))
            $company->Status = 1;
        else
            $company->Status = 0;
        $company->save();

        return redirect()->back()->with('success', 'Company Status Changed Successfully');
    }
    public function ChangeStatusOfVacancy(Request $req)
    {
        if (!session()->has('AdminUser'))
            return redirect()->route('Login', app()->getLocale());

        $req = $req->all();
        $vacancy = Vacancy::find($req['id']);
        if (isset($req['status']))
            $vacancy->Status = 1;
        else
            $vacancy->Status = 0;
        $vacancy->save();

        return redirect()->back()->with('success', 'Vacancy Status Changed Successfully');
    }
}
