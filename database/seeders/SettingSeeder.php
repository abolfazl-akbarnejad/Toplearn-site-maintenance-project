<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'title' => 'فروشگاه من',
            'description' => 'فروشگاه من',
            'keywords' => 'کلمات کلیدی',
            'icon' => 'fa fa-cogs',
            'logo' => 'fa fa-cogs',
        ]);
    }
}
