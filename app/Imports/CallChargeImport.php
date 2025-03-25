<?php

namespace App\Imports;

use App\Models\CallCharge;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class CallChargeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row): Model|CallCharge|null
    {
        return new CallCharge([
            //
        ]);
    }
}
