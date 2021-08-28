<?php


namespace App\DataServices\Admin;

use App\Http\Requests\AgreementMassPaymentRequest;
use App\Http\Requests\AgreementPaymentRequest;
use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class AgreementPaymentsDataservice
{
    /**
     *Создание нового элемента
     */
    public static function create(Request $request, Agreement $agreement):AgreementPayment
    {
        $payment = new AgreementPayment();
        if (!empty($request->old())) $payment->fill($request->old());
        else $payment->agreement_id = $agreement->id;
        return $payment;
    }

    public static function edit(Request $request, AgreementPayment $payment)
    {
        if (!empty($request->old())) $payment->fill($request->old());
    }

    public static function saveChanges(AgreementPaymentRequest $request, AgreementPayment $payment)
    {
        $payment->fill($request->all());
        if (!$payment->user_id) $payment->user_id = Auth::user()->id;
        if ($payment->id) $payment->updated_at = now();
        else $payment->created_at = now();
        $payment->save();
    }

    public static function store(AgreementPaymentRequest $request)
    {
        try {
            $payment = new AgreementPayment();
//            $payment->agreement_id = $agreement->id; ????? Потенциально сбойный элемент. Приенадлежность к договору может поменяться
            self::saveChanges($request, $payment);
            session()->flash('message', 'Добавлен новый платеж');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новый платеж');
        }
    }

    public static function update(AgreementPaymentRequest $request, AgreementPayment $payment)
    {
        try {
            self::saveChanges($request, $payment);
            session()->flash('message', 'Данные платежа обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные платежа');
        }
    }

    public static function delete(AgreementPayment $payment)
    {
        try {
            $payment->delete();
            session()->flash('message', 'Платеж удален');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить платеж');
        }
    }

    public static function toRealPayment(AgreementPayment $payment)
    {
       try {
           $realPayment = new RealPayment();
           $realPayment->agreement_id = $payment->agreement_id;
           $realPayment->payment_date = $payment->payment_date;
           $realPayment->amount = $payment->amount;
           $realPayment->user_id = Auth::user()->id;
           $realPayment->created_at = now();
           $realPayment->save();
           session()->flash('message', 'Платеж перенесен в список реальных платежей');
       } catch (Error $err) {
           session()->flash('error', 'Не удалось перенести платеж в список реальных платежей');
       }

    }

    /**
     * Добавление ежемесячных повторяющихся платежей
     */
    public static function addManyPayments(AgreementMassPaymentRequest $request, Agreement $agreement)
    {
        try {
            $repeatCount = $request->post('repeat_count');
            $dateStart = $request->post('date_start');
            $payments = [];
            for ($i = 0; $i < $repeatCount; $i++) {
                $payments[] = [
                    'agreement_id' => $agreement->id,
                    'payment_date' => Carbon::create($dateStart)->addMonths($i),
                    'amount' => $request->post('amount'),
                    'currency' => $request->post('currency')
                ];
            }
            AgreementPayment::insert($payments);
            session()->flash('message', "Добавлено периодических $repeatCount платежей по договору");
        } catch(Err $err) {
            session()->flash('error', 'Не удалось добавить периодические платежи по договору');
        }
    }

    public static function massEraseAgreementPayments(Request $request, Agreement $agreement)
    {
        try {
            $agreement->payments()->delete();
            session()->flash('message', 'Платежи по договору удалены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось очистить таблицу платежей по договору');
        }
    }


}
