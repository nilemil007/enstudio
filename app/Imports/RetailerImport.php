<?php

namespace App\Imports;

use App\Models\Retailer;
use App\Models\Rso;
use App\Rules\Nid;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RetailerImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|Retailer|null
     */
    public function model(array $row): Model|Retailer|null
    {
        return new Retailer([
            'dd_house'          => $row['dd_code'],
            'code'              => $row['retailer_code'],
            'name'              => $row['retailer_name'],
            'type'              => $row['retailer_type'],
            'enabled'           => $row['enabled'],
            'sim_seller'        => $row['sim_seller'],
            'supervisor'        => $row['supervisor_number'],
            'rso_id'            => Rso::firstWhere('itop_number', $row['rso_number'])->id,
            'itop_number'       => $row['itop_number'],
            'service_point'     => $row['service_point'],
            'owner_name'        => $row['owner_name'],
            'own_shop'          => $row['own_shop'],
            'contact_no'        => $row['contact_number'],
            'district'          => $row['district'],
            'thana'             => $row['thana'],
            'address'           => $row['address'],
            'nid'               => $row['nid'],
            'trade_license_no'  => $row['trade_license'],
            'route'             => $row['route'],
            'password'          => $row['password'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'dd_code'               => ['required'],
            '*.dd_code'             => ['required'],
            'retailer_code'         => ['required','unique:retailers,code'],
            '*.retailer_code'       => ['required','unique:retailers,code'],
            'retailer_name'         => ['required'],
            '*.retailer_name'       => ['required'],
            'retailer_type'         => ['required'],
            '*.retailer_type'       => ['required'],
            'enabled'               => ['required'],
            '*.enabled'             => ['required'],
            'sim_seller'            => ['required'],
            '*.sim_seller'          => ['required'],
            'supervisor_number'     => ['required'],
            '*.supervisor_number'   => ['required'],
            'rso_number'            => ['required'],
            '*.rso_number'          => ['required'],
            'itop_number'           => ['required','unique:retailers,itop_number'],
            '*.itop_number'         => ['required','unique:retailers,itop_number'],
            'service_point'         => ['required'],
            '*.service_point'       => ['required'],
            'owner_name'            => ['required'],
            '*.owner_name'          => ['required'],
            'own_shop'              => ['required'],
            '*.own_shop'            => ['required'],
            'contact_number'        => ['required','unique:retailers,contact_no'],
            '*.contact_number'      => ['required','unique:retailers,contact_no'],
            'district'              => ['required'],
            '*.district'            => ['required'],
            'thana'                 => ['required'],
            '*.thana'               => ['required'],
            'address'               => ['required'],
            '*.address'             => ['required'],
            'nid'                   => ['required', new Nid,'unique:retailers,nid'],
            '*.nid'                 => ['required', new Nid,'unique:retailers,nid'],
            'trade_license'         => ['nullable','unique:retailers,trade_license_no'],
            '*.trade_license'       => ['nullable','unique:retailers,trade_license_no'],
            'route'                 => ['required'],
            '*.route'               => ['required'],
            'password'              => ['nullable'],
            '*.password'            => ['nullable'],
        ];
    }
}
