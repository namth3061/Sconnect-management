<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ModalSize extends Enum
{
    public const SMALL = 'small';
    public const LARGE = 'large';
    public const EXTRA_LARGE = 'extra-large';
}
