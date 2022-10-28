<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRegisterRequest;
use App\Http\Requests\EditAccount;
use App\Http\Requests\UserRegisterRequest;
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
use Illuminate\Support\Facades\Validator;
//use invervation image
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return "Welcome to our homepage";
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
    public function Messages()
    {
        //check if user is logged in
        if(!session()->has('user'))
            return redirect()->route('Signin',app()->getLocale());

        return view('FrontEnd/Messages');
    }
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
        return view('FrontEnd/post-job');
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
    public function Contact()
    {
        return view('FrontEnd/contact');
    }
    public function CandidateDetails($lang, $id)
    {

        if (!session()->has('CompanyUser'))
            return redirect()->back();

        $user = User::where('id', $id)->first();
        $user = HomeController::MergeUsersTable($user);

        return view('FrontEnd/candidate-details', ['can' => $user]);
    }
    public function Candidates($lang)
    {
        //get last 8 users and paginate
        $users = User::orderBy('id', 'desc')->paginate(8);
        return view('FrontEnd/candidate', ['users' => $users]);
    }
    public function AccountCompanyVacancies($lang)
    {
        if (!session()->has('CompanyUser'))
            return redirect()->route('Signin', app()->getLocale());

        $user = session()->get('CompanyUser');
        $user = $this->MergeCompanyUsersTable($user);
        session()->put('CompanyUser', $user);

        // get User Vacancies with pagination
        $Vacancies = $user->Vacancies()->paginate(4);


        return view('FrontEnd/AccountVacancies')->with(['Vacancies' => $Vacancies]);
    }
    public function AccountCompany($lang)
    {

        if (!session()->has('CompanyUser'))
            return redirect()->route('Signin', ['language' => $lang]);

        $CompanyUser = $this->MergeCompanyUsersTable(session()->get('CompanyUser'));
        session()->put('CompanyUser', $CompanyUser);

        //get all categories
        $Categories = Category::all();
        // $languages = $languages->map(function ($language) {
        //     $language->Selected = false;
        //     if (session()->get('user')->Languages->contains('id', $language->id))
        //         $language->Selected = true;
        //     return $language;
        // });
        //get selected categories
        $Categories = $Categories->map(function ($Category) {
            if (session()->get('CompanyUser')->Categories->contains('id', $Category->id))
                $Category->Selected = true;
            return $Category;
        });

        //get lang id
        $lang_id = lang::where('LanguageCode', $lang)->first()->id;
        //merge categories with category_langs
        $Categories = $Categories->map(function ($Category) use ($lang_id) {
            //get category_langs
            $Category->CategoryLang = $Category->category_langs()->where('lang_id', $lang_id)->first();
            return $Category;
        });
        return view('FrontEnd/AccountCompany', ['categories' => $Categories]);
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

        //get all categories
        $categories = Category::all();
        //merge categories with category langs
        $categories = $categories->map(function ($category) use ($lang) {
            $category->CategoryLang = $category->category_langs()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $category;
        });

        // set selected to categories from session user 
        $categories = $categories->map(function ($category) {
            $category->Selected = false;
            if (session()->get('user')->Categories->contains('id', $category->id))
                $category->Selected = true;
            return $category;
        });

        //get all education level name
        $education_level = EducationLevel::All();
        //merge education level with education level langs
        $education_level = $education_level->map(function ($education) use ($lang) {
            $education->EducationLevelLang = $education->education_level_langs()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $education;
        });



        //get all languages
        $languages = Language::all();
        // set selected to Languages from session user 
        $languages = $languages->map(function ($language) {
            $language->Selected = false;
            if (session()->get('user')->Languages->contains('id', $language->id))
                $language->Selected = true;
            return $language;
        });

        $user = session()->get('user');
        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);

        return view("FrontEnd/account")->with([
            'cities' => $cities,
            'Langs' => $langs,
            'categories' => $categories,
            'languages' => $languages,
            'education_levels' => $education_level
        ]);
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


        $jobs = $jobs->paginate(10);

        //get all cities
        $cities = City::all();
        //merge cities with city langs
        $cities = $cities->map(function ($city) use ($lang) {
            $city->CityLang = $city->cityLang()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $city;
        });


        //get all categories
        $categories = Category::all();
        //merge categories with category langs
        $categories = $categories->map(function ($category) use ($lang) {
            $category->CategoryLang = $category->category_langs()->where('lang_id', lang::where('LanguageCode', $lang)->first()->id)->first();
            return $category;
        });




        return view('FrontEnd/find-job', ['Jobs' => $jobs, 'Cities' => $cities, 'Categories' => $categories]);
    }
    public function Hom($lang)
    {

        //check session
        if (session()->has('user')) {
            $user = $this->mergeUsersTable(session()->get('user'));
            session()->put('user', $user);
        }

        $Vacancies = Vacancy::where('status', 1)->orderBy('id', 'desc')->take(20)->get();
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
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('Status', 1)->get();
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

        //get all cities 
        $Cities = City::all();
        //merge cities with city_langs
        $Cities = $Cities->map(function ($City) use ($lang_id) {
            $City->CityLang = $City->cityLang()->where('lang_id', $lang_id)->first();
            return $City;
        });

        return view('Frontend/Index')->with(['Users' => $Users, 'CompanyUsers' => $CompanyUsers, 'Cities' => $Cities, 'Categories' => $Categories, 'Vacancies' => $Vacancies, "Langs" => $Langs]);
    }
    public function About($lang)
    {

        return view('Frontend/About');
    }
    public function Companies($lang)
    {
        //get company users and sort by Vacancies count
        $Companies = CompanyUser::where('status', 1)->orderBy('id', 'desc')->paginate(4);
        //merge company users with vacancies
        $CompanyUsers = $Companies->map(function ($CompanyUser) {
            $vac = Vacancy::where('CompanyUser_id', $CompanyUser->id)->where('status', 1)->get();
            $CompanyUser->Vacancies = $vac;
            $CompanyUser->VacanciesCount = $vac->count();
            return $CompanyUser;
        });
        //sort by vacancies count
        $CompanyUsers = $CompanyUsers->sortByDesc('VacanciesCount');


        return view('Frontend/Company')->with(['Companies' => $Companies, 'CompanyUsers' => $CompanyUsers]);
    }
    public function AppliedJobs($lang)
    {
        //check if session
        if (!session()->has('user'))
            return redirect()->route('Signin', app()->getLocale());


        $user = session()->get('user');
        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);

        $AppliedVacancies = subscribe_vacancy::where('User_id', $user->id)->paginate(4);

        $Langs = lang::all();
        return view('FrontEnd/AppliedJobs')->with(['Langs' => $Langs, 'AppliedVacancies' => $AppliedVacancies]);
    }
    public function JobDetails($lang, $id)
    {

        $vac = Vacancy::where('id', $id)->where('Status', 1)->first();
        if ($vac == null)
            return redirect()->route('Hom');

        $langs = lang::all();

        //merge vacancy with city   
        $lang_id = $langs->where('LanguageCode', $lang)->first()->id;
        $vac->City = City::where('id', $vac->City_id)->first();
        $vac->City->CityLang = $vac->City->cityLang()->where('lang_id', $lang_id)->first();

        //merge vac with category
        $vac->Category = Category::where('id', $vac->Category_id)->first();
        $vac->Category->Category_lang = $vac->Category->category_langs()->where('lang_id', $lang_id)->first();

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

        return view('FrontEnd/job-Details')->with(['vac' => $vac, 'Langs' => $langs, 'Vacancies' => $Vacancies]);
    }
    public function MyResume($lang)
    {
        //check session
        if (session()->has('user')) {
            $user = session()->get('user');
            $user = $this->MergeUsersTable($user);

            $langs = lang::all();

            return view('FrontEnd/Resume', ['Langs' => $langs]);
        } else {
            return redirect()->route('login');
        }
    }
    public function Signup($lang)
    {
        //check session
        if (session()->has('user') || session()->has('CompanyUser'))
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
    public function SigninPage($lang)
    {
        // user session have redirect to home page
        if (session()->has('user') || session()->has('CompanyUser'))
            return redirect()->route('Hom', ['language' => $lang]);

        $Langs = lang::all();

        return view("FrontEnd/signin", ["Langs" => $Langs]);
    }
    public function ChangePass($lang)
    {
        if (!session()->has('user'))
            return redirect()->route('Signin', ['language' => $lang]);

        $Langs = lang::all();


        return view("FrontEnd/changePassword", ["Langs" => $Langs]);
    }
    public function ChangePassCompany($lang)
    {
        //check session
        if (session()->has('CompanyUser')) {
            $user = session()->get('CompanyUser');
            $user = $this->MergeCompanyUsersTable($user);
            session()->put('CompanyUser', $user);

            return view('FrontEnd/ChangePassCompany');
        } else {
            return redirect()->route('Signin', app()->getLocale());
        }
    }
    public function AppliedCandidates($lang, $VacId)
    {
        //check session
        if (session()->has('CompanyUser')) {
            $user = session()->get('CompanyUser');
            $user = $this->MergeCompanyUsersTable($user);
            session()->put('CompanyUser', $user);

            // find VacId Id ed vacancies from session
            $vac = Vacancy::where('id', $VacId)->where('CompanyUser_id', $user->id)->where('Status', 1)->first();
            if ($vac == null)
                return redirect()->back();

            $UserIds = subscribe_vacancy::where('Vacancy_id', $VacId)->get()->pluck('User_id');
            // $Candidates = User::whereIn('id',$UserIds)->get();
            //paginate
            $Candidates = User::whereIn('id', $UserIds)->paginate(6);
            $myCandidates = [];

            foreach ($Candidates as $can) {
                $myCandidates[] = $this->MergeUsersTable($can);
            }

            foreach ($myCandidates as $can) {

                $path = public_path('/CandidatesPicture/' . $can->image);
                //resize image 500x600 from path
                //if file is exits in path 

                if (file_exists(pathinfo($path, PATHINFO_FILENAME) . "_150x150.webp"))
                    $can->image = pathinfo($path, PATHINFO_FILENAME) . "_150x150.webp";
                else {
                    $img = Image::make($path)->resize(150, 150);
                    //save image to path

                    // get extension
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    // fullname without extension
                    $fullname = pathinfo($path, PATHINFO_FILENAME);
                    $imgName = $fullname . '_150x150.webp';

                    $img->save(public_path('/CandidatesPicture/' . $imgName), 85, 'webp');

                    $can->image = $imgName;
                }
            }

            //make all notifications status 1
            $nots = NotificationForCompanyUser::where('Vacancy_id', $VacId)->where('Status', 0)->get();
            foreach ($nots as $not) {
                $not->Status = 1;
                $not->save();
            }

            return view('FrontEnd/AppliedCandidates')->with(['myCandidates' => $myCandidates, 'Candidates' => $Candidates, 'vac' => $vac]);
        } else {
            return redirect()->route('Signin', app()->getLocale());
        }
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


    //LOGIN REGISTER
    public function Signin($lang, Request $req)
    {
        if (session()->has('user') || session()->has('CompanyUser'))
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

                    $user = $this->MergeUsersTable($user);

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
        if (session()->has('user') || session()->has('CompanyUser'))
            return redirect()->route('Hom', ['language' => $lang]);

        $data = $req->all();

        //check EducationYear is valid with regex
        $regex = '/^\d{4}$/';
        if (isset($data['educationYearStart'])) {
            $IsMatch = false;
            foreach ($data['educationYearStart'] as $item) {
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
        if (isset($data['educationYearEnd'])) {

            $IsMatch = false;
            foreach ($data['educationYearEnd'] as $item) {
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
        if (isset($data['LinkName'])) {
            foreach ($data['LinkName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your link name correctly")]]);
            if (isset($data['Link'])) {
                foreach ($data['LinkName'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your link name correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your link correctly")]]);
        }
        // If Link is empty send error to view  
        if (isset($data['companyname'])) {
            foreach ($data['companyname'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company name correctly")]]);
            if (isset($data['companyrank'])) {
                foreach ($data['companyrank'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your company rank correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your company rank correctly")]]);
            if (isset($data['companyStartdate'])) {
                foreach ($data['companyStartdate'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
            if (isset($data['companyEnddate'])) {
                foreach ($data['companyEnddate'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
        }
        // if educationName is empty send error to view
        if (isset($data['educationName'])) {
            foreach ($data['educationName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your education name correctly")]]);

            if (isset($data['educationYearStart'])) {
                foreach ($data['educationYearStart'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            if (isset($data['educationYearEnd'])) {
                foreach ($data['educationYearEnd'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            if (isset($data['educationLevel'])) {
                foreach ($data['educationLevel'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your education level correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your education level correctly")]]);
        }

        $data['Password'] = md5(md5($data['Password']));
        $data['Password_confirmation'] = md5(md5($data['Password_confirmation']));

        $data['City_id'] = $data['City'];

        // $user->City_Id = $data['City'];

        $data['EducationName'] = isset($data['educationName']) ? $data['educationName'] : null;
        $data['YearStart'] = isset($data['educationYearStart']) ? $data['educationYearStart'] : null;
        $data['YearEnd'] = isset($data['educationYearEnd']) ? $data['educationYearEnd'] : null;
        $data['EducationLevel_Id'] = isset($data['educationLevel']) ? $data['educationLevel'] : null;


        $data['Skills'] = isset($req->Skills) ? $req->Skills : null;
        $data['Description'] = isset($req->Description) ? $req->Description : null;
        $data['MinSalary'] = isset($req->MinSalary) ? $req->MinSalary : null;
        $data['MaxSalary'] = isset($req->MaxSalary) ? $req->MaxSalary : null;

        $image = $req->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('CandidatesPicture'), $imageName);
        $data['image'] = $imageName;

        $user = User::create($data);
        unset($data['educationName']);
        unset($data['educationYearStart']);
        unset($data['educationYearEnd']);
        unset($data['educationLevel']);

        $user->save();

        //create one to many relation between user and education
        if (isset($data['EducationName']))
            for ($i = 0; $i < count($data['EducationName']); $i++) {
                $education = new Education();
                $education->EducationName = $data['EducationName'][$i];
                $education->EducationLevel_id = $data['EducationLevel_Id'][$i];
                $education->YearStart = $data['YearStart'][$i];
                $education->YearEnd = $data['YearEnd'][$i];
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
                $company->DateEnd = $data['companyEnddate'][$i];
                $company->DateStart = $data['companyStartdate'][$i];
                $company->user_id = $user->id;
                $company->save();
            }

        $user->usersAndCategories()->attach($data['Categories']);
        $user->usersAndLanguages()->attach($data['Languages']);

        return redirect()->route('Signin');
     }
    public function registerCompany(CompanyRegisterRequest $request)
    {

        if (session()->has('user') || session()->has('CompanyUser'))
            return redirect()->route('Hom', ['language' => app()->getLocale()]);

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

        $data['CompanyPassword'] = md5(md5($data['CompanyPassword']));

        //dowload request image
        $image = $request->file('CompanyLogo');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('CompanyLogos'), $imageName);
        $data['CompanyLogo'] = $imageName;

        //create company User With WebSiteLink
        $CompanyUser = new CompanyUser();
        $CompanyUser->CompanyName = $data['CompanyName'];
        $CompanyUser->CompanyUsername = $data['CompanyUsername'];
        $CompanyUser->CompanyEmail = $data['CompanyEmail'];
        $CompanyUser->CompanyPassword = $data['CompanyPassword'];
        $CompanyUser->CompanyAddress = $data['CompanyAddress'];
        $CompanyUser->CompanyLogo = $data['CompanyLogo'];
        $CompanyUser->CompanyDescription = $data['CompanyDescription'];
        $CompanyUser->CompanyWebSiteLink = $data['CompanyWebSiteLink'];

        $CompanyUser->save();

        $CompanyUser->CompanyAndCategories()->attach($data['CompanyCategories']);

        for ($i = 0; $i < count($data['CompanyPhone']); $i++) {
            $phone = new CompanyPhones();
            $phone->CompanyPhone = $data['CompanyPhone'][$i];
            $phone->CompanyUser_Id = $CompanyUser->id;
            $phone->save();
        }
        // redirect to hom page
        return redirect()->route('hom', app()->getLocale());
    }
    public function Logout($lang)
    {
        //remove user from session
        session()->forget('user');

        return redirect()->route('Hom', ['language' => $lang]);
    }
    public function LogoutCompany($lang)
    {
        //remove user from session
        session()->forget('CompanyUser');

        return redirect()->route('Hom', ['language' => $lang]);
    }
    public function SigninCompany(Request $req)
    {
        if (session()->has('user') || session()->has('Compnayuser'))
            return redirect()->route('Hom', ['language' => app()->getLocale()]);
        $data = $req->all();
        $Company = CompanyUser::where('CompanyEmail', $data['CompanyEmail'])->first();

        if ($Company == null)
            $Company = CompanyUser::where('CompanyUsername', $data['CompanyEmail'])->first();
        if ($Company == null)
            return redirect()->back()->withErrors(['CompanyEmail' => __("validationCompany.Email or Username is not correct")]);
        $Pass = md5(md5($data['CompanyPassword']));
        if ($Company->CompanyPassword != $Pass)
            return redirect()->back()->withErrors(['CompanyPassword' => __("validationCompany.Password is not correct")]);

        session()->put('CompanyUser', $Company);
        return redirect()->route('Hom', app()->getLocale());
    }


    //UPDATE ACTIONS
    public function UpdateUser(EditAccount $req)
    {

        if (!session()->has('user'))
            return redirect()->route('Signin', ['language' => app()->getLocale()]);

        //check username is unique in users table
        $data = $req->validated();
        if (session()->get('user')->Username != $data['Username']) {
            $user = User::where('Username', $data['Username'])->first();
            if ($user != null)
                return redirect()->back()->withErrors(['Username' => __("validationUser.This username is already taken")]);
        }
        if (session()->get('user')->email != $data['email']) {
            $user = User::where('email', $data['email'])->first();
            if ($user != null)
                return redirect()->back()->withErrors(['email' => __("validationUser.This email is already taken")]);
        }
        if (session()->get('user')->phone != $data['phone']) {
            $user = User::where('phone', $data['phone'])->first();
            if ($user != null)
                return redirect()->back()->withErrors(['phone' => __("validationUser.This Phone is already taken")]);
        }

        $user = User::where('id', session()->get('user')->id)->first();
        $data = $req->all();
        //dowload request image
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('CandidatesPicture'), $imageName);
            $data['image'] = $imageName;

            //renive old image
            $oldImage = public_path('CandidatesPicture/' . $user->image);
            if (file_exists($oldImage))
                unlink($oldImage);
        } else {
            $data['image'] = session()->get('user')->image;
        }


        //get req->GetAll


        // FirstName LastName FatherName Username email City phone maried Description Skills MinSalary MaxSalary
        $user->FirstName = $data['FirstName'];
        $user->LastName = $data['LastName'];
        $user->FatherName = $data['FatherName'];
        $user->Username = $data['Username'];
        $user->email = $data['email'];
        $user->City_id = $data['City'];
        $user->phone = $data['phone'];
        $user->image = $data['image'];
        $user->Married = $data['Married'];
        $user->Description = $data['Description'];
        $user->Skills = $data['Skills'];
        $user->MinSalary = $data['MinSalary'];
        $user->MaxSalary = $data['MaxSalary'];


        $user->save();

        $user->UsersAndCategories()->detach();
        $user->UsersAndCategories()->attach($data['Categories']);

        $user->UsersAndLanguages()->detach();
        $user->UsersAndLanguages()->attach($data['Languages']);



        $user = $this->MergeUsersTable($user);
        // dd($user);

        session()->put('user', $user);

        return redirect()->back();
    }
    public function UpdateUserEducation(Request $req)
    {

        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();

        if (isset($data['EducationName']))
            for ($i = 0; $i < count($data['EducationName']); $i++) {
                //check EducationYear Is Match Regex /^\d{4}$/
                $regex = '/^\d{4}$/';
                if (!preg_match($regex, $data['YearStart'][$i]))
                    return redirect()->back()->withErrors(['EducationYear' => __("validationUser.Enter your Education Year correctly")]);
                if (!preg_match($regex, $data['YearEnd'][$i]))
                    return redirect()->back()->withErrors(['EducationYear' => __("validationUser.Enter your Education Year correctly")]);
                if ($data['EducationName'][$i] == null)
                    return redirect()->back()->withErrors(['EducationName' => __("validationUser.Enter your Education Name correctly")]);
                // EducationId Find Education
                $Education = Education::where('user_id', $user->id)->where('id', $data['EducationId'][$i])->first();
                if ($Education == null)
                    return redirect()->back()->withErrors(['EducationName' => __("validationUser.Enter your Education Name correctly")]);

                $Education->EducationName = $data['EducationName'][$i];
                $Education->YearStart = $data['YearStart'][$i];
                $Education->YearEnd = $data['YearEnd'][$i];
                $Education->EducationLevel_Id = $data['EducationLevel'][$i];
                $Education->save();
            }

        if (isset($data['NewEducationName']))
            for ($i = 0; $i < count($data['NewEducationName']); $i++) {
                //check EducationYear Is Match Regex /^\d{4}$/
                $regex = '/^\d{4}$/';
                if (!preg_match($regex, $data['NewYearStart'][$i]))
                    return redirect()->back()->withErrors(['NewEducationYear' => __("validationUser.Enter your New Education Year correctly")]);
                if (!preg_match($regex, $data['NewYearEnd'][$i]))
                    return redirect()->back()->withErrors(['NewEducationYear' => __("validationUser.Enter your New Education Year correctly")]);
                if ($data['NewEducationName'][$i] == null)
                    return redirect()->back()->withErrors(['NewEducationName' => __("validationUser.Enter your New Education Name correctly")]);

                $Education = new Education();
                $Education->EducationName = $data['NewEducationName'][$i];
                $Education->YearStart = $data['NewYearStart'][$i];
                $Education->YearEnd = $data['NewYearEnd'][$i];
                $Education->EducationLevel_Id = $data['NewEducationLevel'][$i];
                $Education->user_id = $user->id;
                $Education->save();

                $user = $this->MergeUsersTable($user);
                session()->put('user', $user);
            }

        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);


        return redirect()->back();
    }
    public function UpdateUserCompany(Request $req)
    {

        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();
        if (isset($data['companyname']))
            for ($i = 0; $i < count($data['companyname']); $i++) {
                if ($data['companyname'][$i] == null)
                    return redirect()->back()->withErrors(['companyname' => __("validationUser.Enter your Company Name correctly")]);
                if ($data['companyrank'][$i] == null)
                    return redirect()->back()->withErrors(['companyrank' => __("validationUser.Enter your Company Rank correctly")]);
                if ($data['companyStartdate'][$i] == null)
                    return redirect()->back()->withErrors(['companyStartdate' => __("validationUser.Enter your Company Start Date correctly")]);
                if ($data['companyEnddate'][$i] == null)
                    return redirect()->back()->withErrors(['companyEnddate' => __("validationUser.Enter your Company End Date correctly")]);

                $Company = Company::where('user_id', $user->id)->where('id', $data['CompanyId'][$i])->first();

                if ($Company == null)
                    return redirect()->back()->withErrors(['companyname' => __("validationUser.You have not this Company")]);

                $Company->CompanyName = $data['companyname'][$i];
                $Company->rank = $data['companyrank'][$i];
                $Company->DateStart = $data['companyStartdate'][$i];
                $Company->DateEnd = $data['companyEnddate'][$i];
                $Company->save();
            }

        if (isset($data['Newcompanyname']))
            for ($i = 0; $i < count($data['Newcompanyname']); $i++) {

                if ($data['Newcompanyname'][$i] == null)
                    return redirect()->back()->withErrors(['Newcompanyname' => __("validationUser.Enter your New Company Name correctly")]);
                if ($data['Newcompanyrank'][$i] == null)
                    return redirect()->back()->withErrors(['Newcompanyrank' => __("validationUser.Enter your New Company Rank correctly")]);
                if ($data['NewcompanyStartdate'][$i] == null)
                    return redirect()->back()->withErrors(['NewcompanyStartdate' => __("validationUser.Enter your New Company Start Date correctly")]);
                if ($data['NewcompanyEnddate'][$i] == null)
                    return redirect()->back()->withErrors(['NewcompanyEnddate' => __("validationUser.Enter your New Company End Date correctly")]);

                $Company = new Company();
                $Company->CompanyName = $data['Newcompanyname'][$i];
                $Company->rank = $data['Newcompanyrank'][$i];
                $Company->DateStart = $data['NewcompanyStartdate'][$i];
                $Company->DateEnd = $data['NewcompanyEnddate'][$i];
                $Company->user_id = $user->id;
                $Company->save();

                $user = $this->MergeUsersTable($user);
                session()->put('user', $user);
            }


        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);

        return redirect()->back();
    }
    public function UpdateUserlink(Request $req)
    {
        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();
        if (isset($data['linkname']))
            for ($i = 0; $i < count($data['linkname']); $i++) {
                if ($data['linkname'][$i] == null)
                    return redirect()->back()->withErrors(['linkname' => __("validationUser.Enter your Link Name correctly")]);
                if ($data['link'][$i] == null)
                    return redirect()->back()->withErrors(['link' => __("validationUser.Enter your Link Url correctly")]);

                $Link = Link::where('user_id', $user->id)->where('id', $data['LinkId'][$i])->first();

                if ($Link == null)
                    return redirect()->back()->withErrors(['linkname' => __("validationUser.You have not this Link")]);

                $Link->LinkName = $data['linkname'][$i];
                $Link->Link = $data['link'][$i];
                $Link->save();
            }

        if (isset($data['Newlinkname']))
            for ($i = 0; $i < count($data['Newlinkname']); $i++) {

                if ($data['Newlinkname'][$i] == null)
                    return redirect()->back()->withErrors(['Newlinkname' => __("validationUser.Enter your New Link Name correctly")]);
                if ($data['Newlink'][$i] == null)
                    return redirect()->back()->withErrors(['Newlink' => __("validationUser.Enter your New Link Url correctly")]);

                $Link = new Link();
                $Link->LinkName = $data['Newlinkname'][$i];
                $Link->Link = $data['Newlink'][$i];
                $Link->user_id = $user->id;
                $Link->save();

                $user = $this->MergeUsersTable($user);
                session()->put('user', $user);
            }
        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);

        return redirect()->back();
    }
    public function UpdateUserPassword(Request $req)
    {
        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        //message error
        $messages = [
            'password.required' => __('validationUser.Password is required'),
            'password.min' => __('validationUser.Password must be at least 6 characters'),
            'newpassword.required' => __('validationUser.New Password is required'),
            'newpassword.min' => __('validationUser.New Password must be at least 6 characters'),
            'confirmpassword.required' => __('validationUser.Confirm Password is required'),
            'confirmpassword.same' => __('validationUser.Confirm Password must be same New Password'),
        ];
        //validate request Password Required
        $req->validate([
            'password' => 'required | min:6',
            'newpassword' => 'required | min:6',
            'confirmpassword' => 'required | same:newpassword',
        ], $messages);

        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();

        $Pass = md5(md5($data['password']));
        if ($user->Password != $Pass)
            return redirect()->back()->withErrors(['password' => __("validationUser.Password is not correct")]);

        $user->Password = md5(md5($data['newpassword']));
        $user->save();
        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);
        return redirect()->back();
    }
    public function UpdateCompanyUser(Request $req)
    {


        $messages = [
            'CompanyName.required' => __('messages.Company Name Required'),
            'CompanyUsername.required' => __('messages.Company Username Required'),
            'CompanyEmail.required' => __('messages.Company Email Required'),
            'CompanyEmail.email' => __('messages.Company Email Email'),
            'CompanyWebSiteLink.required' => __('messages.Company Website Link Required'),
            'CompanyAddress.required' => __('messages.Company Address Required'),
            'CompanyLogo.image' => __('messages.Company Logo Image'),
            'CompanyLogo.mimes' => __('messages.Company logo must be jpeg,png,jpg,gif,svg'),
            'CompanyLogo.max' => __('messages.Company Logo  max 2048'),
            'CompanyDescription.required' => __('messages.Company Description Required'),
        ];
        $req->validate([
            'CompanyName' => 'required',
            'CompanyUsername' => 'required',
            'CompanyEmail' => 'required | email',
            'CompanyWebSiteLink' => 'required',
            'CompanyAddress' => 'required',
            'CompanyLogo' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'CompanyDescription' => 'required',
        ], $messages);

        //get lang id
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;

        //get company user
        $CompanyUser = CompanyUser::where('id', session('CompanyUser')->id)->first();


        // delete image from CompanyLogos folder if exists\\
        if ($req->hasFile('CompanyLogo')) {
            $image = $req->file('CompanyLogo');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('CompanyLogos'), $imageName);
            $req->CompanyLogo = $imageName;

            //renive old image
            $oldImage = public_path('CandidatesPicture/' . $CompanyUser->CompanyLogo);
            if (file_exists($oldImage))
                unlink($oldImage);
        } else {
            $req->CompanyLogo = $CompanyUser->CompanyLogo;
        }



        //update company user
        $CompanyUser->CompanyName = $req->CompanyName;
        $CompanyUser->CompanyUsername = $req->CompanyUsername;
        $CompanyUser->CompanyEmail = $req->CompanyEmail;
        $CompanyUser->CompanyLogo = $req->CompanyLogo;
        $CompanyUser->CompanyWebSiteLink = $req->CompanyWebSiteLink;
        $CompanyUser->CompanyAddress = $req->CompanyAddress;
        $CompanyUser->CompanyDescription = $req->CompanyDescription;

        $CompanyUser->save();

        //update company user categories

        // $user->UsersAndCategories()->detach();
        // $user->UsersAndCategories()->attach($data['Categories']);

        // $user->UsersAndLanguages()->detach();
        // $user->UsersAndLanguages()->attach($data['Languages']);


        $CompanyUser->CompanyAndCategories()->detach();
        $CompanyUser->CompanyAndCategories()->attach($req['CompanyCategories']);


        //update session
        $CompanyUser = $this->MergeCompanyUsersTable($CompanyUser);
        session()->put('CompanyUser', $CompanyUser);

        return redirect()->back()->with('success', __('messages.Company Updated Successfully'));
    }
    public function UpdateCompanyUserPhones(Request $req)
    {
        $messages = [
            'CompanyPhone.required' => __('messages.Company Phone Required'),
        ];
        $req->validate([
            'CompanyPhone' => 'required | array',
        ], $messages);

        if (isset($req->CompanyPhone))
            for ($i = 0; $i < count($req->CompanyPhone); $i++) {
                $companyPhone = CompanyPhones::where('id', $req->PhoneId)->first();
                $companyPhone->CompanyPhone = $req->CompanyPhone[$i];
            }
        if (isset($req->NewCompanyPhone)) {
            for ($i = 0; $i < count($req->NewCompanyPhone); $i++) {
                $companyPhone = new CompanyPhones();
                $companyPhone->CompanyPhone = $req->NewCompanyPhone[$i];
                $companyPhone->CompanyUser_Id = session('CompanyUser')->id;
                $companyPhone->save();
            }
        }
        //update session
        $CompanyUser = $this->MergeCompanyUsersTable(session('CompanyUser'));
        session()->put('CompanyUser', $CompanyUser);

        return redirect()->back()->with('success', __('messages.Company Phone Added Successfully'));
    }
    public function UpdateCompanyUserPassword(Request $req)
    {
        //message error
        $messages = [
            'password.required' => __('validationUser.Password is required'),
            'password.min' => __('validationUser.Password must be at least 6 characters'),
            'newpassword.required' => __('validationUser.New Password is required'),
            'newpassword.min' => __('validationUser.New Password must be at least 6 characters'),
            'confirmpassword.required' => __('validationUser.Confirm Password is required'),
            'confirmpassword.same' => __('validationUser.Confirm Password must be same New Password'),
        ];
        //validate request Password Required
        $req->validate([
            'password' => 'required | min:6',
            'newpassword' => 'required | min:6',
            'confirmpassword' => 'required | same:newpassword',
        ], $messages);

        $data = $req->all();
        $user = CompanyUser::where('id', session()->get('CompanyUser')->id)->first();

        $Pass = md5(md5($data['password']));
        if ($user->Password != $Pass)
            return redirect()->back()->withErrors(['password' => __("validationUser.Password is not correct")]);

        $user->Password = md5(md5($data['newpassword']));
        $user->save();
        $user = $this->MergeCompanyUsersTable($user);
        session()->put('CompanyUser', $user);
        return redirect()->back();
    }


    //DELETE ACTIONS
    public function DeleteUserEducation(Request $req)
    {
        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();
        $Education = Education::where('user_id', $user->id)->where('id', $data['EducationId'])->first();
        if ($Education == null)
            return redirect()->back()->withErrors(['EducationName' => __("validationUser.You have not this Education")]);
        $Education->delete();

        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);

        return redirect()->back();
    }
    public function DeleteUserCompany(Request $req)
    {
        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();
        $Company = Company::where('user_id', $user->id)->where('id', $data['CompanyId'])->first();
        if ($Company == null)
            return redirect()->back()->withErrors(['companyname' => __("validationUser.You have not this Company")]);
        $Company->delete();
        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);
        return redirect()->back();
    }
    public function DeleteUserLink(Request $req)
    {
        if (!session()->has('user'))
            return redirect()->back()->withErrors(['Redirect' => __("validationUser.You must be logged in to access this page")]);
        $data = $req->all();
        $user = User::where('id', session()->get('user')->id)->first();
        $Link = Link::where('user_id', $user->id)->where('id', $data['LinkId'])->first();
        if ($Link == null)
            return redirect()->back()->withErrors(['Link' => __("validationUser.You have not this Link")]);
        $Link->delete();
        $user = $this->MergeUsersTable($user);
        session()->put('user', $user);
        return redirect()->back();
    }
    public function DeletePhoneNumber($lang, $id)
    {
        if (!session()->has('CompanyUser'))
            return redirect()->route('Signin', app()->getLocale());

        $user = CompanyUser::where('id', session()->get('CompanyUser')->id)->first();
        $Link = CompanyPhones::where('CompanyUser_Id', $user->id)->where('id', $id)->first();
        if ($Link == null)
            return redirect()->back()->withErrors(['Link' => __("validationUser.You have not this Phone")]);
        $Link->delete();
        $user = $this->MergeCompanyUsersTable($user);
        session()->put('CompanyUser', $user);
        return redirect()->back();
    }


    //AJAX ACTIONS
    public function SignUpControllerAjax(UserRegisterRequest $req)
    {
        $data = $req->all();

        //check EducationYear is valid with regex
        $regex = '/^\d{4}$/';
        if (isset($data['educationYearStart'])) {
            $IsMatch = false;
            foreach ($data['educationYearStart'] as $item) {
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
        if (isset($data['educationYearEnd'])) {

            $IsMatch = false;
            foreach ($data['educationYearEnd'] as $item) {
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
        if (isset($data['LinkName'])) {
            foreach ($data['LinkName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your link name correctly")]]);
            if (isset($data['Link'])) {
                foreach ($data['LinkName'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your link name correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your link correctly")]]);
        }
        // If Link is empty send error to view  
        if (isset($data['companyname'])) {
            foreach ($data['companyname'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your company name correctly")]]);
            if (isset($data['companyrank'])) {
                foreach ($data['companyrank'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your company rank correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your company rank correctly")]]);
            if (isset($data['companyStartdate'])) {
                foreach ($data['companyStartdate'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
            if (isset($data['companyEnddate'])) {
                foreach ($data['companyEnddate'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your company date correctly")]]);
        }
        // if educationName is empty send error to view
        if (isset($data['educationName'])) {
            foreach ($data['educationName'] as $item)
                if ($item == null)
                    return response()->json(['errors' => [__("validationUser.Enter your education name correctly")]]);

            if (isset($data['educationYearStart'])) {
                foreach ($data['educationYearStart'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            if (isset($data['educationYearEnd'])) {
                foreach ($data['educationYearEnd'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your education year correctly")]]);
            if (isset($data['educationLevel'])) {
                foreach ($data['educationLevel'] as $item)
                    if ($item == null)
                        return response()->json(['errors' => [__("validationUser.Enter your education level correctly")]]);
            } else
                return response()->json(['errors' => [__("validationUser.Enter your education level correctly")]]);
        }
        return response()->json(['success' => 'Success ']);
    }
    public function SignUpCompanyControllerAjax(CompanyRegisterRequest $req)
    {

        $data = $req->all();

        //check EducationYear is valid with regex
        $regex = '/^\+994\d{9}$/';
        if (isset($data['CompanyPhones'])) {
            $IsMatch = false;
            foreach ($data['CompanyPhones'] as $item) {
                if (preg_match($regex, $item))
                    $IsMatch = true;
                else {
                    $IsMatch = false;
                    break;
                }
            }
            if (!$IsMatch)
                return response()->json(['errors' => [__("validationUser.Enter your phone correctly")]]);
        }

        return response()->json(['success' => 'Success ']);
    }
    public function ApplyVacancy($lang, $id)
    {
        if (!session()->has('user'))
            return response()->json(['redirect' => route('Signin', ['language' => app()->getLocale()])]);
        $user = User::where('id', session()->get('user')->id)->first();
        $vacancy = Vacancy::where('id', $id)->where('Status', 1)->first();
        if ($vacancy == null)
            return response()->json(['errors' => [__("validationUser.This vacancy is not exist")]]);


        $vacUser = subscribe_vacancy::where('user_id', $user->id)->where('vacancy_id', $vacancy->id)->first();
        if ($vacUser != null) {
            $vacUser->delete();
            $notification = NotificationForCompanyUser::where('user_id', $user->id)->where('vacancy_id', $vacancy->id)->delete();
            $user = $this->MergeUsersTable($user);
            session()->put('user', $user);
            return response()->json(['success' => "UnApplied Successfully"]);
        } else {
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

            $user = $this->MergeUsersTable($user);
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
}
