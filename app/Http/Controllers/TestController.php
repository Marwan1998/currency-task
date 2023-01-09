<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class TestController extends Controller
{
    //
    public function index()
    {
        $user = User::find(1);
        $result = $user->getPermissionNames();

        return [
            'data' => $result,
        ];
    }
}
