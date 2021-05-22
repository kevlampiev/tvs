<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DictionariesController extends Controller
{
    public function index(Request $request):string
    {
        return "тут будут все типы техники";
    }
}
