<?php

namespace App\Imports;

use App\Models\Cm;
use App\Models\DdHouse;
use App\Rules\Nid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CmImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    use Importable;

    /**
     * @param array $row
     * @return Model|Cm|null
     */
    public function model(array $row): Model|Cm|null
    {
//        dd($row);
        return new Cm([
            'dd_house_id'       => DdHouse::firstWhere('code', $row['dd_code'])->id,
            'name'              => $row['name'],
            'designation'       => $row['designation'],
            'type'              => $row['type'],
            'pool_number'       => $row['pool_number'],
            'personal_number'   => $row['personal_number'],
            'nid_number'        => $row['nid_number'],
            'dob'               => Carbon::instance(Date::excelToDateTimeObject($row['dob']))->toDateString(),
            'father_name'       => $row['father_name'],
            'mother_name'       => $row['mother_name'],
            'address'           => $row['address'],
            'joining_date'      => Carbon::instance(Date::excelToDateTimeObject($row['joining_date']))->toDateString(),
            'bank_account_name' => $row['bank_account_name'],
            'bank_name'         => $row['bank_name'],
            'account_number'    => $row['account_number'],
            'account_type'      => $row['account_type'],
            'branch_name'       => $row['branch_name'],
            'salary'            => $row['gross_salary'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'dd_code'               => ['required'],
            '*.dd_code'             => ['required'],
            'name'                  => ['required'],
            '*.name'                => ['required'],
            'designation'           => ['required'],
            '*.designation'         => ['required'],
            'type'                  => ['required'],
            '*.type'                => ['required'],
            'pool_number'           => ['required', 'unique:cms,pool_number'],
            '*.pool_number'         => ['required', 'unique:cms,pool_number'],
            'personal_number'       => ['required', 'unique:cms,personal_number'],
            '*.personal_number'     => ['required', 'unique:cms,personal_number'],
            'nid_number'            => ['required',  new Nid, 'unique:cms,nid_number'],
            '*.nid_number'          => ['required',  new Nid, 'unique:cms,nid_number'],
            'dob'                   => ['required'],
            '*.dob'                 => ['required'],
            'father_name'           => ['required'],
            '*.father_name'         => ['required'],
            'mother_name'           => ['required'],
            '*.mother_name'         => ['required'],
            'address'               => ['required'],
            '*.address'             => ['required'],
            'joining_date'          => ['required'],
            '*.joining_date'        => ['required'],
            'bank_account_name'     => ['required'],
            '*.bank_account_name'   => ['required'],
            'bank_name'             => ['required'],
            '*.bank_name'           => ['required'],
            'account_number'        => ['required', 'unique:cms,account_number'],
            '*.account_number'      => ['required', 'unique:cms,account_number'],
            'account_type'          => ['required'],
            '*.account_type'        => ['required'],
            'branch_name'           => ['required'],
            '*.branch_name'         => ['required'],
            'gross_salary'          => ['required'],
            '*.gross_salary'        => ['required'],
        ];
    }
}
