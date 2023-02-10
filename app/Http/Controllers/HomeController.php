<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRegisterRequest;
use App\Http\Requests\EditAccount;
use App\Http\Requests\UserRegisterRequest;
use App\Models\blog;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use App\Models\EducationLevel;
use App\Models\City;
use App\Models\Company;
use App\Models\company_and_categories;
use App\Models\CompanyPhones;
use App\Models\CompanyUser;
use App\Models\contact_message;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\lang;
use App\Models\wallet;
use App\Models\category_lang;
use App\Models\wallet_transaction;
use App\Models\Link;
use App\Models\Message;
use App\Models\NotificationForCompanyUser;
use App\Models\subscribe_vacancy;
use App\Models\UsersAndCategories;
use App\Models\UsersAndCities;
use App\Models\UsersAndLanguages;
use App\Models\Vacancy;
use App\QueryFilters\Category as QueryFiltersCategory;
use App\QueryFilters\City as QueryFiltersCity;
use App\QueryFilters\Company as QueryFiltersCompany;
use App\QueryFilters\MaxSalary as MaxSalaryFilter;
use App\QueryFilters\MinSalary as MinSalaryFilter;
use App\QueryFilters\VacancyName as VacancyNameFilter;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Models\config;


class HomeController extends Controller
{
    
    public function __invoke(Request $request)
    {
        return "Welcome to our homepage";
    }
    public function ads($lang){

        return view('FrontEnd/addads');
    }
    //STATIC FUNCTIONS
    static function MergeUsersTable($user)
    {
        //update session
        $user->temp = UsersAndCategories::where('User_id', $user->id)->get();

        //get lang id
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;

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


        //merge users with educations
        $user->temp = Education::where('User_id', $user->id)->get();

        $user->temp = $user->temp->map(function ($UserEducation) use ($lang_id) {
            $UserEducation->Education = $UserEducation;
            $UserEducation->Education->EducationLevel = EducationLevel::where('id', $UserEducation->EducationLevel_Id)->first();
            $UserEducation->Education->EducationLevel->EducationLevelLang = $UserEducation->EducationLevel->education_level_langs()->where('lang_id', $lang_id)->first();
            return $UserEducation;
        });

        $user->Educations = $user->temp->Pluck('Education');
        //merge users with Companies
        $user->Companies = Company::where('user_id', $user->id)->get();




        //merger users with links
        $user->Links = Link::where('User_id', $user->id)->get();



        //merge users with subscribed vacancies
        $user->AppliedVacancies = subscribe_vacancy::where('User_id', $user->id)->get();






        unset($user->temp);

        return $user;
    }
    static function MergeCompanyUsersTable($CompanyUser)
    {
        //update session
        $CompanyUser->temp = company_and_categories::where('CompanyUser_Id', $CompanyUser->id)->get();

        //get lang id
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;

        $CompanyUser->temp = $CompanyUser->temp->map(function ($UserCategory) use ($lang_id) {
            $UserCategory->Category = Category::where('id', $UserCategory->category_id)->first();
            $UserCategory->Category->Category_lang = $UserCategory->Category->category_langs()->where('lang_id', $lang_id)->first();
            return $UserCategory;
        });

        $CompanyUser->Categories = $CompanyUser->temp->Pluck('Category');
        //unset temp

        //merge CompanyUser with Company and CompanyPhones
        $CompanyUser->CompanyPhones = CompanyPhones::where('CompanyUser_Id', $CompanyUser->id)->get();

        //merge CompanyUser with Vacancies
        $CompanyUser->Vacancies = Vacancy::where('CompanyUser_Id', $CompanyUser->id)->where('Status', 1)->get();



        session()->put('CompanyUser', $CompanyUser);
        return $CompanyUser;
    }

    //PAGES INVOKER\

    public function NotFound()
    {
        return view('FrontEnd/404');
    }
    public function PostAJob()
    {
        if (!session()->has('CompanyUser'))
            return redirect()->back();

        $CompanyUser = session()->get('CompanyUser');
        $CompanyUser = $this->MergeCompanyUsersTable($CompanyUser);

        //get all cities
        $Cities = City::all();
        //get all categories
        $Categories = Category::all();

        //get lang id
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;

        //merge categories with category lang
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });
        //merge cities with city lang
        $Cities = $Cities->map(function ($City) use ($lang_id) {
            $City->CityLang = $City->cityLang()->where('lang_id', $lang_id)->first();
            return $City;
        });

        return view('FrontEnd/post-job')->with(['Cities' => $Cities, 'Categories' => $Categories]);
    }
    public function Privacy()
    {
        return view('FrontEnd/privacy-policy');
    }
    public function Faq()
    {
        return view('FrontEnd/faq');
    }
    public function terms()
    {
        return view('FrontEnd/terms-condition');
    }
    public function Blogs($lang)
    {
        $Blogs = Blog::orderBy('id', 'desc')->paginate(6);
        return view('FrontEnd/blog')->with(['blogs' => $Blogs]);
    }
    public function BlogDetail($lang, $id)
    {

        $blog = Blog::find($id);
        //take last 5 blogs
        $LastBlogs = Blog::orderBy('id', 'desc')->take(5)->get();

        return view('FrontEnd/blog-details')->with(['blog' => $blog, "myIdBool" => true, "myId" => $id, 'lastBlogs' => $LastBlogs]);
    }
    public function Contact()
    {
        return view('FrontEnd/contact');
    }
    public function CandidateDetails($lang, $id)
    {

        $user = User::where('id', $id)->first();
        $user = HomeController::MergeUsersTable($user);

        return view('FrontEnd/candidate-details', ['can' => $user, "myIdBool" => true, "myId" => $id]);
    }
    public function Candidates($lang)
    {
        //get last 8 users and paginate
        $users = User::orderBy('id', 'desc')->paginate(8);
        $preUsers = User::where('PremiumEndDate', '!=', 'null')->take(4)->get();

        //get first category of each user   
        return view('FrontEnd/candidate', ['users' => $users,'preUsers'=>$preUsers]);
    }
    public function EditAJob($lang,$id){
        if (!session()->has('CompanyUser'))
            return redirect()->back();

        $CompanyUser = session()->get('CompanyUser');
        $CompanyUser = $this->MergeCompanyUsersTable($CompanyUser);



        //get all cities
        $Cities = City::all();
        //get all categories
        $Categories = Category::all();

        //get lang id
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;

        //merge categories with category lang
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });
        //merge cities with city lang
        $Cities = $Cities->map(function ($City) use ($lang_id) {
            $City->CityLang = $City->cityLang()->where('lang_id', $lang_id)->first();
            return $City;
        });

        $vac = Vacancy::find($id);
        if($vac == null)
            return redirect()->back();

        if($vac->CompanyUser_id != $CompanyUser->id)
            return redirect()->back();

        return view('FrontEnd/edit-job')->with(['Cities' => $Cities,"myIdBool" => true, "myId" => $id,'Categories' => $Categories,'vac'=>$vac]);
    }
    public function EditAJobPost(Request $req)
    {
        $messages =  [
            'VacancyName.required' => __('validation.Job Title is required'),
            'Email.required' => __('validation.Email is required'),
            'Email.email' => __('validation.Email is not valid'),
            'PersonPhone.required' => __('validation.Phone is required'),
            'PersonPhone.regex' => __('validation.Phone is not valid'),
            'CompanyUser.required' => __('validation.Company User is required'),
            'Category.required' => __('validation.Category is required'),
            'City.required' => __('validation.City is required'),
            'PersonName.required' => __('validation.Person Name is required'),

        ];
        $req->validate([
            'VacancyName' => 'required',
            'Email' => 'required|email',
            'PersonPhone' => 'required | regex:/^\+994\d{9}$/',
            'CompanyUser' => 'required',
            'Category' => 'required | numeric',
            'City' => 'required | numeric',
            'PersonName' => 'required',
            'VacancyDescription' => 'required',
            'VacancyRequirements' => 'required',
            'VacancySalary' => 'required'
        ], $messages);


        $vac=Vacancy::find($req->vacId);
        //create vacancy with $req
        $data = [];
        $data['CompanyUser_id'] = $req->CompanyUser;
        $data['Category_id'] = $req->Category;
        $data['City_id'] = $req->City;
        $data['Status'] = $vac->Status;
        // data['EndDate'] date now + 1 month 
        $data['EndDate'] = $vac->EndDate;

        $data['VacancyDescription'] = $req->VacancyDescription;
        $data['VacancyRequirements'] = $req->VacancyRequirements;
        $data['VacancySalary'] = $req->VacancySalary;
        $data['VacancyName'] = $req->VacancyName;
        $data['PersonName'] = $req->PersonName;
        $data['PersonPhone'] = $req->PersonPhone;
        $data['Email'] = $req->Email;

        //edit vacancy
        $vac->fill($data);
        $vac->save();

        return redirect()->route('AccountCompanyVacancies', ['language' => app()->getLocale()]);
    }
    public function FindAJob($lang)
    {
        $jobs = Vacancy::where('Status', 1);

       

        $jobs = app(Pipeline::class)->send($jobs)
            ->through([
                VacancyNameFilter::class,
                QueryFiltersCategory::class,
                QueryFiltersCity::class,
                MinSalaryFilter::class,
                MaxSalaryFilter::class,
                QueryFiltersCompany::class
            ])
            ->thenReturn();
 //order by jobs id desc and sortOrder desc
 $jobs = $jobs->orderBy('id', 'desc');

 

        $jobs = $jobs->paginate(90);

        $PreVacancies = Vacancy::where('status', 1)->where("PremiumEndDate",'!=',"null")->orderBy('PremiumEndDate', 'desc')->take(12)->get();
        //Merge Vacancies with Owner Company User
        $PreVacancies = $PreVacancies->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });

        //get all cities
        $cities = City::all();
        //merge cities with city langs
        $cities = $cities->map(function ($city) use ($lang) {
            $city->CityLang = $city->cityLang()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $city;
        });


        //get all categories orderby sort
        $categories = Category::orderBy('SortOrder', 'desc')->get();
        //merge categories with category langs
        $categories = $categories->map(function ($category) use ($lang) {
            $category->CategoryLang = $category->category_langs()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $category;
        });


        return view('FrontEnd/find-job', ['PremiumVacancies'=>$PreVacancies,'Jobs' => $jobs, 'Cities' => $cities, 'Categories' => $categories]);
    }
    public function Hom($lang)
    {

        if(app()->getLocale()=='az'){
            app()->setLocale(null);
            return redirect()->route('Hom2');
        }

        //check session
        if (session()->has('user')) {
            $user = $this->mergeUsersTable(session()->get('user'));
            session()->put('user', $user);
        }

        $PreVacancies = Vacancy::where('status', 1)->where("PremiumEndDate",'!=',"null")->orderBy('PremiumEndDate', 'desc')->take(12)->get();
        //Merge Vacancies with Owner Company User
        $PreVacancies = $PreVacancies->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });
        $lang_id = lang::where('LanguageCode', $lang)->first()->id;

        //merge vacancies with category
        $PreVacancies = $PreVacancies->map(function ($Vacancy) use ($lang_id) {
            $cat = Category::where('id', $Vacancy->Category_id)->first();
            $Vacancy->Category = $cat->category_langs()->where('lang_id', $lang_id)->first();
            $Vacancy->Category->StyleClass = $cat->StyleClass;
            $Vacancy->Category->SortOrder = $cat->SortOrder;

            return $Vacancy;
        });

        // // merge vacancies with city
        // $PreVacancies = $PreVacancies->map(function ($Vacancy) use ($lang_id) {
        //     $city = City::where('id', $Vacancy->City_id)->first();
        //     $Vacancy->City = $city->cityLang()->where('lang_id', $lang_id)->first();
        //     return $Vacancy;
        // });



        //get top 10 categories
        $Categories = Category::orderBy('SortOrder', 'desc')->take(12)->get();
        //merge categories with category_langs
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });

        //count vacancies in each category
        $Categories = $Categories->map(function ($Category) {
            $Category->VacanciesCount = Vacancy::where('Category_id', $Category->id)->where('status', 1)->count();
            //find min and max salary in each category
            $Category->MinSalary = Vacancy::where('Category_id', $Category->id)->where('status', 1)->where('withAgreement','0')->get()->min('VacancySalary');
            $Category->MaxSalary = Vacancy::where('Category_id', $Category->id)->where('status', 1)->where('withAgreement','0')->get()->max('VacancySalary');
            return $Category;
        });

        //get company users PremiumEndDate not null
        $CompanyUsers = CompanyUser::where('status', 1)->where('PremiumEndDate', '!=', 'null')->get();
        // $CompanyUsers = CompanyUser::where('status', 1)->where(->get();
        //merge company users with vacancies
        $CompanyUsers = $CompanyUsers->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('Status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });
        $CompanyUsers = $CompanyUsers->sortByDesc('PremiumEndDate')->take(8);
        
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

        //get all cities 
        $Cities = City::all();
        //merge cities with city_langs
        $Cities = $Cities->map(function ($City) use ($lang_id) {
            $City->CityLang = $City->cityLang()->where('lang_id', $lang_id)->first();
            return $City;
        });

        $blogs = blog::orderBy('id', 'desc')->take(5)->get();
        
        $Vacancies = Vacancy::where('status', 1)->take(30)->orderBy('id','desc')->get();
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
        
        return view('FrontEnd/index')->with(['Users' => $Users, 'CompanyUsers' => $CompanyUsers, 'Cities' => $Cities, 'Categories' => $Categories,"Vacancies"=>$Vacancies, 'PremiumVacancies' => $PreVacancies, "Langs" => $Langs, 'blogs' => $blogs]);
    }
    public function Hom2()
    {
        if(request()->has('language')){
            $lang = request()->get('language');
            app()->setLocale($lang);
            return redirect()->route('Hom', ['language' => $lang]);
        }else{
            app()->setLocale('az');
        }
      

        //check session
        if (session()->has('user')) {
            $user = $this->mergeUsersTable(session()->get('user'));
            session()->put('user', $user);
        }

        $PreVacancies = Vacancy::where('status', 1)->where("PremiumEndDate",'!=',"null")->orderBy('PremiumEndDate', 'desc')->take(12)->get();
        //Merge Vacancies with Owner Company User
        $PreVacancies = $PreVacancies->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;

        //merge vacancies with category
        $PreVacancies = $PreVacancies->map(function ($Vacancy) use ($lang_id) {
            $cat = Category::where('id', $Vacancy->Category_id)->first();
            $Vacancy->Category = $cat->category_langs()->where('lang_id', $lang_id)->first();
            $Vacancy->Category->StyleClass = $cat->StyleClass;
            $Vacancy->Category->SortOrder = $cat->SortOrder;

            return $Vacancy;
        });

        // // merge vacancies with city
        // $PreVacancies = $PreVacancies->map(function ($Vacancy) use ($lang_id) {
        //     $city = City::where('id', $Vacancy->City_id)->first();
        //     $Vacancy->City = $city->cityLang()->where('lang_id', $lang_id)->first();
        //     return $Vacancy;
        // });



        //get top 10 categories
        $Categories = Category::orderBy('SortOrder', 'desc')->take(12)->get();
        //merge categories with category_langs
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            $Category->Category_lang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });

        //count vacancies in each category
        $Categories = $Categories->map(function ($Category) {
            $Category->VacanciesCount = Vacancy::where('Category_id', $Category->id)->where('status', 1)->count();
            //find min and max salary in each category
            $Category->MinSalary = Vacancy::where('Category_id', $Category->id)->where('status', 1)->where('withAgreement','0')->get()->min('VacancySalary');
            $Category->MaxSalary = Vacancy::where('Category_id', $Category->id)->where('status', 1)->where('withAgreement','0')->get()->max('VacancySalary');
            return $Category;
        });

        //get company users PremiumEndDate not null
        $CompanyUsers = CompanyUser::where('status', 1)->where('PremiumEndDate', '!=', 'null')->get();
        // $CompanyUsers = CompanyUser::where('status', 1)->where(->get();
        //merge company users with vacancies
        $CompanyUsers = $CompanyUsers->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('Status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });
        $CompanyUsers = $CompanyUsers->sortByDesc('PremiumEndDate')->take(8);
        
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

        //get all cities 
        $Cities = City::all();
        //merge cities with city_langs
        $Cities = $Cities->map(function ($City) use ($lang_id) {
            $City->CityLang = $City->cityLang()->where('lang_id', $lang_id)->first();
            return $City;
        });

        $blogs = blog::orderBy('id', 'desc')->take(5)->get();
        
        $Vacancies = Vacancy::where('status', 1)->take(30)->orderBy('id','desc')->get();
        //Merge Vacancies with Owner Company User
        $Vacancies = $Vacancies->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });

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
        
        return view('FrontEnd/index')->with(['Users' => $Users, 'CompanyUsers' => $CompanyUsers, 'Cities' => $Cities, 'Categories' => $Categories,"Vacancies"=>$Vacancies, 'PremiumVacancies' => $PreVacancies, "Langs" => $Langs, 'blogs' => $blogs]);
    }
    public function About($lang)
    {
        return view('FrontEnd/about');
    }
    public function Companies($lang)
    {
        //get company users and sort by Vacancies count
        $Companies = CompanyUser::where('status', 1)->paginate(32);
        //merge company users with vacancies
        $CompanyUsers = $Companies->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });

         // sort company users by vacancies count and premium end date 
        $CompanyUsers = $CompanyUsers->sortByDesc('VacanciesCount');

        $preComps = CompanyUser::where('status', 1)->where('PremiumEndDate', '!=', 'null')->get();
        $preComps = $preComps->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });


        return view('FrontEnd/company')->with(['PreComps'=>$preComps,'Companies' => $Companies, 'CompanyUsers' => $CompanyUsers]);
    }
    public function JobDetails($lang, $id)
    {

        $vac = Vacancy::where('id', $id)->first();

        if ($vac->Status != 1 && !session()->has("CompanyUser"))
            return redirect()->route('Hom', app()->getLocale());

        $langs = lang::all();

        //merge vacancy with city   
        $lang_id = $langs->where('LanguageCode', $lang)->first()->id;
        $vac->City = City::where('id', $vac->City_id)->first();
        $vac->City->CityLang = $vac->City->cityLang()->where('lang_id', $lang_id)->first();

        //merge vac with category
        $vac->Category = Category::where('id', $vac->Category_id)->first();
        $vac->Category->Category_lang = $vac->Category->category_langs()->where('lang_id', $lang_id)->first();

        $vac->owner = CompanyUser::where('id', $vac->CompanyUser_id)->first();
        //merge vac with CompanyUser 
        $vac->CompanyUser = CompanyUser::where('id', $vac->CompanyUser_id)->first();

        //get vacancis same category last 15
        $Vacancies = Vacancy::where('Category_id', $vac->Category_id)->where('id', '!=', $vac->id)->where('Status', 1)->orderBy('id', 'desc')->take(10)->get();
        // $Vacancies = Vacancy::where('Category_id', $vac->Category_id)->where('id', '!=', $vac->id)->where('Status', 1)->get();

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

        $vac->Owner = CompanyUser::where('id', $vac->CompanyUser_id)->first();



        return view('FrontEnd/job-Details')->with(['vac' => $vac, 'Langs' => $langs, 'Vacancies' => $Vacancies, "myIdBool" => true, "myId" => $id]);
    }
    public function Categories($lang)
    {

        //get top 10 categories paginate
        $Categories = Category::orderBy('SortOrder', 'desc')->paginate(8);
        return view('FrontEnd/catagories')->with(['Categories' => $Categories]);
    }

    //POST ACTIONS
    public function ContactUs(Request $req)
    {

        $messages =  [
            'name.required' => __('validation.name is required'),
            'email.required' => __('validation.email is required'),
            'email.email' => __('validation.email is not valid'),
            'message.required' => __('validation.message is required'),
            'phone.required' => __('validation.phone is required'),
            'phone.regex' => __('validation.phone is not valid'),
            'subject.required' => __('validation.subject is required'),

        ];
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            //regex for +994xxxxxxxxx
            'phone' => 'required | regex:/^\+994\d{9}$/',
            'subject' => 'required',
            'message' => 'required'
        ], $messages);


        $contact = new contact_message();

        $contact->FullName = $req->name;
        $contact->Email = $req->email;
        $contact->Phone = $req->phone;
        $contact->Subject = $req->subject;
        $contact->Message = $req->message;

        $contact->save();

        return redirect()->back()->with('success', 'Your Message Has Been Sent Successfully');
    }
    public function PostAJobPost(Request $req)
    {
        $messages =  [
            'VacancyName.required' => __('validation.Job Title is required'),
            'Email.required' => __('validation.Email is required'),
            'Email.email' => __('validation.Email is not valid'),
            'PersonPhone.required' => __('validation.Phone is required'),
            'PersonPhone.regex' => __('validation.Phone is not valid'),
            'CompanyUser.required' => __('validation.Company User is required'),
            'Category.required' => __('validation.Category is required'),
            'City.required' => __('validation.City is required'),
            'PersonName.required' => __('validation.Person Name is required'),

        ];
        $req->validate([
            'VacancyName' => 'required',
            'Email' => 'required|email',
            'PersonPhone' => 'required | regex:/^\+994\d{9}$/',
            'CompanyUser' => 'required',
            'Category' => 'required | numeric',
            'City' => 'required | numeric',
            'PersonName' => 'required',
            'VacancyDescription' => 'required',
            'VacancyRequirements' => 'required',
            'VacancySalary' => 'numeric',
        ], $messages);
        if($req->WithAgreement=='on'){
            $req->WithAgreement = 1;
            $req->VacancySalary = null;
        }
        else{
            $req->WithAgreement = 0;
            $req->validate([
                'VacancySalary' => 'required | numeric',
            ], $messages);
        }

        //create vacancy with $req
        $data = $req->all();
        $data['CompanyUser_id'] = $req->CompanyUser;
        $data['Category_id'] = $req->Category;
        $data['City_id'] = $req->City;
        $data['Status'] = 4;
        // data['EndDate'] date now + 1 month 
        $data['EndDate'] = date('Y-m-d', strtotime('+1 month'));

        $data['VacancyDescription'] = $req->VacancyDescription;
        $data['VacancyRequirements'] = $req->VacancyRequirements;
        $data['VacancySalary'] = $req->VacancySalary;
        $data['WithAgreement'] = $req->WithAgreement;
        $data['VacancyName'] = $req->VacancyName;
        $data['PersonName'] = $req->PersonName;
        $data['PersonPhone'] = $req->PersonPhone;
        $data['Email'] = $req->Email;

        $vacancy = Vacancy::create($data);

        $vacancy->save();

        return redirect()->route('AccountCompanyVacancies', ['language' => app()->getLocale()]);
    }
    public function ApplyVacancy($lang, $id)
    {
        if (!session()->has('user'))
            return response()->json(['redirect' => route('Signin', ['language' => app()->getLocale()])]);
        $user = User::where('id', session()->get('user')->id)->first();
        $vacancy = Vacancy::where('id', $id);
        if ($vacancy->first() == null)
            return response()->json(['errors' => [__("validationUser.This vacancy is not exist")]]);


        $vacUser = subscribe_vacancy::where('user_id', $user->id)->where('vacancy_id', $vacancy->first()->id)->first();
        if ($vacUser != null) {
            $vacUser->delete();
            $notification = NotificationForCompanyUser::where('user_id', $user->id)->where('vacancy_id', $vacancy->first()->id)->delete();
            $user = HomeController::MergeUsersTable($user);
            session()->put('user', $user);
            return response()->json(['success' => "UnApplied Successfully"]);
        } else {
        $vacancy = $vacancy->where('Status', 1)->first();
            
            //check vacancy end date
            $vacancyEndDate = $vacancy->EndDate;
            $vacancyEndDate = strtotime($vacancyEndDate);
            $today = strtotime(date('Y-m-d'));
            if ($vacancyEndDate < $today)
                return response()->json(['errors' => [__("validationUser.This vacancy is expired")]]);

            $subscribe = new subscribe_vacancy();
            $subscribe->user_id = $user->id;
            $subscribe->vacancy_id = $id;
            $subscribe->save();

            $notification = new NotificationForCompanyUser();
            $notification->user_id = $user->id;
            $notification->vacancy_id = $id;
            $notification->body = "User Applied to your vacancy";
            $notification->Status = 0;
            $notification->save();

            $user = HomeController::MergeUsersTable($user);
            session()->put('user', $user);
            return response()->json(['success' => 'Applied Successfully']);
        }
    }
    public function SendMessagePost(Request $req)
    {

        if (!session()->has('CompanyUser'))
            return response()->json(['errors' => 'You Most be login with Company User']);


        $messages =  [
            'MessageTitle.required' => __('validation.Message Title is required'),
            'Message.required' => __('validation.Message is required'),
            'UserId.required' => __('validation.User Id Is required'),
            'VacId.required' => __('validation.VacId Id Is required')

        ];
        $req->validate([
            'MessageTitle' => 'required',
            'Message' => 'required',
            'UserId' => 'required',
            'VacId' => 'required'
        ], $messages);


        //find VacId ed Vacancy owner id
        $vac = Vacancy::where('id', $req->VacId)->first();
        if ($vac == null)
            return response()->json(['errors' => 'Vacancy Not Found']);
        //find user
        $user = User::where('id', $req->UserId)->first();
        if ($user == null)
            return response()->json(['errors' => 'User Not Found']);
        //check if user is subscribed to VacId
        $sub = subscribe_vacancy::where('User_id', $user->id)->where('Vacancy_id', $vac->id)->first();
        if ($sub == null)
            return response()->json(['errors' => 'User is not subscribed to Vacancy']);

        if ($vac->CompanyUser_id != session()->get('CompanyUser')->id)
            return response()->json(['errors' => 'You are not owner of this Vacancy']);


        $msg = new Message();
        $msg->Title = $req->MessageTitle;
        $msg->message = $req->Message;
        $msg->Vacancy_id = $vac->id;
        $msg->UserId = $req->UserId;

        $msg->save();

        return response()->json(['success' => 'Message Sent Successfully']);
    }
//payment section

    public function payment(Request $req)
    {
        if (!session()->has('CompanyUser')) 
        return response()->json(['redirect' => route('Signin', ['language' => app()->getLocale()])]);
        //where status 0 or 3
        $vacancy = Vacancy::find($req->vacancy_id);
        if (!($vacancy->Status == 0 || $vacancy->Status == 3)) 
            return response()->json(['errors' => [__("validationUser.this vacancy is active or waiting for approval from admin")]]);
        if ($vacancy == null)
            return response()->json(['errors' => [__("validationUser.This vacancy is not exist")]]);
        if ($vacancy->CompanyUser_id != session()->get('CompanyUser')->id)
            return response()->json(['errors' => [__("validationUser.You are not owner of this vacancy")]]);
        
        // $vacancyEndDate = $vacancy->EndDate;
        // $vacancyEndDate = strtotime($vacancyEndDate);
        // $today = strtotime(date('Y-m-d'));
        // if ($vacancyEndDate > $today)
        //     return response()->json(['errors' => [__("validationUser.This vacancy is not expired")]]);
            //get vacancy owner company user
        
        $wallet = wallet::where('CompanyUser_id', $vacancy->CompanyUser_id)->first();
        if ($wallet == null){
            $wallet = new wallet();
            $wallet->CompanyUser_id = $vacancy->CompanyUser_id;
            $wallet->total_spend = 0;
            $wallet->status = 1;
            $wallet->save();
        }
        if ($wallet->status == 0)
            return response()->json(['errors' => [__("validationUser.Your wallet is blocked")]]);

        //get config vacancy price
        $vacancy_price = config::where('key', 'vacancy_price')->first()->value;

        //generate xml request
        $xml = new \SimpleXMLElement('<TKKPG/>');
        $xml->addChild('Request');
        $xml->Request->addChild('Operation', 'CreateOrder');
        $xml->Request->addChild('Language', app()->getLocale());
        $xml->Request->addChild('Order');
        $xml->Request->Order->addChild('OrderType', 'Purchase');    
        $xml->Request->Order->addChild('Merchant', 'E1000010');
        $xml->Request->Order->addChild('Amount', $vacancy_price*100);
        $xml->Request->Order->addChild('Currency', '944');
        $xml->Request->Order->addChild('Description', 'Vacancy Payment For'.$vacancy->Title);
        $xml->Request->Order->addChild('ApproveURL', 'https://flejob.az/az/payment/success');
        $xml->Request->Order->addChild('CancelURL', 'https://flejob.az/az/payment/canceled');
        $xml->Request->Order->addChild('DeclineURL', 'https://flejob.az/az/payment/decline');
        $xml = $xml->asXML();
        
        $xml = $this->xmlRequest($xml);
        $SESSION_ID = $xml['Response']['Order']['SessionID'];
        $ORDER_ID = $xml['Response']['Order']['OrderID'];
        $URL = $xml['Response']['Order']['URL'];

        // 'id',
        // 'wallet_id',
        // 'vacancy_id',
        // 'session_id',
        // 'order_id',
        // 'order_status',
        // 'amount',
        // 'currency',
        // 'transaction_id', null
        // 'PAN', null
        wallet_transaction::create([
            'wallet_id'=>$wallet->id,
            'vacancy_id'=>$vacancy->id,
            'session_id'=>$SESSION_ID,
            'order_id'=>$ORDER_ID,
            'order_status'=>'pending',
            'amount'=>$vacancy_price*100,
            'currency'=>'944',
        ]);
        
        //redirect to kapital bank 
        // return response()->json(['redirect' => $URL."?ORDERID=".$ORDER_ID."&SESSIONID=".$SESSION_ID]);
        return redirect()->to($URL.'?ORDERID='.$ORDER_ID.'&SESSIONID='.$SESSION_ID);
    }
    
    function xmlRequest($request)
    {
        $path = base_path().'/public';

        $url = "https://tstpg.kapitalbank.az:5443/Exec";
        $keyFile =  $path."/certs/flegri.key";
        $certFile =  $path."/certs/flegri.crt";
        $ch = curl_init();
        $header = array("Content-Type: text/html; charset=utf-8");
        $options = array(
        CURLOPT_HTTPHEADER => $header ,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        CURLOPT_URL => $url ,
        CURLOPT_SSLCERT => $certFile ,
        CURLOPT_SSLKEY => $keyFile ,
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_POST => true
        );
        curl_setopt_array($ch , $options);
        $output = curl_exec($ch);
        $array_data = json_decode(json_encode(simplexml_load_string($output)), true);

        return $array_data;
    }
    function paymentCanceled(Request $req){
        $array_data = json_decode(json_encode(simplexml_load_string($req->all()['xmlmsg'])), true);
        $wallet_transaction = wallet_transaction::where('session_id', $array_data['SessionID'])->where('order_id', $array_data['OrderID'])->first();

        $wallet_transaction->order_status = $array_data['OrderStatus'];
        $wallet_transaction->save();
        //find wallet 
        $wallet = wallet::find($wallet_transaction->wallet_id);
        //find CompanyUser 
        $CompanyUser = CompanyUser::find($wallet->CompanyUser_id);
        
        $CompanyUser=$this->MergeCompanyUsersTable($CompanyUser);
        session()->put('CompanyUser', $CompanyUser);

        return redirect()->route('Hom',app()->getLocale());
    }
    function paymentDecline(Request $req){
        $array_data = json_decode(json_encode(simplexml_load_string($req->all()['xmlmsg'])), true)['Message'];
        $wallet_transaction = wallet_transaction::where('session_id', $array_data['SessionID'])->where('order_id', $array_data['OrderID'])->first();

        $wallet_transaction->order_status = $array_data['OrderStatus'];
        $wallet_transaction->order_status_code = $array_data['ResponseCode'];
        $wallet_transaction->order_status_description = $array_data['ResponseDescription'];
        $wallet_transaction->transaction_id = $array_data['TranId'];
        $wallet_transaction->PAN = $array_data['PAN'];
        $wallet_transaction->save();

        $wallet = wallet::find($wallet_transaction->wallet_id);
        //find CompanyUser 
        $CompanyUser = CompanyUser::find($wallet->CompanyUser_id);
        
        $CompanyUser=$this->MergeCompanyUsersTable($CompanyUser);
        session()->put('CompanyUser', $CompanyUser);

        return redirect()->route('Hom',app()->getLocale());

    }
    function paymentSuccess(Request $req){
        $array_data = json_decode(json_encode(simplexml_load_string($req->all()['xmlmsg'])), true)['Message'];
        //get wallet_transaction
        $wallet_transaction = wallet_transaction::where('session_id', $array_data['SessionID'])->where('order_id', $array_data['OrderID'])->first();

        if ($wallet_transaction == null)
            return response()->json(['errors' => [__("validationUser.You are not owner of this vacancy")]]);
        if ($wallet_transaction->order_status == 'APPROVED')
            return response()->json(['errors' => [__("validationUser.You are already paid for this vacancy")]]);
        if ($array_data['OrderStatus'] != 'APPROVED')
            return response()->json(['errors' => [__("validationUser.Your payment is not approved")]]);
        if ($array_data['PurchaseAmount'] != $wallet_transaction->amount)
            return response()->json(['errors' => [__("validationUser.Your payment amount is not correct")]]);
        if ($array_data['Currency'] != $wallet_transaction->currency)
            return response()->json(['errors' => [__("validationUser.Your payment currency is not correct")]]);

            //  $table->string('transaction_id')->nullable();
            // $table->string('PAN')->nullable();
        $wallet_transaction->order_status = $array_data['OrderStatus'];
        $wallet_transaction->order_status_code = $array_data['ResponseCode'];
        $wallet_transaction->order_status_description = $array_data['ResponseDescription'];
        $wallet_transaction->transaction_id = $array_data['TranId'];
        $wallet_transaction->PAN = $array_data['PAN'];
        $wallet_transaction->save();
        //get wallet
        $wallet = wallet::find($wallet_transaction->wallet_id);
        $wallet->total_spend += $wallet_transaction->amount/10;
        $wallet->save();

        $wallet_transaction->save();

        //get CompanyUser
        $company_user = CompanyUser::find($wallet->CompanyUser_id);
        $company_user->Paying = 1;
        $company_user->save();
        //get vacancy
        $vacancy = Vacancy::find($wallet_transaction->vacancy_id);
        //2022-01-01 date time now add 1 month
        $vacancy->EndDate = date('Y-m-d H:i:s', strtotime('+1 month'));
        $vacancy->Status = 1;
        $vacancy->save();

        $CompanyUser=$this->MergeCompanyUsersTable($company_user);
        session()->put('CompanyUser', $CompanyUser);
        
        // dd(session()->get('CompanyUser'));

        return redirect()->route('Hom',app()->getLocale());
    }

    function payment2(Request $req){

        //count vacancies premium 
        $vacancies = Vacancy::where('Status', 1)->where("PremiumEndDate",'!=','null')->get()->count();
        if ($vacancies >= 12)
            return redirect()->back()->with('message', __("validationUser.You can not add more than 12 vacancies premium"));

        if (!session()->has('CompanyUser')) 
        return response()->json(['redirect' => route('Signin', ['language' => app()->getLocale()])]);
        //where status 0 or 3
        $vacancy = Vacancy::find($req->vacancy_id);
        //if vacancy sortOrder == 1 or premiumenddate is not null
        if ($vacancy->sortOrder == 1 || $vacancy->PremiumEndDate != null)
            return response()->json(['errors' => [__("validationUser.This vacancy is already premium")]]);
        if ($vacancy == null)
            return response()->json(['errors' => [__("validationUser.This vacancy is not exist")]]);
        if ($vacancy->CompanyUser_id != session()->get('CompanyUser')->id)
            return response()->json(['errors' => [__("validationUser.You are not owner of this vacancy")]]);
        
        $wallet = wallet::where('CompanyUser_id', $vacancy->CompanyUser_id)->first();
        if ($wallet == null){
            $wallet = new wallet();
            $wallet->CompanyUser_id = $vacancy->CompanyUser_id;
            $wallet->total_spend = 0;
            $wallet->status = 1;
            $wallet->save();
        }
        if ($wallet->status == 0)
            return response()->json(['errors' => [__("validationUser.Your wallet is blocked")]]);

        //get config vacancy price
        $premium_price = config::where('key', 'premium_price')->first()->value;

        //generate xml request
        $xml = new \SimpleXMLElement('<TKKPG/>');
        $xml->addChild('Request');
        $xml->Request->addChild('Operation', 'CreateOrder');
        $xml->Request->addChild('Language', app()->getLocale());
        $xml->Request->addChild('Order');
        $xml->Request->Order->addChild('OrderType', 'Purchase');    
        $xml->Request->Order->addChild('Merchant', 'E1000010');
        $xml->Request->Order->addChild('Amount', $premium_price*100);
        $xml->Request->Order->addChild('Currency', '944');
        $xml->Request->Order->addChild('Description', 'Vacancy Payment For'.$vacancy->Title);
        $xml->Request->Order->addChild('ApproveURL', 'https://flejob.az/az/payment/success/premium');
        $xml->Request->Order->addChild('CancelURL', 'https://flejob.az/az/payment/canceled');
        $xml->Request->Order->addChild('DeclineURL', 'https://flejob.az/az/payment/decline');
        $xml = $xml->asXML();
        
        $xml = $this->xmlRequest($xml);
        $SESSION_ID = $xml['Response']['Order']['SessionID'];
        $ORDER_ID = $xml['Response']['Order']['OrderID'];
        $URL = $xml['Response']['Order']['URL'];

        // 'id',
        // 'wallet_id',
        // 'vacancy_id',
        // 'session_id',
        // 'order_id',
        // 'order_status',
        // 'amount',
        // 'currency',
        // 'transaction_id', null
        // 'PAN', null
        wallet_transaction::create([
            'wallet_id'=>$wallet->id,
            'vacancy_id'=>$vacancy->id,
            'session_id'=>$SESSION_ID,
            'order_id'=>$ORDER_ID,
            'order_status'=>'pending',
            'amount'=>$premium_price*100,
            'currency'=>'944',
        ]);
        
        //redirect to kapital bank 
        // return response()->json(['redirect' => $URL."?ORDERID=".$ORDER_ID."&SESSIONID=".$SESSION_ID]);
        return redirect()->to($URL.'?ORDERID='.$ORDER_ID.'&SESSIONID='.$SESSION_ID);
    }

    function paymentSuccessForPremium(Request $req){

        $array_data = json_decode(json_encode(simplexml_load_string($req->all()['xmlmsg'])), true)['Message'];
        //get wallet_transaction
        $wallet_transaction = wallet_transaction::where('session_id', $array_data['SessionID'])->where('order_id', $array_data['OrderID'])->first();

        if ($wallet_transaction == null)
            return response()->json(['errors' => [__("validationUser.You are not owner of this vacancy")]]);
        if ($wallet_transaction->order_status == 'APPROVED')
            return response()->json(['errors' => [__("validationUser.You are already paid for this vacancy")]]);
        if ($array_data['OrderStatus'] != 'APPROVED')
            return response()->json(['errors' => [__("validationUser.Your payment is not approved")]]);
        if ($array_data['PurchaseAmount'] != $wallet_transaction->amount)
            return response()->json(['errors' => [__("validationUser.Your payment amount is not correct")]]);
        if ($array_data['Currency'] != $wallet_transaction->currency)
            return response()->json(['errors' => [__("validationUser.Your payment currency is not correct")]]);

            //  $table->string('transaction_id')->nullable();
            // $table->string('PAN')->nullable();
        $wallet_transaction->order_status = $array_data['OrderStatus'];
        $wallet_transaction->order_status_code = $array_data['ResponseCode'];
        $wallet_transaction->order_status_description = $array_data['ResponseDescription'];
        $wallet_transaction->transaction_id = $array_data['TranId'];
        $wallet_transaction->PAN = $array_data['PAN'];
        $wallet_transaction->save();
        //get wallet
        $wallet = wallet::find($wallet_transaction->wallet_id);
        $wallet->total_spend += $wallet_transaction->amount/10;
        $wallet->save();

        $wallet_transaction->save();

        //get CompanyUser
        $company_user = CompanyUser::find($wallet->CompanyUser_id);
        $company_user->Paying = 1;
        $company_user->save();
        //get vacancy
        $vacancy = Vacancy::find($wallet_transaction->vacancy_id);
        //add premium end date 1 day
        $vacancy->PremiumEndDate = date('Y-m-d H:i:s', strtotime('+1 day'));
        $vacancy->sortOrder=1;
        $vacancy->save();

        $CompanyUser=$this->MergeCompanyUsersTable($company_user);
        session()->put('CompanyUser', $CompanyUser);
        
        // dd(session()->get('CompanyUser'));

        return redirect()->route('Hom',app()->getLocale());
    }
    public function paymentForPremiumUser(Request $req){
        if (!session()->has('user')) 
            return response()->json(['redirect' => route('Signin', ['language' => app()->getLocale()])]);

        //count company users who PremiumEndDate is not null 
        $premium_count = User::where('PremiumEndDate', '!=', null)->count();
        //if greater than 10 return error
        if ($premium_count >= 4)
            return response()->json(['errors' => [__("validationUser.There is no more premium vacancy")]]);
        
        
        $User = session()->get('user');
        // $vacancyEndDate = $vacancy->EndDate;
        // $vacancyEndDate = strtotime($vacancyEndDate);
        // $today = strtotime(date('Y-m-d'));
        // if ($vacancyEndDate > $today)
        //     return response()->json(['errors' => [__("validationUser.This vacancy is not expired")]]);
            //get vacancy owner company user
        
        $wallet = wallet::where('UserId', $User->id)->first();
        if ($wallet == null){
            $wallet = new wallet();
            $wallet->UserId = $User->id;
            $wallet->total_spend = 0;
            $wallet->status = 1;
            $wallet->save();
        }
        if ($wallet->status == 0)
            return response()->json(['errors' => [__("validationUser.Your wallet is blocked")]]);

        //get config vacancy price
        $UserPrice = config::where('key', 'CvPremium_price')->first()->value;

        //generate xml request
        $xml = new \SimpleXMLElement('<TKKPG/>');
        $xml->addChild('Request');
        $xml->Request->addChild('Operation', 'CreateOrder');
        $xml->Request->addChild('Language', app()->getLocale());
        $xml->Request->addChild('Order');
        $xml->Request->Order->addChild('OrderType', 'Purchase');    
        $xml->Request->Order->addChild('Merchant', 'E1000010');
        $xml->Request->Order->addChild('Amount', $UserPrice*100);
        $xml->Request->Order->addChild('Currency', '944');
        $xml->Request->Order->addChild('Description', 'Account Premium Payment For '.$User->Username);
        $xml->Request->Order->addChild('ApproveURL', 'https://flejob.az/az/payment/success/User');
        $xml->Request->Order->addChild('CancelURL', 'https://flejob.az/az/payment/canceled');
        $xml->Request->Order->addChild('DeclineURL', 'https://flejob.az/az/payment/decline');
        $xml = $xml->asXML();
        
        $xml = $this->xmlRequest($xml);
        $SESSION_ID = $xml['Response']['Order']['SessionID'];
        $ORDER_ID = $xml['Response']['Order']['OrderID'];
        $URL = $xml['Response']['Order']['URL'];

        // 'id',
        // 'wallet_id',
        // 'vacancy_id',
        // 'session_id',
        // 'order_id',
        // 'order_status',
        // 'amount',
        // 'currency',
        // 'transaction_id', null
        // 'PAN', null
        wallet_transaction::create([
            'wallet_id'=>$wallet->id,
            'UserId'=>$User->id,
            'session_id'=>$SESSION_ID,
            'order_id'=>$ORDER_ID,
            'order_status'=>'pending',
            'amount'=>$UserPrice*100,
            'currency'=>'944',
        ]);
        
        //redirect to kapital bank 
        // return response()->json(['redirect' => $URL."?ORDERID=".$ORDER_ID."&SESSIONID=".$SESSION_ID]);
        return redirect()->to($URL.'?ORDERID='.$ORDER_ID.'&SESSIONID='.$SESSION_ID);
    }
    public function paymentSuccessForPremiumUser(Request $req){
        
        $array_data = json_decode(json_encode(simplexml_load_string($req->all()['xmlmsg'])), true)['Message'];
        //get wallet_transaction
        $wallet_transaction = wallet_transaction::where('session_id', $array_data['SessionID'])->where('order_id', $array_data['OrderID'])->first();

        if ($wallet_transaction->order_status == 'APPROVED')
            return response()->json(['errors' => [__("validationUser.You are already paid for this vacancy")]]);
        if ($array_data['OrderStatus'] != 'APPROVED')
            return response()->json(['errors' => [__("validationUser.Your payment is not approved")]]);
        if ($array_data['PurchaseAmount'] != $wallet_transaction->amount)
            return response()->json(['errors' => [__("validationUser.Your payment amount is not correct")]]);
        if ($array_data['Currency'] != $wallet_transaction->currency)
            return response()->json(['errors' => [__("validationUser.Your payment currency is not correct")]]);

            //  $table->string('transaction_id')->nullable();
            // $table->string('PAN')->nullable();
        $wallet_transaction->order_status = $array_data['OrderStatus'];
        $wallet_transaction->order_status_code = $array_data['ResponseCode'];
        $wallet_transaction->order_status_description = $array_data['ResponseDescription'];
        $wallet_transaction->transaction_id = $array_data['TranId'];
        $wallet_transaction->PAN = $array_data['PAN'];
        $wallet_transaction->save();
        //get wallet
        $wallet = wallet::find($wallet_transaction->wallet_id);
        $wallet->total_spend += $wallet_transaction->amount/10;
        $wallet->save();

        $wallet_transaction->save();

        //get CompanyUser
        $User = User::find($wallet->UserId);
        //get vacancy
        //add premium end date 1 month
        // $CompanyUser->PremiumEndDate = date('Y-m-d H:i:s', strtotime('+1 day'));
        $User->PremiumEndDate = date('Y-m-d H:i:s', strtotime('+1 month'));
        $User->save();

        $User=$this->MergeUsersTable($User);
        session()->put('user', $User);
        
        // dd(session()->get('CompanyUser'));

        return redirect()->route('Hom',app()->getLocale());
    }
    public function paymentForPremiumCompanyUser(Request $req)
    {
        if (!session()->has('CompanyUser')) 
        return response()->json(['redirect' => route('Signin', ['language' => app()->getLocale()])]);


        //count company users who PremiumEndDate is not null 
        $premium_count = CompanyUser::where('PremiumEndDate', '!=', null)->count();
        //if greater than 10 return error
        if ($premium_count >= 8)
            return response()->json(['errors' => [__("validationUser.There is no more premium vacancy")]]);
        
        
        $company_user = session()->get('CompanyUser');
        // $vacancyEndDate = $vacancy->EndDate;
        // $vacancyEndDate = strtotime($vacancyEndDate);
        // $today = strtotime(date('Y-m-d'));
        // if ($vacancyEndDate > $today)
        //     return response()->json(['errors' => [__("validationUser.This vacancy is not expired")]]);
            //get vacancy owner company user
        
        $wallet = wallet::where('CompanyUser_id', $company_user->id)->first();
        if ($wallet == null){
            $wallet = new wallet();
            $wallet->CompanyUser_id = $company_user->id;
            $wallet->total_spend = 0;
            $wallet->status = 1;
            $wallet->save();
        }
        if ($wallet->status == 0)
            return response()->json(['errors' => [__("validationUser.Your wallet is blocked")]]);

        //get config vacancy price
        $companyPrice = config::where('key', 'companyPremium_price')->first()->value;

        //generate xml request
        $xml = new \SimpleXMLElement('<TKKPG/>');
        $xml->addChild('Request');
        $xml->Request->addChild('Operation', 'CreateOrder');
        $xml->Request->addChild('Language', app()->getLocale());
        $xml->Request->addChild('Order');
        $xml->Request->Order->addChild('OrderType', 'Purchase');    
        $xml->Request->Order->addChild('Merchant', 'E1000010');
        $xml->Request->Order->addChild('Amount', $companyPrice*100);
        $xml->Request->Order->addChild('Currency', '944');
        $xml->Request->Order->addChild('Description', 'Company Account Premium Payment For'.$company_user->CompanyName);
        $xml->Request->Order->addChild('ApproveURL', 'https://flejob.az/az/payment/success/CompanyUser');
        $xml->Request->Order->addChild('CancelURL', 'https://flejob.az/az/payment/canceled');
        $xml->Request->Order->addChild('DeclineURL', 'https://flejob.az/az/payment/decline');
        $xml = $xml->asXML();
        
        $xml = $this->xmlRequest($xml);
        $SESSION_ID = $xml['Response']['Order']['SessionID'];
        $ORDER_ID = $xml['Response']['Order']['OrderID'];
        $URL = $xml['Response']['Order']['URL'];

        // 'id',
        // 'wallet_id',
        // 'vacancy_id',
        // 'session_id',
        // 'order_id',
        // 'order_status',
        // 'amount',
        // 'currency',
        // 'transaction_id', null
        // 'PAN', null
        wallet_transaction::create([
            'wallet_id'=>$wallet->id,
            'CompanyUser_id'=>$company_user->id,
            'session_id'=>$SESSION_ID,
            'order_id'=>$ORDER_ID,
            'order_status'=>'pending',
            'amount'=>$companyPrice*100,
            'currency'=>'944',
        ]);
        
        //redirect to kapital bank 
        // return response()->json(['redirect' => $URL."?ORDERID=".$ORDER_ID."&SESSIONID=".$SESSION_ID]);
        return redirect()->to($URL.'?ORDERID='.$ORDER_ID.'&SESSIONID='.$SESSION_ID);
    }
    public function paymentSuccessForCompanyPremium(Request $req){
        
        $array_data = json_decode(json_encode(simplexml_load_string($req->all()['xmlmsg'])), true)['Message'];
        //get wallet_transaction
        $wallet_transaction = wallet_transaction::where('session_id', $array_data['SessionID'])->where('order_id', $array_data['OrderID'])->first();

        if ($wallet_transaction->order_status == 'APPROVED')
            return response()->json(['errors' => [__("validationUser.You are already paid for this vacancy")]]);
        if ($array_data['OrderStatus'] != 'APPROVED')
            return response()->json(['errors' => [__("validationUser.Your payment is not approved")]]);
        if ($array_data['PurchaseAmount'] != $wallet_transaction->amount)
            return response()->json(['errors' => [__("validationUser.Your payment amount is not correct")]]);
        if ($array_data['Currency'] != $wallet_transaction->currency)
            return response()->json(['errors' => [__("validationUser.Your payment currency is not correct")]]);

            //  $table->string('transaction_id')->nullable();
            // $table->string('PAN')->nullable();
        $wallet_transaction->order_status = $array_data['OrderStatus'];
        $wallet_transaction->order_status_code = $array_data['ResponseCode'];
        $wallet_transaction->order_status_description = $array_data['ResponseDescription'];
        $wallet_transaction->transaction_id = $array_data['TranId'];
        $wallet_transaction->PAN = $array_data['PAN'];
        $wallet_transaction->save();
        //get wallet
        $wallet = wallet::find($wallet_transaction->wallet_id);
        $wallet->total_spend += $wallet_transaction->amount/10;
        $wallet->save();

        $wallet_transaction->save();

        //get CompanyUser
        $company_user = CompanyUser::find($wallet->CompanyUser_id);
        $company_user->Paying = 1;
        //get vacancy
        //add premium end date 1 month
        // $CompanyUser->PremiumEndDate = date('Y-m-d H:i:s', strtotime('+1 day'));
        $company_user->PremiumEndDate = date('Y-m-d H:i:s', strtotime('+1 month'));
        $company_user->save();

        $company_user=$this->MergeCompanyUsersTable($company_user);
        session()->put('CompanyUser', $company_user);
        
        // dd(session()->get('CompanyUser'));

        return redirect()->route('Hom',app()->getLocale());
    }
    
}



