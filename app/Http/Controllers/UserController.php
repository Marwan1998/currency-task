<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Role;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    //

    private $inputValidationString = 'integer | required';


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
            'user_id' => $this->inputValidationString,
            'role_id' => $this->inputValidationString,
        ]);

        if ($validator->fails()) {
            Flash::error($validator->messages());
            return redirect(route('users.index'));
        }
        
        $user = User::find($input['user_id']);

        $result = $user->assignRole($input['role_id']); //it could be by role id or name.

        try {
            $assingedRoleName = $result->roles->first()->name;
        } catch (\Throwable $th) {
            $assingedRoleName = 'none';
        }

        Flash::success("role `$assingedRoleName` has been assigned to user `$user->name` successfully.");
        return redirect(route('users.index'));
    }

    public function removeRole(Request $request)
    {
        $input = $request->all();
        $validator = validator()->make($input, [
            'user_id' => $this->inputValidationString,
            'role_id' => $this->inputValidationString,
        ]);

        if ($validator->fails()) {
            Flash::error($validator->messages());
            return redirect(route('users.index'));
        }

        $user = User::find($input['user_id']);
        $user->removeRole($input['role_id']); //this method accepts role id or name.

        Flash::success("a role has been removed from user `$user->name` successfully.");
        return redirect(route('users.index'));
    }

}
