<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\DdHouse;
use App\Models\Retailer;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Activation\CoreActivation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CoreActivationImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CoreActivation([
            'activation_date'   => Carbon::instance(Date::excelToDateTimeObject($row['activation_date']))->toDateString(),
            'dd_house_id'       => DdHouse::firstWhere('code', $row['distributor_code'])->id,
            'retailer_id'       => Retailer::firstWhere('code', $row['retailer_code'])->id,
            'supervisor_id'     => Retailer::firstWhere('code', $row['retailer_code'])->id,
            'rso_id'            => Retailer::firstWhere('code', $row['retailer_code'])->id,
            'product_code'      => $row['product_code'],
            'product_name'      => $row['product_name'],
            'sim_serial'        => $row['sim_no'],
            'msisdn'            => $row['msisdn'],
            'selling_price'     => $row['selling_price'],
            'bp_flag'           => $row['bp_flag'],
            'bp_number'         => $row['bp_number'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'activation_date'   => ['required'],
            '*.activation_date' => ['required'],
            'dd_house_id'       => ['required'],
            '*.dd_house_id'     => ['required'],
            'retailer_id'       => ['required'],
            '*.retailer_id'     => ['required'],
            'supervisor_id'     => ['required', 'max:10', 'unique:rsos,rso_code'],
            '*.supervisor_id'   => ['required', 'max:10', 'unique:rsos,rso_code'],
            'rso_id'            => ['required', 'numeric', 'digits: 11', 'unique:rsos,itop_number'],
            '*.rso_id'          => ['required', 'numeric', 'digits: 11', 'unique:rsos,itop_number'],
            'product_code'      => ['required', 'numeric', 'digits: 11', 'unique:rsos,pool_number'],
            '*.product_code'    => ['required', 'numeric', 'digits: 11', 'unique:rsos,pool_number'],
            'product_name'      => ['required', 'numeric', 'digits: 11', 'unique:rsos,personal_number'],
            '*.product_name'    => ['required', 'numeric', 'digits: 11', 'unique:rsos,personal_number'],
            'sim_serial'        => ['required', 'unique:rsos,rid'],
            '*.sim_serial'      => ['required', 'unique:rsos,rid'],
            'msisdn'            => ['required', 'max:8', 'unique:rsos,sr_no'],
            '*.msisdn'          => ['required', 'max:8', 'unique:rsos,sr_no'],
            'selling_price'     => ['required', 'min: 3', 'max: 50', 'string'],
            '*.selling_price'   => ['required', 'min: 3', 'max: 50', 'string'],
            'bp_flag'           => ['required', 'min: 3', 'max: 50', 'string'],
            '*.bp_flag'         => ['required', 'min: 3', 'max: 50', 'string'],
            'bp_number'         => ['required'],
            '*.bp_number'       => ['required'],
        ];
    }
}
