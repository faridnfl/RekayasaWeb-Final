<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Redis::get('users');

        if (!$users) {
            $users = User::all();
            Redis::set('users', $users->toJson());
        } else {
            $users = collect(json_decode($users, true));
        }

        return Inertia::render('User/TampilanUser', [
            'users' => $users,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'User/TambahUser',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'nomor' => $request->number,
            'password' => $request->password,
        ]);

        Redis::del('users');

        return redirect()->route('users.index');
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
    public function edit(User $user)
    {
        return Inertia::render('User/EditUser', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Perbarui data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'nomor' => $request->number,
            'password' => $request->password,
        ]);

        Redis::del('users');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        Redis::del('users');

        return redirect()->route('users.index');
    }
}
