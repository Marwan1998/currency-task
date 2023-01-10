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

        $validator = validator()->make($input, [
            'user_id' => 'integer | required',
            'role_id' => 'integer | required',
        ]);

        if ($validator->fails()) {
            Flash::error($validator->messages());
            return redirect(route('users.index'));
        }
        
        $user = User::find($input['user_id']);
        $role = Role::find($input['role_id']);

        // TODO: assign the role to the user.
        

        return [
            'user' => $user,
            'role' => $role,
        ];


        Flash::success("role `$role->name` assigned to user `$user->name` successfully.");
        return redirect(route('users.index'));
    }

}
