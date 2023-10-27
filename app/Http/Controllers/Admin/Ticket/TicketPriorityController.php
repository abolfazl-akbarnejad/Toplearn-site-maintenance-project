<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;
use App\Models\Ticket\TicketPriority;

class TicketPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketPriorities = TicketPriority::all();
        return view('admin.ticket.priority.index', compact('ticketPriorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketPriorityRequest $request)
    {
        $result = TicketPriority::create($request->all());
        if ($result) {
            return redirect()->route('admin.ticket.priority.index')->with('success', " الویت با موفقیت انجام شد");
        } else {
            return redirect()->route('admin.ticket.priority.index')->with('error', " آپلود الویت با خطا مواجه شد");
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
    public function edit(TicketPriority $ticketPriority)
    {
        return view('admin.ticket.priority.edit', compact('ticketPriority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketPriorityRequest $request, TicketPriority $ticketPriority)
    {
        $result = $ticketPriority->update($request->all());
        if ($result) {
            return redirect()->route('admin.ticket.priority.index')->with('success', " الویت با موفقیت ویرایش شد");
        } else {
            return redirect()->route('admin.ticket.priority.index')->with('error', " ویرایش الویت با خطا مواجه شد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPriority $ticketPriority)
    {
        $result = $ticketPriority->delete();
        if ($result) {
            return redirect()->route('admin.ticket.priority.index')->with('success', " الویت با موفقیت حذف شد");
        } else {
            return redirect()->route('admin.ticket.priority.index')->with('error', " حذف الویت با خطا مواجه شد");
        }
    }


    public function status(TicketPriority $ticketPriority)
    {

        $ticketPriority->status = $ticketPriority->status == 0 ? 1 : 0;
        $result = $ticketPriority->save();
        if ($result) {
            if ($ticketPriority->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
