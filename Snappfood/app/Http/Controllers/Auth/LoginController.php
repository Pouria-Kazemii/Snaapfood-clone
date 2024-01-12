<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email' , $request->input('email'))->first();
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)){
            return view('auth.login')->withErrors(['error' => 'invalid username or password']);
        } else{
            Auth::login($user);
            $user->recordActivity();

            if($user->role_id == 'customer'){
                return redirect()->route('customer');
            }

            if($user->role_id == 'admin'){
                return redirect()->route('admin.home');
            }

            if ($user->role_id == 'restaurant'){
                $restaurantName = $user->restaurant->name;
                return redirect()->intended("/restaurant/$restaurantName");
            }
        }
    }

}
