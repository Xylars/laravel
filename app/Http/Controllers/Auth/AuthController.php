<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\StoreUserDataRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate( [
            "email"=> "required|email",
            "password"=> "required|string|min:6"
        ]);

        if (Auth::attempt($data)) {
            session()->regenerate();
            return redirect()->route("posts.index");
        }
        else {
            return redirect()->back()->with("login","Invalid credentials!");
        }
    }

    public function register(StoreUserDataRequest $request)
    {
        $data = $request->validated();
        $profile = Profile::create();
        $user = User::create(array_merge($data, [
            'profile_id' => $profile->id
        ]));
        Auth::login($user);
        return redirect()->route("posts.index");
    }
    public function logout(Request $request)
    {
        Auth::logout();
        session()->invalidate();
        return redirect()->route("login");
    }
}
