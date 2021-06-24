<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services\DolarService;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DolarExport;

class DolarController extends Controller
{
    public function getDolar(Request $request, DolarService $dolarservice){
        $dolarData = $dolarservice->getDolarData($request->year);
        $filteredData = $dolarservice->FilterDataByDate($dolarData, $request->year, $request->month);
        return $filteredData;

    }

    public function getDolarExcel(Request $request){
        $year = $request->year;
        $month = $request->month;
        $excelResponse = Excel::download(new DolarExport($year, $month), 'dolar.xlsx');
        return $excelResponse;
    }
}
