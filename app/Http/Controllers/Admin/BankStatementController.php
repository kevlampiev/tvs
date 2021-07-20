<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\BankStatementDataservice;
use App\DataServices\Admin\CompaniesDataservice;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Vehicle;
use App\DataServices\InsurancesRepo;
use App\Parsers\BankStatementParser;
use Carbon\Carbon;
use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankStatementController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.load-bank-statement', BankStatementDataservice::provideData());
    }

    public function preLoadFile(Request $request)
    {
        if ($request->file('file1C')) {
            $file = $request->file('file1C');
            $upload_folder = config('paths.bankStatements','public/bank-statements');
            Storage::putFile($upload_folder, $file);
            $parser = new BankStatementParser($file);
            BankStatementDataservice::storeData($parser->getDocs());

        }
        return redirect()->back()->with('message','Данные выписки загружены для анализа');
    }

    public function transferToRealPayments()
    {
        BankStatementDataservice::transferToRealPayments();
        return redirect()->back()->with('message','Информация о реальных платежах перенесена в базу данных');
    }


}
