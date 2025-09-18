<?php
use App\Http\Controllers\DynamicPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;


// Dashboard - only authenticated users
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('backend.profile.edit', [
            'user' => Auth::user(),
        ]);
    })->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dynamic Pages - only Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [DynamicPageController::class, 'index'])->name('dynamic.index');
    Route::get('/create', [DynamicPageController::class, 'create'])->name('dynamic.create');
    Route::post('/store', [DynamicPageController::class, 'store'])->name('dynamic.store');
    Route::get('/show', [DynamicPageController::class, 'show'])->name('dynamic.show');
    Route::get('/edit', [DynamicPageController::class, 'edit'])->name('dynamic.edit');
    Route::get('/destroy', [DynamicPageController::class, 'destroy'])->name('dynamic.destroy');
    Route::get('/update', [DynamicPageController::class, 'destroy'])->name('dynamic.update');
});

//  Settings - only Admin
Route::prefix('settings')->middleware(['auth'])->group(function () {
    Route::get('/mail', [SettingsController::class, 'mailSettings'])->name('settings.mail');
    Route::post('/mail', [SettingsController::class, 'mailstore'])->name('settings.mail.update');
    Route::get('/settings/admin', [SettingsController::class, 'admin'])->name('settings.admin');
    Route::post('/settings/admin', [SettingsController::class, 'updateAdmin'])->name('settings.admin.update');
    
});

// User Profile and Management - only Admin
Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');        // /users
    Route::get('/create', [UserController::class, 'create'])->name('users.create'); // /users/create
    Route::post('/', [UserController::class, 'store'])->name('users.store');        // /users
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');// /users/{user}/edit
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');// /users/{user}
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');// /users/{user}
    
});

Route::middleware(['auth'])->group(function() {
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

    // Admin CRUD
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');
});


// Categories - only Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Roles - only Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

});



