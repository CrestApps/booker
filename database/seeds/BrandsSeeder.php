<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->truncate();
        DB::table('brands')->insert([
            [
                'name' => 'Kia',
            ],
            [
                'name' => 'BMW',
            ],
            [
                'name' => 'Buick',
            ],
            [
                'name' => 'GMC',
            ],
            [
                'name' => 'Chevy',
            ],
            [
                'name' => 'Ford',
            ],
            [
                'name' => 'Nissan',
            ],
        ]);
    }
}
