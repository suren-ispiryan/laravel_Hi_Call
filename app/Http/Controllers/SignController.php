<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;

class SignController extends Controller{

// ================================== sign up ================================================
    public function signUp(SignUpRequest $request){                
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
        Auth::login($user); // put in session
        
        if($user) return redirect('dashboard');
        return abort(403);
    }

    
// ================================= sign in ==================================================
    public function signIn(SignInRequest $request){
        $email = request('email');
        $password = request('password');

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }   
        return abort(403);        
    }


// ================================= log out =================================================
    public function logout(){
        Auth::logout();
        return redirect('/'); 
    }  
    

// ============================ change user info ==============================================
    public function change(){
        $userName = request('name');
        $userPass = Hash::make(request('password'));
        
        if($userName){
            Auth::User()->update(['name' => $userName]);
            if($userPass){
                Auth::User()->update(['password' => $userPass]);
            }
            return redirect('dashboard');
        }
        else{
            return back() -> with('msg', 'Name can not be empty');
        }
         
    }  

}
