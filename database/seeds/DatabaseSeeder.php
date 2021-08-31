<?php

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
        // $this->call(UserSeeder::class);
        DB::table('admins')->insert([
            'name' => 'Md. Jubair Admin',
            'email' => 'jubir.hosn@gmail.com',
            'username' => 'jubair_admin_e3r4t5y6u7q',
            'password' => Hash::make('cC@dm|n20>Jh'),
            'level' => '0',
            'status' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('admins')->insert([
            'name' => 'Md. Sami Admin',
            'email' => 'shah.sami77@gmail.com',
            'username' => 'sami_admin_awse234rfd1',
            'password' => Hash::make('cC@dm|n20>Ms'),
            'level' => '0',
            'status' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('admins')->insert([
            'name' => 'Administrator',
            'email' => 'admin@codecarigor.com',
            'username' => 'administrator_st257yg34rd',
            'password' => Hash::make('cC@dm|n20>%'),
            'level' => '1',
            'status' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('company_infos')->insert([
            'about' => '0',
            'tnc' => '0',
            'ppy' => '0',
            'faq' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('social_platforms')->insert([
            'platform' => 'Facebook',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('social_platforms')->insert([
            'platform' => 'Twitter',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('social_platforms')->insert([
            'platform' => 'TikTok',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('social_platforms')->insert([
            'platform' => 'Instagram',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('social_platforms')->insert([
            'platform' => 'Twitch',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Other',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Actors',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Comedians',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Creators',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Entrepreneurs',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Influencers',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Models',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Musicians',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'category' => 'Sports',
            'show' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
