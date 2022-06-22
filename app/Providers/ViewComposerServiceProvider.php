<?php

namespace App\Providers;

use App\Http\ViewComposers\CountersComposer;
use App\Models\Configurations\AcademicLevel;
use App\Models\Configurations\Deadline;
use App\Models\Configurations\PaperType;
use App\Models\Configurations\Pricing;
use App\Models\Configurations\Website;
use App\Models\OrderPricing;
use App\Models\Ratings\Rating;
use App\Models\Samples\Sample;
use App\Models\Services\Service;
use App\Models\Tips\Tip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $views = [
            'app.dashboard',
            'app.nav.top_nav',
            'app.nav.sidebar',
        ];

        View::composer($views, CountersComposer::class);

        view()->composer($views, function ($view) {
            $view->with('user', Auth::user());
        });

        View::composer(['layouts.page.service'], function ($view) {
            $view->with(['services' => Service::general()]);
        });


        View::composer(['pages.samples'], function ($view) {
            $view->with(['samples' => Sample::all()->take(3)]);
        });

        View::composer(['pages.components.reviews'], function ($view) {
            $view->with(['reviews' => Rating::reviews()
                ->where('type', 'client_mark')
                ->get()]);
        });

        view()->composer('orders.partials.simple_order', function ($view) {
            $view->with([
                'papers' => PaperType::all(),
                'academicLevels' => AcademicLevel::all(),
                'deadlines' => Deadline::orderDeadlines(),
                'pricing' => collect([
                    'prices' => OrderPricing::all()])
            ]);
        });


        view()->composer('orders.partials.page_calculator', function ($view) {
            $view->with([
                'papers' => PaperType::all(),
                'academicLevels' => AcademicLevel::all(),
                'deadlines' => Deadline::orderDeadlines(),
                'pricing' => collect([
                    'prices' => OrderPricing::all()])
            ]);
        });

        view()->composer('pages.price', function ($view) {
            $view->with([
                'client' => Website::findOrFail(websiteId()),
                'academicLevels' => AcademicLevel::all(),
                'deadlines' => Deadline::orderDeadlines(),
                'pricing' => Pricing::formattedPricing(websiteId()),
            ]);
        });

        view()->composer('pages.pricezh', function ($view) {
            $view->with([
                'client' => Website::findOrFail(websiteId()),
                'academicLevels' => AcademicLevel::all(),
                'deadlines' => Deadline::orderDeadlines(),
                'pricing' => Pricing::formattedPricing(websiteId()),
            ]);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
