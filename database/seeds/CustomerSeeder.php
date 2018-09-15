<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->truncate();
        DB::table('customers')->insert([
            [
                'fullname' => 'Majd Alhayek',
                'personal_identification_number' => str_random(10),
                'driver_license_number' => str_random(15),
                'birth_date' => $this->getDate('-20 years'),
                'driver_license_issue_date' => $this->getDate('+5 years'),
                'driver_license_experation_date' => $this->getDate('+4 years'),
                'phone' => '702-499-3350',
                'is_black_listed' => 0,
            ],
            [
                'fullname' => 'Jaylen Alhayek',
                'personal_identification_number' => str_random(10),
                'driver_license_number' => str_random(15),
                'birth_date' => $this->getDate('-20 years'),
                'driver_license_issue_date' => $this->getDate('-5 years'),
                'driver_license_experation_date' => $this->getDate('+4 years'),
                'phone' => '702-499-3350',
                'is_black_listed' => 0,
            ],
            [
                'fullname' => 'Jace Alhayek',
                'personal_identification_number' => str_random(10),
                'driver_license_number' => str_random(15),
                'birth_date' => $this->getDate('-20 years'),
                'driver_license_issue_date' => $this->getDate('-5 years'),
                'driver_license_experation_date' => $this->getDate('+4 years'),
                'phone' => '702-499-3350',
                'is_black_listed' => 0,
            ],
            [
                'fullname' => 'Areen Alhayek',
                'personal_identification_number' => str_random(10),
                'driver_license_number' => str_random(15),
                'birth_date' => $this->getDate('-20 years'),
                'driver_license_issue_date' => $this->getDate('-5 years'),
                'driver_license_experation_date' => $this->getDate('+4 years'),
                'phone' => '702-499-3350',
                'is_black_listed' => 0,
            ],
        ]);

    }

    /**
     * Get new data from a giving string
     *
     * @param string $str
     *
     * @return date
     */
    protected function getDate($str = 'now')
    {
        return date('Y-m-d H:i:s', strtotime($str));
    }
}
