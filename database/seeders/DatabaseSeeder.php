<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        DB::table('Users')->insert([
            'name'=>'test',
            'email'=>'test@test.te',
            'password'=>Hash::make('testtest')
        ]);

        DB::table('RfidCards')->insert([
            'uid'=>'B2 A8 3F 61',
            'userId'=>1
        ]);

        DB::table('RfidCards')->insert([
            'uid'=>'DC 33 75 32',
            'userId'=>1
        ]);

        DB::table('Doors')->insert([
            'name'=>'C-089',
            'description'=>'Local a Alain',
            'location'=>'C-089'
        ]);

        DB::table('Accesses')->insert([
            'cardUid'=>'B2 A8 3F 61',
            'doorId'=>1,
        ]);
    }
}
