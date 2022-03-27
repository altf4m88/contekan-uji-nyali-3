<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();

        $users = [
            [
                'employee_name' => 'Admin Pengaduan',
                'username' => 'AdminPengaduan',
                'password' => Hash::make('UKK2022'),
                'role' => Employee::ADMIN,
            ],
            [
                'employee_name' => 'Petugas 1',
                'username' => 'PetugasPengaduan',
                'password' => Hash::make('UKK2022'),
                'role' => Employee::EMPLOYEE,
            ],
        ];

        foreach ($users as $user) {
            $employee = new Employee;

            $employee->employee_name = $user['employee_name'];
            $employee->username = $user['username'];
            $employee->password = $user['password'];
            $employee->role = $user['role'];

            $employee->save();
        }
    }
}
