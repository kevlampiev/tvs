<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.users', ['users' => User::all()]);
    }

    public function add(Request $request)
    {
        $user = new User();
        if ($request->isMethod('post')) {
            $user->fill($request->all());
            $user->password = \Illuminate\Support\Facades\Hash::make('12345678');
            $user->save();
            return redirect()->route('admin.users');
        } else {
            return view('Admin/user-edit', [
                'user' => $user,
                'route' => 'admin.addUser',
            ]);
        }
    }

    public function edit(Request $request, User $user)
    {
        if ($request->isMethod('post')) {
            $user->fill($request->all());
            $user->save();
            return redirect()->route('admin.users');
        } else {
            return view('Admin/user-edit', [
                'user' => $user,
                'route' => 'admin.editUser',
            ]);
        }
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users');
    }
}
