<?php

namespace App\Services;
use GuzzleHttp\Client;

class DolarService {

    private $client;

    public function __construct(){
        $this->client = new Client();
    }

    public function getDolarData($year){

        $url = "https://mindicador.cl/api/dolar/".$year;
        $response = $this->client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        $serie = $responseBody->serie;
        return $serie;
    }

    public function FilterDataByDate($serie, $year,$month){
        $serieCollection = collect($serie);
        $queryDate = $year."-".$month;

        // Create a date of the first day of the month
        $firstDate = date('Y-m-01', strtotime($queryDate));
        // Create a date of the last day of the month in ISO 8601 format
        $lastDate = date('Y-m-t\T23:59:59\Z', strtotime($queryDate));

        $filteredByDateCollection = $serieCollection->whereBetween('fecha', [$firstDate,$lastDate]);
        return $filteredByDateCollection;
    }



}
