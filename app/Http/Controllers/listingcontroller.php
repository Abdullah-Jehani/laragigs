<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function create() {
        return view('listings.create') ;
    }
    public function store(request $request) { // request for validation 
        $formField = $request->validate([
        'title' => 'required' ,
        'company' => ['required', Rule::unique('listings', 'company')],
        'location' => 'required' ,
        'website' =>'required' , 
        'email' => ['required' , 'email'] , 
        'tags' => 'required' , 
        'description' => 'required'

        ]);
        listing::create($formField) ; 
        return redirect('/')->with('message' , 'Listing Created Successfully!') ;
    }
    
}
