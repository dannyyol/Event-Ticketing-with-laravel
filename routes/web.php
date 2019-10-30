<?php
use App\Event;
use App\Ticket;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Subcategory;


// Route::get('/', function () { return redirect('/admin/home'); });

// $this->get('/', 'Guest\EventsController@index')->name('guest.home');
Route::get('/', 'Guest\EventsController@index')->name('guest.home');

//$this->get('events', 'Guest\EventsController@index')->name('events.index');
//$this->get('events/{event}', 'Guest\EventsController@show')->name('events.show');
$this->resource('events', 'Guest\EventsController');

$this->post('payment', 'Guest\PaymentsController@store')->name('guest.payment');

Route::resource('subcategory', 'Guest\SubcategoryController');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');

$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('events', 'Admin\EventsController');
    Route::post('events_mass_destroy', ['uses' => 'Admin\EventsController@massDestroy', 'as' => 'events.mass_destroy']);
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoryController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('subcategories_mass_destroy', ['uses' => 'Admin\SubcategoryController@massDestroy', 'as' => 'subcategories.mass_destroy']);


    Route::resource('tickets', 'Admin\TicketsController');
    Route::post('tickets_mass_destroy', ['uses' => 'Admin\TicketsController@massDestroy', 'as' => 'tickets.mass_destroy']);
    Route::resource('payments', 'Admin\PaymentsController');

    Route::resource('categories', 'Admin\CategoryController');
    // Route::get('/', 'Admin\CategoryController');
    Route::resource('subcategories', 'Admin\SubcategoryController');

});
Route::group(['middleware', 'auth'], function(){
    Route::post('event/like','LikeController@toggleLike')->name('toggleLike');
    // Route::post('pay-with-paypal', 'Guest\PaymentsController@payWithPaypal')->name('payment.paypal');
    // Route::get('/paypalCallback', 'Guest\PaymentsController@paySuccess')->name('payment.paypalSuccess');
    Route::resource('/cart', 'CartController');
    Route::get('/cart/add-item/{id}', 'CartController@addItem')->name('cart.addItem');


    Route::post('paypal/express-checkout', 'Guest\PaymentsController@expressCheckout')->name('paypal.express-checkout');
    Route::get('paypal/express-checkout-success', 'Guest\PaymentsController@expressCheckoutSuccess');
    Route::post('paypal/notify', 'Guest\PaymentsController@notify');

});

// Route::get('/price', function() {

//     $tickets = Ticket::where(function($query){

//         $min_price = Input::has('min_price') ? Input::get('min_price') : null;
//         $max_price  = Input::has('max_price') ? Input::get('max_price') : null;
//         // $max = implode('', $max);
//         if(isset($min_price) && isset($max_price)){
//             $query->where('price', $min_price)
//             ->where('price', $max_price);
//         }
//     })->get();
    
//     return view('guest.home',  compact('tickets'));
    
// });

Route::any('search',function(Request $request){
    $q = Input::get('q');
    if($q != ''){
        
      $data = Event::where('title','LIKE','%'.$q.'%')
      ->orWhere('venue','LIKE','%'.$q.'%')
      ->paginate('4')
      ->setpath('');
      $data->appends(array(
        'q'=>Input::get('q'),
      ));
      if(count($data) > 0){
        return view('guest.events.search', ['msg'=>'Results: '. $q])->withData($data);
      }
      return view ('guest.events.search')->withMessage('No details found. Try to search again !');
    }
});
