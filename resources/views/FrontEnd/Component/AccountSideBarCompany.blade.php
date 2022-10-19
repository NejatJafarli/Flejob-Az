<ul>
    <li>
        <a id="Profile" href="{{ route('AccountCompany', app()->getLocale()) }}">
            <i class='bx bx-user'></i>
            My Profile
        </a>
    </li>
    <li>
        <a id="Vacancies" href="{{ route('AccountCompanyVacancies', app()->getLocale()) }}">
            <i class='bx bx-envelope'></i>
            Vacancies
        </a>
    </li>
    <li>
        <a id="ChangePass" href="{{ route('ChangePassCompany', app()->getLocale()) }}">
            <i class='bx bx-lock-alt'></i>
            Change Password
        </a>
    </li>
    <li>
        <a id="Logout" href="{{ route('LogoutCompany', app()->getLocale()) }}">
            <i class='bx bx-log-out'></i>
            Log Out
        </a>
    </li>
</ul>
