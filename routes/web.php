<?php

use App\Http\Controllers\Admin as A;
use App\Http\Controllers\DevelopmentController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/* ------------------------------ Public site ------------------------------ */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');
// Friendly listing shortcuts: same page with filters preset.
Route::get('/for-sale', [PropertyController::class, 'index'])->defaults('purpose', 'sale')->name('properties.sale');
Route::get('/for-rent', [PropertyController::class, 'index'])->defaults('purpose', 'rent')->name('properties.rent');
Route::get('/land-for-sale', [PropertyController::class, 'index'])->defaults('purpose', 'sale')->defaults('type', 'land')->name('properties.land-sale');
Route::get('/land-for-lease', [PropertyController::class, 'index'])->defaults('purpose', 'lease')->defaults('type', 'land')->name('properties.land-lease');
Route::get('/apartments-for-sale', [PropertyController::class, 'index'])->defaults('purpose', 'sale')->defaults('type', 'apartment')->name('properties.apartments-sale');
Route::get('/apartments-for-rent', [PropertyController::class, 'index'])->defaults('purpose', 'rent')->defaults('type', 'apartment')->name('properties.apartments-rent');
Route::get('/houses-for-rent', [PropertyController::class, 'index'])->defaults('purpose', 'rent')->defaults('type', 'house')->name('properties.houses-rent');

Route::get('/premium', [DevelopmentController::class, 'index'])->name('developments.index');
Route::get('/premium/{development:slug}', [DevelopmentController::class, 'show'])->name('developments.show');
Route::get('/locations/{location:slug}', [LocationController::class, 'show'])->name('locations.show');

Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [PageController::class, 'terms'])->name('terms');

Route::post('/enquiry', [EnquiryController::class, 'store'])->middleware('throttle:6,1')->name('enquiry.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->middleware('throttle:6,1')->name('newsletter.store');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/* ------------------------------ Back office ------------------------------ */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [A\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [A\AuthController::class, 'login'])->middleware('throttle:6,1')->name('login.submit');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [A\AuthController::class, 'logout'])->name('logout');
        Route::get('/', [A\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('properties', A\PropertyController::class)->except('show');
        Route::resource('developments', A\DevelopmentController::class)->except('show');
        Route::resource('locations', A\LocationController::class)->except('show');
        Route::resource('services', A\ServiceController::class)->except('show');
        Route::resource('team', A\TeamController::class)->except('show');
        Route::resource('testimonials', A\TestimonialController::class)->except('show');
        Route::resource('faqs', A\FaqController::class)->except('show');

        Route::get('enquiries', [A\EnquiryController::class, 'index'])->name('enquiries.index');
        Route::get('enquiries/{enquiry}', [A\EnquiryController::class, 'show'])->name('enquiries.show');
        Route::put('enquiries/{enquiry}', [A\EnquiryController::class, 'update'])->name('enquiries.update');
        Route::delete('enquiries/{enquiry}', [A\EnquiryController::class, 'destroy'])->name('enquiries.destroy');

        Route::get('subscribers', [A\SubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('subscribers/export', [A\SubscriberController::class, 'export'])->name('subscribers.export');
        Route::delete('subscribers/{subscriber}', [A\SubscriberController::class, 'destroy'])->name('subscribers.destroy');

        Route::get('settings', [A\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [A\SettingController::class, 'update'])->name('settings.update');
        Route::get('account', [A\AccountController::class, 'edit'])->name('account.edit');
        Route::put('account', [A\AccountController::class, 'update'])->name('account.update');
    });
});
