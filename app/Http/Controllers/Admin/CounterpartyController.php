<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\CounterpartiesDataservice;
use App\Http\Requests\ManufacturerRequest;
use App\Models\Counterparty;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterpartyController extends Controller
{
    public function index()
    {
        return view('Admin.counterparties', CounterpartiesDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $counterparty = new Counterparty();
        if (!empty($request->old())) {
            $counterparty->fill($request->old());
        }
        return view('Admin.counterparty-edit', [
            'counterparty' => $counterparty,
            'route' => 'admin.addCounterparty',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManufacturerRequest $request
     * @return RedirectResponse
     */
    public function store(ManufacturerRequest $request): RedirectResponse
    {
        $counterparty = new Counterparty();
        $counterparty->fill($request->all())->save();
        session()->flash('message', 'Добавлена новый контрагент');
        return redirect()->route('admin.counterparties');
    }

    /**
     * Display the specified resource.
     *
     * @param Counterparty $counterparty
     * @return void
     */
    public function show(Counterparty $counterparty)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param Counterparty $counterparty
     * @return View
     */
    public function edit(Request $request, Counterparty $counterparty): View
    {
        if (!empty($request->old())) {
            $counterparty->fill($request->old());
        }
        return view('Admin.counterparty-edit', [
            'counterparty' => $counterparty,
            'route' => 'admin.editCounterparty',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param ManufacturerRequest $request
     * @param Counterparty $counterparty
     * @return RedirectResponse
     */
    public function update(ManufacturerRequest $request, Counterparty $counterparty): RedirectResponse
    {

        $counterparty->fill($request->all())->save();
        session()->flash('message', 'Информация о контрагенте изменена');
        return redirect()->route('admin.counterparties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Counterparty $counterparty
     * @return RedirectResponse
     */
    public function destroy(Counterparty $counterparty): RedirectResponse
    {
        $counterparty->delete();
        session()->flash('message', 'Информация о контрагенте удалена');
        return redirect()->route('admin.counterparties');
    }

}
