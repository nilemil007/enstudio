<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
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
            'name'      => $row['name'],
            'username'  => $row['username'],
            'phone'     => $row['phone'],
            'email'     => $row['email'],
            'role'      => $row['role'],
            'password'  => $row['password'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
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
