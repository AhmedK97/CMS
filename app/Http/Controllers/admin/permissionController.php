<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class permissionController extends Controller
{
    public $permission;
    public function __construct(Permission $permission)
    {
        $this->permission  = $permission;
    }


    public function index()
    {
        // dd(Permission::get());
        $permissions = $this->permission->all();
        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        return $request;
    }
}
