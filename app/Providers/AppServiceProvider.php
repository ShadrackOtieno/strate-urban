<?php

namespace App\Providers;

use App\Models\Development;
use App\Models\Enquiry;
use App\Models\Location;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('Support/helpers.php');

        // Old local MySQL installs may default to MyISAM, which has a small index limit and ignores foreign keys.
        config(['database.connections.mysql.engine' => 'InnoDB', 'database.connections.mariadb.engine' => 'InnoDB']);
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Site settings are available as $site in EVERY view.
        View::composer('*', function ($view) {
            static $shared = null;
            if ($shared === null) {
                try {
                    $shared = ['site' => Setting::map()];
                } catch (\Throwable $e) {
                    $shared = ['site' => []];
                }
            }
            $view->with($shared);
        });

        // Navigation and footer data (only the public layout needs these).
        View::composer('layouts.site', function ($view) {
            try {
                $view->with([
                    'navDevelopments' => Development::active()->get(['id', 'name', 'slug']),
                    'navLocations' => Location::active()->get(['id', 'name', 'slug']),
                ]);
            } catch (\Throwable $e) {
                $view->with(['navDevelopments' => collect(), 'navLocations' => collect()]);
            }
        });

        View::composer('layouts.admin', function ($view) {
            try {
                $view->with('badges', ['enquiries' => Enquiry::where('status', 'new')->count()]);
            } catch (\Throwable $e) {
                $view->with('badges', ['enquiries' => 0]);
            }
        });
    }
}
