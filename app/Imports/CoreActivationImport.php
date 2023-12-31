<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use App\Models\DdHouse;
use App\Models\Retailer;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Activation\CoreActivation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Events\ImportFailed;

class CoreActivationImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|CoreActivation|null
     */
    public function model(array $row): Model|CoreActivation|null
    {
        return new CoreActivation([
            'activation_date'   => Carbon::parse($row['activation_date'])->toDateString(),
            'dd_house_id'       => DdHouse::firstWhere('code', $row['distributor_code'])->id,
            'retailer_id'       => Retailer::firstWhere('code', $row['retailer_code'])->id,
            'supervisor_id'     => Retailer::firstWhere('code', $row['retailer_code'])->supervisor_id,
            'rso_id'            => Retailer::firstWhere('code', $row['retailer_code'])->rso_id,
            'product_code'      => $row['product_code'],
            'product_name'      => $row['product_name'],
            'sim_serial'        => $row['sim_no'],
            'msisdn'            => $row['msisdn'],
            'selling_price'     => $row['selling_price'],
            'bp_flag'           => $row['bp_flag'],
            'bp_number'         => $row['bp_number'],
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
            'activation_date'       => ['required'],
            '*.activation_date'     => ['required'],
            'distributor_code'      => ['required'],
            '*.distributor_code'    => ['required'],
            'retailer_code'         => ['required'],
            '*.retailer_code'       => ['required'],
            'product_code'          => ['required'],
            '*.product_code'        => ['required'],
            'product_name'          => ['required'],
            '*.product_name'        => ['required'],
            'sim_no'                => ['required', 'unique:core_activations,sim_serial'],
            '*.sim_no'              => ['required', 'unique:core_activations,sim_serial'],
            'msisdn'                => ['required'],
            '*.msisdn'              => ['required'],
            'selling_price'         => ['required'],
            '*.selling_price'       => ['required'],
        ];
    }
}
