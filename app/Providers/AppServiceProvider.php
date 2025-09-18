<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View; // ✅ Corrected
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('currentRoute', Route::currentRouteName());
        });

        // if (Schema::hasTable('settings')) {
        //     Config::set('mail.mailers.smtp.transport', get_setting('mail_mailer', 'smtp'));
        //     Config::set('mail.mailers.smtp.host', get_setting('mail_host', 'smtp.mailtrap.io'));
        //     Config::set('mail.mailers.smtp.port', get_setting('mail_port', 587));
        //     Config::set('mail.mailers.smtp.username', get_setting('mail_username'));
        //     Config::set('mail.mailers.smtp.password', get_setting('mail_password'));
        //     Config::set('mail.from.address', get_setting('mail_from_address', 'admin@example.com'));
        //     Config::set('app.name', get_setting('app_name', 'My App'));
        // }

        // ✅ Register @role Blade directive
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function () {
            return '<?php endif; ?>';
        });

        // / Get favicon from settings, fallback to default
        $favicon = get_setting('APP_FAVICON');

        if (! $favicon || ! file_exists(public_path($favicon))) {
            // fallback if the uploaded file is missing
            $favicon = 'backend/uploads/settings/favicon.ico'; // or your preferred default
        }

        // Share globally
        View::share('faviconPath', $favicon);

    }
}
