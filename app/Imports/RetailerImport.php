<?php

namespace App\Imports;

use App\Rules\Nid;
use App\Models\Rso;
use App\Models\Route;
use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class RetailerImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading
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
            'dd_house_id'       => DdHouse::firstWhere('code', $row['distributor_code'])->id,
            'supervisor_id'     => Supervisor::firstWhere('pool_number', $row['supervisor_number'])->id,
            'rso_id'            => Rso::firstWhere('itop_number', $row['i_top_up_sr_number'])->id,
            'route_id'          => Route::firstWhere('code', $row['route'])->id,
            'code'              => $row['retailer_code'],
            'name'              => $row['retailer_name'],
            'type'              => $row['retailer_type'],
            'enabled'           => $row['enabled'],
            'sim_seller'        => $row['sim_seller'],
            'itop_number'       => $row['i_top_up_number'],
            'service_point'     => $row['service_point'],
            'service_point'     => $row['category'],
            'owner_name'        => $row['owner_name'],
            'own_shop'          => $row['own_shop'],
            'contact_no'        => $row['contact_no'],
            'district'          => $row['district'],
            'thana'             => $row['thana'],
            'address'           => $row['address'],
            'nid'               => $row['nid'],
            'trade_license_no'  => $row['tradelicenseno'],
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
            'distributor_code'      => ['required'],
            '*.distributor_code'    => ['required'],
            'i_top_up_sr_number'    => ['required'],
            '*.i_top_up_sr_number'  => ['required'],
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
            'i_top_up_number'       => ['required','unique:retailers,itop_number'],
            '*.i_top_up_number'     => ['required','unique:retailers,itop_number'],
            'service_point'         => ['required'],
            '*.service_point'       => ['required'],
            'owner_name'            => ['required'],
            '*.owner_name'          => ['required'],
            'own_shop'              => ['required'],
            '*.own_shop'            => ['required'],
            'contact_no'            => ['nullable','unique:retailers,contact_no'],
            '*.contact_no'          => ['nullable','unique:retailers,contact_no'],
            'district'              => ['required'],
            '*.district'            => ['required'],
            'thana'                 => ['required'],
            '*.thana'               => ['required'],
            'address'               => ['required'],
            '*.address'             => ['required'],
            'nid'                   => ['nullable', new Nid,'unique:retailers,nid'],
            '*.nid'                 => ['nullable', new Nid,'unique:retailers,nid'],
            'tradelicenseno'        => ['nullable','unique:retailers,trade_license_no'],
            '*.tradelicenseno'      => ['nullable','unique:retailers,trade_license_no'],
        ];
    }
}
