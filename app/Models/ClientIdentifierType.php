<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientIdentifierType extends Model
{
    /** @use HasFactory<\Database\Factories\ClientIdentifierTypesFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            "country_id" => "required|exists:countries,id",
            "name" => "required|string|max:255",
            "short_name" => "required|string|max:50",
            "format" => "nullable|string|max:255",
            "is_primary" => "boolean",
            "verification_website" => "nullable|url|max:255"
        ]);
    }

    protected $fillable = [
        'country_id', 'name', 'short_name',
        'format', 'is_primary', 'verification_website',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function identifiers()
    {
        return $this->hasMany(ClientIdentifier::class, 'identifier_type_id');
    }

}
