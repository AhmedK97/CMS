<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // app()->useLangPath(base_path('lang'));
        Carbon::setLocale('ar');

        View::composer(['partials.sidebar', 'lists.categories'], function ($view) {
            $view->with('categories', Category::all());
        });

        View::composer('lists.roles', function ($view) {
            $view->with('roles', Role::all());
        });

        View::composer(['partials.sidebar', 'user.profile'], function ($view) {
            $view->with('comments', Comment::latest()->take(5)->get());
        });

        View::composer(['partials.navbar'], function ($view) {
            $view->with('pages', Page::get());
        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
         
        view::composer(['admin.template'], function ($view) {
            $view->with('pages', page::get());
        });
    }
}
