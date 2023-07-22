<?php

namespace App\Imports;

use App\Models\Route;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RouteImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|Route|null
     */
    public function model(array $row): Model|Route|null
    {
        return new Route([
            'dd_house_id'   => $row['dd_code'],
            'code'          => $row['route_code'],
            'name'          => $row['route_name'],
            'description'   => $row['description'],
            'weekdays'      => $row['weekday'],
            'length'        => $row['route_length'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'dd_code'           => ['required'],
            '*.dd_code'         => ['required'],
            'route_code'        => ['required', 'unique:routes,code', 'max:20',],
            '*.route_code'      => ['required', 'unique:routes,code', 'max:20',],
            'route_name'        => ['required', 'string', 'min:3', 'max:30'],
            '*.route_name'      => ['required', 'string', 'min:3', 'max:30'],
            'description'       => ['required', 'string', 'min:3', 'max:200',],
            '*.description'     => ['required', 'string', 'min:3', 'max:200',],
            'weekday'           => ['required', 'string', 'min:3', 'max:100',],
            '*.weekday'         => ['required', 'string', 'min:3', 'max:100',],
            'route_length'      => ['nullable'],
            '*.route_length'    => ['nullable'],
        ];
    }
}
