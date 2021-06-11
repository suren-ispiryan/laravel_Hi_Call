<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\ProfileRequest;
use Carbon\Carbon;

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
    public function change(ProfileRequest $request){ 
        $userName = request('name');
        $userPass = Hash::make(request('password'));
        $file = request('avatar');
        
        Auth::User()->update(['name' => $userName]);
        if($userPass){
            Auth::User()->update(['password' => $userPass]);
        }
        if($file){
            // add image to laravel
            $image_name = Carbon::now()->timestamp.$file->getClientOriginalExtension();
            $destinationPath = public_path('avatars');
            $file->move($destinationPath,$image_name);
            $data['avatar'] = $image_name;
            
            // add image name to db 
            $avatar_check = Auth::User()->avatar;
            Auth::User()->update(['avatar' => $image_name]);
            
            // delete old photo from laravel
            if($avatar_check){
                $file_path = public_path().'/avatars/'.$avatar_check;
                unlink($file_path);
            }
        }
 
        return back();      
    }  

}
