<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBankAccount extends Model
{
    /** @use HasFactory<\Database\Factories\ClientBankAccountsFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            "client_id" => "required|exists:clients,id",
            "iban" => "required|string|regex:/^[A-Z]{2}\\d{2}[A-Z0-9]{11,30}$/",
            "bank_name" => "nullable|string|max:255",
            "swift" => "nullable|string|regex:/^[A-Z0-9]{8,11}$/",
            "is_default" => "boolean"
        ]);
    }

    protected $fillable = [
        'client_id', 'iban', 'bank_name', 'swift', 'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function iban(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(preg_replace('/\s+/', '', $value)),
            get: fn ($value) => trim(chunk_split($value, 4, ' ')),
        );
    }

    public function swift(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(preg_replace('/\s+/', '', $value)),
            get: fn ($value) => strtoupper($value),
        );
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
