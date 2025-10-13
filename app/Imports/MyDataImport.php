<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MyDataImport implements ToCollection
{
    public $data;

    public function collection(Collection $collection)
    {
        // The collection contains all rows of the Excel file
        // You can process the data here or simply store it
        $this->data = $collection;
    }
}