<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;

class listingcontroller extends Controller
{
    // show all lists 
    public function index() {
        return view('listings.index' , [
            'listings' => listing::latest()->filter(request(['tag' , 'search']))->get()
        ]);
    }
    // show single listing 
    public function show(listing $listing) {
        return view('listings.show' , [
            'listing' => $listing 
            // we store the id in listing
        ]) ;
        // another method in note.txt
  
    }
    
}
