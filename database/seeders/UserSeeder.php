<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat data user langsung dalam seeder
        $userData = [
            [
                'name' => 'UKM Lumut',
                'email' => 'ukmexplant@polije.ac.id',
                'ketua' => 'Bayu Samudra',
                'password' => bcrypt('321321'),
            ],
            [
                'name' => 'UKM Pramuka',
                'email' => 'ukmpramuka@polije.ac.id',
                'ketua' => 'Dani Darmawan',
                'password' => bcrypt('123123'),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Simpan data baru ke dalam tabel user dengan menggunakan create
        foreach ($userData as $data) {
            User::create($data);
        }
    }
}
