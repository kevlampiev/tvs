<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceRequest;
use App\Models\Insurance;
use App\Models\Vehicle;
use App\DataServices\InsurancesRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataServices\Admin\InsurancesDataservice;
use phpDocumentor\Reflection\Types\String_;

class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.insurances', InsurancesDataservice::index($request));
    }

    private function previousUrl()
    {
//        $route = session('previous_url', route('admin.insurances'));
        $route = url()->previous();
        if (preg_match('/vehicles.{1,}summary$/i', $route)) $route .= '/insurance_policies';
        return $route;
    }


    public function create(Request $request, Vehicle $vehicle = null)
    {
        $insurance = InsurancesDataservice::create($request, $vehicle);
        if (url()->previous() !== url()->current()) session(['previous_url' => $this->previousUrl()]);
        return view('Admin.insurance-edit',
            InsurancesDataservice::provideInsuranceEditor($insurance, 'admin.addInsurance'));
    }

    public function store(InsuranceRequest $request)
    {
        InsurancesDataservice::store($request);
        $route = session('previous_url', route('admin.insurances'));
        return redirect()->to($route);
    }


    public function edit(Request $request, Insurance $insurance)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => $this->previousUrl()]);
        InsurancesDataservice::edit($request, $insurance);
        return view('Admin.insurance-edit',
            InsurancesDataservice::provideInsuranceEditor($insurance, 'admin.editInsurance'));
    }

    public function update(InsuranceRequest $request, Insurance $insurance)
    {
        InsurancesDataservice::update($request, $insurance);
        $route = session('previous_url', route('admin.insurances'));
        return redirect()->to($route);
    }

    public function delete(Insurance $insurance): \Illuminate\Http\RedirectResponse
    {
        InsurancesDataservice::delete($insurance);
        $route = session('previous_url', route('admin.insurances'));
        return redirect()->to($route);
    }

}
