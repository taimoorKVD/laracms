<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckUserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index')->withUsers(User::orderBy('created_at','DESC')->paginate(7));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit()
    {
        return view('user.edit')->withUser(auth()->user());
    }

    public function update(CheckUserRequest $cur, User $user)
    {
        $user->name = request()->name;
        $user->about = request()->about;
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('message', 'Profile updated successfully.');
    }

    public function destroy($id)
    {
        //
    }

    public function makeAdmin(User $user)
    {
        $user->role = "admin";
        $user->save();

        return redirect()
            ->back()
            ->with('message', $user->name.' made admin successfully.');
    }
}
