<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('user_type', 0)->get();
        return view('admin.user.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $resultImage =   $imageService->save($request->file('profile_photo_path'));
            $inputs['profile_photo_path'] = $resultImage;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;

        $result = User::create($inputs);
        if ($result) {
            return redirect()->route('admin.user.customer.index')->with('success', 'ادمین جدید با موفقیت اضافه شد');
        } else {
            return redirect()->route('admin.user.customer.index')->with('error', 'خطا در ذخیره اطلاعات');
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
        return view('admin.user.customer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, User $user, ImageService $imageService)
    {

        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $resultImage =   $imageService->save($request->file('profile_photo_path'));
            $imageService->deleteImage($user->profile_photo_path);
            $inputs['profile_photo_path'] = $resultImage;
        }

        $result = $user->update($inputs);
        if ($result) {
            return redirect()->route('admin.user.customer.index')->with('success', 'ویرایش اطلاعات ادمین با موفقیت انجام شد');
        } else {
            return redirect()->route('admin.user.customer.index')->with('error', 'خطا در ذخیره اطلاعات');
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
            return redirect()->route('admin.user.customer.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }

    public function status(User $user)
    {

        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function activation(User $user)
    {

        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->activation == 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }
}
