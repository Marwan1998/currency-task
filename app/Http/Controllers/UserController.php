<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
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

        $validator = validator([
            $input['user'] => 'required',
            $input['role'] => 'required',
        ]);

        if ($validator->fails()) {
            Flash::error($validator->errors());
            return redirect(route('usres.index'));
        }


        // TODO: find the user with find($id), find role with find($id), then assign the role to the user.

        return $input;
    }

}
