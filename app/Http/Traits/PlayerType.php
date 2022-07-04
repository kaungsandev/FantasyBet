<?php
namespace App\Http\Traits;

trait PlayerType
{
    public function getPlayerTypeShort($type)
    {
        return match ($type) {
            1 => 'GK',
            2 => 'DEF',
            3 => 'MID',
            4 => 'FWD'
        };
    }

    public function getPlayerTypeLong($type)
    {
        return match ($type) {
            1 => 'Goalkeeper',
            2 => 'Defender',
            3 => 'Midfielder',
            4 => 'Forward'
        };
    }
}