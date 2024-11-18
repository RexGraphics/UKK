<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Schema::disableForeignKeyConstraints();
        // User::truncate();
        // Schema::enableForeignKeyConstraints();
        $user = [
            [
                'ghazwanName' => 'ghazwan',
                'ghazwanRole' => 'admin',
                'ghazwanUsername' => 'admin',
                'ghazwanPassword' => Hash::make('12345678'),
                'ghazwanPhone' => '02345698764',
            ],
            [
                'ghazwanName' => 'ghazwin',
                'ghazwanRole' => 'petugas',
                'ghazwanUsername' => 'petugas',
                'ghazwanPassword' => Hash::make('12345678'),
                'ghazwanPhone' => '01234567890',
            ],
        ];
        foreach ($user as $value) {
            Petugas::create([
                'nama_petugas' => $value['ghazwanName'],
                'username' => $value['ghazwanUsername'],
                'password' => $value['ghazwanPassword'],
                'telp' => $value['ghazwanPhone'],
                'level' => $value['ghazwanRole'],
            ]);
        }
    }
}
