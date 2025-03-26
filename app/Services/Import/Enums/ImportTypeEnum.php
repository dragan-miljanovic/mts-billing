<?php

namespace App\Services\Import\Enums;

enum ImportTypeEnum: string
{
    case Cdr = 'CDR';
    case Conf = 'CONF';
}
