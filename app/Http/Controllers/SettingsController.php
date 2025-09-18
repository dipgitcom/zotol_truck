<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;



class SettingsController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');

    // Middleware for permission-based access
    $this->middleware('can:settings_manage');
}


    /**
     * Show Mail Settings form
     */
    public function mailSettings()
    {
        $settings = [
            'mail_mailer'      => env('MAIL_MAILER'),
            'mail_host'        => env('MAIL_HOST'),
            'mail_port'        => env('MAIL_PORT'),
            'mail_username'    => env('MAIL_USERNAME'),
            'mail_password'    => env('MAIL_PASSWORD'),
            'mail_encryption'  => env('MAIL_ENCRYPTION'),
            'mail_from_address'=> env('MAIL_FROM_ADDRESS'),
            'app_name'         => env('APP_NAME'),
        ];

        return view('backend.settings.mail', compact('settings'));
    }

    /**
     * Update Mail Settings
     */
    public function mailstore(Request $request)
    {
        $request->validate([
            'mail_mailer'       => 'required|string',
            'mail_host'         => 'required|string',
            'mail_port'         => 'required|string',
            'mail_username'     => 'nullable|string',
            'mail_password'     => 'nullable|string',
            'mail_encryption'   => 'nullable|string',
            'mail_from_address' => 'required|string',
            'app_name'          => 'required|string',
        ]);

        try {
            $envPath = base_path('.env');

            if (!File::exists($envPath)) {
                return redirect()->back()->with('error', '.env file not found');
            }

            $envContent = File::get($envPath);

            $envContent = preg_replace([
                '/MAIL_MAILER=(.*)/',
                '/MAIL_HOST=(.*)/',
                '/MAIL_PORT=(.*)/',
                '/MAIL_USERNAME=(.*)/',
                '/MAIL_PASSWORD=(.*)/',
                '/MAIL_ENCRYPTION=(.*)/',
                '/MAIL_FROM_ADDRESS=(.*)/',
                '/APP_NAME=(.*)/',
            ], [
                'MAIL_MAILER=' . $request->mail_mailer,
                'MAIL_HOST=' . $request->mail_host,
                'MAIL_PORT=' . $request->mail_port,
                'MAIL_USERNAME=' . $request->mail_username,
                'MAIL_PASSWORD=' . $request->mail_password,
                'MAIL_ENCRYPTION=' . $request->mail_encryption,
                'MAIL_FROM_ADDRESS="' . $request->mail_from_address . '"',
                'APP_NAME="' . $request->app_name . '"',
            ], $envContent);

            File::put($envPath, $envContent);

            return redirect()->back()->with('success', 'Mail settings updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show Admin Settings form
     */
    public function admin()
    {
        $settings = [
            'APP_NAME'   => env('APP_NAME'),
            'APP_DEBUG'  => env('APP_DEBUG'),
            'APP_URL'    => env('APP_URL'),
            'APP_LOGO'   => env('APP_LOGO'),
            'APP_FAVICON'=> env('APP_FAVICON'),
        ];

        return view('backend.settings.admin', compact('settings'));
    }

    /**
     * Update Admin Settings
     */
    public function updateAdmin(Request $request)
{
    $request->validate([
        'APP_NAME'   => 'required|string',
        'APP_URL'    => 'required|url',
        'APP_DEBUG'  => 'required|in:true,false',
        'APP_LOGO'   => 'nullable|image|mimes:png,jpg,jpeg,svg,ico|max:2048',
        'APP_FAVICON'=> 'nullable|image|mimes:png,jpg,jpeg,svg,ico|max:1024',
    ]);

    $data = $request->only(['APP_NAME', 'APP_URL', 'APP_DEBUG']);

    // Logo upload
    if ($request->hasFile('APP_LOGO')) {
        $logoPath = $request->file('APP_LOGO')->store('uploads', 'public');
        $data['APP_LOGO'] = '/storage/' . $logoPath;

        Setting::updateOrCreate(
            ['key' => 'APP_LOGO'],
            ['value' => $data['APP_LOGO']]
        );
    }

    // Favicon upload
   if ($request->hasFile('APP_FAVICON')) {
    $favicon = $request->file('APP_FAVICON');
    $faviconName = 'favicon.' . $favicon->getClientOriginalExtension();

    $favicon->move(public_path('backend/uploads/settings'), $faviconName);

    Setting::updateOrCreate(
        ['key' => 'APP_FAVICON'],
        ['value' => 'backend/uploads/settings/' . $faviconName]
    );
}


    // Save other settings (APP_NAME, APP_URL, APP_DEBUG)
    foreach ($data as $key => $value) {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    \Cache::flush();

    return back()->with('success', 'Admin settings updated successfully.');
}


    /**
     * Helper method to update .env
     */
    private function updateEnv(array $data)
    {
        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            throw new \Exception('.env file not found');
        }

        $content = file_get_contents($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = $key . '=' . $value;

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $replacement, $content);
            } else {
                $content .= "\n{$replacement}";
            }
        }

        file_put_contents($envPath, $content);
    }
}
