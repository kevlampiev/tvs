<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\AgreementsDataservice;
use App\DataServices\AgreementsRepo;
use App\Events\RealTimeMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementRequest;
use App\Models\Agreement;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function index(Request $request)
    {

        return view('Admin.agreements', AgreementsDataservice::index($request));
    }

    public function create(Request $request)
    {
        event(new RealTimeMessage('Начинваем создавать новый договор'));
        $agreement = AgreementsDataservice::create($request);
        return view('Admin.agreement-edit',
            AgreementsDataservice::provideAgreementEditor($agreement, 'admin.addAgreement'));
    }

    public function store(AgreementRequest $request): \Illuminate\Http\RedirectResponse
    {
        AgreementsDataservice::store($request);
        $route = session('previous_url', route('admin.agreements'));
        return redirect()->to($route);
    }


    public function edit(Request $request, Agreement $agreement)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        AgreementsDataservice::edit($request, $agreement);
        return view('Admin.agreement-edit',
            AgreementsDataservice::provideAgreementEditor($agreement, 'admin.editAgreement'));
    }

    public function update(AgreementRequest $request, Agreement $agreement): \Illuminate\Http\RedirectResponse
    {
        AgreementsDataservice::update($request, $agreement);
        $route = session('previous_url');
        return redirect()->to($route);
    }


    public function delete(Agreement $agreement): \Illuminate\Http\RedirectResponse
    {
        AgreementsDataservice::delete($agreement);
        $route = session('previous_url');
        return redirect()->to($route);
    }

    public function summary(Agreement $agreement)
    {
        $agreement->payments()->orderBy('payment_date');
        return view('Admin/agreement-summary', ['agreement' => $agreement]);
    }

    public function addVehicle(Request $request, Agreement $agreement, Vehicle $vehicle)
    {
        if ($request->isMethod('post')) {
            AgreementsDataservice::addVehicle($request, $agreement);
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']);
        } else {
            return view('Admin/agreement-add-vehicle',
                AgreementsRepo::provideAddVehicleView($agreement));
        }
    }

    public function detachVehicle(Request $request, Agreement $agreement, Vehicle $vehicle): \Illuminate\Http\RedirectResponse
    {
        AgreementsDataservice::detachVehicle($agreement, $vehicle);
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']);
    }


}
