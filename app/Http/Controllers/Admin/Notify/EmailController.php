<?php

namespace App\Http\Controllers\admin\notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Models\Notify\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails  = Email::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        dd($request);
        $inputs = $request->all();
        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);
        $result = Email::create($inputs);
        if ($result) {
            return redirect()->route('admin.notify.email.index')->with('success', " ایمیل شما با موفقیت ساخته شد");
        } else {
            return redirect()->route('admin.notify.email.index')->with('success', "ایمیل  پیامک با خطا مواجه شد");
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
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $inputs = $request->all();
        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);
        $result = $email->update($inputs);
        if ($email) {
            return redirect()->route('admin.notify.email.index')->with('success', "ایمیل شما با موفقیت ویرایش شد");
        } else {
            return redirect()->route('admin.notify.email.index')->with('success', " ایمیل پیامک با خطا مواجه شد ");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        if ($email) {
            $email->delete();
            return redirect()->route('admin.notify.email.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }


    public function status(Email $email)
    {

        $email->status = $email->status == 0 ? 1 : 0;
        $result = $email->save();
        if ($result) {
            if ($email->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
