<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BrandsSeeder::class);
        $this->call(VehicleSizesSeeder::class);
        $this->call(VehiclesSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
