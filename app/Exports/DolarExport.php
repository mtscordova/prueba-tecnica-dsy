<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Services\DolarService;


class DolarExport implements FromCollection, WithHeadings
{

    private $year;
    private $month;

    public function __construct($year, $month){
        $this->year = $year;
        $this->month = $month;
    }

    public function headings(): array
    {
        return ["day", "dolar value"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dolarService = new DolarService();
        $dolarData = $dolarService->getDolarData($this->year);
        $filteredData = $dolarService->FilterDataByDate($dolarData, $this->year, $this->month);
        return $filteredData;
    }
}
