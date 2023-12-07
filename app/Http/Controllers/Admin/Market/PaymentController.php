<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\CashPayment;
use App\Models\Market\OflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        $onlinePayment = OnlinePayment::all();
        $oflinePayment = OflinePayment::all();
        return view('admin.market.payment.index', compact('payments', 'onlinePayment', 'oflinePayment'));
    }

    public function show(Payment $payment)
    {
        if ($payment->paymentable_type == "App/Model/OnlinePayment") {
            $payment_value = OnlinePayment::where('id', $payment->paymentable_id)->first();
        } elseif ($payment->paymentable_type == "App/Model/OflinePayment") {
            $payment_value = OflinePayment::where('id', $payment->paymentable_id)->first();
        } else {
            $payment_value = CashPayment::where('id', $payment->paymentable_id)->first();
        }

        return view('admin.market.payment.show', compact('payment', 'payment_value'));
    }




    public function offline()
    {
        $payments = Payment::orderBy('created_at', 'desc')->where('paymentable_type', 'App/Model/OflinePayment')->get();
        $oflinePayment = OflinePayment::all();
        return view('admin.market.payment.index', compact('payments', 'oflinePayment'));
    }
    public function online()
    {
        $payments = Payment::orderBy('created_at', 'desc')->where('paymentable_type', 'App/Model/OnlinePayment')->get();
        $onlinePayment = OnlinePayment::all();
        return view('admin.market.payment.index', compact('payments', 'onlinePayment'));
    }
    public function attendance()
    {
        return view('admin.market.payment.index');
    }
    public function confirm()
    {
        return view('admin.market.payment.index');
    }
}
