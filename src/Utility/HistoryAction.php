<?php

namespace App\Utility;

/**
 * Class HistoryAction
 * @package App\Utility
 */
class HistoryAction
{
    const ADD = 1;
    const UPDATE = 2;
    const ADD_LABEL = 'Added';
    const UPDATE_LABEL = 'Updated';

    /**
     * @param int $value
     * @return string
     */
    public static function getLabel(int $value)
    {
        return match ($value) {
            self::ADD => self::ADD_LABEL,
            self::UPDATE => self::UPDATE_LABEL,
            default => GenericResponse::NOT_APPLICABLE,
        };
    }
}