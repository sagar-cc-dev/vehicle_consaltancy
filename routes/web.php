<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about',[\App\Http\Controllers\HomeController::class,'about'])->name('about');
Route::get('/contact',[\App\Http\Controllers\HomeController::class,'contact'])->name('contact');
Route::get('/vehicals',[\App\Http\Controllers\VehicalsController::class,'index'])->name('vehicals.list');
Route::get('/vehical/{slug}',[\App\Http\Controllers\VehicalsController::class,'show'])->name('vehical.show');
Route::post('/vehical/inquiry',[App\Http\Controllers\VehicalsController::class,'StoreInquiry'])->name('vehical.inquiry');
Route::post('/inquiry',[App\Http\Controllers\HomeController::class,'StoreInquiry'])->name('store.inquiry');
Route::get('/favouite/vehical/{id}',[App\Http\Controllers\VehicalsController::class,'FavouriteVehical'])->name('favourite.vehical');
Route::get('/favouite/vehical',[App\Http\Controllers\UsersController::class,'FavouriteList'])->name('favourite.list');
Route::get('/profile',[\App\Http\Controllers\UsersController::class,'profile'])->name('profile');
Route::post('/profile',[App\Http\Controllers\UsersController::class,'updateProfile'])->name('update.profile');
Route::post('/feedback',[App\Http\Controllers\UsersController::class,'StoreFeedback'])->name('feedback');
Route::get('fetch',[\App\Http\Controllers\Admin\VehicalsController::class,'fetch'])->name('fetchData');

//Admin Section
Route::get('admin/login',[\App\Http\Controllers\Admin\AuthController::class,'getLogin'])->name('admin.login');
Route::post('admin/login',[\App\Http\Controllers\Admin\AuthController::class,'postLogin'])->name('admin.post.login');

Route::middleware('admin')->prefix('admin')->namespace('\App\Http\Controllers\Admin')->name('admin.')->group(function(){

	Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');

	// Route for profile
	Route::get('profile',[\App\Http\Controllers\Admin\AuthController::class,'getProfile'])->name('profile');
	Route::post('profile',[\App\Http\Controllers\Admin\AuthController::class,'postProfile'])->name('post.profile');

	// Route for Change Password
	Route::get('password',[\App\Http\Controllers\Admin\AuthController::class,'getPassword'])->name('password');
	Route::post('password',[\App\Http\Controllers\Admin\AuthController::class,'postPassword'])->name('post.password');

	// Route for Setting
    Route::get('settings',[\App\Http\Controllers\Admin\DashboardController::class,'settings'])->name('setting');
    Route::post('settings',[\App\Http\Controllers\Admin\DashboardController::class,'post_settings'])->name('post.setting');

    Route::resource('users',UsersController::class);

    Route::resource('categories',CategoriesController::class);

    Route::resource('brands',BrandsController::class);

    Route::resource('models',ModelsController::class);

    Route::resource('vehicals',VehicalsController::class);
    Route::post('vehicals/status',[\App\Http\Controllers\Admin\VehicalsController::class,'updateStatus'])->name('vehicals.status');

    Route::resource('vehical.galleries',VehicalGalleriesController::class);

    Route::resource('inquiries',InquiriesController::class);
    Route::post('inquiries/status',[\App\Http\Controllers\Admin\InquiriesController::class,'updateStatus'])->name('inquiries.status');

    Route::resource('feedbacks',FeedbacksController::class);


	// Route for Logout
	Route::post('logout',[\App\Http\Controllers\Admin\AuthController::class,'getLogout'])->name('admin.logout');

});
