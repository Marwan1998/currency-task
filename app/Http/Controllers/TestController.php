<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Route;


class TestController extends Controller
{
    //
    public function index()
    {

        $webRoutes = $this->getRoutesPermissions();
        $apiRoutes = $this->getRoutesPermissions('api');

        // $this->createPermissions($webRoutes);


        
        $user = User::find(1);
        $result = $user->getPermissionNames();

        return [
            'data' => $result,
            'routes-web' => $webRoutes,
            'routes-api' => $apiRoutes,
            'permissions' => Permission::all(),
        ];
    }



    // protected functions
    protected function getRoutesPermissions($type = 'web')
    {
        if ($type != 'web' && $type != 'api') {
            return ['result' => 'wrong type'];
        }

        $routes = Route::getRoutes()->getRoutes();
        $myRoutes = [];

        foreach ($routes as $route) {
            if ($route->getName() != '' && $route->getAction()['middleware']['0'] == $type) {
                $permission = Permission::where('name', $route->getName())->first();
                if (is_null($permission)) {
                    array_push($myRoutes, ['name' => $route->getName(), 'guard_name' => $type]);
                }
            }
        }
        return $myRoutes;
    }

    protected function createPermissions(array $permissions)
    {
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

}
