<?php


namespace App\DataServices\Admin;

use App\Http\Requests\AgreementMassPaymentRequest;
use App\Http\Requests\AgreementPaymentRequest;
use App\Http\Requests\RealPaymentRequest;
use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class RealPaymentsDataservice
{
    /**
     *Создание нового элемента
     */
    public static function create(Request $request, Agreement $agreement):RealPayment
    {
        $payment = new RealPayment();
        if (!empty($request->old())) $payment->fill($request->old());
        else $payment->agreement_id = $agreement->id;
        return $payment;
    }

    public static function edit(Request $request, RealPayment $payment)
    {
        if (!empty($request->old())) $payment->fill($request->old());
    }

    public static function saveChanges(RealPaymentRequest $request, RealPayment $payment)
    {
        $payment->fill($request->all());
        if (!$payment->user_id) $payment->user_id = Auth::user()->id;
        if ($payment->id) $payment->updated_at = now();
        else $payment->created_at = now();
        $payment->save();
    }

    public static function store(RealPaymentRequest $request)
    {
        try {
            $payment = new RealPayment();
            self::saveChanges($request, $payment);
            session()->flash('message', 'Добавлен новый платеж');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новый платеж');
        }
    }

    public static function update(RealPaymentRequest $request, RealPayment $payment)
    {
        try {
            self::saveChanges($request, $payment);
            session()->flash('message', 'Данные платежа обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные платежа');
        }
    }

    public static function delete(RealPayment $payment)
    {
        try {
            $payment->delete();
            session()->flash('message', 'Платеж удален');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить платеж');
        }
    }

}
