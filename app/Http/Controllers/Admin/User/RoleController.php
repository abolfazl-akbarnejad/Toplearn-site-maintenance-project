<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\User\permission;
use App\Models\User\Role;
use Database\Seeders\Role\PermissionSeeder;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check exist value in the table permision
        $checkPermision = permission::first();
        if ($checkPermision  == null) {
            $defult = new PermissionSeeder;
            $defult->run();
        }
        $roles = Role::orderBy('created_at', 'desc')->get();


        return view('admin.user.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check exist value in the table permision
        $checkPermision = permission::first();
        if ($checkPermision  == null) {
            $defult = new PermissionSeeder;
            $defult->run();
        }


        $permisions = permission::all();
        return view('admin.user.role.create', compact('permisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $resultRole = Role::create($inputs);
        $inputs['permisions'] = $inputs['permisions'] ?? [];
        $resultPermision = $resultRole->permissions()->sync($inputs['permisions']);
        if ($resultRole && $resultPermision) {
            return redirect()->route('admin.user.role.index')->with('success', 'نقش جدید با موفقیت اضافه شد');
        } else {
            return redirect()->route('admin.user.role.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.user.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $result = $role->update($request->all());
        if ($result) {
            return redirect()->route('admin.user.role.index')->with('success', 'نقش  با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.user.role.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role) {
            $role->delete();
            return redirect()->route('admin.user.role.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }


    public function permissionForm(Role $role)
    {
        // $role->permision  = $role->permision->tan
        $permissions = permission::all();
        return view('admin.user.role.set_permission', compact('role', 'permissions'));
    }

    public function permissionUpdate(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $inputs['permisions'] = $inputs['permisions'] ?? [];
        $result  = $role->permissions()->sync($inputs['permisions']);
        if ($result) {
            return redirect()->route('admin.user.role.index')->with('success', 'سطح دسترسی با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.user.role.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }
}
