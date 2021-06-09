<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\RealPayment;
use Illuminate\Http\Request;

class RealPaymentController extends Controller
{

    public function add(Request $request, Agreement $agreement)
    {
        $realPayment = new RealPayment();
        if ($request->isMethod('post')) {
            $realPayment->fill($request->all());
            $realPayment->save();
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
        } else {
            $realPayment->agreement_id = $agreement->id;
            $realPayment->payment_date = date('Y-m-d');;
            return view('Admin/real-payment-edit', [
                'payment' => $realPayment,
                'agreement' => $agreement
            ]);
        }
    }

    public function edit(Request $request, Agreement $agreement,RealPayment $payment)
    {
        if ($request->isMethod('post')) {
            $payment->fill($request->all());
            $payment->save();
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
        } else {
            return  view('Admin/real-payment-edit', [
                'payment' => $payment,
                'agreement' => $agreement,
            ]);
        }
    }

    public function delete(Agreement $agreement, RealPayment $payment): \Illuminate\Http\RedirectResponse
    {
        $payment->delete();
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
    }
}
