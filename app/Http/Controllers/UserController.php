<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();

        return view('users.index')
            ->with('roles', $roles);

        return ['hi'];
    }
}
