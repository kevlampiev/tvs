<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agreement;
use App\Models\AgreementType;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.agreements', [
            'agreements' => Agreement::all()]);
    }

    public function add(Request $request)
    {
        $agreement = new Agreement();
        if ($request->isMethod('post')) {
            $agreement->fill($request->except(['id']));
            $agreement->save();
            return redirect()->route('admin.agreements');
        } else {
            return view('Admin/agreement-edit', [
                'agreement' => $agreement,
                'route' => 'admin.addAgreement',
                'agreementTypes' => AgreementType::all(),
                'companies' => Company::all(),
                'counterparties' => Counterparty::all(),
            ]);
        }
    }

    public function edit(Request $request, Agreement $agreement)
    {
        if ($request->isMethod('post')) {
            $agreement->fill($request->all());
            $agreement->save();
            return redirect()->route('admin.agreements');
        } else {
            return view('Admin/agreement-edit', [
                'agreement' => $agreement,
                'route' => 'admin.editAgreement',
                'agreementTypes' => AgreementType::all(),
                'companies' => Company::all(),
                'counterparties' => Counterparty::all(),
            ]);
        }
    }

    public function delete(Agreement $agreement): \Illuminate\Http\RedirectResponse
    {
        $agreement->delete();
        return redirect()->route('admin.agreements');
    }

    public function summary(Agreement $agreement)
    {
        return view('Admin/agreement-summary', ['agreement' => $agreement]);
    }

    public function addVehicle(Request $request, Agreement $agreement, Vehicle $vehicle)
    {
        if ($request->isMethod('post')) {
            $vehicle = Vehicle::find($request->vehicle_id);
            $agreement->vehicles()->save($vehicle);
            return redirect()->route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'vehicles']);
        } else {
            return view('Admin/agreement-add-vehicle', [
                'agreement' => $agreement,
                'vehicles' => Vehicle::all(),
            ]);
        }
    }

    public function detachVehicle(Request $request, Agreement $agreement, Vehicle $vehicle)
    {
        $agreement->vehicles()->detach($vehicle);
        return redirect()->back();
//        return redirect()->route('admin.agreementSummary', [ 'agreement' => $agreement]);
    }

}
