<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Codescandy" />

    <!-- Favicon + CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicon/favicon.ico') }}" />
    <link href="{{ asset('backend/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">

    <title>@yield('title', 'Login')</title>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-logo img {
            max-height: 60px;
        }
        .btn-primary {
            background-color: #378beb;
            border-color: #378beb;
        }
        .btn-primary:hover {
            background-color: #2c6edb;
            border-color: #2c6edb;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/theme.min.js') }}"></script>
@stack('scripts')

</body>
</html>
