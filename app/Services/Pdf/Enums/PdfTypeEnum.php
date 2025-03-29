<?php

namespace App\Services\Pdf\Enums;

enum PdfTypeEnum: string
{
    case Cdr = 'call_charges';
    case Conf = 'confirmations';
}
