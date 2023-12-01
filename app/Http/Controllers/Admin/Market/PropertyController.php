<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_attributes = CategoryAttribute::orderBy('created_at', 'desc')->get();

        return view('admin.market.property.index', compact('category_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories = ProductCategory::all();
        return view('admin.market.property.create', compact('product_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAttributeRequest $request)
    {

        $result  = CategoryAttribute::create($request->all());
        if ($result) {
            return redirect()->route('admin.market.property.index')->with('success', 'فرم  جدید با موفقیت ساخته شد');
        } else {
            return redirect()->route('admin.market.property.index')->with('error', 'خطا در ذخیره اطلاعات');
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
    public function edit(CategoryAttribute $category_attribute)
    {
        $product_categories = ProductCategory::all();

        return view('admin.market.property.edit', compact('category_attribute', 'product_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryAttributeRequest $request, CategoryAttribute $category_attribute)
    {
        $result  = $category_attribute->update($request->all());
        if ($result) {
            return redirect()->route('admin.market.property.index')->with('success', 'فرم  جدید با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.market.property.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $category_attribute)
    {
        if ($category_attribute) {
            $category_attribute->delete();
            return redirect()->route('admin.market.property.value.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
