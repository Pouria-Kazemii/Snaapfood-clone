<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validateData = $request->validated();

        $user = User::create([
            'name' => $validateData['name'],
            'phone_number' => $validateData['phone'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'role_id' => $validateData['role'],
            'last_activity_at' => now()
        ]);

        if ($user->role_id == 'restaurant'){
            Restaurant::create([
                'user_id' => $user->id,
                'name' => $validateData['name'],
                'phone_number' => $validateData['phone'],
                'banner_image_path' => 'home_background.jpg',
                'profile_image_path' => 'home_background.jpg'
            ]);
        }

        if($user->role_id == 'customer'){
            Customer::create([
                'user_id' => $user->id
            ]);
        }

        return redirect('login');
    }
}
