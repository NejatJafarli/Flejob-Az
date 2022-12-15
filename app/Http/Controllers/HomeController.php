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

        if (!session()->has('CompanyUser'))
            return redirect()->back();

        $user = User::where('id', $id)->first();
        $user = HomeController::MergeUsersTable($user);

        return view('FrontEnd/candidate-details', ['can' => $user, "myIdBool" => true, "myId" => $id]);
    }
    public function Candidates($lang)
    {
        if (!session()->has('CompanyUser'))
            return redirect()->back();

        $CompanyUser = session()->get('CompanyUser');
        if ($CompanyUser->Paying == 0)
            return redirect()->back();

        //get last 8 users and paginate
        $users = User::orderBy('id', 'desc')->paginate(8);
        return view('FrontEnd/candidate', ['users' => $users]);
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


        //get all categories orderby sort
        $categories = Category::orderBy('SortOrder', 'desc')->get();
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

        $blogs = blog::orderBy('id', 'desc')->take(5)->get();


        return view('FrontEnd/index')->with(['Users' => $Users, 'CompanyUsers' => $CompanyUsers, 'Cities' => $Cities, 'Categories' => $Categories, 'Vacancies' => $Vacancies, "Langs" => $Langs, 'blogs' => $blogs]);
    }
    public function About($lang)
    {

        return view('FrontEnd/about');
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


        return view('FrontEnd/company')->with(['Companies' => $Companies, 'CompanyUsers' => $CompanyUsers]);
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
            'VacancySalary' => 'required'
        ], $messages);


        //create vacancy with $req
        $data = $req->all();
        $data['CompanyUser_id'] = $req->CompanyUser;
        $data['Category_id'] = $req->Category;
        $data['City_id'] = $req->City;
        $data['Status'] = 0;
        // data['EndDate'] date now + 1 month 
        $data['EndDate'] = date('Y-m-d', strtotime('+1 month'));

        $data['VacancyDescription'] = $req->VacancyDescription;
        $data['VacancyRequirements'] = $req->VacancyRequirements;
        $data['VacancySalary'] = $req->VacancySalary;
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
        $vacancy = Vacancy::where('id', $id)->where('Status', 1)->first();
        if ($vacancy == null)
            return response()->json(['errors' => [__("validationUser.This vacancy is not exist")]]);


        $vacUser = subscribe_vacancy::where('user_id', $user->id)->where('vacancy_id', $vacancy->id)->first();
        if ($vacUser != null) {
            $vacUser->delete();
            $notification = NotificationForCompanyUser::where('user_id', $user->id)->where('vacancy_id', $vacancy->id)->delete();
            $user = HomeController::MergeUsersTable($user);
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
}
