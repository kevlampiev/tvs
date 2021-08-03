<?php

namespace App\Http\Controllers\User;

use App\DataServices\User\UserProfileDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function edit(Request $request)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        return view('User.user-profile-edit', UserProfileDataservice::provideData($request));
    }

    public function update(UserProfileRequest $request)
    {
        UserProfileDataservice::storeData($request);
        return redirect()->route('home');
    }
}
