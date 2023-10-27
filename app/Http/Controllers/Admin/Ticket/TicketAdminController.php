<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Models\User;
use App\Models\Ticket\TicketAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        return view('admin.ticket.admin.index', compact('admins'));
    }

    public function set(User $admin)
    {

        // dd(TicketAdmin::all());
        $ticketAdmin = TicketAdmin::where('user_id', $admin->id)->first() ? TicketAdmin::where('user_id', $admin->id)->delete() : TicketAdmin::create(['user_id' => $admin->id]);

        if ($ticketAdmin) {
            if ($admin->ticketAdmin == null) {
                return redirect()->route('admin.ticket.admin.index')->with('success', 'ادمین حذف شد');
            } else {
                  return redirect()->route('admin.ticket.admin.index')->with('success', 'ادمین جدید اضافه شد');
            }
        } else {
            return redirect()->route('admin.ticket.admin.index')->with('error', 'خطا در اضافه کردن ادمین جدید');
        }
    }
}
