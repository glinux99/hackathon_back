<?php

namespace App\Exports;

use App\Models\Trash;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrashExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Car::all();
    }
}
