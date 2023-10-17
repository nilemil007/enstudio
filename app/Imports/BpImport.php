<?php

namespace App\Imports;

use App\Models\Bp;
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

class BpImport implements ToModel, WithHeadingRow, WithChunkReading
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|\App\Models\Bp|null
     */
    public function model(array $row): Model|Bp|null
    {
//        dd($row);
        return new Bp([
            'dd_house_id'       => DdHouse::firstWhere('code', $row['dd_code'])->id,
            'response_id'       => $row['response_id'],
            'name'              => $row['bp_name'],
            'type'              => $row['bp_type'],
            'pool_number'       => $row['pool_phone_no'],
            'gender'            => $row['gender'],
            'nid'               => $row['bp_nidbc_no'],
            'father_name'       => $row['father_name'],
            'mother_name'       => $row['mother_name'],
            'bank_name'         => $row['sse_bank_name'],
            'account_number'    => $row['sse_bank_account_no'],
            'dob'               => Carbon::instance(Date::excelToDateTimeObject($row['date_of_birth']))->toDateString(),
            'joining_date'      => Carbon::instance(Date::excelToDateTimeObject($row['date_of_joining']))->toDateString(),
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
            'response_id'           => ['required', 'unique:bps,response_id'],
            '*.response_id'         => ['required', 'unique:bps,response_id'],
            'bp_name'               => ['required'],
            '*.bp_name'             => ['required'],
            'bp_type'               => ['required'],
            '*.bp_type'             => ['required'],
            'pool_phone_no'         => ['required', 'unique:bps,pool_number'],
            '*.pool_phone_no'       => ['required', 'unique:bps,pool_number'],
            'gender'                => ['required'],
            '*.gender'              => ['required'],
            'bp_nid_bc_no'          => ['required',  new Nid, 'unique:bps,nid'],
            '*.bp_nid_bc_no'        => ['required',  new Nid, 'unique:bps,nid'],
            'father_name'           => ['required'],
            '*.father_name'         => ['required'],
            'mother_name'           => ['required'],
            '*.mother_name'         => ['required'],
            'sse_bank_name'         => ['required'],
            '*.sse_bank_name'       => ['required'],
            'sse_bank_account_no'   => ['required', 'unique:bps,account_number'],
            '*.sse_bank_account_no' => ['required', 'unique:bps,account_number'],
            'date_of_birth'         => ['required'],
            '*.date_of_birth'       => ['required'],
            'date_of_joining'       => ['required'],
            '*.date_of_joining'     => ['required'],
        ];
    }
}
