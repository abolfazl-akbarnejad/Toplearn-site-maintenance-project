<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductGallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . 'gallery');
            $resultImage =  $imageService->fitAndSave($request->file('image'), 220, 350);
            $inputs['image'] = $resultImage;
        }

        $inputs['product_id'] = $product->id;
        $result = ProductGallery::create($inputs);
        if ($result) {
            return redirect()->route('admin.market.product.gallery.index', $product->id)->with('succses', 'عکس شما با موفیت ذخیره شد');
        } else {
            return redirect()->route('admin.market.product.gallery.index', $product->id)->with('error', 'خطا در ذخیره اطلاعات');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductGallery $gallery)
    {
        if ($gallery) {
            $gallery->delete();
            return redirect()->route('admin.market.product.gallery.index', $product->id)->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
