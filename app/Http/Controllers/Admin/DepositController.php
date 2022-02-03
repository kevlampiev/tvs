<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\DepositDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\Agreement;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request, Agreement $agreement)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        return view('Admin.agreement-add-deposit',
            DepositDataservice::provideEditor($request, $agreement));
    }

    public function store(DepositRequest $request, Agreement $agreement): \Illuminate\Http\RedirectResponse
    {
        DepositDataservice::store($request);
        $route = session('previous_url', route('admin.agreements'));
        return redirect()->to($route);
    }


    public function edit(Request $request, Deposit $deposit)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        DepositDataservice::edit($request, $deposit);
        return view('Admin.agreement-add-deposit',
            DepositDataservice::provideEditor($request, $deposit->agreement, $deposit));
    }

    public function update(DepositRequest $request, Deposit $deposit): \Illuminate\Http\RedirectResponse
    {
        DepositDataservice::update($request, $deposit);
        $route = session('previous_url');
        return redirect()->to($route);
    }


    public function delete(Deposit $deposit): \Illuminate\Http\RedirectResponse
    {
        DepositDataservice::delete($deposit);
        $route = session('previous_url');
        return redirect()->to($route);
    }
}
