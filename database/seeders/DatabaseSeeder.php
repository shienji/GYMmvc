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

        // TABEL ROLE
        DB::table('role')->insert([
            'role_nama' => "Gold",
            'role_harga' => 750000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_status' => "aktif",
        ]);
        DB::table('role')->insert([
            'role_nama' => "Silver",
            'role_harga' => 500000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_status' => "aktif",
        ]);
        DB::table('role')->insert([
            'role_nama' => "Bronze",
            'role_harga' => 250000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_status' => "aktif",
        ]);
        DB::table('role')->insert([
            'role_nama' => "Admin",
            'role_harga' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_status' => "aktif",
        ]);

        // TABEL USER
        DB::table('user')->insert([
            'user_email' => "ghofur@gymmvc.com",
            'user_nama' => "ghofur",
            'user_password' => bcrypt("ghofur"),
            'user_nik' => "3501258789654632520",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546580",
            'user_role' => "Admin",
            'user_status' => "Active",
            'created_at' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-01-01 01:00:00')
        ]);

        DB::table('user')->insert([
            'user_email' => "wilsin@gymmvc.com",
            'user_nama' => "wilsin",
            'user_password' => bcrypt("wilsin"),
            'user_nik' => "3501258789654632521",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546581",
            'user_role' => "Gold",
            'created_at' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-02-01 01:00:00')
        ]);

        DB::table('user')->insert([
            'user_email' => "kindly@gymmvc.com",
            'user_nama' => "kindly",
            'user_password' => bcrypt("kindly"),
            'user_nik' => "3501258789654632522",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546582",
            'user_role' => "Silver",
            'created_at' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-03-01 01:00:00')
        ]);

        DB::table('user')->insert([
            'user_email' => "joger@gymmvc.com",
            'user_nama' => "joger",
            'user_password' => bcrypt("joger"),
            'user_nik' => "3501258789654632523",
            'user_tgllahir' => "2023/01/01",
            'user_nohp' => "085232546583",
            'user_role' => "Bronze",
            'created_at' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-04-01 01:00:00')
        ]);
        DB::table('fasilitas')->insert([
            'fasilitas_nama' => "Sauna",
            'fasilitas_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('fasilitas')->insert([
            'fasilitas_nama' => "Kolam Renang",
            'fasilitas_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('fasilitas')->insert([
            'fasilitas_nama' => "Aerobic",
            'fasilitas_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('fasilitas')->insert([
            'fasilitas_nama' => "Sumba",
            'fasilitas_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('peralatan')->insert([
            'fasilitas_nama' => "Kolam Renang",
            'peralatan_nama' => "Kaca Mata renang",
            'peralatan_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('peralatan')->insert([
            'fasilitas_nama' => "Kolam Renang",
            'peralatan_nama' => "Pelampung",
            'peralatan_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('peralatan')->insert([
            'fasilitas_nama' => "Kolam Renang",
            'peralatan_nama' => "Swim Cap",
            'peralatan_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('peralatan')->insert([
            'fasilitas_nama' => "Aerobic",
            'peralatan_nama' => "Dumbel",
            'peralatan_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('peralatan')->insert([
            'fasilitas_nama' => "Aerobic",
            'peralatan_nama' => "Hula Hoop",
            'peralatan_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('peralatan')->insert([
            'fasilitas_nama' => "Sauna",
            'peralatan_nama' => "Handuk",
            'peralatan_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('pelatih')->insert([
            'pelatih_nama' => "Melvin",
            'pelatih_nik' => "1536598462156398",
            'pelatih_keahlian' => "Renang Gaya Bebas",
            'pelatih_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('pelatih')->insert([
            'pelatih_nama' => "Nicklaus",
            'pelatih_nik' => "5698745632695876",
            'pelatih_keahlian' => "Aerobic",
            'pelatih_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('pelatih')->insert([
            'pelatih_nama' => "Niko",
            'pelatih_nik' => "5963654987632695",
            'pelatih_keahlian' => "Renang Gaya Punggung",
            'pelatih_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('pelatih')->insert([
            'pelatih_nama' => "Felix",
            'pelatih_nik' => "6596654987456932",
            'pelatih_keahlian' => "Sumba",
            'pelatih_status' => "aktif",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        //event
        DB::table('event')->insert([
            'event_nama' => "Lompat Indah",
            'event_start' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-05-29 12:00:00'),
            'event_end' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-06-25 01:00:00'),
            'event_by' => "Panitia",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('event')->insert([
            'event_nama' => "Renang",
            'event_start' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-05-30 09:00:00'),
            'event_end' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-06-01 01:00:00'),
            'event_by' => "Panitia",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('event')->insert([
            'event_nama' => "Lari Marathon",
            'event_start' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-05-29 01:00:00'),
            'event_end' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-06-15 01:00:00'),
            'event_by' => "Panitia",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('event')->insert([
            'event_nama' => "Bakar Karbo Yes..!!",
            'event_start' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-06-25 06:00:00'),
            'event_end' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-07-01 01:00:00'),
            'event_by' => "Panitia",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('event')->insert([
            'event_nama' => "Balap Kurangi Lemak",
            'event_start' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-05-30 09:00:00'),
            'event_end' => Carbon::createFromFormat("Y-m-d H:i:s",'2023-06-11 01:00:00'),
            'event_by' => "Panitia",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // eventfas
        DB::table('eventfas')->insert([
            'event_id' => "1",
            'fasilitas_id' => "1",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
        ]);

        DB::table('eventfas')->insert([
            'event_id' => "2",
            'fasilitas_id' => "3",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'deleted_at' => NULL,
        ]);
    }
}
