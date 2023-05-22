<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // TABEL USER
        DB::table('role')->insert([
            'role_nama' => "Gold",
            'role_harga' => 750000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('role')->insert([
            'role_nama' => "Silver",
            'role_harga' => 500000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('role')->insert([
            'role_nama' => "Bronze",
            'role_harga' => 250000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('role')->insert([
            'role_nama' => "Admin",
            'role_harga' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        // TABEL USER
        DB::table('user')->insert([
            'user_email' => "ghofur@gymmvc.com",
            'user_nama' => "ghofur",
            'user_password' => bcrypt("ghofur"),
            'user_nik' => "3501258789654632520",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546580",
            'user_role' => "admin",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user')->insert([
            'user_email' => "wilsin@gymmvc.com",
            'user_nama' => "wilsin",
            'user_password' => bcrypt("wilsin"),
            'user_nik' => "3501258789654632521",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546581",
            'user_role' => "Gold",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user')->insert([
            'user_email' => "kindly@gymmvc.com",
            'user_nama' => "kindly",
            'user_password' => bcrypt("kindly"),
            'user_nik' => "3501258789654632522",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546582",
            'user_role' => "Silver",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user')->insert([
            'user_email' => "joger@gymmvc.com",
            'user_nama' => "joger",
            'user_password' => bcrypt("joger"),
            'user_nik' => "3501258789654632523",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546583",
            'user_role' => "Bronze",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
