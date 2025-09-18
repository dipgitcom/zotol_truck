<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Codescandy" />

    <!-- Dynamic Favicon -->
   
<link rel="icon" href="{{ asset(get_setting('APP_FAVICON', 'backend/uploads/settings/favicon.ico')) }}?v={{ time() }}">
<link rel="shortcut icon" href="{{ asset(get_setting('APP_FAVICON', 'backend/uploads/settings/favicon.ico')) }}?v={{ time() }}">


    <!-- Styles -->
    @include('backend.partials.style')

    <title>@yield('title', get_setting('site_name', 'Admin Panel'))</title>
</head>

<body>
<main id="main-wrapper" class="main-wrapper">
    
    {{-- Sidebar --}}
    @include('backend.partials.sidebar')

    {{-- Navbar --}}
    @include('backend.partials.navbar')

    {{-- Page Content --}}
    <div id="page-wrapper" class="page-wrapper container-fluid">
        @yield('content')
    </div>

</main>

<!-- Scripts -->
@include('backend.partials.script')
@stack('scripts')

</body>
</html>
