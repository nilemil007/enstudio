<?php

namespace App\Imports;

use App\Models\User;
use App\Models\DdHouse;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, ShouldQueue, WithChunkReading
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|User|null
     */
    public function model(array $row): Model|User|null
    {
        return new User([
            'dd_house'  => DdHouse::firstWhere('code', $row['dd_code'])->id,
            'name'      => $row['name'],
            'username'  => $row['username'],
            'phone'     => $row['phone'],
            'email'     => $row['email'],
            'role'      => $row['role'],
            'password'  => $row['password'],
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
            'dd_code' => ['required'],
            // Above is alias for as it always validates in batches
            '*.dd_code' => ['required'],

            'name' => ['required', 'min:3', 'max:100',],
            // Above is alias for as it always validates in batches
            '*.name' => ['required', 'min:3', 'max:100',],

            'username' => ['required', 'min:3', 'max:30', 'unique:users,username',],
            // Above is alias for as it always validates in batches
            '*.username' => ['required', 'min:3', 'max:30', 'unique:users,username',],

            'phone' => ['required', 'numeric', 'digits:11', 'starts_with:01', 'unique:users,phone',],
            // Above is alias for as it always validates in batches
            '*.phone' => ['required', 'numeric', 'digits:11', 'starts_with:01', 'unique:users,phone',],

            'email' => ['required', 'email', 'unique:users,email',],
            // Above is alias for as it always validates in batches
            '*.email' => ['required', 'email', 'unique:users,email',],

            'role' => ['required'],
            // Above is alias for as it always validates in batches
            '*.role' => ['required'],

            'password' => ['required'],
            // Above is alias for as it always validates in batches
            '*.password' => ['required'],
        ];
    }
}
