<?php

namespace Database\Seeders;

use App\Models\MasterSetting;
use Illuminate\Database\Seeder;

class MasterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $master=MasterSetting::create([
            'application_name' => 'Name',
            'application_title' => 'Title',
            'app_logo' => 'logo',
            'favicon' => 'favicon',
            'mobile' => '',
            'email_id' => 'sample@gmail.com',
            'currency_symbol' => 'sample@gmail.com',
            'tax_percentage' => '18',
            'payrun_period' => '1',
            'total_paid_leave' => '15',
            'country' => 'India',
            'state' => 'Kerala',
            'district' => '',
            'pincode' => '',
            'address' => ''
        ]);
    }
}
