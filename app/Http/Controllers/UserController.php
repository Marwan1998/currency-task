<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all()->pluck('name', 'id');
        $users = User::all()->pluck('email', 'id');

        return view('users.index')
            ->with('users', $users)
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        

        return $input;
    }

}
