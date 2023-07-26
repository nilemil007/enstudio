<?php

namespace App\Imports;

use App\Models\Bts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BtsImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|Bts|null
     */
    public function model(array $row): Model|Bts|null
    {
        return new Bts([
            'dd_house'              => $row['dd_code'],
            'site_id'               => $row['site_id'],
            'bts_code'              => $row['bts_code'],
            'division'              => $row['division'],
            'district'              => $row['district'],
            'thana'                 => $row['thana'],
            'address'               => $row['address'],
            'network_mode'          => $row['network_mode'],
            'longitude'             => $row['longitude'],
            'latitude'              => $row['latitude'],
            'two_g_on_air_date'     => Carbon::instance(Date::excelToDateTimeObject($row['2g_on_air_date'] ?? ''))->toDateString(),
            'three_g_on_air_date'   => Carbon::instance(Date::excelToDateTimeObject($row['3g_on_air_date'] ?? ''))->toDateString(),
            'four_g_on_air_date'    => Carbon::instance(Date::excelToDateTimeObject($row['4g_on_air_date'] ?? ''))->toDateString(),
            'urban_rural'           => $row['urban_rural'],
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
            'site_id'           => ['required','starts_with:DHK_','unique:bts,site_id','max:12',],
            '*.site_id'         => ['required','starts_with:DHK_','unique:bts,site_id','max:12',],
            'bts_code'          => ['required','starts_with:DHK','unique:bts,bts_code','alpha_num','max:10',],
            '*.bts_code'        => ['required','starts_with:DHK','unique:bts,bts_code','alpha_num','max:10',],
            'division'          => ['required','string','max:15',],
            '*.division'        => ['required','string','max:15',],
            'district'          => ['required','string','max:20'],
            '*.district'        => ['required','string','max:20'],
            'thana'             => ['required','string','max:20'],
            '*.thana'           => ['required','string','max:20'],
            'address'           => ['required','string'],
            '*.address'         => ['required','string'],
            'network_mode'      => ['required','string','max:10'],
            '*.network_mode'    => ['required','string','max:10'],
            'longitude'         => ['required'],
            '*.longitude'       => ['required'],
            'latitude'          => ['required'],
            '*.latitude'        => ['required'],
            '2g_on_air_date'    => ['required'],
            '*.2g_on_air_date'  => ['required'],
            'urban_rural'       => ['required','string','max:20'],
            '*.urban_rural'     => ['required','string','max:20'],
        ];
    }
}
