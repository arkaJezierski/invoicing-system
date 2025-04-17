<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            "name" => "required|string|max:255",
            "pl_name" => "required|string|max:255",
            "code" => "required|string|size:2|unique:countries,code",
            "currency" => "required|string|max:100",
            "currency_code" => "required|string|size:3",
            "currency_symbol" => "required|string|max:5"
        ]);
    }

    protected $fillable = [
        'name',
        'pl_name',
        'code',
        'currency',
        'currency_symbol',
        'currency_code'
    ];


    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function clientAddresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function identifierTypes()
    {
        return $this->hasMany(ClientIdentifierType::class);
    }

}
