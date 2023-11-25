<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
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
                'phone_number' => $validateData['phone']
            ]);
        }

        return redirect('login');
    }
}
