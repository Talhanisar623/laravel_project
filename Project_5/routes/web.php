<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


// user with login signin

Route::get("admin/logout",[AdminController::class,"logout"])
->name("auth.admin.logout");

Route::prefix("admin")->group(function(){




// Admin Login Signup



Route::get("/login",[AdminController::class,"adminLogin"])
->name("auth.admin.login");

Route::post("/login",[AdminController::class,"login"])
->name("auth.admin.login.post");


Route::get("/register",[AdminController::class,"adminRegister"])
->name("auth.admin.register");

Route::post("/register",[AdminController::class,"store"])
->name("auth.admin.register.post");


});



// Admin Dashboard
Route::prefix("admin")->middleware(["adminAuth"])->group(function(){

    // Admin Dashboard
    Route::get("/dashboard",[AdminController::class,"admindashboard"])
    ->name("admin.dashboard");

});




// user with login signin


Route::get("user/logout",[UserController::class,"logout"])
->name("auth.user.logout");


Route::prefix("user")->middleware(["checkUser"])->group(function(){




// User Login Signup

Route::get("/login",[UserController::class,"userLogin"])
->name("auth.user.login");

Route::post("/login",[UserController::class,"login"])
->name("auth.user.login.post");


Route::get("/register",[UserController::class,"userRegister"])
->name("auth.user.register");

Route::post("/register",[UserController::class,"store"])
->name("auth.user.register.post");


});

Route::prefix("user")->middleware(["auth"])->group(function(){


    // User Dashboard
    Route::get("/dashboard",[UserController::class,"userdashboard"])
    ->name("user.dashboard");


});




//customer


Route::prefix("customer")->group(function(){


    // customer Dashboard
    Route::get("/dashboard",[customerController::class,"customerdashboard"])
    ->name("customer.dashboard");

// Admin Insert
Route::post("/dashboard/submit",[customerController::class,"customerdashboard_submit"])
->name("customer.dashboard.submit");


// Admin Update
Route::get("/dashboard/update/{id}",[customerController::class,"customerdashboard_update"])
->name("customer.dashboard.update")->where("id","[0-9]+");

Route::post("/dashboard/update",[customerController::class,"customerdashboard_update_form"])
->name("customer.dashboard.update.form");



// Admin Delete
Route::get("/dashboard/delete/{abc}",[customerController::class,"customerdashboard_delete"])
->name("customer.dashboard.delete")->where("abc","[0-9]+");

Route::post("/dashboard/delete",[customerController::class,"customerdashboard_delete_form"])
->name("customer.dashboard.delete.form");

});