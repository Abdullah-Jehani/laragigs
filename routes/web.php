<?php

use App\Http\Controllers\listingcontroller;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

// Single Listing by checking the id
route::get('/listings/{listing}', [listingcontroller::class , 'show'] );





























// Route::get('/posts/{id}' , function($id) {
//     return response('posts ' . $id) ; 
// })-> where('id' , '[0-9]+') ; 