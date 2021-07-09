<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Vehicle;
use App\DataServices\InsurancesRepo;
use Carbon\Carbon;
use Carbon\Factory;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.insurances', InsurancesRepo::getInsurances($request));
    }

    public function add(Request $request, Vehicle $vehicle = null)
    {
        $insurance = new Insurance();
        $insurance->date_open = Carbon::today()->toDateString();
        $insurance->date_close = Carbon::today()->addYear()->toDateString();
        $insurance->description = 'Страхуемые риски: ';
        if ($vehicle) $insurance->vehicle_id = $vehicle->id;


        if ($request->isMethod('post')) {
            $this->validate($request, Insurance::rules());
            $insurance->fill($request->except(['id']));
            $insurance->save();
            $route = session('previous_url', route('admin.insurances'));
            return redirect()->to($route);
        } else {
            if (!empty($request->old())) {
                $insurance->fill($request->old());
            }
            if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
            return view('Admin.insurance-edit',
                InsurancesRepo::provideInsuranceEditor($insurance, 'admin.addInsurance'));
        }
    }


    public function edit(Request $request, Insurance $insurance)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, Insurance::rules());
            $insurance->fill($request->all());
            $insurance->save();
            $route = session('previous_url', route('admin.insurances'));
            return redirect()->to($route);
        } else {
            if (!empty($request->old())) {
                $insurance->fill($request->old());
            }
            if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
            return view('Admin.insurance-edit',
                InsurancesRepo::provideInsuranceEditor($insurance, 'admin.editInsurance'));
        }
    }

    public function delete(Insurance $insurance): \Illuminate\Http\RedirectResponse
    {
        $insurance->delete();
        $route = session('previous_url', route('admin.insurances'));
        return redirect()->to($route);
    }

}