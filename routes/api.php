<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {

        Route::post("problem", [App\Http\Controllers\Api\ProblemsControllers::class, 'sotre']);
        Route::post("app_evaluation", [App\Http\Controllers\Api\AppevaluationController::class, 'sotre']);


        // products
        Route::post('addProduct', [App\Http\Controllers\Api\ProductsController::class, 'addProduct']);
        Route::post('addProduct/details/{product_id}', [App\Http\Controllers\Api\ProductsController::class, 'addProductdetails']);

        Route::post("addProduct/advertisement/{product_id}", [App\Http\Controllers\Api\ProductsController::class, 'addadvertisement']);

        Route::post("product/user/{product_id}", [App\Http\Controllers\Api\ProductsController::class, 'product_user']);
        //payment
        Route::post("payment/{product_id}", [App\Http\Controllers\Api\PaymentController::class, 'store']);




        //conversations
        Route::post("conversations", [App\Http\Controllers\Api\ConversationController::class, 'store']);
        Route::post("chat/{conversation_id}", [App\Http\Controllers\Api\ConversationController::class, 'show']);
        Route::post("chat/store/{conversation_id}", [App\Http\Controllers\Api\ConversationController::class, 'store_chat']);



        //ratting
        Route::post("ratting/sallers/{prouduct_id}", [App\Http\Controllers\Api\RattingController::class, 'ratingSallar']);
        Route::post("ratting/product/{prouduct_id}", [App\Http\Controllers\Api\RattingController::class, 'ratingProudct']);

        // reset password
        Route::post('respassword', [App\Http\Controllers\Api\RegisterUserController::class, 'respassword']);

        //logout
        Route::post("logout", [App\Http\Controllers\Api\RegisterUserController::class, 'logout']);
    }
);
Route::get("product/{product_id}/{en}", [App\Http\Controllers\Api\ProductsController::class, 'show']);

Route::post('login', [App\Http\Controllers\Api\RegisterUserController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\RegisterUserController::class, 'register']);
Route::get("/getLogo", [App\Http\Controllers\Api\GeneralApi::class, 'getLogo']);
Route::get("/getOnslash/{lang}", [App\Http\Controllers\Api\OnlasheController::class, 'index']);
Route::get("/whous/{lang}", [App\Http\Controllers\Api\GeneralApi::class, 'whous']);
Route::get("/terms/{lang}", [App\Http\Controllers\Api\GeneralApi::class, 'terms']);
Route::get("/categories/{lang}", [App\Http\Controllers\Api\CategoriesController::class, 'index']);
Route::get("/categories/{parent_id}/{lang}", [App\Http\Controllers\Api\CategoriesController::class, 'child_categories']);

Route::get('/index/{lang}', [App\Http\Controllers\Api\GeneralApi::class, 'index']);
Route::get("colorsproducts", [App\Http\Controllers\Api\GeneralApi::class, 'getColors']);
Route::get("productsInput/{lang}", [App\Http\Controllers\Api\GeneralApi::class, 'productsInput']);
Route::get('advertisement', [App\Http\Controllers\Api\GeneralApi::class, 'advertisement']);
