<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::orderBy('created_at', 'desc')->where('user_type', 1)->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $resultImage =   $imageService->save($request->file('profile_photo_path'));
            $inputs['profile_photo_path'] = $resultImage;
        }
        $inputs['password'] = Hash::make($request->password);
        // dd($inputs);
        $inputs['user_type'] = 1;

        $result = User::create($inputs);
        if ($result) {
            return redirect()->route('admin.user.admin-user.index')->with('success', 'ادمین جدید با موفقیت اضافه شد');
        } else {
            return redirect()->route('admin.user.admin-user.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $resultImage =   $imageService->save($request->file('profile_photo_path'));
            $imageService->deleteImage($admin->profile_photo_path);
            $inputs['profile_photo_path'] = $resultImage;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;

        $result = $admin->update($inputs);
        if ($result) {
            return redirect()->route('admin.user.admin-user.index')->with('success', 'ویرایش اطلاعات ادمین با موفقیت انجام شد');
        } else {
            return redirect()->route('admin.user.admin-user.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {

        if ($admin) {
            $admin->delete();
            return redirect()->route('admin.user.admin-user.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }

    public function status(User $admin)
    {

        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function activation(User $admin)
    {

        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->activation == 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }
}
