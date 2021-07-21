<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use App\DataServices\AgreementsRepo;
use Illuminate\Http\Request;

class AgreementPaymentController extends Controller
{

    public function add(Request $request, Agreement $agreement)
    {
        $agrPayment = new AgreementPayment();
        if ($request->isMethod('post')) {
            $this->validate($request, AgreementPayment::rules());
            $agrPayment->fill($request->all());
            $agrPayment->save();
            return redirect()->back()->with('message', 'Запись успешно добавлена');
        } else {
            if (!empty($request->old())) {
                $agrPayment->fill($request->old());
            } else {
                $agrPayment->agreement_id = $agreement->id;
                $agrPayment->payment_date = date('Y-m-d');;
            }
            return view('Admin/agreement-payment-edit', [
                'payment' => $agrPayment,
                'agreement' => $agreement
            ]);
        }
    }

    /**
     *Добавление периодических платежей
     */
    public function massAddPayments(Request $request, Agreement $agreement)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, AgreementPayment::massRules());
            AgreementsRepo::addManyPayments($request, $agreement);
            return redirect()
                ->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])
                ->with('message', 'Произведено массовое добавление платежей');
        } else {
            return view('Admin/agreement-mass-payment', ['agreement' => $agreement]);
        }

    }

    public function edit(Request $request, Agreement $agreement, AgreementPayment $payment)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, AgreementPayment::rules());
            $payment->fill($request->all());
            $payment->save();
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']);
        } else {
            return view('Admin/agreement-payment-edit', [
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

    public function toRealPayments(Agreement $agreement, AgreementPayment $payment)
    {
        $realPayment = new RealPayment();
        $realPayment->agreement_id = $payment->agreement_id;
        $realPayment->payment_date = $payment->payment_date;
        $realPayment->amount = $payment->amount;
        $realPayment->save();
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])->with('message', 'Запись о реальном платеже добавлена');

    }

    public function cancelPayments(Request $request, Agreement $agreement)
    {
        if ($request->isMethod('post')) {
            dd($request);
            return redirect()
                ->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])
                ->with('message', 'Записи о платежах помечены, как отмененные');
        } else {
            return view('Admin/agreement-payments-close', ['agreement' => $agreement]);
        }
    }

    public function massDeletePayments(Request $request, Agreement $agreement)
    {

//        AgreementPayment::where('agreement_id','=',$agreement->id)->delete();
        $agreement->payments()->delete();
        return redirect()
            ->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])
            ->with('message', 'Записи о платежах по договору удалены');
    }
}
