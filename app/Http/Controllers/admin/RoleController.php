<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\each;

class RoleController extends Controller
{

    public $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function store(Request $request)
    {
        // return $request;
        //   return dd($this->role->find($request->rol_id)->permissions()->name);
        $this->role->find($request->role_id)->permissions()->sync($request->permission);
        return back();
    }

    public function permission_byRole(Request $data)
    {
        // $permissions = $this->role::find($data->id)->permissions()->pluck('permission_id');

        // return $permissions;
        $permissions = $this->role->find($data->id)->permissions()->pluck('permission_id');
        // dd($permissions);
        return $permissions;
    }
}
