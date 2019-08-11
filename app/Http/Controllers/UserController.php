<?php

namespace App\Http\Controllers;

use App\Mail\ActivateUser;
use App\User;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function activateUser(Request $request){
        $id = $request->user_id;
        $token = $request->token;

        $this->user = $this->user->where('id',$id)->where('activation_token',$token)->first();
        if(!$this->user){
            abort(404);
        }

        $this->user->status =  'active';
        $this->user->activation_token = null;
        $this->user->save();
        $request->session()->flash('success','Your account has been activated successfully. Please login to continue.');
        return redirect()->route('login');
     }

    public function registerUser(Request $request){
        $rules = array(
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:vendor,customer',
            'password' => 'required|confirmed|min:8'
        );
        $request->validate($rules);

        $data = $request->all();
        $data['status'] = 'inactive';
        $data['password'] = Hash::make($data['password']);
        $token = \Str::random(100);
        $data['activation_token'] = $token;

        $this->user->fill($data);
        $success = $this->user->save();
        if($success){
            // Mail to activate user
            Mail::to($request->email)->send(new ActivateUser($this->user));
            $request->session()->flash('success','Thank you for registering. Please check your email for further process.');
            return redirect()->route('login');
        }else {
            $request->session()->flash('error','Sorry! Your account could not be created at this moment. Please try again later.');
            return redirect()->route('signup');
        }
    }
}
