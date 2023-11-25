<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductColorRequest;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.color.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.color.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductColorRequest $request, Product $product)
    {
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        $result  = ProductColor::create($inputs);
        if ($result) {
            return redirect()->route('admin.market.product.color.index', $product->id)->with('success', 'رنگ جدید با موفقیت ساخته شد');
        } else {
            return redirect()->route('admin.market.product.color.index', $product->id)->with('error', 'خطا در ذخیره اطلاعات');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductColor $color)
    {
        if ($color) {
            $result =  $color->delete();
            if ($result) {
                return redirect()->route('admin.market.product.color.index', $product->id)->with('success', 'دیتا شما با موفقیت حذف شد');
            } else {
                return redirect()->route('admin.market.product.color.index', $product->id)->with('success', 'خطا در حذف اطلاعات');
            }
        } else {
            return abort(404);
        }
    }
}
