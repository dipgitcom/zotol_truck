<div class="app-menu">
    <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar>
           <!-- Sidebar Brand (Modern Card Style with Hover Animation & Custom Font) -->
<a href="{{ route('dashboard') }}" class="sidebar-brand d-flex align-items-center px-3 py-2" 
   style="background:#f8f9fc; border-radius:8px; text-decoration:none; transition: all 0.3s ease;">

    <!-- Logo -->
    <img src="{{ get_setting('APP_LOGO', asset('assets/images/brand/logo/logo-2.svg')) }}" 
         alt="App Logo" 
         style="height:50px; width:auto; object-fit:contain; margin-right:10px; transition: transform 0.3s ease;">

    <!-- App Name with Poppins font -->
    <span class="fw-bold app-name" style="font-size:1.1rem; color:#4e73df; font-family: 'Poppins', sans-serif; transition: all 0.3s ease;">
        {{ get_setting('APP_NAME', 'Admin Panel') }}
    </span>

</a>

<!-- Optional: Google Font (add once in master layout) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

<!-- Inline CSS for hover effects -->
<style>
.sidebar-brand:hover {
    background-color: #e2e6f0; /* subtle hover background */
    transform: translateY(-2px); /* slight lift */
}

.sidebar-brand img {
    /* Slight zoom on hover */
}
.sidebar-brand:hover img {
    transform: scale(1.05);
}

.sidebar-brand:hover .app-name {
    color: #2e59d9; /* darker blue on hover */
}
</style>

            <ul class="navbar-nav flex-column" id="sideNavbar">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <div class="navbar-heading">Layouts & Pages</div>
                </li>

                <!-- FAQ -->
                @can('faq_view')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq.index') }}">
                        <i class="bi bi-question-circle me-2"></i> FAQ
                    </a>
                </li>
                @endcan

                <!-- Dynamic Pages -->
                @canany(['dynamic_view', 'dynamic_create'])
                <li class="nav-item">
                    <a class="nav-link has-arrow {{ request()->routeIs('dynamic.*') ? '' : 'collapsed' }}"
                       href="#!"
                       data-bs-toggle="collapse"
                       data-bs-target="#navDynamicPages"
                       aria-expanded="{{ request()->routeIs('dynamic.*') ? 'true' : 'false' }}"
                       aria-controls="navDynamicPages">
                        <i data-feather="file-text" class="nav-icon me-2 icon-xxs"></i> Dynamic Pages
                    </a>

                    <div id="navDynamicPages" class="collapse {{ request()->routeIs('dynamic.*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            @can('dynamic_view')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dynamic.index') ? 'active' : '' }}" href="{{ route('dynamic.index') }}">
                                    All Pages
                                </a>
                            </li>
                            @endcan
                            @can('dynamic_create')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dynamic.create') ? 'active' : '' }}" href="{{ route('dynamic.create') }}">
                                    Add New Page
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                <!-- Settings -->
                @can('settings_manage')
                <li class="nav-item">
                    <a class="nav-link has-arrow {{ request()->routeIs('settings.*') ? '' : 'collapsed' }}"
                       href="#!"
                       data-bs-toggle="collapse"
                       data-bs-target="#navSettings"
                       aria-expanded="{{ request()->routeIs('settings.*') ? 'true' : 'false' }}"
                       aria-controls="navSettings">
                        <i data-feather="settings" class="nav-icon me-2 icon-xxs"></i> Settings
                    </a>

                    <div id="navSettings" class="collapse {{ request()->routeIs('settings.*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('settings.mail') ? 'active' : '' }}" href="{{ route('settings.mail') }}">
                                    Mail Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('settings.admin') ? 'active' : '' }}" href="{{ route('settings.admin') }}">
                                    Admin Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                <!-- Users -->
                @canany(['user_view','user_create'])
                <li class="nav-item">
                    <a class="nav-link has-arrow {{ request()->routeIs('users.*') ? '' : 'collapsed' }}"
                       href="#!"
                       data-bs-toggle="collapse"
                       data-bs-target="#navUsers"
                       aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}"
                       aria-controls="navUsers">
                        <i data-feather="users" class="nav-icon me-2 icon-xxs"></i> Users
                    </a>

                    <div id="navUsers" class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            @can('user_view')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                    All Users
                                </a>
                            </li>
                            @endcan
                            @can('user_create')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">
                                    Add New User
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                <!-- Categories -->
                @canany(['category_view','category_create'])
                <li class="nav-item">
                    <a class="nav-link has-arrow {{ request()->routeIs('categories.*') ? '' : 'collapsed' }}"
                       href="#!"
                       data-bs-toggle="collapse"
                       data-bs-target="#navCategories"
                       aria-expanded="{{ request()->routeIs('categories.*') ? 'true' : 'false' }}"
                       aria-controls="navCategories">
                        <i data-feather="grid" class="nav-icon me-2 icon-xxs"></i> Categories
                    </a>

                    <div id="navCategories" class="collapse {{ request()->routeIs('categories.*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            @can('category_view')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                    All Categories
                                </a>
                            </li>
                            @endcan
                            @can('category_create')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('categories.create') ? 'active' : '' }}" href="{{ route('categories.create') }}">
                                    Add New Category
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                <!-- Roles -->
                @canany(['role_view','role_create'])
                <li class="nav-item">
                    <a class="nav-link has-arrow {{ request()->routeIs('roles.*') ? '' : 'collapsed' }}"
                       href="#!"
                       data-bs-toggle="collapse"
                       data-bs-target="#navRoles"
                       aria-expanded="{{ request()->routeIs('roles.*') ? 'true' : 'false' }}"
                       aria-controls="navRoles">
                        <i class="bi bi-shield-lock me-2"></i> Roles
                    </a>

                    <div id="navRoles" class="collapse {{ request()->routeIs('roles.*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            @can('role_view')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                    All Roles
                                </a>
                            </li>
                            @endcan
                            @can('role_create')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('roles.create') ? 'active' : '' }}" href="{{ route('roles.create') }}">
                                    Add New Roles
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

            </ul>
        </div>
    </div>
</div>
