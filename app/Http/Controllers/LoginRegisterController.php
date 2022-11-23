<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class LoginRegisterController extends Controller
{
    //
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

        if ($user == null)
            return redirect()->route('Signin', ['language' => $lang])->withErrors(['errors' => 'Email or Password is incorrect']);
        if ($pass == $user->Password) {
            //check if user status is active
            if ($user->Status == 1) {

                $user = HomeController::MergeUsersTable($user);

                session()->put('user', $user);
                return redirect()->route('Hom', ['language' => $lang]);
            } else
                //user is not active
                return redirect()->route('Signin', ['language' => $lang])->withErrors(['errors' => 'Your Account is not active']);
        } else {
            return redirect()->route('Signin', ['language' => $lang])->withErrors(['errors' => 'Email or Password is incorrect']);
        }
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

        return redirect()->route('Signin', app()->getLocale());
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
        return redirect()->route('Hom', app()->getLocale());
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
}
