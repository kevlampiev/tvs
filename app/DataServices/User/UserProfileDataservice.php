<?php


namespace App\DataServices\User;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserProfileDataservice
{
    public static function provideData():array
    {
        return ['user'=>Auth::user()];
    }

    public static function storeData(Request $request)
    {
        $user = auth()->user();
        $user->fill($request->only('name', 'email'));
        $user->updated_at = now();
        $user->save();
    }

}
