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
use App\Mail\SendMail;                      // sending email

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
    


// ============================ send new password ==============================================
    public function sendPassword(ForgotEmailRequest $request){ 
      $newEmail = request('email');
      $user = User::where('email', $newEmail)->first();
      if($user){
            // send to users email a link for spassword recover page
        Mail::to($newEmail)->send(new SendMail('tocken'));
            // create tocken for identidfy user
            
      }
    
      return redirect('/');
    } 

}
