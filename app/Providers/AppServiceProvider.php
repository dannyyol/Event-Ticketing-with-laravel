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
            // dd($inp);
        
        View::share('count_subcategories', Subcategory::withCount('events')->get());
        View::share('count_categories', Category::withCount('events')->get());
        View::share('new_events', Event::orderBy('updated_at', 'ASC')->get());
        // $t = View::share('count_sub', Subcategory::with('categories')->get());

        // $test = View::share('count_categories', Category::withCount('events')->get());
        
        // foreach($t as $s){
        //     dd($s->events->title);
        // }
       
        // View::share('price_range', Tickets::where('price', '>=', 10));

        $max = 56;
        $min = 0;
        // $venue = View::share('venue', DB::select(
        //     DB::raw("SELECT * FROM (SELECT title, COUNT(venue) as e_count FROM events GROUP BY venue) a WHERE a.e_count > 1")
        // ));
            // dd($venue);
        
            // $venue= View::share('venue', DB::select('SELECT title, COUNT(venue) FROM events GROUP BY title HAVING (COUNT(venue) > 1)')
            //      );
            //      dd($venue);
        
        // $ticket = DB::select("select * from `tickets` where(price BETWEEN $min AND $max)");
        // foreach($ticket as $t){
        //     return $t;
        // }

        // dd($ticket->events());



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
