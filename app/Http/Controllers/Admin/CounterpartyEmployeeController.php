<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\CounterpartiesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\CounterpartyEmployeeRequest;
use App\Http\Requests\ManufacturerRequest;
use App\Models\Counterparty;
use App\Models\CounterpartyEmployee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CounterpartyEmployeeController extends Controller
{
//    public function index()
//    {
//        return view('Admin.counterparties.counterparties', CounterpartiesDataservice::provideData());
//    }
//
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function create(Request $request, Counterparty $counterparty)
    {
        $employee = new CounterpartyEmployee();
        $employee->counterparty_id = $counterparty->id;
        if (!empty($request->old())) {
            $counterparty->fill($request->old());
        }
        return view('Admin.counterparties.counterparty-employee-edit', [
            'employee' => $employee,
//            'route' => 'admin.addCounterparty',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CounterpartyEmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(CounterpartyEmployeeRequest $request): RedirectResponse
    {
        $employee = new CounterpartyEmployee();
        $employee->fill($request->all())->save();
        session()->flash('message', 'Добавлен новый сотрудник контрагента');
        return redirect()->route('admin.counterpartySummary', ['counterparty' => $employee->counterparty_id]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param CounterpartyEmployee $employee
     * @return View
     */
    public function edit(Request $request, CounterpartyEmployee $employee): View
    {
        if (!empty($request->old())) {
            $employee->fill($request->old());
        }
        return view('Admin.counterparties.counterparty-employee-edit', [
            'employee' => $employee,
//            'route' => 'admin.editCounterparty',
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param CounterpartyEmployeeRequest $request
     * @param CounterpartyEmployee $employee
     * @return RedirectResponse
     */
    public function update(CounterpartyEmployeeRequest $request, CounterpartyEmployee $employee): RedirectResponse
    {

        $employee->fill($request->all())->save();
        session()->flash('message', 'Информация о сотруднике контрагента изменена');
        return redirect()
            ->route('admin.counterpartyCard', ['counterparty' => $employee->counterparty, 'page'=> 'staff']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Counterparty $counterparty
     * @return RedirectResponse
     */
    public function destroy(CounterpartyEmployee $employee): RedirectResponse
    {
        $employee->delete();
        session()->flash('message', 'Информация о сотруднике контрагента удалена');
        return redirect()
            ->route('admin.counterpartyCard', ['counterparty' => $employee->counterparty, 'page'=> 'staff']);
    }

}
