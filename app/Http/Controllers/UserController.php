<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register/create form
    public function create() {
        return view('users.register')  ; 
    }
    public function store( request $request) {
        $formField = $request->validate([
            'name' => ['required' , 'min:3' , 'max:255'] , 
            'email' => ['required' , 'email' , Rule::unique('users' , 'email')] , 
            'password' => 'required |confirmed|min:8'
        ]); 
        // Hash Password
        $formField['password'] = bcrypt($formField['password']) ;

        // create The User
        $user = User::create($formField) ;

        // Login in 
        auth()->login($user) ;
        return redirect('/')->with('message' , 'User Created and Logged In!') ;
    }
  
    // logout User
    public function logout(request $request) {
        auth()->logout();
        $request->session()->invalidate(); // this will actually delete the session
        $request->session()->regenerateToken(); // this will create a new session for the user 

        return redirect('/');


    }

    // show login form 
    public function login () {
        return view('users.login') ;
    }

    // Authenticate User
    public function authenticate(request $request) {
        $formField = $request->validate([
            'email' => ['required' , 'email'] , 
            'password' => 'required'
        ]); 
        if (auth()->attempt($formField)) {
            $request->session()->regenerate();
            return redirect('/')->with('message' , 'You Logged In!') ; 
        }

        return back()->withErrors([
            'email' => 'Your provided credentials could not be verified.'
        ])->onlyInput('email');
    }
}
