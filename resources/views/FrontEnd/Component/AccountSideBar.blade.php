<ul>
    <li>
        <a id="account" href="{{ route('Account', app()->getLocale()) }}">
            <i class='bx bx-user'></i>
            My Profile
        </a>
    </li>
    <li>
        <a id="Resume" href="{{ route('MyResume', app()->getLocale()) }}">
            <i class='bx bxs-file-doc'></i>
            My Resume
        </a>
    </li>
    <li>
        <a id="AppliedJobs" href="{{ route('AppliedJobs', app()->getLocale()) }}">
            <i class='bx bx-briefcase'></i>
            Applied Job
        </a>
    </li>
    <li>
        <a id="Messages" href="{{ route('Messages', app()->getLocale()) }}">
            <i class='bx bx-envelope'></i>
            Messages
        </a>
    </li>
    <li>
        <a id="ChangePass" href="{{ route('ChangePass', app()->getLocale()) }}">
            <i class='bx bx-lock-alt'></i>
            Change Password
        </a>
    </li>
    <li>
        <a id="Logout" href="{{ route('Logout', app()->getLocale()) }}">
            <i class='bx bx-log-out'></i>
            Log Out
        </a>
    </li>
</ul>
