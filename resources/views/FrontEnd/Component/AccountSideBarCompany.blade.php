@php
    
    use App\Models\NotificationForCompanyUser;
    use App\Models\Vacancy;
    if (session()->has('CompanyUser')) {
        // NotificationForCompanyUser count
    
        // NotificationForCompanyUser count
        $NotificationForCompanyUser = NotificationForCompanyUser::where('status', 0)->get();
    
        $CompanyUserVacancy = Vacancy::where('CompanyUser_id', session()->get('CompanyUser')->id)->get();
    
        $count = 0;
    
        foreach ($NotificationForCompanyUser as $value) {
            foreach ($CompanyUserVacancy as $value2) {
                if ($value->vacancy_id == $value2->id) {
                    $count++;
                }
            }
        }
        $empty = null;
        if ($count == 0) {
            $empty = 'empty';
        }
    }
    
@endphp


<ul>
    <li>
        <a id="Profile" href="{{ route('AccountCompany', app()->getLocale()) }}">
            <i class='bx bx-user'></i>
            {{ __('AccountSideBar.My Profile') }}
        </a>
    </li>
    <li>
        <a style="display: flex;
        align-items: center;
        justify-content: space-between;" id="Vacancies"
            href="{{ route('AccountCompanyVacancies', app()->getLocale()) }}">
            <div>

                <i class='bx bx-envelope'></i>
                {{ __('AccountSideBar.Vacancies') }}
            </div>
            @if ($empty == null)
                <span class="badge bg-danger" style="float:right;size: 17px;">{{ $count }}</span>
            @endif
        </a>
    </li>
    <li>
        <a id="ChangePass" href="{{ route('ChangePassCompany', app()->getLocale()) }}">
            <i class='bx bx-lock-alt'></i>
            {{ __('AccountSideBar.Change Password') }}
        </a>
    </li>
    <li>
        <a id="Logout" href="{{ route('LogoutCompany', app()->getLocale()) }}">
            <i class='bx bx-log-out'></i>
            {{ __('AccountSideBar.Log Out') }}
        </a>
    </li>
</ul>
