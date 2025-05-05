<?php

namespace App\Services;

use App\DTO\GUSDTO;
use App\Enums\Currency;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use GusApi\GusApi;
use NBP\Client;
use NBP\Exception\NotFoundException;


class GUSService
{

    public GusApi $gus;

    public function __construct()
    {
        $this->gus = new GusApi(config('api.gus_api_key'), config('app.env'));

        $this->gus->login();
    }
    public function __destruct()
    {
        if ($this->gus->isLogged())
            $this->gus->logout();
    }

    public function getCompanyData(array|string $nip)
    {
        if (is_array($nip)) {
            return collect($nip)->map(function ($singleNip) {
                return $this->getCompanyData($singleNip);
            })->all();
        }

        $raw = $this->gus->getByNip($nip);
        if (!$raw) return null;

        return GUSDTO::gusParserCreate($raw);
    }



}
