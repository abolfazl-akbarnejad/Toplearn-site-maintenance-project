<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Copan;
use App\Models\Market\Product;
use App\Models\User\User;

class DiscountController extends Controller
{
    public function copan()
    {
        $copans = Copan::orderBy('created_at', 'desc')->get();

        return view('admin.market.discount.copan.copan', compact('copans'));
    }
    public function copanCreate()
    {
        $users = User::all();
        return view('admin.market.discount.copan.copan-create', compact('users'));
    }

    public function copanStore(CopanRequest $request)
    {
        $inputs = $request->all();

        //time stamp start_date
        $realetimestampStart = intval(substr($request->start_date, 0, 10));
        $inputs['start_date'] = date('Y-m-d H:i:s', $realetimestampStart);


        //time stamp end_date
        $realetimestampEnd = intval(substr($request->end_date, 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', $realetimestampEnd);

        // dd($inputs);
        $result  = Copan::create($inputs);


        if ($result) {
            return redirect()->route('admin.market.discount.copan')->with('success', 'تخفیف با موفقیت ساخته شد');
        } else {
            return redirect()->route('admin.market.discount.copan')->with('error', 'مشکلی در ساخت مطلب به وجود آمد');
        }
    }


    public function copanEdit(Copan $copan)
    {
        $users = User::all();

        return view('admin.market.discount.copan.copan-edit', compact('copan', 'users'));
    }


    public function copanUpdate(Request $request, Copan $copan)
    {
        $inputs = $request->all();

        //time stamp start_date
        $realetimestampStart = intval(substr($request->start_date, 0, 10));
        $inputs['start_date'] = date('Y-m-d H:i:s', $realetimestampStart);


        //time stamp end_date
        $realetimestampEnd = intval(substr($request->end_date, 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', $realetimestampEnd);

        $result  = $copan->update($inputs);


        if ($result) {
            return redirect()->route('admin.market.discount.copan')->with('success', 'تخفیف با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.market.discount.copan')->with('error', 'مشکلی در ساخت مطلب به وجود آمد');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function copanDestroy(Copan $copan)
    {
        if ($copan) {
            $copan->delete();
            return redirect()->route('admin.market.discount.copan')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }









    public function commonDiscount()
    {
        $commons =  CommonDiscount::orderBy('created_at', 'desc')->get();
        return view('admin.market.discount.common.common', compact('commons'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common.common-create');
    }


    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();

        //time stamp start_date
        $realetimestampStart = intval(substr($request->start_date, 0, 10));
        $inputs['start_date'] = date('Y-m-d H:i:s', $realetimestampStart);


        //time stamp end_date
        $realetimestampEnd = intval(substr($request->end_date, 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', $realetimestampEnd);
        $result  = CommonDiscount::create($inputs);


        if ($result) {
            return redirect()->route('admin.market.discount.commonDiscount')->with('success', 'تخفیف با موفقیت ساخته شد');
        } else {
            return redirect()->route('admin.market.discount.commonDiscount')->with('error', 'مشکلی در ساخت مطلب به وجود آمد');
        }
    }


    public function commonDiscountEdit(CommonDiscount $discount)
    {
        return view('admin.market.discount.common.common-edit', compact('discount'));
    }


    public function commonDiscountUpdate(Request $request, CommonDiscount $discount)
    {
        $inputs = $request->all();

        //time stamp start_date
        $realetimestampStart = intval(substr($request->start_date, 0, 10));
        $inputs['start_date'] = date('Y-m-d H:i:s', $realetimestampStart);


        //time stamp end_date
        $realetimestampEnd = intval(substr($request->end_date, 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', $realetimestampEnd);
        $result  = $discount->update($inputs);


        if ($result) {
            return redirect()->route('admin.market.discount.commonDiscount')->with('success', 'تخفیف با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.market.discount.commonDiscount')->with('error', 'مشکلی در ساخت مطلب به وجود آمد');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountDestroy(CommonDiscount $discount)
    {
        if ($discount) {
            $discount->delete();
            return redirect()->route('admin.market.discount.commonDiscount')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }







    public function amazingSale()
    {
        $amazings =  AmazingSale::orderBy('created_at', 'desc')->get();

        return view('admin.market.discount.amazing.amazing', compact('amazings'));
    }



    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing.amazing-create', compact('products'));
    }


    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();

        //time stamp start_date
        $realetimestampStart = intval(substr($request->start_date, 0, 10));
        $inputs['start_date'] = date('Y-m-d H:i:s', $realetimestampStart);


        //time stamp end_date
        $realetimestampEnd = intval(substr($request->end_date, 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', $realetimestampEnd);
        $result  = AmazingSale::create($inputs);


        if ($result) {
            return redirect()->route('admin.market.discount.amazingSale')->with('success', 'تخفیف با موفقیت ساخته شد');
        } else {
            return redirect()->route('admin.market.discount.amazingSale')->with('error', 'مشکلی در ساخت مطلب به وجود آمد');
        }
    }


    public function amazingSaleEdit(AmazingSale $amazing)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing.amazing-edit', compact('products', 'amazing'));
    }




    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazing)
    {
        $inputs = $request->all();

        //time stamp start_date
        $realetimestampStart = intval(substr($request->start_date, 0, 10));
        $inputs['start_date'] = date('Y-m-d H:i:s', $realetimestampStart);


        //time stamp end_date
        $realetimestampEnd = intval(substr($request->end_date, 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', $realetimestampEnd);
        $result  = $amazing->update($inputs);


        if ($result) {
            return redirect()->route('admin.market.discount.amazingSale')->with('success', 'تخفیف با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.market.discount.amazingSale')->with('error', 'مشکلی در ساخت مطلب به وجود آمد');
        }
    }


    public function amazingSaleDestroy(AmazingSale $amazing)
    {
        if ($amazing) {
            $amazing->delete();
            return redirect()->route('admin.market.discount.amazingSale')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
