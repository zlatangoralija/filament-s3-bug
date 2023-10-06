<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PragmaRX\Countries\Package\Countries;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = new Countries();
        $allCountries = $countries->all();


        foreach ($allCountries as $country) {
            $commonName = $country->name->common;
            $currencyCode = $country->currencies[0] ?? 'EUR';
            $code = $country['postal'] ?? 'N/A';

            DB::table('countries')->insert([
                'name' => $commonName,
                'code' => $code,
                'currency_code' => $currencyCode,
            ]);
        }
    }
}
