<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductCategory extends Enum
{
    const WET =   1;
    const DRY =   2;
    const OTHER = 3;
}
