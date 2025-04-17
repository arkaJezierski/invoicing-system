<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    /** @use HasFactory<\Database\Factories\ClientAddressFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            "client_id" => "required|exists:clients,id",
            "type" => "required|in:billing,shipping",
            "street" => "nullable|string|max:255",
            "postal_code" => "nullable|regex:/^\\d{2}-\\d{3}$/",
            "city" => "nullable|string|max:255",
            "country_id" => "nullable|exists:countries,id",
            "is_default" => "boolean"
        ]);
    }

    protected $fillable = [
        'client_id', 'type', 'street',
        'postal_code', 'city', 'country_id',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function postalCode(): Attribute
    {
        return Attribute::make(
            set: fn ($val) => preg_replace('/[^0-9]/', '', $val),
            get: fn ($val) => preg_replace('/(\d{2})(\d{3})/', '$1-$2', $val),
        );
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
