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
            'dd_code'           => ['required'],
            '*.dd_code'         => ['required'],
            'supervisor'        => ['required'],
            '*.supervisor'      => ['required'],
            'routes'            => ['required'],
            '*.routes'          => ['required'],
            'rso_code'          => ['required', 'max:10', 'unique:rsos,rso_code'],
            '*.rso_code'        => ['required', 'max:10', 'unique:rsos,rso_code'],
            'itop_number'       => ['required', 'numeric', 'digits: 11', 'unique:rsos,itop_number'],
            '*.itop_number'     => ['required', 'numeric', 'digits: 11', 'unique:rsos,itop_number'],
            'pool_number'       => ['required', 'numeric', 'digits: 11', 'unique:rsos,pool_number'],
            '*.pool_number'     => ['required', 'numeric', 'digits: 11', 'unique:rsos,pool_number'],
            'personal_number'   => ['required', 'numeric', 'digits: 11', 'unique:rsos,personal_number'],
            '*.personal_number' => ['required', 'numeric', 'digits: 11', 'unique:rsos,personal_number'],
            'rid'               => ['required', 'unique:rsos,rid'],
            '*.rid'             => ['required', 'unique:rsos,rid'],
            'sr_no'             => ['required', 'max:8', 'unique:rsos,sr_no'],
            '*.sr_no'           => ['required', 'max:8', 'unique:rsos,sr_no'],
            'father_name'       => ['required', 'min: 3', 'max: 50', 'string'],
            '*.father_name'     => ['required', 'min: 3', 'max: 50', 'string'],
            'mother_name'       => ['required', 'min: 3', 'max: 50', 'string'],
            '*.mother_name'     => ['required', 'min: 3', 'max: 50', 'string'],
            'division'          => ['required'],
            '*.division'        => ['required'],
            'district'          => ['required'],
            '*.district'        => ['required'],
            'thana'             => ['required'],
            '*.thana'           => ['required'],
            'address'           => ['required', 'max: 200'],
            '*.address'         => ['required', 'max: 200'],
            'blood_group'       => ['required'],
            '*.blood_group'     => ['required'],
            'account_number'    => ['required', 'unique:rsos,account_number'],
            '*.account_number'  => ['required', 'unique:rsos,account_number'],
            'bank_name'         => ['required'],
            '*.bank_name'       => ['required'],
            'brunch_name'       => ['required'],
            '*.brunch_name'     => ['required'],
            'routing_number'    => ['required', 'numeric'],
            '*.routing_number'  => ['required', 'numeric'],
            'salary'            => ['required', 'numeric'],
            '*.salary'          => ['required', 'numeric'],
            'education'         => ['required'],
            '*.education'       => ['required'],
            'marital_status'    => ['required'],
            '*.marital_status'  => ['required'],
            'gender'            => ['required'],
            '*.gender'          => ['required'],
            'date_of_birth'     => ['required'],
            '*.date_of_birth'   => ['required'],
            'nid'               => ['required', 'numeric', new Nid, 'unique:rsos,nid',],
            '*.nid'             => ['required', 'numeric', new Nid, 'unique:rsos,nid',],
            'residential_rso'   => ['required'],
            '*.residential_rso' => ['required'],
            'joining_date'      => ['required'],
            '*.joining_date'    => ['required'],
        ];
    }
}
