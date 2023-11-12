<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\ThnSPP;
use Carbon\Carbon;

class ThnSPPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignkeyConstraints();
        ThnSPP::truncate();
        Schema::enableForeignkeyConstraints();
        
        $data = [
           [
                'tahun' => 2023,
                'nominal' => 150000,
            ],
        ];
        
        foreach ($data as $value){
            $value["created_at"] = Carbon::now();
            $value["updated_at"] = Carbon::now();
            ThnSPP::insert($value);
        }
    }
}
