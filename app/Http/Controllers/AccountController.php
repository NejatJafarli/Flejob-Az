<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EditAccount;
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
use App\Models\NotificationForCompanyUser;
use App\Models\subscribe_vacancy;
use App\Models\Vacancy;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    //
    public function AccountCompanyVacancies($lang)
    {
        if (!session()->has('CompanyUser'))
            return redirect()->route('Signin', app()->getLocale());

        $user = session()->get('CompanyUser');
        $user = HomeController::MergeCompanyUsersTable($user);
        session()->put('CompanyUser', $user);

        // get User Vacancies with pagination
        $Vacancies = $user->Vacancies()->paginate(4);


        return view('FrontEnd/AccountVacancies')->with(['Vacancies' => $Vacancies]);
    }
    public function AccountCompany($lang)
    {

        if (!session()->has('CompanyUser'))
            return redirect()->route('Signin', ['language' => $lang]);

        $CompanyUser = HomeController::MergeCompanyUsersTable(session()->get('CompanyUser'));
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
        $user = HomeController::MergeUsersTable($user);
        session()->put('user', $user);

        return view("FrontEnd/account")->with([
            'cities' => $cities,
            'Langs' => $langs,
            'categories' => $categories,
            'languages' => $languages,
            'education_levels' => $education_level
        ]);
    }
    public function AppliedJobs($lang)
    {
        //check if session
        if (!session()->has('user'))
            return redirect()->route('Signin', app()->getLocale());


        $user = session()->get('user');
        $user = HomeController::MergeUsersTable($user);
        session()->put('user', $user);

        $AppliedVacancies = subscribe_vacancy::where('User_id', $user->id)->paginate(4);

        $Langs = lang::all();
        return view('FrontEnd/AppliedJobs')->with(['Langs' => $Langs, 'AppliedVacancies' => $AppliedVacancies]);
    }
    public function MyResume($lang)
    {
        //check session
        if (session()->has('user')) {
            $user = session()->get('user');
            $user = HomeController::MergeUsersTable($user);

            $langs = lang::all();

            return view('FrontEnd/Resume', ['Langs' => $langs]);
        } else {
            return redirect()->route('Signin', app()->getLocale());
        }
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
            $user = HomeController::MergeCompanyUsersTable($user);
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
            $user = HomeController::MergeCompanyUsersTable($user);
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
                $myCandidates[] = HomeController::MergeUsersTable($can);
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
    

    /////
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
    
    
    
            $user = HomeController::MergeUsersTable($user);
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
    
                    $user = HomeController::MergeUsersTable($user);
                    session()->put('user', $user);
                }
    
            $user = HomeController::MergeUsersTable($user);
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
    
                    $user = HomeController::MergeUsersTable($user);
                    session()->put('user', $user);
                }
    
    
            $user = HomeController::MergeUsersTable($user);
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
    
                    $user = HomeController::MergeUsersTable($user);
                    session()->put('user', $user);
                }
            $user = HomeController::MergeUsersTable($user);
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
            $user = HomeController::MergeUsersTable($user);
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
            $CompanyUser = HomeController::MergeCompanyUsersTable($CompanyUser);
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
            $CompanyUser = HomeController::MergeCompanyUsersTable(session('CompanyUser'));
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
            $user = HomeController::MergeCompanyUsersTable($user);
            session()->put('CompanyUser', $user);
            return redirect()->back();
        }

        ///// 
        
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

        $user = HomeController::MergeUsersTable($user);
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
        $user = HomeController::MergeUsersTable($user);
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
        $user = HomeController::MergeUsersTable($user);
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
        $user = HomeController::MergeCompanyUsersTable($user);
        session()->put('CompanyUser', $user);
        return redirect()->back();
    }
    public function Messages()
    {
        //check if user is logged in
        if (!session()->has('user'))
            return redirect()->route('Signin', app()->getLocale());

        return view('FrontEnd/Messages');
    }
}
