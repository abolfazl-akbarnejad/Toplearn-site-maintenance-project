<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;
use App\Models\Market\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_methode  = Delivery::orderBy('id', 'desc')->get();

        return view('admin.market.delivery.index', compact('delivery_methode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        $result = Delivery::create($request->all());
        if ($result) {
            return redirect()->route('admin.market.delivery.index')->with('success', " روزش ارسال جدید با موفقیت انجام شد");
        } else {
            return redirect()->route('admin.market.delivery.index')->with('error', " ساخت روش ارسال جدید با خطا مواجه شد");
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
    public function edit(Delivery $delivery)
    {
        return view('admin.market.delivery.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {



        $result =  $delivery->update($request->all());

        if ($result) {
            return redirect()->route('admin.market.delivery.index')->with('success', " روش های ارسال شما با موفقیت ویرایش شد");
        } else {
            return redirect()->route('admin.market.delivery.index')->with('success', "ساخت  پیامک با خطا مواجه شد");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {

        if ($delivery) {
            $delivery->delete();
            return redirect()->route('admin.market.delivery.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
