<?php


namespace App\DataServices\Admin;

use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;

class UserProfileDataservice
{
    public static function provideData(Request $request): array
    {
        $user = auth()->user();
        if (!empty($request->old())) {
            $user->fill($request->old());
        }
        return ['user' => $user];
    }

    public static function storeData(UserProfileRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->only('name', 'email', 'phone_number'));
        $user->updated_at = now();
        $user->save();
    }

}
