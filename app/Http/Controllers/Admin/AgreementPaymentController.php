<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\AgreementPayment;
use Illuminate\Http\Request;

class AgreementPaymentController extends Controller
{

    public function add(Request $request, Agreement $agreement)
    {
        $agrPayment = new AgreementPayment();
        if ($request->isMethod('post')) {
            $agrPayment->fill($request->all());
            $agrPayment->save();
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
        } else {
            $agrPayment->agreement_id = $agreement->id;
            $agrPayment->payment_date = date('Y-m-d');;
            return view('Admin/agreement-payment-edit', [
                'payment' => $agrPayment,
                'agreement' => $agreement
            ]);
        }
    }

    public function edit(Request $request, Agreement $agreement, AgreementPayment $payment)
    {
        if ($request->isMethod('post')) {
            $payment->fill($request->all());
            $payment->save();
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
        } else {
            return  view('Admin/agreement-payment-edit', [
                'payment' => $payment,
                'agreement' => $agreement,
            ]);
        }
    }

    public function delete(Agreement $agreement, AgreementPayment $payment): \Illuminate\Http\RedirectResponse
    {
        $payment->delete();
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
    }
}
