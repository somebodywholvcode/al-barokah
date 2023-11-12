<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignkeyConstraints();
        Kelas::truncate();
        Schema::enableForeignkeyConstraints();
        
        $data = [
            ["nama_kelas" => "DTA 1"],
            ["nama_kelas" => "DTA 2"],
            ["nama_kelas" => "DTA 3"],
            ["nama_kelas" => "DTA 4"],
            ["nama_kelas" => "DTA 5"],
            ["nama_kelas" => "DTA 6"],
            ["nama_kelas" => "TKQ A"],
            ["nama_kelas" => "TKQ B"],
        ];
        
        foreach ($data as $value){
            $value["created_at"] = Carbon::now();
            $value["updated_at"] = Carbon::now();
            Kelas::insert($value);
        }
    }
}
