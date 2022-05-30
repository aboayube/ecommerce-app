<?php

use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\AdvertisementUserController;
use App\Http\Controllers\Admin\AppevaluationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\OnslashController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProblemsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductdetailsController;
use App\Http\Controllers\Admin\ProductUserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReviewProductController;
use App\Http\Controllers\Admin\ReviewSalersController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SellersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProductdetialsInputController;
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

Route::get('statusUpdate', function () {
    if (auth()->user()->status == 1) {
        return redirect()->route('home');
    }
    return view('auth.statusUpdate');
})->name('statusUpdate');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(
            [
                'prefix' => '/admin/', 'as' => 'admin.',
                'middleware' => ['auth', 'isAdmin']
            ],
            function () {


                Route::get('/dashboard', [App\Http\Controllers\Admin\DashboradController::class, 'index'])->name('dashboard');
                //roles    
                Route::group(
                    ['prefix' => '/roles/', 'as' => 'roles.'],
                    function () {
                        Route::get('/', [RoleController::class, 'index'])->name('index');
                        Route::post('/store', [RoleController::class, 'store'])->name('store');
                        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                        Route::patch('/update/{id}', [RoleController::class, 'update'])->name('update');
                        Route::post('/delete', [RoleController::class, 'destroy'])->name('delete');
                    }
                );
                //users
                Route::group([
                    'prefix' => '/users',
                    'as' => 'users.'
                ],  function () {
                    Route::get('/', [UserController::class, 'index'])->name('index');
                    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
                    Route::post('/update', [UserController::class, 'update'])->name('update');
                    Route::post('/delete', [UserController::class, 'destroy'])->name('delete');
                });

                    //salers
                Route::group([
                    'prefix' => '/sellers',
                    'as' => 'sellers.'
                ],  function () {
                    Route::get('/', [SellersController::class, 'index'])->name('index');
                    Route::get('/edit/{id}', [SellersController::class, 'edit'])->name('edit');
                    Route::get('/show/{id}', [SellersController::class, 'show'])->name('show');
                    Route::post('/update', [SellersController::class, 'update'])->name('update');
                    Route::post('/delete', [SellersController::class, 'destroy'])->name('destroy');
                });
                //products
                Route::group([
                    'prefix' => '/products',
                    'as' => 'products.'
                ],  function () {
                    Route::get('/', [ProductController::class, 'index'])->name('index');
                    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
                    Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
                    Route::post('/update', [ProductController::class, 'update'])->name('update');
                    Route::post('/delete', [ProductController::class, 'destroy'])->name('destroy');
                });
                //اعدادات الموقع
                Route::group([
                    'prefix' => '/settings',
                    'as' => 'settings.'
                ],  function () {
                    Route::get('/', [SettingController::class, 'index'])->name('index');
                    Route::post('/', [SettingController::class, 'update'])->name('update');
                    Route::get('/', [SettingController::class, 'index'])->name('index');
                });
                //مشاكل المستخدمين
                Route::group([
                    'prefix' => '/problems',
                    'as' => 'problems.'
                ],  function () {
                    Route::get('/', [ProblemsController::class, 'index'])->name('index');
                    Route::post('/', [ProblemsController::class, 'destroy'])->name('delete');
                });
                //تقييم التطبيق من قبل المستخدمين
                Route::group([
                    'prefix' => '/appevaluations',
                    'as' => 'appevaluations.'
                ],  function () {
                    Route::get('/', [AppevaluationController::class, 'index'])->name('index');
                    Route::post('/', [AppevaluationController::class, 'destroy'])->name('delete');
                });

                //onslashs
                Route::group([
                    'prefix' => '/onslashs',
                    'as' => 'onslashs.'
                ],  function () {
                    Route::get('/', [OnslashController::class, 'index'])->name('index');
                    Route::post('/store', [OnslashController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [OnslashController::class, 'edit'])->name('edit');
                    Route::post('/update', [OnslashController::class, 'update'])->name('update');
                    Route::post('/delete', [OnslashController::class, 'destroy'])->name('delete');
                });
                //categories
                Route::group([
                    'prefix' => '/categories',
                    'as' => 'categories.'
                ],  function () {
                    Route::get('/', [CategoryController::class, 'index'])->name('index');
                    Route::post('/store', [CategoryController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
                    Route::post('/update', [CategoryController::class, 'update'])->name('update');
                    Route::post('/delete', [CategoryController::class, 'destroy'])->name('delete');
                });
                //departments
                Route::group([
                    'prefix' => '/departments',
                    'as' => 'departments.'
                ],  function () {
                    Route::get('/', [DepartmentController::class, 'index'])->name('index');
                    Route::post('/store', [DepartmentController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
                    Route::post('/update', [DepartmentController::class, 'update'])->name('update');
                    Route::post('/delete', [DepartmentController::class, 'destroy'])->name('delete');
                });

                // advertisements
                Route::group([
                    'prefix' => '/advertisements',
                    'as' => 'advertisements.'
                ],  function () {
                    Route::get('/', [AdvertisementController::class, 'index'])->name('index');
                    Route::post('/store', [AdvertisementController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [AdvertisementController::class, 'edit'])->name('edit');
                    Route::post('/update', [AdvertisementController::class, 'update'])->name('update');
                    Route::post('/delete', [AdvertisementController::class, 'destroy'])->name('delete');
                });

                //تقييم التطبيق من قبل المستخدمين
                Route::group([
                    'prefix' => '/advertisementUsers',
                    'as' => 'advertisementUsers.'
                ],  function () {
                    Route::get('/', [AdvertisementUserController::class, 'index'])->name('index');
                });

                //اعدادات الموقع
                Route::group([
                    'prefix' => '/productdetialsInputs',
                    'as' => 'productdetialsInputs.'
                ],  function () {
                    Route::get('/', [ProductdetialsInputController::class, 'index'])->name('index');
                    Route::post('/', [ProductdetialsInputController::class, 'update'])->name('update');
                    Route::get('/', [ProductdetialsInputController::class, 'index'])->name('index');
                });

                //productdetails
                Route::group([
                    'prefix' => '/productdetails',
                    'as' => 'productdetails.'
                ],  function () {
                    Route::get('/', [ProductdetailsController::class, 'index'])->name('index');
                    Route::get('/edit/{id}', [ProductdetailsController::class, 'edit'])->name('edit');
                    Route::get('/show/{id}', [ProductdetailsController::class, 'show'])->name('show');
                    Route::post('/update', [ProductdetailsController::class, 'update'])->name('update');
                    Route::post('/delete', [ProductdetailsController::class, 'destroy'])->name('destroy');
                });
                //admin.colors.index
                Route::group([
                    'prefix' => '/colors',
                    'as' => 'colors.'
                ],  function () {
                    Route::get('/', [ColorsController::class, 'index'])->name('index');
                    Route::post('/store', [ColorsController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [ColorsController::class, 'edit'])->name('edit');
                    Route::post('/update', [ColorsController::class, 'update'])->name('update');
                    Route::post('/delete', [ColorsController::class, 'destroy'])->name('delete');
                });

                //payment
                Route::group([
                    'prefix' => '/payments',
                    'as' => 'payments.'
                ],  function () {
                    Route::get('/', [PaymentController::class, 'index'])->name('index');
                });
                // productuser
                Route::group([
                    'prefix' => '/productuser',
                    'as' => 'productuser.'
                ],  function () {
                    Route::get('/', [ProductUserController::class, 'index'])->name('index');
                });
                //reviewproducts
                Route::group([
                    'prefix' => '/reviewproducts',
                    'as' => 'reviewproducts.'
                ],  function () {
                    Route::get('/', [ReviewProductController::class, 'index'])->name('index');
                    Route::post('/', [ReviewProductController::class, 'destroy'])->name('delete');
                });
                //reviewsalers
                Route::group([
                    'prefix' => '/reviewsalers',
                    'as' => 'reviewsalers.'
                ],  function () {
                    Route::get('/', [ReviewSalersController::class, 'index'])->name('index');
                    Route::post('/', [ReviewSalersController::class, 'destroy'])->name('delete');
                });



                Route::group([
                    'prefix' => '/profile',
                    'as' => 'profile.'
                ], function () {
                    Route::get('/', [ProfileController::class, 'index'])->name('index');
                    Route::post('/', [ProfileController::class, 'update'])->name('update');
                });
                Route::group([
                    'prefix' => '/conversations',
                    'as' => 'conversations.'
                ], function () {
                    Route::get('/', [ConversationController::class, 'index'])->name('index');
                    Route::get('/store/{id}', [ConversationController::class, 'show'])->name('show');
                    Route::post('/store', [ConversationController::class, 'store'])->name('store');
                });
            }



        );
    }
);

require __DIR__ . '/auth.php';
