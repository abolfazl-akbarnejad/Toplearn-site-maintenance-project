<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.market.store.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToStore(Product $product)
    {
        return view('admin.market.store.add-to-store', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Product $product)
    {
        $inputs = $request->all();

        //** The previous value in the database is taken and added to the entered value */
        $inputs['marketable_number']  = $product->marketable_number + $inputs['marketable_number'];


        $info =  [
            'product_id' => $product->id,
            'product_name' =>  $product->name,
            'transferee' =>  $inputs['transferee'],
            'delivery' =>  $inputs['delivery'],
            'description' =>  $inputs['description'],
            'date' => date('Y-m-d H:i:s')
        ];
        // $info =  'product_id =>' . $product->id . '/' . 'product_name =>' . $product->name . '/' . 'transferee =>'  . $inputs['transferee']  . '/' . 'delivery =>'  . $inputs['delivery']  . '/' . 'description =>' . $inputs['description'] . '/' . 'date=>' . date('Y-m-d H:i:s');

        $logPath = storage_path('logs/laravel.log');
        Log::info('info store', $info, ['path' => $logPath]);


        // dd($info);


        $result = $product->update(['marketable_number' => $inputs['marketable_number']]);
        if ($result) {
            return redirect()->route('admin.market.store.index')->with('success', '  موجودی محصول افزایش یافت');
        } else {
            return redirect()->route('admin.market.store.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.market.store.edit-to-store', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Product $product)
    {
        $result = $product->update($request->all());
        if ($result) {
            return redirect()->route('admin.market.store.index')->with('success', '  موجودی محصول   ویرایش یافت');
        } else {
            return redirect()->route('admin.market.store.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
