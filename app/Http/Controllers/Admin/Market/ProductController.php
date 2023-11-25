<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::orderBy('created_at', 'desc')->get();
        $brands = Brand::orderBy('created_at', 'desc')->get();
        return view('admin.market.product.create', compact('productCategories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $resultImage =  $imageService->fitAndSave($request->file('image'), 60, 60);
            $inputs['image'] = $resultImage;
        }

        //** filde time published at */
        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);


        //** If one part is not made, the other part is not made either */
        DB::transaction(function () use ($request, $inputs) {
            $resultProduct =   Product::create($inputs);

            //** create meta value */
            $metas = array_combine($request->meta_key, $request->meta_value);
            foreach ($metas as $key => $value) {
                $meta = ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $resultProduct->id,
                ]);
            }
        });



        return redirect()->route('admin.market.product.index')->with('success', 'دسته بندی شما با موفقیت ثبت شد');
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
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::orderBy('created_at', 'desc')->get();
        $brands = Brand::orderBy('created_at', 'desc')->get();

        return view('admin.market.product.edit', compact('product', 'productCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $resultImage =  $imageService->fitAndSave($request->file('image'), 60, 60);
            $inputs['image'] = $resultImage;
        }

        //** filde time published at */
        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);


        //** If one part is not made, the other part is not made either */
        DB::transaction(function () use ($request, $inputs, $product) {

            $resultProduct =  $product->update($inputs);

            //** create meta value */
            $metas = array_combine($request->meta_key, $request->meta_value);
            // dd($metas == "");

            foreach ($metas as $key => $value) {
                if ($value != null) {
                    $meta = ProductMeta::create([
                        'meta_key' => $key,
                        'meta_value' => $value,
                        'product_id' => $product->id,
                    ]);
                }
            }
        });



        return redirect()->route('admin.market.product.index')->with('success', 'دسته بندی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product) {
            $product->delete();
            return redirect()->route('admin.market.product.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
