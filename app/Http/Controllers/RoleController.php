<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends AppBaseController
{
    /** @var RoleRepository $roleRepository*/
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->all()->where('name', '!=', 'Master');

        return view('roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all(['name', 'guard_name', 'id']);

        return view('roles.create')->with('permissions', $permissions);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $selectedPermissionsIds = $this->getIDsFromInput($input);

        if (count($selectedPermissionsIds) == 0) {
            Flash::error('at least one permission should be added.');
            return redirect(route('roles.create'));
        }

        $permissions = Permission::findMany($selectedPermissionsIds);
        
        $role = Role::create([
            'name' => $input['name'],
            'guard_name' => $input['guard']
        ]);

        $role->syncPermissions($permissions);

        Flash::success('Role saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $rolePermissions = Role::find($id)->permissions->pluck('name');

        return view('roles.show')
        ->with('role', $role)
        ->with('permissions', $rolePermissions);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $permissions = Permission::all(['name', 'guard_name', 'id']);

        return view('roles.edit')
        ->with('role', $role)
        ->with('permissions', $permissions);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('roles.index'));
        }

        $input = $request->all();

        $selectedPermissionsIds = $this->getIDsFromInput($input);

        if (!count($selectedPermissionsIds) == 0) {
            $addPermissoins = Permission::findMany($selectedPermissionsIds)->pluck('name');
            // delete all previous permissions and add the new ones in one method.
            $role->syncPermissions($addPermissoins);
        }

        $role->name = $input['name'];
        $role->guard_name = $input['guard'];
        $role->save();

        Flash::success('Role updated successfully.');
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('roles.index'));
        }

        // $role->delete();

        // $this->roleRepository->delete($id);

        return [
            'message' => 'Delete Role is not supported yet.',
            // 'role' => $role,
        ];

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }


    //protected methods.
    protected function getIDsFromInput($input)
    {
        $ids = [];
        foreach ($input as $key => $value) {
            if (str_starts_with($key, 'permission')) {
                array_push($ids, $value);
            }
        }
        return $ids;
    }

}
