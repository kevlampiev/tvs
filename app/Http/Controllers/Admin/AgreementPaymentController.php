<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\AgreementPaymentsDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementMassPaymentRequest;
use App\Http\Requests\AgreementPaymentRequest;
use App\Models\Agreement;
use App\Models\AgreementPayment;
use Illuminate\Http\Request;

class AgreementPaymentController extends Controller
{
    public function create(Request $request, Agreement $agreement)
    {
        $payment = AgreementPaymentsDataservice::create($request, $agreement);
        return view('Admin.agreement-payment-edit',['payment'=>$payment]);
    }

    public function store(AgreementPaymentRequest $request, Agreement $agreement)
    {
        AgreementPaymentsDataservice::store($request);
        return redirect()
            ->to(route('admin.agreementSummary',['agreement'=>$agreement, 'page'=>'payments']));
    }

    public function edit(Request $request, Agreement $agreement, AgreementPayment $payment)
    {
        AgreementPaymentsDataservice::edit($request, $payment);
        return view('Admin.agreement-payment-edit',
            ['payment' => $payment]);
    }

    public function update(AgreementPaymentRequest $request, Agreement $agreement, AgreementPayment $payment)
    {
        AgreementPaymentsDataservice::update($request, $payment);
        return redirect()->to(route('admin.agreementSummary',
            ['agreement'=>$agreement, 'page'=>'payments']));
    }

    public function delete(Agreement $agreement, AgreementPayment $payment): \Illuminate\Http\RedirectResponse
    {
        AgreementPaymentsDataservice::delete($payment);
        return redirect()->to(route('admin.agreementSummary',
                    ['agreement'=>$agreement, 'page'=>'payments']));
    }


    /**
     *Добавление периодических платежей. GET
     */
    public function createAddPayments(Request $request, Agreement $agreement)
    {
            return view('Admin/agreement-mass-payment', ['agreement' => $agreement]);
    }
    /**
     *Сохранение периодических платежей. POST
     */
    public function storeAddPayments(AgreementMassPaymentRequest $request, Agreement $agreement)
    {
            AgreementPaymentsDataservice::addManyPayments($request, $agreement);
            return redirect()
                ->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])
                ->with('message', 'Произведено массовое добавление платежей');
    }

    /**
     * Масовое удаленпие всех платежей по договорру
     */
    public function massDeletePayments(Request $request, Agreement $agreement)
    {
        AgreementPaymentsDataservice::massEraseAgreementPayments($request, $agreement);
        return redirect()
            ->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])
            ->with('message', 'Записи о платежах по договору удалены');
    }


    /**
     * Перенос планового платежа в фактический
     */
    public function toRealPayments(Agreement $agreement, AgreementPayment $payment)
    {
        AgreementPaymentsDataservice::toRealPayment($payment);
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])->with('message', 'Запись о реальном платеже добавлена');

    }

}
