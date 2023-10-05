<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //if we have records, do not seed
        if (DB::table('countries')->count() > 0) {
            $this->command->info('Countries table is not empty, skipping...');
            return;
        }

        $countries = require base_path() . '/database/seeders/countries-seeder.php';
        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country['name'],
                'code' => $country['code'],
                'currency_code' => $country['currency_code'],
            ]);
        }
    }
}
