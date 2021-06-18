<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;        
use Illuminate\Support\Facades\Mail;        // sending email

use App\Models\User;
use App\Http\Requests\ForgotEmailRequest;   // Request
use App\Http\Requests\SignUpRequest;        // Request
use App\Http\Requests\SignInRequest;        // Request
use App\Http\Requests\ProfileRequest;       // Request
use App\Http\Requests\SetNewPasswordRequest;// Request

use App\Mail\SendMail;                      // Sending email
use Carbon\Carbon;                          // Set date




class SignController extends Controller{

// ================================== show pages ================================================
    public function showSign(){   
        return view('sign');
    }

    public function showPassword(){   
        return view('sendPassword');
    }

    public function showForgotPassword(){   
        return view('forgotPassword');
    }


// ================================== sign up ================================================
    public function signUp(SignUpRequest $request){                
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
        if($user) {
            Auth::login($user); // put in session
            return redirect('dashboard');
        }
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
            $image_name = Carbon::now()->timestamp.".".$file->getClientOriginalExtension();
            $destinationPath = public_path('avatars');
            $file->move($destinationPath,$image_name);
            // $data['avatar'] = $image_name;
            
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
    


// ============================ send new password ==============================================
    public function sendPassword(ForgotEmailRequest $request){ 
      $newEmail = request('email');
      $user = User::where('email', $newEmail)->first();
      if($user){
            // create tocken for identidfy user
        $token = md5(rand(1000, 9999));
            // put token in db
        $user->remember_token = $token;
        $user->save(); // or like this -> $user->update(['remember_token' => $token]);

            // send to users email a link for spassword recover page
        Mail::to($newEmail)->send(new SendMail($user));    
      }
    
      return redirect('/');
    } 



    // ============================ scheckToken ==============================================
    public function checkToken($email, $token){
        $user = User::where('email', $email)->where('remember_token', $token)->first();
        if($user){
            return view('resetPassword');
        }
        return abort(403);

    }



    // ============================ scheck Token Again For Hackers And Mail ==============================================
    public function checkPass(SetNewPasswordRequest $request, $email, $token){ 
        $user = User::where('email', $email)->where('remember_token', $token)->first();
        if($user){
            // change password
            $newPass = Hash::make(request('passReset'));     
            $user->update(['password' => $newPass, 'remember_token' => null]); 
            return redirect('/')->with('resetMsg', "Password reseted succesfully");
        }
     
        return abort(403);
    }

}