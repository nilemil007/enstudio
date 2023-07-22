<?php

namespace App\Imports;

use App\Models\DdHouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DdHouseImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|DdHouse|null
     */
    public function model(array $row): Model|DdHouse|null
    {
        return new DdHouse([
            'cluster_name'      => $row['cluster_name'],
            'region'            => $row['region'],
            'name'              => $row['dd_name'],
            'code'              => $row['dd_code'],
            'email'             => $row['email'],
            'district'          => $row['district'],
            'address'           => $row['address'],
            'proprietor_name'   => $row['proprietor_name'],
            'proprietor_number' => $row['proprietor_number'],
            'poc_name'          => $row['poc_name'],
            'poc_number'        => $row['poc_number'],
            'tin_number'        => $row['tin_number'],
            'bin_number'        => $row['bin_number'],
            'latitude'          => $row['latitude'],
            'longitude'         => $row['longitude'],
            'bts_code'          => $row['bts_code'],
            'lifting_date'      => Carbon::instance(Date::excelToDateTimeObject($row['lifting_date']))->toDateString(),
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'cluster_name'      => ['required','max:30'],
            // Above is alias for as it always validates in batches
            '*.cluster_name'      => ['required','max:30'],

            'region'            => ['required','max:20'],
            // Above is alias for as it always validates in batches
            '*.region'            => ['required','max:20'],

            'dd_code'              => ['required','max:10', 'unique:dd_houses,code'],
            // Above is alias for as it always validates in batches
            '*.dd_code'              => ['required','max:10', 'unique:dd_houses,code'],

            'dd_name'              => ['required','min:3','max:100'],
            // Above is alias for as it always validates in batches
            '*.dd_name'              => ['required','min:3','max:100'],

            'email'             => ['required','email','unique:dd_houses,email'],
            // Above is alias for as it always validates in batches
            '*.email'             => ['required','email','unique:dd_houses,email'],

            'district'          => ['required','max:20'],
            // Above is alias for as it always validates in batches
            '*.district'          => ['required','max:20'],

            'address'           => ['required','max:150'],
            // Above is alias for as it always validates in batches
            '*.address'           => ['required','max:150'],

            'proprietor_name'   => ['required','min:3','max:100'],
            // Above is alias for as it always validates in batches
            '*.proprietor_name'   => ['required','min:3','max:100'],

            'proprietor_number' => ['required','numeric','digits:11','starts_with:01',],
            // Above is alias for as it always validates in batches
            '*.proprietor_number' => ['required','numeric','digits:11','starts_with:01',],

            'poc_name'          => ['required','min:3','max:100'],
            // Above is alias for as it always validates in batches
            '*.poc_name'          => ['required','min:3','max:100'],

            'poc_number'        => ['required','numeric','digits:11','starts_with:01',],
            // Above is alias for as it always validates in batches
            '*.poc_number'        => ['required','numeric','digits:11','starts_with:01',],

            'tin_number'        => ['required','unique:dd_houses,tin_number'],
            // Above is alias for as it always validates in batches
            '*.tin_number'        => ['required','unique:dd_houses,tin_number'],

            'bin_number'        => ['required','unique:dd_houses,bin_number'],
            // Above is alias for as it always validates in batches
            '*.bin_number'        => ['required','unique:dd_houses,bin_number'],

            'latitude'          => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            // Above is alias for as it always validates in batches
            '*.latitude'          => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],

            'longitude'         => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            // Above is alias for as it always validates in batches
            '*.longitude'         => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],

            'bts_code'          => ['required','starts_with:DHK','min:7','max:9'],
            // Above is alias for as it always validates in batches
            '*.bts_code'          => ['required','starts_with:DHK','min:7','max:9'],

            'lifting_date'      => ['required'],
            // Above is alias for as it always validates in batches
            '*.lifting_date'      => ['required'],
        ];
    }
}
