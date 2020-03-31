<?php

namespace App\Http\Controllers;

use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions_index()
    {
        $permissions = Permission::get();
        // dd($permissions);

        return view('permission_system.permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions_create()
    {
        $permission = Permission::create([
            'name' => 'Enable Profession'
        ]);

        return $permission->name;

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permissions_store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_destroy($id)
    {
        //
    }
    /**
     * Role Mangement
     *
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function role_index()
    {
        // $user = Auth::user();
        // $role = Role::findByName('Super Admin');
        // // dd($role);
        // $user->assignRole($role->name);
        $roles = Role::latest()->get();

        return view('permission_system.roles.index')->with('roles', $roles);
    }

    /**
     * Display permissions assigned to role
     *
     *
     */
    public function role_permissions($id)
    {
        $id = decrypt($id);
        $role = Role::find($id);
        $permissions = $role->getAllPermissions();
        $data = [
            'permissions' => $permissions,
            'role' => $role
        ];
        return view('permission_system.roles.permissions')->with('data', $data);
    }
    /**
     * Show form to Edit Assigned Permissions
     *
     */
    public function role_permissions_edit($id)
    {
        $id = decrypt($id);

        $role = Role::find($id);
        $all_permissions = Permission::get();
        $permissions = $role->getAllPermissions();
        $data = [
            'permissions' => $permissions,
            'all_permissions' => $all_permissions,
            'role' => $role
        ];
        return view('permission_system.roles.edit')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function role_create()
    {
        $roles = Role::get();
        // return $roles;
        $permissions = Permission::get();
        // dd($permissions);
        return view('permission_system.roles.create')->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function role_store(Request $request)
    {
        $this->store_role_validation($request);

        $roles = Role::get();
        $permissions = $request->input('permissions');
        $notSame = false;
        $sameRole = null;
        for ($i = 0; $i < count($roles); $i++) {
            $role_permissions[$i] = $roles[$i]->getAllPermissions()
                ->pluck('id')->toArray();
            for ($j = 0; $j < count($role_permissions[$i]); $j++) {
                if ($role_permissions[$i] == $permissions) {
                    $notSame = true;
                    $sameRole = $roles[$i];
                    break;
                }
            }
        }
        /**
         * Below condition will check if same set of permissions is
         * not assigned to any other role then It will be processed
         * further otherwise user have to choose different set of
         * permission
         *
         */
        if ($notSame && ($sameRole != null)) {
            alert()->warning('Role Already Exists', 'A role named as "' . $sameRole->name . '" with same permissions already exists try with another permissions set');
        } else {
            try {
                DB::beginTransaction();
                $role = Role::create([
                    'name' => $request->input('role')
                ]);

                $permissions = $request->input('permissions');
                // Assigning Array of Permissions to role
                $role->syncPermissions($permissions);

                DB::commit();
                alert()->success('Role Created', '"' . $request->input('role') . '" Role is Created with "' . count($permissions) . '" Permissions');
                return redirect(url('role/'));
            } catch (\Exception $e) {
                DB::rollback();
                alert()->error('Role Not Created', 'Something unexpected happend.Please try again');
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function role_show($id)
    {
        //
    }

    /**
     * Update Assigned Permissions
     *
     */
    public function role_permissions_update(Request $request, $id)
    {
        $this->update_role_validation($request);

        $role = Role::find($id);

        $roles = Role::get();
        $permissions = $request->input('permissions');
        $notSame = false;
        $sameRole = null;
        for ($i = 0; $i < count($roles); $i++) {
            $role_permissions[$i] = $roles[$i]->getAllPermissions()
                ->pluck('id')->toArray();
            for ($j = 0; $j < count($role_permissions[$i]); $j++) {
                if (($role_permissions[$i] == $permissions) && ($roles[$i]->id != $id)) {
                    $notSame = true;
                    $sameRole = $roles[$i];
                    break;
                }
            }
        }
        /**
         * Below condition will check if same set of permissions is
         * not assigned to any other role then It will be processed
         * further otherwise user have to choose different set of
         * permission
         *
         */
        if ($notSame && ($sameRole != null)) {
            alert()->warning('Role Already Exists', 'A role named as "' . $sameRole->name . '" with same permissions already exists try with another permissions set');
        } else {
            try {
                DB::beginTransaction();
                $permissions = $request->input('permissions');
                // Assigning Array of Permissions to role
                $role->syncPermissions($permissions);

                DB::commit();
                alert()->success('Role Updated', '"' . $request->input('role') . '" Role is Updated with "' . count($permissions) . '" Permissions');
                return redirect(url('role/'));
            } catch (\Exception $e) {
                DB::rollback();
                alert()->error('Role Not Updated', 'Something unexpected happend. Please try again');
            }
        }
        return redirect()->back();
    }

    /**
     * Delete permission from role
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function role_permission_delete($role_id, $permission_id)
    {
        try {
            DB::beginTransaction();
            $permission = Permission::findById($permission_id);
            $role = Role::findById($role_id);

            $role->revokePermissionTo($permission);

            DB::commit();

            alert()->success('Permission Removed', '"' . $permission->name . '" Permissions is successfully revoked from "' . $role->name . '" role sucessfully');
        } catch (\Exception $e) {
            DB::rollback();
            alert()->error("Permission didn't Removed", 'An unexpected error occured. Please try again');
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function role_update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function role_delete($id)
    {
        try {
            DB::beginTransaction();
            $role = Role::findById($id);
            $permission = $role->getAllPermissions();
            $users = User::get();
            if ($users) {
                for ($i = 0; $i < count($users); $i++) {
                    if ($users[$i]->hasRole($role->name)) {
                        $users[$i]->removeRole($role);
                    }
                }
            }
            $role->revokePermissionTo($permission);
            $role->delete();

            DB::commit();

            alert()->success('Role Deleted', '"' . $role->name . '" is removed from all users and all permission assigned to this role are successfully deleted"');
        } catch (\Exception $e) {
            DB::rollback();
            alert()->error("Role didn't Removed", 'An unexpected error occured. Please try again');
        }
        return redirect()->back();
    }

    /**
     * View Staff who have Roles assigned
     *
     */
    public function user_roles_index()
    {
        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->latest()->get();
        return view('permission_system.user.roles.index')->with('user', $users);
    }
    /**
     * View Staff who have Roles
     *
     */
    public function user_assigned_roles($id)
    {
        $id = decrypt($id);

        $user = User::find($id);
        // dd($staffs->roles);
        return view('permission_system.user.roles.user_roles')->with('user', $user);
    }
    /**
     * Show form to assign role to staff
     *
     */
    public function user_roles_create()
    {
        $role = Role::get();
        $user = Auth::user();
        $user = User::where('id', '!=', $user->id)->get();

        $data = [
            'roles' => $role,
            'user' => $user
        ];
        return view('permission_system.user.roles.create')->with('data', $data);
    }
    /**
     * Assign role to Staff
     *
     */
    public function user_roles_store(Request $request)
    {
        $this->assign_role_form($request);
        try {
            DB::beginTransaction();
            $role_id = (int) $request->input('role');
            $user_id = (int) $request->input('user');
            // dd(Auth::guard());
            $user = User::find($user_id);
            $role = Role::findById($role_id);

            if ($user->hasRole($role)) {
                alert()->warning('Can not Re-Assign Role', '"' . $user->name  . '" already have  role of "' . $role->name . '"');

                return redirect()->back();
            }

            $user->assignRole($role->name);

            alert()->success('Role Assigned', 'Role of "' . $role->name . '" is successfully assigned to "' . $user->name . '"');

            DB::commit();

            return redirect(url('user/roles'));
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            alert()->error("Role not Assigned", 'An unexpected error occured. Please try again');
        }
        return redirect()->back();
    }
    /**
     * Show staff data
     *
     * return response()->jsn()
     *
     */
    public function showStaffData($id)
    {
        $staff = User::find($id);
        $user = $staff->user()->first();

        $data = [
            'staff' => $staff,
            'user' => $user
        ];

        return response()->json($data);
    }
    /**
     * Remove Assigned role to Staff
     *
     */
    public function user_roles_delete($user_id, $role_id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($user_id);
            $role = Role::findById((int) $role_id);
            $user->removeRole($role->name);

            alert()->success('Role Revoked', '"' . $role->name . '" is successfully revoked from "' . $user->name . '"');

            DB::commit();

            return redirect(url('user/roles'));
        } catch (\Exception $e) {
            DB::rollback();
            alert()->error("Role didn't Revoked", 'An unexpected error occured. Please try again');
        }
        return redirect()->back();
    }

    /**
     * Form Validations
     *
     */
    public function store_role_validation($request)
    {
        $validation = $request->validate([
            'role' => 'required|unique:roles,name',
            'permissions' => ['required', Rule::notIn(['null'])]
        ]);
    }
    public function update_role_validation($request)
    {
        $validation = $request->validate([
            'role' => 'required',
            'permissions' => ['required', Rule::notIn(['null'])]
        ]);
    }
    public function assign_role_form($request)
    {
        $request->validate([
            'role' => ['required', Rule::notIn(['Select Role'])],
            'user' => ['required', Rule::notIn(['Select Portal User'])]
        ]);
    }
}
