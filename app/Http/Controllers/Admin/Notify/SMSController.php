<?php

namespace App\Http\Controllers\admin\notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smses  = SMS::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.sms.index', compact('smses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SMSRequest $request)
    {
        $inputs = $request->all();
        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);
        $result = SMS::create($inputs);
        if ($result) {
            return redirect()->route('admin.notify.sms.index')->with('success', " پیامک شما با موفقیت ساخته شد");
        } else {
            return redirect()->route('admin.notify.sms.index')->with('success', "ساخت  پیامک با خطا مواجه شد");
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sms)
    {

        return view('admin.notify.sms.edit', compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();
        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);
        $result = $sms->update($inputs);
        if ($sms) {
            return redirect()->route('admin.notify.sms.index')->with('success', "پیامگ شما با موفقیت ویرایش شد");
        } else {
            return redirect()->route('admin.notify.sms.index')->with('success', " ویرایش پیامک با خطا مواجه شد ");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sms)
    {
        if ($sms) {
            $sms->delete();
            return redirect()->route('admin.notify.sms.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
    public function status(SMS $sms)
    {

        $sms->status = $sms->status == 0 ? 1 : 0;
        $result = $sms->save();
        if ($result) {
            if ($sms->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
