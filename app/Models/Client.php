<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|regex:/^\d{9}$/',
            'is_company' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'country_id' => 'nullable|exists:countries,id',
        ]);
    }


    protected $fillable = [
        'name',
        'email',
        'phone',
        'is_company',
        'user_id',
        'country_id',
    ];

    protected $casts = [
        'is_company' => 'boolean',
    ];

    public function email(): Attribute
    {
        return Attribute::make(
            set: fn ($val) => strtolower(trim($val)),
        );
    }

    public function phone(): Attribute
    {
        return Attribute::make(
            set: fn ($val) => preg_replace('/\D+/', '', $val),
            get: fn ($val) => preg_replace('/^(\d{3})(\d{3})(\d{3})$/', '$1 $2 $3', $val) ?? $val,
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(ClientBankAccount::class);
    }

    public function identifiers()
    {
        return $this->hasMany(ClientIdentifier::class);
    }

    public function defaultBillingAddress()
    {
        return $this->hasOne(ClientAddress::class)->where('type', 'billing')->where('is_default', true);
    }

    public function defaultBankAccount()
    {
        return $this->hasOne(ClientBankAccount::class)->where('is_default', true);
    }
}
