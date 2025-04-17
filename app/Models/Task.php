<?php

namespace App\Models;

use App\Traits\ValidatesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use ValidatesModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setModelRules([
            'name' => "required|string|max:512",
            'completed' => "boolean"
        ]);
    }

    protected $fillable = [
        'name',
        'completed'
    ];

    protected $casts = [
        'name' => 'string',
        'completed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
