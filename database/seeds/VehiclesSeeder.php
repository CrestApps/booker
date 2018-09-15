<?php

use Illuminate\Database\Seeder;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->truncate();
        DB::table('vehicles')->insert([
            [
                'name' => 'Kia Rio',
                'size_id' => 1,
                'brand_id' => 1,
                'year' => 2017,
                'last_oil_change' => '2017-01-01 00:00:00',
                'registration_experation_on' => '2017-01-01 00:00:00',
                'insurance_experation_on' => '2017-01-01 00:00:00',
                'daily_rate' => 80,
                'weekly_rate' => 70,
                'monthly_rate' => 50,
                'is_active' => 1,
                'vin_number' => str_random(25),
                'licence_plate' => str_random(6),
            ],
            [
                'name' => 'Kia Sportage',
                'size_id' => 1,
                'brand_id' => 1,
                'year' => 2018,
                'last_oil_change' => '2017-01-01 00:00:00',
                'registration_experation_on' => '2017-01-01 00:00:00',
                'insurance_experation_on' => '2017-01-01 00:00:00',
                'daily_rate' => 80,
                'weekly_rate' => 70,
                'monthly_rate' => 50,
                'is_active' => 1,
                'vin_number' => str_random(25),
                'licence_plate' => str_random(6),
            ],
            [
                'name' => 'Kia Forte',
                'size_id' => 1,
                'brand_id' => 1,
                'year' => 2016,
                'last_oil_change' => '2017-01-01 00:00:00',
                'registration_experation_on' => '2017-01-01 00:00:00',
                'insurance_experation_on' => '2017-01-01 00:00:00',
                'daily_rate' => 80,
                'weekly_rate' => 70,
                'monthly_rate' => 50,
                'is_active' => 1,
                'vin_number' => str_random(25),
                'licence_plate' => str_random(6),
            ],
            [
                'name' => 'Kia Sorento',
                'size_id' => 1,
                'brand_id' => 1,
                'year' => 2019,
                'last_oil_change' => '2017-01-01 00:00:00',
                'registration_experation_on' => '2017-01-01 00:00:00',
                'insurance_experation_on' => '2017-01-01 00:00:00',
                'daily_rate' => 80,
                'weekly_rate' => 70,
                'monthly_rate' => 50,
                'is_active' => 1,
                'vin_number' => str_random(25),
                'licence_plate' => str_random(6),
            ],
        ]);
    }
}
