<?php

namespace App\Imports;

use App\Models\DdHouse;
use App\Models\KpiTarget;
use App\Models\Rso;
use App\Models\Supervisor;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KpiTargetImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KpiTarget([
            'user_id'                           => User::firstWhere('phone', $row['dd_manager_number'])->id,
            'dd_house_id'                       => DdHouse::firstWhere('code', $row['dd_code'])->id,
            'rso_id'                            => Rso::firstWhere('itop_number', $row['rso_number'])->id,
            'supervisor_id'                     => Supervisor::firstWhere('pool_number', $row['supervisor_number'])->id,
            'ga'                                => $row['ga_target'],
            'recharge'                          => $row['recharge_target'],
            'data'                              => $row['data_target'],
            'mixed'                             => $row['mixed_bundle_target'],
            'voice'                             => $row['voice_bundle_target'],
            'total_bundle'                      => $row['total_bundle_target'],
            'lso'                               => $row['active_lso_target'],
            'sso'                               => $row['active_sso_target'],
            'bso'                               => $row['bso_target'],
            'dsso'                              => $row['dsso_target'],
            'ddso'                              => $row['daily_dso_target'],
            'dso'                               => $row['dso_target'],
            'main_house_osdo_residential_rso'   => $row['main_houseosdoresidential_rso'],
            'thana'                             => $row['thana_name'],
            'sran_rso'                          => $row['sran_rs0'],
            'sran_site_count'                   => $row['sran_site_count'],
            'remarks'                           => $row['remarks'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'dd_code' => ['required'],
            // Above is alias for as it always validates in batches
            '*.dd_code' => ['required'],

            'rso_number' => ['required'],
            // Above is alias for as it always validates in batches
            '*.rso_number' => ['required'],

            'supervisor_number' => ['required'],
            // Above is alias for as it always validates in batches
            '*.supervisor_number' => ['required'],

            'dd_manager_number' => ['required'],
            // Above is alias for as it always validates in batches
            '*.dd_manager_number' => ['required'],

            'ga_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.ga_target' => ['required'],

            'recharge_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.recharge_target' => ['required'],

            'data_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.data_target' => ['required'],

            'mixed_bundle_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.mixed_bundle_target' => ['required'],

            'voice_bundle_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.voice_bundle_target' => ['required'],

            'total_bundle_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.total_bundle_target' => ['required'],

            'active_lso_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.active_lso_target' => ['required'],

            'bso_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.bso_target' => ['required'],

            'active_sso_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.active_sso_target' => ['required'],

            'dsso_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.dsso_target' => ['required'],

            'daily_dso_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.daily_dso_target' => ['required'],

            'dso_target' => ['required'],
            // Above is alias for as it always validates in batches
            '*.dso_target' => ['required'],
        ];
    }
}
