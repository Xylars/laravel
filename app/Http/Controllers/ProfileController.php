<?php

namespace App\Http\Controllers;

use Arr;
use Hash;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\UpdateProfileRequest;
use App\Http\Requests\user\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load('profile');
        $posts = Post::with(['category', 'tag'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(4);


        return view("main.profiles.view-profile", compact("user","posts"));
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if ($user->id == Auth::id()) {
            return $this->index();
        }
        $user->load("profile");
        $posts = Post::with(['category', 'tag'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(4);

        return view("main.profiles.view-profile", compact("user", "posts"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        return view("main.profiles.edit-profile", compact("user"));
    }

    public function changepw()
    {
        $user = auth()->user();
        return view("main.profiles.change-password", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->load("profile");
        $data = $request->validated();
        if ($request->boolean('remove_avatar')) {
            $data['avatar'] = 'assets/avatars/default.jpg';
        } elseif ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');

            $filename = $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('assets/avatars/'), $filename);
            $data['avatar'] = 'assets/avatars/' . $filename;

        }
        $user->update(Arr::only($data, ["name", "phone", "email"]));
        $user->profile->update(Arr::only($data, ["bio", "avatar"]));
        return redirect()->route('profile.self')->with('success', 'Updated profile successfully!');
    }
    public function updatepw(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->input("current_password"), $user->password)) {
            return redirect()->back()->with("error", "Invalid password!");
        }
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('profile.self')->with('success', 'Updated profile successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
