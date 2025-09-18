<div class="header">
    <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">

            <!-- Brand Logo (Mobile) -->
            <a class="navbar-brand d-block d-md-none" href="{{ url('/') }}">
                <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                     alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="40" />
            </a>

            <!-- Sidebar Toggle -->
            <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                     class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                    <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 
                             2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 
                             1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 
                             6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 
                             0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 
                             1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 
                             0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg>
            </a>

            <!-- Navbar nav -->
            <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">

            
<!-- Logout (Danger Mode) -->
<li class="ms-2">
    <a href="{{ route('logout') }}" class="nav-link p-2 text-danger"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i data-feather="power"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>


                <!-- Profile Dropdown -->
                <li class="dropdown ms-2">
                    <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            <img src="{{ Auth::check() ? Auth::user()->profile_photo_url : asset('backend/assets/images/default-avatar.png') }}" 
                                 alt="Profile Photo" class="rounded-circle" width="40" height="40">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <div class="px-4 pb-0 pt-2">
                            <div class="lh-1">
                                <h5 class="mb-1">{{ Auth::user()->name ?? 'Guest' }}</h5>
                                <a href="{{ route('profile.edit') }}" class="text-inherit fs-6">View my profile</a>
                            </div>
                            <div class="dropdown-divider mt-3 mb-2"></div>
                        </div>
                        <ul class="list-unstyled">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="activity"></i>Activity Log
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#!">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="settings"></i>Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>
    </div>
</div>