<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('author', $user->id)->get()->count();
        return view("user.profile", compact("user", "posts"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'picture' => 'nullable|image|max:2048',
            'password' => 'nullable|string|min:8',
            'pwConfirm' => 'nullable|string|same:password',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password') && $request->filled('pwConfirm')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('picture')) {
            if ($user->picture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->picture);
            }
            $path = $request->file('picture')->store('headers', 'public');
            $user->picture = $path;
        }

        $user->save();
        return redirect()->route("profile.index")->with("success", "Profile updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
