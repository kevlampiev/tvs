<?php

namespace App\Http\Controllers\User;

use App\DataServices\User\UserProfileDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function edit()
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        return view('User.user-profile-edit', UserProfileDataservice::provideData());
    }

    public function update(Request $request)
    {
        UserProfileDataservice::storeData($request);
        return redirect()->route('home');
    }
}
