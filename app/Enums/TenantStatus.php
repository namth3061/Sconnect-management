<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TenantStatus extends Enum
{
    public const ACTIVE = 'active';
    public const UNACTIVE = 'un-active';
}
