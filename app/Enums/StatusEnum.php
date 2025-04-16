<?php

namespace App\Enums;

use App\Contracts\HasLabel;

enum StatusEnum: int implements HasLabel
{
    case DONE = 0;
    case ACTIVE = 1;

    public function label(): string
    {
        return match($this) {
            self::DONE => 'Unactive',
            self::ACTIVE => 'Active',
        };
    }
}
