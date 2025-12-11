<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            $auth = Auth::user();
            $setting = Setting::whereId(1)->first();
            $c_questions = Question::count();
            $view->with(['auth' => $auth, 'setting' => $setting, 'c_questions' => $c_questions]);
        });
        Paginator::useBootstrap();
        Model::automaticallyEagerLoadRelationships();
    }
}
