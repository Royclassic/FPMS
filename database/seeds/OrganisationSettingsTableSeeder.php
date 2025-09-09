<?php

use Illuminate\Database\Seeder;
use App\Setting;
use App\Currency;
use Illuminate\Support\Facades\DB;


class OrganisationSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('organisation_settings')->truncate();
        $organisationSettings = [
            'company_name' => 'PFPMS',
            'company_email' => 'company@email.com',
            'company_phone' => '1234567891',
            'logo' => null,
            'login_background' => null,
            'address' => 'Company address',
            'website' => 'www.domain.com',
            'timezone' => 'Asia/Kolkata',
            'date_format' => 'd-m-Y',
            'time_format' => 'h:i a',
            'locale' => 'en',
            'latitude' => 26.91243360,
            'longitude' => 75.78727090,
            'active_theme' => 'default',
            'last_updated_by' => null,
            'created_at' => '2019-12-10 05:49:11',
            'updated_at' => '2019-12-10 05:49:11',
        ];

        DB::table('organisation_settings')->insert($organisationSettings);
    }

}
