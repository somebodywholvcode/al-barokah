<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignkeyConstraints();
        Roles::truncate();
        Schema::enableForeignkeyConstraints();
        
        $data = [
            ["role" => "Admin"],
            ["role" => "Staff"],
        ];
        
        foreach ($data as $value){
            Roles::insert($value);
        }
    }
}
