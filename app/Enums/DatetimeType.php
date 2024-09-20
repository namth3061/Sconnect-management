<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DatetimeType extends Enum
{
    public const TIME = 'time';
    public const DATE = 'date';
    public const DATE_TIME = 'datetime-local';

}
