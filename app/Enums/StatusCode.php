<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StatusCode extends Enum
{
    public const OK = '200';
    public const UNAUTHORIZED = '401';
    public const NOTFOUND = '404';
    public const SERVERERROR = '500';
}
