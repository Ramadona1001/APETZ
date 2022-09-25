<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ModelsExport implements FromCollection
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function collection()
    {
        return $this->model::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }
}
