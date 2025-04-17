<?php

namespace App\Models;

use App\Enums\Currency;
use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /** @use HasFactory<\Database\Factories\ExchangeRateFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            "currency_code" => "required|string|size:3",
            "effective_date" => "required|date",
            "mid" => "nullable|numeric",
            "bid" => "nullable|numeric",
            "ask" => "nullable|numeric"
        ]);
    }

    protected $fillable = [
        'currency_code',
        'effective_date',
        'mid',
        'bid',
        'ask',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'currency_code' => Currency::class,
        'effective_date' => 'date',
        'mid' => 'double',
        'bid' => 'double',
        'ask' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
