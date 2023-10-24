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
    public function edit(User $user)
    {
        return view('admin.user.admin-user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $resultImage =   $imageService->save($request->file('profile_photo_path'));
            $imageService->deleteImage($user->profile_photo_path);
            $inputs['profile_photo_path'] = $resultImage;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;

        $result = $user->update($inputs);
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
    public function destroy(User $user)
    {

        if ($user) {
            $user->delete();
            return redirect()->route('admin.user.admin-user.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
