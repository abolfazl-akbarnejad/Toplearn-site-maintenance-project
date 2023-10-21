<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus  = Menu::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus  = Menu::where('parent_id', null)->get();

        return view('admin.content.menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $inputs['parent_id']  = $request->parent_id == 0 ? null : $request->parent_id;
        $result = Menu::create($inputs);
        if ($result) {
            return redirect()->route('admin.content.menu.index')->with('success', 'منوی اضافه شد.');
        } else {
            return redirect()->route('admin.content.menu.create')->with('error', 'مشکلی در ایجاد اطلاعات.');
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
    public function edit(Menu $menu)
    {
        $parentMenus  = Menu::where('parent_id', null)->get();
        return view('admin.content.menu.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $inputs['parent_id']  = $request->parent_id == 0 ? null : $request->parent_id;
        $result = $menu->update($inputs);
        if ($result) {
            return redirect()->route('admin.content.menu.index')->with('success', 'منوی ویرایش شد.');
        } else {
            return redirect()->route('admin.content.menu.create')->with('error', 'مشکلی در ویرایش اطلاعات.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu) {
            $menu->delete();
            return redirect()->route('admin.content.menu.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
    public function status(Menu $menu)
    {

        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();
        if ($result) {
            if ($menu->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
