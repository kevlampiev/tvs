<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.user.users', ['users' => User::query()->orderBy('name')->get(), 'filter' => '']);
    }

    public function add(Request $request)
    {
        $user = new User();
        if ($request->isMethod('post')) {
            $user->fill($request->all());
            $user->password = \Illuminate\Support\Facades\Hash::make('12345678');
            $user->save();
            Mail::to($user->email)->queue(new UserCreated($user));
            return redirect()->route('admin.users');
        } else {
            return view('Admin.user.user-edit', [
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
            return view('Admin.user.user-edit', [
                'user' => $user,
                'route' => 'admin.editUser',
            ]);
        }
    }

    public function delete(User $user)
    {
        if (User::all()->count() < 2) {
            return redirect()->back()->with('error', 'Невозможно удалить последнего пользователя');
        }
        $user->delete();
        return redirect()->route('admin.users');
    }

    public function userSummary(User $user)
    {
        return view('Admin.user.user-summary',
            ['user' => $user,
            ]);
    }

    public function setTempPassword(Request $request, User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->back()->with('error', 'Невозможно использовать данный метод для установки пароля самому себе');
        }
        if ($request->isMethod('POST')) {
            $tempPassword = $request->post('tempPassword');
            $user->password = \Illuminate\Support\Facades\Hash::make($tempPassword);
            $user->password_changed_at = null;
            $user->save();
            return redirect()->route('admin.users')->with('message', 'Временный пароль установлен');
        } else {
            return view('Admin.user.user-setTempPassword', ['user' => $user]);
        }
    }


}
