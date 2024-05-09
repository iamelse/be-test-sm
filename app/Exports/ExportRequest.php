<?php

namespace App\Exports;

use App\Models\Request as ModelRequest;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportRequest implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    
    public function collection()
    {
        return ModelRequest::with('driver', 'validator', 'vehicle')->get();
    }

    public function headings(): array
    {
        return [
            'Driver Name',
            'Validator Name',
            'Vehicle',
            'Approved To Borrow At',
            'Approved To Use At'
        ];
    }

    public function map($request): array
    {
        return [
            [
                $request->driver->name . ' ' . $request->driver->last_name,
                $request->validator->name . ' ' . $request->validator->last_name,
                $request->vehicle->brand . ' ' . $request->vehicle->model,
                $request->valid_to_borrow_at,
                $request->valid_to_use_at,
            ]
        ];
    }
}
