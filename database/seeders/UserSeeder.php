<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignkeyConstraints();
        User::truncate();
        Schema::enableForeignkeyConstraints();
        
        $data = [
            [
                'name' => 'Naufal',
                'role_id' => 1,
                'email' => 'naufal@gmail.com',
                'password' => 'almer123'
            ],
        ];
        
         foreach ($data as $value){
            User::insert($value);
        }
    }
}
