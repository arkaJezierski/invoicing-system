<?php

namespace App\Models;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /** @use HasFactory<\Database\Factories\ExchangeRateFactory> */
    use HasFactory;

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
