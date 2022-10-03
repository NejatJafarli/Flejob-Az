<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRegisterRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use App\Models\EducationLevel;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyPhones;
use App\Models\CompanyUser;
use App\Models\Education;
use App\Models\lang;
use App\Models\Link;
use App\Models\UsersAndCategories;
use App\Models\UsersAndCities;
use App\Models\UsersAndLanguages;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return "Welcome to our homepage";
    }
    public function Hom($lang)
    {

        $Vacancies = Vacancy::where('status', 1)->orderBy('id', 'desc')->take(30)->get();
        //Merge Vacancies with Owner Company User
        $Vacancies = $Vacancies->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });
        $lang_id = lang::where('LanguageCode', $lang)->first()->id;

        //merge vacancies with category
        $Vacancies = $Vacancies->map(function ($Vacancy)use ($lang_id) {
            $cat=Category::where('id', $Vacancy->Category_id)->first();
            $Vacancy->Category = $cat->category_langs()->where('lang_id', $lang_id)->first();
            $Vacancy->Category->StyleClass = $cat->StyleClass;
            $Vacancy->Category->SortOrder = $cat->SortOrder;
            
            return $Vacancy;
        });

        // merge vacancies with city
        $Vacancies = $Vacancies->map(function ($Vacancy)use ($lang_id) {
            $city=City::where('id', $Vacancy->City_id)->first();
            $Vacancy->City = $city->cityLang()->where('lang_id', $lang_id)->first();
            return $Vacancy;
        });


        return view('Frontend/Index')->with('Vacancies', $Vacancies);
    }
    public function index()
    {
        // get all categories
        $categories = Category::all();
        //get all languages
        $languages = Language::all();
        //get all cities
        $cities = City::all();
        //get all education level
        $education_level = EducationLevel::All();
        return view('User')->with([
            'categories' => $categories,
            'languages' => $languages,
            'cities' => $cities,
            'education_levels' => $education_level
        ]);
    }
    public function index2()
    {
        $categories = Category::all();
        return view("test")->with([
            'categories' => $categories
        ]);
    }
    public function Company()
    {
        // get all categories
        $categories = Category::all();

        return view("CompanyUser")->with([
            'categories' => $categories
        ]);
    }
    // public function SELECT USER ALL DATA()
    // {

    //     $MyData = [];

    //     $MyUser = User::all()->first();

    //     $temp = Link::where('user_id', $MyUser->id)->get();

    //     //create associative array
    //     $MyData['links'] = [];
    //     foreach ($temp as $item) {
    //         $MyData['links'][$item->LinkName] = [];
    //         $MyData['links'][$item->LinkName]['LinkName'] = $item->LinkName;
    //         $MyData['links'][$item->LinkName]['Link'] = $item->Link;
    //     }
    //     $temp = Education::where('user_id', $MyUser->id)->get();
    //     $MyData['education'] = [];
    //     foreach ($temp as $item) {
    //         $MyData['education'][$item->EducationName] = [];
    //         $MyData['education'][$item->EducationName]['EducationName'] = $item->EducationName;
    //         $MyData['education'][$item->EducationName]['EducationLevel_id'] = $item->EducationLevel_Id;
    //         $MyData['education'][$item->EducationName]['Year'] = $item->Year;
    //     }
    //     $temp = Company::where('user_id', $MyUser->id)->get();
    //     $MyData['company'] = [];
    //     foreach ($temp as $item) {
    //         $MyData['company'][$item->CompanyName] = [];
    //         $MyData['company'][$item->CompanyName]['CompanyName'] = $item->CompanyName;
    //         $MyData['company'][$item->CompanyName]['Rank'] = $item->Rank;
    //         $MyData['company'][$item->CompanyName]['Date'] = $item->Date;
    //     }
    //     $temp = UsersAndCategories::where('user_id', $MyUser->id)->get();

    //     $MyData['categories'] = [];
    //     foreach ($temp as $item) {
    //         $temp2 = Category::where('id', $item->category_id)->get()->first();
    //         $MyData['categories'][$temp2->CategoryName] = [];
    //         $MyData['categories'][$temp2->CategoryName]['Category_id'] = $item->Category_id;
    //         $MyData['categories'][$temp2->CategoryName]['CategoryName'] = $item->CategoryName;
    //     }
    //     $temp = UsersAndLanguages::where('user_id', $MyUser->id)->get();
    //     $MyData['languages'] = [];

    //     foreach ($temp as $item) {

    //         $temp2 = Language::where('id', $item->language_id)->get()->first();
    //         $MyData['languages'][$temp2->LanguageName] = [];
    //         $MyData['languages'][$temp2->LanguageName]['Language_id'] = $item->language_id;
    //         $MyData['languages'][$temp2->LanguageName]['LanguageName'] = $temp2->LanguageName;
    //     }

    //     dd($MyData);
    // }
    public function registerUser(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $data['Password'] = bcrypt($data['Password']);
        $data['Password_confirmation'] = bcrypt($data['Password_confirmation']);

        //dowload request image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;


        $data['City_id'] = $data['City'];


        $user = User::create($data);
        // $user->City_Id = $data['City'];

        $data['EducationName'] = $data['educationName'];
        $data['Year'] = $data['educationYear'];
        $data['EducationLevel_Id'] = $data['educationLevel'];

        unset($data['educationName']);
        unset($data['educationYear']);
        unset($data['educationLevel']);

        $user->save();

        //create one to many relation between user and education
        for ($i = 0; $i < count($data['EducationName']); $i++) {
            $education = new Education();
            $education->EducationName = $data['EducationName'][$i];
            $education->EducationLevel_id = $data['EducationLevel_Id'][$i];
            $education->Year = $data['Year'][$i];
            $education->user_id = $user->id;
            $education->save();
        }

        for ($i = 0; $i < count($data['LinkName']); $i++) {
            $link = new Link();
            $link->LinkName = $data['LinkName'][$i];
            $link->Link = $data['Link'][$i];
            $link->user_id = $user->id;
            $link->save();
        }

        for ($i = 0; $i < count($data['companyname']); $i++) {
            $company = new Company();
            $company->CompanyName = $data['companyname'][$i];
            $company->Rank = $data['companyrank'][$i];
            $company->Date = $data['companydate'][$i];
            $company->user_id = $user->id;
            $company->save();
        }

        $user->usersAndCategories()->attach($data['Categories']);
        $user->usersAndLanguages()->attach($data['Languages']);


        dd($user);
        // return view('RegisterUser')->with(compact('user'));
    }
    public function registerCompany(CompanyRegisterRequest $request)
    {
        //check CompanyPhone Array Is Match Regex /^\+994\d{9}$/
        $data = $request->validated();
        $regex = '/^\+994\d{9}$/';
        $IsMatch = false;
        foreach ($data['CompanyPhone'] as $item) {
            if (preg_match($regex, $item))
                $IsMatch = true;
            else {
                $IsMatch = false;
                break;
            }
        }

        if (!$IsMatch)
            return redirect()->back()->withErrors(['CompanyPhone' => __("companyValidation.Enter your phone number correctly")]);

        $data['CompanyPassword'] = bcrypt($data['CompanyPassword']);


        //dowload request image
        $image = $request->file('CompanyLogo');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('CompanyLogos'), $imageName);
        $data['CompanyLogo'] = $imageName;

        $data['CompanyWebSiteLink'] = $data['CompanyLink'];

        // $CompanyUser = CompanyUser::create($data);

        //create company User With WebSiteLink
        $CompanyUser = new CompanyUser();
        $CompanyUser->CompanyName = $data['CompanyName'];
        $CompanyUser->CompanyUsername = $data['CompanyUsername'];
        $CompanyUser->CompanyEmail = $data['CompanyEmail'];
        $CompanyUser->CompanyPassword = $data['CompanyPassword'];
        $CompanyUser->CompanyAddress = $data['CompanyAdress'];
        $CompanyUser->CompanyLogo = $data['CompanyLogo'];
        $CompanyUser->CompanyDescription = $data['CompanyDescription'];
        $CompanyUser->CompanyWebSiteLink = $data['CompanyWebSiteLink'];

        $CompanyUser->save();

        $CompanyUser->CompanyAndCategories()->attach($data['Categories']);



        for ($i = 0; $i < count($data['CompanyPhone']); $i++) {
            $phone = new CompanyPhones();
            $phone->CompanyPhone = $data['CompanyPhone'][$i];
            $phone->CompanyUser_Id = $CompanyUser->id;
            $phone->save();
        }

        // dd($CompanyUser);

        // return view("RegisterCompany");
    }
}
