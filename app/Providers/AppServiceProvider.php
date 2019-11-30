<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use App\Subcategory;
use App\Category;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Event;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $inp = Request()->get('id');
            
        
        View::share('count_subcategories', Subcategory::withCount('events')->get());
        View::share('count_categories', Category::withCount('events')->get());
        View::share('new_events', Event::orderBy('updated_at', 'ASC')->get());

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        

    }
}
