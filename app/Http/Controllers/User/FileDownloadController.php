<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileDownloadController extends Controller
{
    public static function previewInsurance(Request $request)
    {
//        $directory = config('paths.insurances.get', 'storage/insurances/');
//        $filename = $request->get('filename');
//        return response()->file($directory.$filename);
        $filename = storage_path('app/public/insurances/' . $request->get('filename'));
        return response()->file($filename);
    }


}
