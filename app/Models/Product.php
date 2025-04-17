<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
        ]);
    }

    protected $fillable = [
    ];

    protected $casts = [
    ];
}
