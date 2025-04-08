<?php

namespace App\Enums;

use App\Contracts\HasLabel;

enum Currency: string implements HasLabel
{
    case PLN = 'PLN';
    case USD = 'USD';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case CHF = 'CHF';
    case SEK = 'SEK';
    case NOK = 'NOK';
    case CZK = 'CZK';

    public function label(): string
    {
        return match($this) {
            self::PLN => 'Polski złoty',
            self::USD => 'Dolar amerykański',
            self::EUR => 'Euro',
            self::GBP => 'Funt szterling',
            self::CHF => 'Frank szwajcarski',
            self::SEK => 'Korona szwedzka',
            self::NOK => 'Korona norweska',
            self::CZK => 'Korona czeska',
        };
    }
}
