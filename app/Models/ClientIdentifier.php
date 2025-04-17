<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientIdentifier extends Model
{
    /** @use HasFactory<\Database\Factories\ClientIdentifiersFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            "client_id" => "required|exists:clients,id",
            "identifier_type_id" => "required|exists:client_identifier_types,id",
            "value" => "required|string|max:255",
            "country_id" => "nullable|exists:countries,id"
        ]);
    }

    protected $fillable = [
        'client_id', 'identifier_type_id', 'value', 'country_id',
    ];

    public function value(): Attribute
    {
        return Attribute::make(
            set: fn ($val) => preg_replace('/\D+/', '', $val),
            get: fn ($val) => match (strlen($val)) {
                10 => preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', '$1-$2-$3-$4', $val),
                9 => preg_replace('/(\d{2})(\d{3})(\d{4})/', '$1.$2.$3', $val),
                default => $val,
            }
        );
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function type()
    {
        return $this->belongsTo(ClientIdentifierType::class, 'identifier_type_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
