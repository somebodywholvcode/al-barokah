<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Santri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignkeyConstraints();
        Santri::truncate();
        Schema::enableForeignkeyConstraints();
        
        $data = [
            [
                'nama_santri' => 'Naufal',
                'gender' => 'L',
                'kelas' => 1,
            ],
            [
                'nama_santri' => 'Muhammad',
                'gender' => 'L',
                'kelas' => 1,
            ],
            [
                'nama_santri' => 'Almer',
                'gender' => 'L',
                'kelas' => 1,
            ],

        ];
        
        foreach ($data as $value){
            $value["created_at"] = Carbon::now();
            $value["created_at"] = Carbon::now();
            Santri::insert($value);
        }
    }
}
