<div class="dropdown-toggle" data-toggle="dropdown">
    <img src="{{ asset('backend/files/assets/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image" />
    <span>{{ Auth::guard('admin')->user()->nombre }}</span>
    <i class="feather icon-chevron-down"></i>
</div>
<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
    {{-- <li>
        <a href="#!">
            <i class="feather icon-settings"></i> Settings
        </a>
    </li>
    <li>
        <a href="default/user-profile.html">
            <i class="feather icon-user"></i> Profile
        </a>
    </li>
    <li>
        <a href="default/email-inbox.html">
            <i class="feather icon-mail"></i> My Messages
        </a>
    </li>
    <li>
        <a href="default/auth-lock-screen.html">
            <i class="feather icon-lock"></i> Lock Screen
        </a>
    </li> --}}
    <li>
        <a href="{{ route('admin.logout.submit') }}"
            onclick="event.preventDefault();
                      document.getElementById('admin-logout-form').submit();">
            <i class="feather icon-log-out"></i> Salir
        </a>
        <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
