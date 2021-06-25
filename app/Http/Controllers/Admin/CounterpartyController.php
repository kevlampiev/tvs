<?php

namespace App\Http\Controllers\Admin;

use App\Models\Counterparty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterpartyController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.counterparties',
            ['counterparties' => Counterparty::withCount('agreements')->get(), 'filter' => '']);
    }

    public function addCounterparty(Request $request)
    {
        $counterparty = new Counterparty();
        if ($request->isMethod('post')) {
            $this->validate($request, Counterparty::rules());
            $counterparty->fill($request->only('name'));
            $counterparty->save();
            return redirect()->route('admin.counterparties');
        } else {
            if (!empty($request->old())) {
                $counterparty->fill($request->old());
            }
            return view('Admin/counterparty-edit', [
                'counterparty' => $counterparty,
                'route' => 'admin.addCounterparty',
            ]);
        }
    }

    public function editCounterparty(Request $request, Counterparty $counterparty)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, Counterparty::rules());
            $counterparty->fill($request->only('name'));
            $counterparty->save();
            return redirect()->route('admin.counterparties');
        } else {
            if (!empty($request->old())) {
                $counterparty->fill($request->old());
            }
            return view('Admin/counterparty-edit', [
                'counterparty' => $counterparty,
                'route' => 'admin.editCounterparty',
            ]);
        }
    }

    public function deleteCounterparty(Counterparty $counterparty): \Illuminate\Http\RedirectResponse
    {
        $counterparty->delete();
        return redirect()->route('admin.counterparties');
    }
}
