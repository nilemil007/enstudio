<?php

namespace App\Imports;

use App\Models\Rso;
use App\Models\User;
use App\Rules\Nid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RsoImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|Rso|null
     */
    public function model(array $row): Model|Rso|null
    {
        return new Rso([
            'dd_house'          => $row['dd_code'],
            'supervisor'        => $row['supervisor'],
            'routes'            => $row['routes'],
            'rso_code'          => $row['rso_code'],
            'itop_number'       => $row['itop_number'],
            'pool_number'       => $row['pool_number'],
            'personal_number'   => $row['personal_number'],
            'rid'               => $row['rid'],
            'sr_no'             => $row['sr_no'],
            'father_name'       => $row['father_name'],
            'mother_name'       => $row['mother_name'],
            'division'          => $row['division'],
            'district'          => $row['district'],
            'thana'             => $row['thana'],
            'address'           => $row['address'],
            'blood_group'       => $row['blood_group'],
            'account_number'    => $row['account_number'],
            'bank_name'         => $row['bank_name'],
            'brunch_name'       => $row['brunch_name'],
            'routing_number'    => $row['routing_number'],
            'salary'            => $row['salary'],
            'education'         => $row['education'],
            'marital_status'    => $row['marital_status'],
            'gender'            => $row['gender'],
            'dob'               => Carbon::instance(Date::excelToDateTimeObject($row['date_of_birth']))->toDateString(),
            'nid'               => $row['nid'],
            'residential_rso'   => $row['residential_rso'],
            'joining_date'      => Carbon::instance(Date::excelToDateTimeObject($row['joining_date']))->toDateString(),
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
