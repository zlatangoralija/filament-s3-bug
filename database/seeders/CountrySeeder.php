<?php

namespace Database\Seeders;

use App\Models\Country;
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
            if(isset($country->postal) && isset($country->name->common)){
                Country::create([
                    'name' => $country->name->common,
                    'code' => $country->postal,
                    'currency_code' => $country->currencies[0] ?? 'EUR',
                ]);
            }
        }
    }
}
