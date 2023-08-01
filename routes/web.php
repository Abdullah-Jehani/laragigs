<?php

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
Route::get('/', function () {
    return view('listings' , [
        'heading' => 'latest listings' , 
        'listings' => Listing::all()
    
    ]);
});
// Single Listing by checking the id

route::get('/listings/{listing}' , function(Listing $listing) {
          return view('listing' , [
        'listing' => $listing 
    ]) ;
});

// or

// route::get('/listings/{id}' , function($id) {
    // $listing = Listing::find($id);
    // if ($listing) {
        //     return view('listing' , [
//   'listing' => $listing 
// ]) ;
    // }
    // else {
    //     abort('404');
    // }

// });


























// Route::get('/posts/{id}' , function($id) {
//     return response('posts ' . $id) ; 
// })-> where('id' , '[0-9]+') ; 