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
use Illuminate\Support\Facades\Hash;

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
        $Vacancies = $Vacancies->map(function ($Vacancy) use ($lang_id) {
            $cat = Category::where('id', $Vacancy->Category_id)->first();
            $Vacancy->Category = $cat->category_langs()->where('lang_id', $lang_id)->first();
            $Vacancy->Category->StyleClass = $cat->StyleClass;
            $Vacancy->Category->SortOrder = $cat->SortOrder;

            return $Vacancy;
        });

        // merge vacancies with city
        $Vacancies = $Vacancies->map(function ($Vacancy) use ($lang_id) {
            $city = City::where('id', $Vacancy->City_id)->first();
            $Vacancy->City = $city->cityLang()->where('lang_id', $lang_id)->first();
            return $Vacancy;
        });



        //get top 10 categories
        $Categories = Category::orderBy('SortOrder', 'desc')->take(10)->get();
        //merge categories with category_langs
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });

        //count vacancies in each category
        $Categories = $Categories->map(function ($Category) {
            $Category->VacanciesCount = Vacancy::where('Category_id', $Category->id)->where('status', 1)->count();
            return $Category;
        });

        //get company users
        $CompanyUsers = CompanyUser::where('status', 1)->orderBy('id', 'desc')->take(30)->get();
        //merge company users with vacancies
        $CompanyUsers = $CompanyUsers->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });
        // get users
        $Users = User::where('status', 1)->orderBy('id', 'desc')->take(30)->get();
        //merge users with categories and users
        $Users = $Users->map(function ($User) use ($lang_id) {
            $User->temp = UsersAndCategories::where('User_id', $User->id)->get();

            $User->temp = $User->temp->map(function ($UserCategory) use ($lang_id) {
                $UserCategory->Category = Category::where('id', $UserCategory->category_id)->first();
                $UserCategory->Category->Category_lang = $UserCategory->Category->category_langs()->where('lang_id', $lang_id)->first();
                return $UserCategory;
            });

            $User->Categories = $User->temp->Pluck('Category');

            $User->Languages = UsersAndLanguages::where('User_id', $User->id)->get();
            $User->Languages = $User->Languages->map(function ($UserLanguage) use ($lang_id) {
                $UserLanguage->Language = Language::where('id', $UserLanguage->language_id)->first();
                return $UserLanguage;
            });
            $User->Languages = $User->Languages->Pluck('Language');
            return $User;
        });

        //merge Users With City
        $Users = $Users->map(function ($User) use ($lang_id) {
            $User->City = City::where('id', $User->City_id)->first();
            $User->City->CityLang = $User->City->cityLang()->where('lang_id', $lang_id)->first();
            return $User;
        });



        //get all langs
        $Langs = lang::all();


        return view('Frontend/Index')->with(['Users' => $Users, 'CompanyUsers' => $CompanyUsers, 'Categories' => $Categories, 'Vacancies' => $Vacancies, "Langs" => $Langs]);
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
    public function Account($lang)
    {

        //check session
        if (!session()->has('user'))
            return redirect()->route('Signin', ['language' => $lang]);
        // get all city
        $cities = City::all();
        //merge cities with city langs
        $cities = $cities->map(function ($city) use ($lang) {
            $city->CityLang = $city->cityLang()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $city;
        });



        // get all Langs
        $langs = lang::all();


        return view("FrontEnd/account")->with([
            'cities' => $cities,
            'Langs' => $langs
        ]);
    }

    public function Signup($lang)
    {

        //check session
        if (session()->has('user'))
            return redirect()->route('Hom', ['language' => $lang]);

        $Langs = lang::all();
        //get all cities
        $lang_id = lang::where('LanguageCode', $lang)->first()->id;


        $cities = City::all();
        //merge cities with city_langs
        $cities = $cities->map(function ($city) use ($lang_id) {
            $city->city_lang = $city->cityLang()->where('lang_id', $lang_id)->first();
            return $city;
        });
        //get all education level
        $education_level = EducationLevel::All();
        //merge education_level with education_level_langs
        $education_level = $education_level->map(function ($education_level) use ($lang_id) {
            $education_level->EducationLevel_lang = $education_level->education_level_langs()->where('lang_id', $lang_id)->first();
            return $education_level;
        });

        //get all categories
        $categories = Category::all();
        //merge categories with category_langs
        $categories = $categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });

        //get all languages
        $languages = Language::all();

        return view("FrontEnd/signup")->with([
            'categories' => $categories,
            'languages' => $languages,
            'cities' => $cities,
            'education_levels' => $education_level,
            'Langs' => $Langs
        ]);
    }
    public function Logout($lang)
    {
        //remove user from session
        session()->forget('user');

        return redirect()->route('Hom', ['language' => $lang]);
    }

    public function SigninPage($lang)
    {

        // user session have redirect to home page
        if (session()->has('user'))
            return redirect()->route('Hom', ['language' => $lang]);

        $Langs = lang::all();

        return view("FrontEnd/signin", ["Langs" => $Langs]);
    }

    public function Signin($lang, Request $req)
    {
        if (session()->has('user'))
            return redirect()->route('Hom', ['language' => $lang]);
        //check if user exist
        $user = User::where('email', $req->Email)->first();
        //check if user is null get req->Username
        if ($user == null) {
            $user = User::where('Username', $req->Email)->first();
        }
        $pass = md5(md5($req->Password));
        //show all session

        if ($user != null)
            if ($pass == $user->Password) {
                //check if user status is active
                if ($user->Status == 1) {

                    // get users
                    // //merge users with categories and users
                    $user->temp = UsersAndCategories::where('User_id', $user->id)->get();

                    //get lang id
                    $lang_id = lang::where('LanguageCode', $lang)->first()->id;

                    $user->temp = $user->temp->map(function ($UserCategory) use ($lang_id) {
                        $UserCategory->Category = Category::where('id', $UserCategory->category_id)->first();
                        $UserCategory->Category->Category_lang = $UserCategory->Category->category_langs()->where('lang_id', $lang_id)->first();
                        return $UserCategory;
                    });

                    $user->Categories = $user->temp->Pluck('Category');
                    //unset temp

                    //merge users with languages and users
                    $user->temp = UsersAndLanguages::where('User_id', $user->id)->get();

                    $user->temp = $user->temp->map(function ($UserLanguage) {
                        $UserLanguage->Language = Language::where('id', $UserLanguage->language_id)->first();
                        return $UserLanguage;
                    });

                    $user->Languages = $user->temp->Pluck('Language');


                    //merge users with city
                    $user->City = City::where('id', $user->City_id)->first();
                    $user->City->CityLang = $user->City->cityLang()->where('lang_id', $lang_id)->first();


                    unset($user->temp);


                    session()->put('user', $user);
                    return redirect()->route('Hom', ['language' => $lang]);
                } else
                    //user is not active
                    return redirect()->route('Signin', ['language' => $lang])->withErrors(['errors' => 'Your Account is not active']);
            } else {
                return redirect()->route('Signin', ['language' => $lang])->withErrors(['errors' => 'Email or Password is incorrect']);
            }

        return view("FrontEnd/signin");
    }


    public function registerUser($lang, UserRegisterRequest $req)
    {

        if (session()->has('user'))
            return redirect()->route('Hom', ['language' => $lang]);

        $data = $req->validated();

        //check EducationYear is valid

        $regex = '/^\d{4}$/';
        $IsMatch = false;
        if (isset($data['educationYear'])) {
            foreach ($data['educationYear'] as $item) {
                if (preg_match($regex, $item))
                    $IsMatch = true;
                else {
                    $IsMatch = false;
                    break;
                }
            }
            if (!$IsMatch)
                return response()->json(['errors' => [__("validationUser.Enter your year correctly")]]);
        }
        // if LinkName is empty send error to view
        if (isset($data['LinkName']))
            foreach ($data['LinkName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your link name correctly")]]);
        // If Link is empty send error to view  
        if (isset($data['Link']))
            foreach ($data['Link'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your link correctly")]]);
        // if CompanyName is empty send error to view
        if (isset($data['companyname']))
            foreach ($data['companyname'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company name correctly")]]);
        // if CompanyRank is empty send error to view
        if (isset($data['companyrank']))
            foreach ($data['CompanyRank'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company rank correctly")]]);
        // if companydate is empty send error to view
        if (isset($data['companydate']))
            foreach ($data['companydate'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
        // if educationName is empty send error to view
        if (isset($data['educationName']))
            foreach ($data['educationName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your education name correctly")]]);
        // if educationLevel is empty send error to view
        if (isset($data['educationLevel']))
            foreach ($data['educationLevel'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your education level correctly")]]);




        $data['Password'] = md5(md5($data['Password']));
        $data['Password_confirmation'] = md5(md5($data['Password_confirmation']));

        //dowload request image
        $image = $req->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('CandidatesPicture'), $imageName);
        $data['image'] = $imageName;




        $data['City_id'] = $data['City'];

        // $user->City_Id = $data['City'];

        $data['EducationName'] = isset($data['educationName']) ? $data['educationName'] : null;
        $data['Year'] = isset($data['educationYear']) ? $data['educationYear'] : null;
        $data['EducationLevel_Id'] = isset($data['educationLevel']) ? $data['educationLevel'] : null;


        $data['Skills'] = isset($req->Skills) ? $req->Skills : null;
        $data['Description'] = isset($req->Description) ? $req->Description : null;
        $data['MinSalary'] = isset($req->MinSalary) ? $req->MinSalary : null;
        $data['MaxSalary'] = isset($req->MaxSalary) ? $req->MaxSalary : null;

        $user = User::create($data);
        unset($data['educationName']);
        unset($data['educationYear']);
        unset($data['educationLevel']);

        $user->save();

        //create one to many relation between user and education
        if (isset($data['EducationName']))
            for ($i = 0; $i < count($data['EducationName']); $i++) {
                $education = new Education();
                $education->EducationName = $data['EducationName'][$i];
                $education->EducationLevel_id = $data['EducationLevel_Id'][$i];
                $education->Year = $data['Year'][$i];
                $education->user_id = $user->id;
                $education->save();
            }

        if (isset($data['LinkName']))
            for ($i = 0; $i < count($data['LinkName']); $i++) {
                $link = new Link();
                $link->LinkName = $data['LinkName'][$i];
                $link->Link = $data['Link'][$i];
                $link->user_id = $user->id;
                $link->save();
            }


        if (isset($data['companyname']))
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



        $Vacancies = Vacancy::where('status', 1)->orderBy('id', 'desc')->take(30)->get();
        //Merge Vacancies with Owner Company User
        $Vacancies = $Vacancies->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });
        $lang_id = lang::where('LanguageCode', $lang)->first()->id;

        //merge vacancies with category
        $Vacancies = $Vacancies->map(function ($Vacancy) use ($lang_id) {
            $cat = Category::where('id', $Vacancy->Category_id)->first();
            $Vacancy->Category = $cat->category_langs()->where('lang_id', $lang_id)->first();
            $Vacancy->Category->StyleClass = $cat->StyleClass;
            $Vacancy->Category->SortOrder = $cat->SortOrder;

            return $Vacancy;
        });

        // merge vacancies with city
        $Vacancies = $Vacancies->map(function ($Vacancy) use ($lang_id) {
            $city = City::where('id', $Vacancy->City_id)->first();
            $Vacancy->City = $city->cityLang()->where('lang_id', $lang_id)->first();
            return $Vacancy;
        });



        //get top 10 categories
        $Categories = Category::orderBy('SortOrder', 'desc')->take(10)->get();
        //merge categories with category_langs
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });

        //count vacancies in each category
        $Categories = $Categories->map(function ($Category) {
            $Category->VacanciesCount = Vacancy::where('Category_id', $Category->id)->where('status', 1)->count();
            return $Category;
        });

        //get company users
        $CompanyUsers = CompanyUser::where('status', 1)->orderBy('id', 'desc')->take(30)->get();
        //merge company users with vacancies
        $CompanyUsers = $CompanyUsers->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });
        // get users
        $Users = User::where('status', 1)->orderBy('id', 'desc')->take(30)->get();
        //merge users with categories and users
        $Users = $Users->map(function ($User) use ($lang_id) {
            $User->temp = UsersAndCategories::where('User_id', $User->id)->get();

            $User->temp = $User->temp->map(function ($UserCategory) use ($lang_id) {
                $UserCategory->Category = Category::where('id', $UserCategory->category_id)->first();
                $UserCategory->Category->Category_lang = $UserCategory->Category->category_langs()->where('lang_id', $lang_id)->first();
                return $UserCategory;
            });

            $User->Categories = $User->temp->Pluck('Category');

            $User->Languages = UsersAndLanguages::where('User_id', $User->id)->get();
            $User->Languages = $User->Languages->map(function ($UserLanguage) use ($lang_id) {
                $UserLanguage->Language = Language::where('id', $UserLanguage->language_id)->first();
                return $UserLanguage;
            });
            $User->Languages = $User->Languages->Pluck('Language');
            return $User;
        });

        //merge Users With City
        $Users = $Users->map(function ($User) use ($lang_id) {
            $User->City = City::where('id', $User->City_id)->first();
            $User->City->CityLang = $User->City->cityLang()->where('lang_id', $lang_id)->first();
            return $User;
        });

        //get all langs
        $Langs = lang::all();

        return view('Frontend/Index')->with(['Users' => $Users, 'CompanyUsers' => $CompanyUsers, 'Categories' => $Categories, 'Vacancies' => $Vacancies, "Langs" => $Langs]);
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




    public function SignUpControllerAjax(UserRegisterRequest $req)
    {
        if (session()->has('user'))
            return redirect()->route('Hom', ['language' => app()->getLocale()]);
        $data = $req->validated();

        //check EducationYear is valid with regex
        $regex = '/^\d{4}$/';
        $IsMatch = false;
        if (isset($data['educationYear'])) {
            foreach ($data['educationYear'] as $item) {
                if (preg_match($regex, $item))
                    $IsMatch = true;
                else {
                    $IsMatch = false;
                    break;
                }
            }
            if (!$IsMatch)
                return response()->json(['errors' => [__("validationUser.Enter your year correctly")]]);
        }

        // if LinkName is empty send error to view
        if (isset($data['LinkName']))
            foreach ($data['LinkName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your link name correctly")]]);
        // If Link is empty send error to view  
        if (isset($data['Link']))
            foreach ($data['Link'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your link correctly")]]);
        // if CompanyName is empty send error to view
        if (isset($data['companyname']))
            foreach ($data['companyname'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company name correctly")]]);
        // if CompanyRank is empty send error to view
        if (isset($data['companyrank']))
            foreach ($data['CompanyRank'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company rank correctly")]]);
        // if companydate is empty send error to view
        if (isset($data['companydate']))
            foreach ($data['companydate'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
        // if educationName is empty send error to view
        if (isset($data['educationName']))
            foreach ($data['educationName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your education name correctly")]]);
        // if educationLevel is empty send error to view
        if (isset($data['educationLevel']))
            foreach ($data['educationLevel'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your education level correctly")]]);
        return response()->json(['success' => 'Success ']);
    }
}
