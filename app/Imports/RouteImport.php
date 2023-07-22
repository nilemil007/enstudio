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
            'dd_house_id'   => ['required'],
            '*.dd_house_id' => ['required'],
            'code'          => ['required', 'unique:routes,code', 'max:20',],
            '*.code'        => ['required', 'unique:routes,code', 'max:20',],
            'name'          => ['required', 'string', 'min:3', 'max:30'],
            '*.name'        => ['required', 'string', 'min:3', 'max:30'],
            'description'   => ['required', 'string', 'min:3', 'max:200',],
            '*.description' => ['required', 'string', 'min:3', 'max:200',],
            'weekdays'      => ['required', 'string', 'min:3', 'max:100',],
            '*.weekdays'    => ['required', 'string', 'min:3', 'max:100',],
            'length'        => ['nullable'],
            '*.length'      => ['nullable'],
        ];
    }
}
