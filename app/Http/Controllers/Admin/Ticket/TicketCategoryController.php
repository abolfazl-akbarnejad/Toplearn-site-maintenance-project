<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketCategories = TicketCategory::orderBy('created_at', 'desc')->get();
        return view('admin.ticket.category.index', compact('ticketCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketCategoryRequest $request)
    {

        $result = TicketCategory::create($request->all());
        if ($result) {
            return redirect()->route('admin.ticket.category.index')->with('success', 'تیکت جدید با موفقیت اضافه شد');
        } else {
            return redirect()->route('admin.ticket.category.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
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
    public function edit(TicketCategory $ticketCategory)
    {
        return view('admin.ticket.category.edit', compact('ticketCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
        $result = $ticketCategory->update($request->all());
        if ($result) {
            return redirect()->route('admin.ticket.category.index')->with('success', 'تیکت  با موفقیت ویرایش شد');
        } else {
            return redirect()->route('admin.ticket.category.index')->with('error', 'خطا در ذخیره اطلاعات');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketCategory $ticketCategory)
    {

        if ($ticketCategory) {
            $ticketCategory->delete();
            return redirect()->route('admin.ticket.category.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }

    public function status(ticketCategory $ticketCategory)
    {

        $ticketCategory->status = $ticketCategory->status == 0 ? 1 : 0;
        $result = $ticketCategory->save();
        if ($result) {
            if ($ticketCategory->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
