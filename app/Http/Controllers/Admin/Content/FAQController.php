<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FAQRequest;
use App\Models\Content\FAQ;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {
        $faq = FAQ::create($request->all());
        if ($faq) {
            return redirect()->route('admin.content.faq.index')->with('success', 'سوال  شما با موفقیت ثبت شد');
        } else {
            return redirect()->route('admin.content.faq.index')->with('error', '  مشکلی در ثبت سوال به وجود آمد');
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
    public function edit(FAQ $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        $result = $faq->update($request->all());
        if ($result) {
            return redirect()->route('admin.content.faq.index')->with('success', 'سوال  شما با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.content.faq.index')->with('error', '  مشکلی در ویرایش سوال به وجود آمد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $faq)
    {
        $result = $faq->delete();
        if ($result) {
            return redirect()->route('admin.content.faq.index')->with('success', 'سوال با موفقیت حذف شد');
        } else {
            return redirect()->route('admin.content.faq.index')->with('error', ' مشکلی در حذف سوال به وجود آمد');
        }
    }
    public function status(FAQ $faq)
    {

        $faq->status = $faq->status == 0 ? 1 : 0;
        $result = $faq->save();
        if ($result) {
            if ($faq->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
