<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agreement;
use App\Models\AgreementType;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Vehicle;
use App\DataServices\AgreementsRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.agreements', AgreementsRepo::getAgreements($request));
    }

    public function add(Request $request)
    {
        $agreement = new Agreement();
        if ($request->isMethod('post')) {
            $this->validate($request, Agreement::rules());
            $agreement->fill($request->except(['id']));
            $agreement->save();
            return redirect()->route('admin.agreements');
        } else {
            if (!empty($request->old())) {
                $agreement->fill($request->old());
            }
            return view('Admin/agreement-edit',
                AgreementsRepo::provideAgreementEditor($agreement, 'admin.addAgreement'));
        }
    }

    public function edit(Request $request, Agreement $agreement)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, Agreement::rules());
            $agreement->fill($request->all());
            $agreement->save();
            $route = session('previous_url', route('admin.agreements'));
            return redirect()->to($route);
        } else {
            if (!empty($request->old())) {
                $agreement->fill($request->old());
            }
            if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
            return view('Admin/agreement-edit',
                AgreementsRepo::provideAgreementEditor($agreement, 'admin.editAgreement'));
        }
    }

    public function delete(Agreement $agreement): \Illuminate\Http\RedirectResponse
    {
        $agreement->delete();
        return redirect()->route('admin.agreements');
    }

    public function summary(Agreement $agreement)
    {
        $agreement->payments()->orderBy('payment_date');
        return view('Admin/agreement-summary', ['agreement' => $agreement]);
    }

    public function addVehicle(Request $request, Agreement $agreement, Vehicle $vehicle)
    {
        if ($request->isMethod('post')) {
            $vehicle = Vehicle::find($request->vehicle_id);
            $agreement->vehicles()->save($vehicle);
            return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']);
        } else {
            return view('Admin/agreement-add-vehicle',
                AgreementsRepo::provideAddVehicleView($agreement));
        }
    }

    public function detachVehicle(Request $request, Agreement $agreement, Vehicle $vehicle)
    {
        $agreement->vehicles()->detach($vehicle);
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']);
    }

}
