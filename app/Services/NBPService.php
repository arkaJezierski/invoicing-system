<?php

namespace App\Services;

use App\Enums\Currency;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use NBP\Client;
use NBP\Exception\NotFoundException;


class NBPService
{

    public function __construct(
        protected Client $client,
        protected array $tabelArray = ['A', 'C']
    ){
        $this->currencyArray = array_map(fn($c) => $c->value, Currency::cases());
    }


    public function getRates($startDate, $endDate)
    {
        $tableData = [];
        foreach ($this->tabelArray as $table){
            $tableData[$table] = $this->client->tables()->betweenDate($table, $startDate, $endDate);
        }

        $mergedRates = [];

        foreach ($tableData as $table => $data){
            foreach ($data as $index => $record) {
                $date = $record['effectiveDate'];

                foreach ($record['rates'] as $rate) {
                    $code = $rate['code'];

                    if (!isset($mergedRates[$date][$code])) {
                        $mergedRates[$date][$code] = [
                            'mid' => null,
                            'bid' => null,
                            'ask' => null,
                        ];
                    }

                    if ($table === 'A') {
                        $mergedRates[$date][$code]['mid'] = $rate['mid'];
                    }

                    if ($table === 'C') {
                        $mergedRates[$date][$code]['bid'] = $rate['bid'];
                        $mergedRates[$date][$code]['ask'] = $rate['ask'];
                    }
                }
            }
        }

        return $mergedRates;
    }

    public function createExchangeRates($mergedRates) : void
    {
        foreach ($mergedRates as $date => $rates) {
            foreach ($rates as $code => $values) {
                if (!in_array($code, $this->currencyArray)) continue;

                if ($values['mid'] !== null && $values['bid'] !== null && $values['ask'] !== null) {
                    ExchangeRate::updateOrCreate(
                        [
                            'currency_code' => $code,
                            'effective_date' => $date,
                        ],
                        [
                            'mid' => $values['mid'],
                            'bid' => $values['bid'],
                            'ask' => $values['ask'],
                        ]
                    );
                }
            }
        }
    }

}
