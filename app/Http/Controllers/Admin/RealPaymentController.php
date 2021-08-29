<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\RealPaymentsDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealPaymentRequest;
use App\Models\Agreement;
use App\Models\RealPayment;
use Illuminate\Http\Request;

class RealPaymentController extends Controller
{

    public function create(Request $request, Agreement $agreement)
    {
        $payment = RealPaymentsDataservice::create($request, $agreement);
        return view('Admin.real-payment-edit',['agreement' => $agreement, 'payment'=>$payment]);
    }

    public function store(RealPaymentRequest $request, Agreement $agreement)
    {
        RealPaymentsDataservice::store($request);
        return redirect()
            ->to(route('admin.agreementSummary',['agreement'=>$agreement, 'page'=>'payments']));
    }

    public function edit(Request $request, Agreement $agreement, RealPayment $payment)
    {
        RealPaymentsDataservice::edit($request, $payment);
        return view('Admin.real-payment-edit',
            ['agreement' => $agreement, 'payment' => $payment]);
    }

    public function update(RealPaymentRequest $request, Agreement $agreement, RealPayment $payment)
    {
        RealPaymentsDataservice::update($request, $payment);
        return redirect()->to(route('admin.agreementSummary',
            ['agreement'=>$agreement, 'page'=>'payments']));
    }

    public function delete(Agreement $agreement, RealPayment $payment): \Illuminate\Http\RedirectResponse
    {
        RealPaymentsDataservice::delete($payment);
        return redirect()->to(route('admin.agreementSummary',
            ['agreement'=>$agreement, 'page'=>'payments']));
    }

}
