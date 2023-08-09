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
            'listings' => listing::latest()->filter(request(['tag' , 'search']))->simplepaginate(6) // allows to us to devide the items on multible pages
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


       if ($request->hasFile('logo')) { // if the user has uploaded a logo
        $formField['logo'] = $request->file('logo')->store('logos' , 'public'); // store the logo in logos folder in public folder
       }

       $formField['user_id'] = auth()->id(); // this is the id of the user that created the listing
       
        listing::create($formField) ; 

        return redirect('/')->with('message' , 'Listing Created Successfully!') ;
    }

    public function edit(listing $listing) { // we are passing the id of the page we want to edit
        return view('listings.edit' , [
            'listing' => $listing // this is the id of the page we want to edit
        ]) ;
    }

 // update function 
    public function update(request $request , listing $listing) { // request for validation 
        // make sure that logged(actual User) is the owner
        if ($listing->user_id != auth()->id())  {
            abort('403' , 'Uauthorized Access');
        }
        $formField = $request->validate([
        'title' => 'required' ,
        'company' => 'required',
        'location' => 'required' ,
        'website' =>'required' , 
        'email' => ['required' , 'email'] , 
        'tags' => 'required' , 
        'description' => 'required'

        ]);
       if ($request->hasFile('logo')) {
        $formField['logo'] = $request->file('logo')->store('logos' , 'public');
       }
        $listing->update($formField) ; 

        return back()->with('message' , 'Listing updated Successfully!') ;
    }

    public function destroy (listing $listing) {
        if ($listing->user_id != auth()->id())  {
            abort('403' , 'Uauthorized Access');
        }
        $listing->delete() ;
        return redirect('/')->with('message' , 'Listing Deleted Successfully!') ;
    }
    // manage Listings Function 
    public function manage() {
        return view('listings.manage' , [
            "listings" => auth()->user()->listings()->get() // allows to us to devide the items on multible pages
        ]);
    }
}
