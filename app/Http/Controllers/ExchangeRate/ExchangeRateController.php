<?php

namespace App\Http\Controllers\ExchangeRate;

use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\View\View;
class ExchangeRateController extends Controller
{
    public function index(Request $request): View
    {

        $currency = Currency::cases();

        $rates = [['id'=>'mid', 'name'=>'Średni'],['id'=>'bid', 'name'=>'Kupno'], ['id'=>'ask', 'name'=>'Sprzedaż'], ['id'=>'all', 'name'=>'Wszystkie']];

        $currency_rates = [];
        $labels = [];
        $data2 = [];
        $start_date = new DateTimeImmutable;

        $end_date = new DateTimeImmutable;

        $field = [
            'currency_id' => null,
            'rate_id' => 'mid',
            'start_date' => $start_date->modify('-90 days')->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d')
        ];

        if($request->get('currency_id')) {
            $validated = $request->validate([
                'currency_id' => 'required|string',
                'rate_id' => 'required|in:mid',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $date = new DateTime($request->get('start_date'));
            $date->modify("-1 day")->format('Y-m-d');
            $field['currency_id'] = $request->get('currency_id');
            $field['rate_id'] = $request->get('rate_id');
            $field['start_date'] = $request->get('start_date');
            $field['end_date'] = $request->get('end_date');

            $currency_rates = ExchangeRate::with('currency_quote')->select()
                ->whereBetween('date', [$request->get('start_date'), $request->get('end_date')])
                ->where('currency', '=', $currency->where('id', '=', $request->get('currency_id'))->pluck('name')->first())
                ->orderBy('date', 'desc')
                ->get();

            $currency_rates_asc = ExchangeRate::query()->select()
                ->whereBetween('date', [$request->get('start_date'), $request->get('end_date')])
                ->where('currency', '=', $currency->where('id', '=', $request->get('currency_id'))->pluck('name')->first())
                ->orderBy('date', 'asc')
                ->get();

            $labels2 = $currency_rates_asc->pluck('date');
            $labels = $labels2->map(function ($item) {
                return $item->format('d-m-Y');
            });

            //            dd($labels);
            //            $data1 = $currency_rates_asc->pluck('ask');
            $data2 = $currency_rates_asc->pluck('mid');
            //            $data3 = $currency_rates_asc->pluck('bid');
        }




        return view('exchange-rate.index', compact('currency', 'rates', 'currency_rates', 'field', 'data2', 'labels'));
    }
}
