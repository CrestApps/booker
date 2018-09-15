<?php

use Illuminate\Database\Seeder;

class VehicleSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_sizes')->truncate();
        DB::table('vehicle_sizes')->insert([
            [
                'name' => 'Full-Size',
            ],
            [
                'name' => 'Mid-Size',
            ],
        ]);
    }
}
