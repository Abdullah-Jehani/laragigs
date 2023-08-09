<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\listingcontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// All Listings
Route::get('/', [listingcontroller::class , 'index']);
// create form 
route::get('/listings/create' , [listingcontroller::class , 'create'])->middleware('auth') ;
// store listing data
route::post('/listings' , [listingcontroller::class , 'store'])->middleware('auth') ;
// edit lists form
route::get('/listings/{listing}/edit' , [listingcontroller::class , 'edit'])->middleware('auth') ;
//  update Listings
route::put('/listings/{listing}' , [listingcontroller::class , 'update'])->middleware('auth') ; 
// delete listing
route::delete('/listings/{listing}' , [listingcontroller::class , 'destroy'])->middleware('auth');
// manage Listings
route::get('/listings/manage' , [listingcontroller::class , 'manage'])->middleware('auth') ; 
// this function is needed to be at the end //show Single Listing by checking the id
route::get('/listings/{listing}', [listingcontroller::class , 'show'] );
// show register/create form
route::get('/register' , [UserController::class , 'create'])->middleware('guest') ;
// create New User
route::post('/users' , [UserController::class , 'store']) ;
// log user Out
route::post('/logout' , [UserController::class , 'logout'])->middleware('auth') ; 
//show Login Form
route::get('/login' , [UserController::class , 'login'])->name('login')->middleware('guest') ;
// log in the User
route::post('/users/authenticate' , [UserController::class , 'authenticate']) ; 
 



























// Route::get('/posts/{id}' , function($id) {
//     return response('posts ' . $id) ; 
// })-> where('id' , '[0-9]+') ; 