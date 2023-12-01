<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryAttributeValue;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class CategoryAttriputeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttribute $category_attribute)
    {
        return view('admin.market.property.value.index', compact('category_attribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryAttribute $category_attribute)
    {
        $products = Product::where('category_id', $category_attribute->category_id)->get();
        return view('admin.market.property.value.create', compact('category_attribute', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryAttributeValueRequest $request, CategoryAttribute $category_attribute)
    {
        $inputs = $request->all();
        $inputs['category_attribute_id'] = $category_attribute->id;
        $inputs['value'] = json_encode(['value' => $inputs['value'], 'price' => $inputs['price_increase']]);
        CategoryAttributeValue::create($inputs);
        return redirect()->route('admin.market.property.value.index', $category_attribute->id)->with('success', 'مقدار فرم کالا  شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryAttribute $category_attribute, CategoryAttributeValue $value)
    {
        $products = Product::where('category_id', $category_attribute->category_id)->get();
        return view('admin.market.property.value.edit', compact('category_attribute', 'products', 'value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryAttributeValueRequest $request, CategoryAttribute $category_attribute, CategoryAttributeValue $value)
    {
        $inputs = $request->all();
        $inputs['category_attribute_id'] = $category_attribute->id;
        $inputs['value'] = json_encode(['value' => $inputs['value'], 'price' => $inputs['price_increase']]);
        $result = $value->update($inputs);
        return redirect()->route('admin.market.property.value.index', $category_attribute->id)->with('success', 'مقدار فرم کالا  شما با موفقیت ثبت شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $category_attribute, CategoryAttributeValue $value)
    {
        if ($value) {
            $value->delete();
            return redirect()->route('admin.market.property.value.index', $value->id)->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
