<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theme_settings')->truncate();
        $themeSettings = [
            [
                'panel' => 'admin',
                'header_color' => '#ed4040',
                'sidebar_color' => '#292929',
                'sidebar_text_color' => '#cbcbcb',
                'link_color' => '#ffffff',
                'user_css' => null,
                'created_at' => '2019-12-10 05:49:11',
                'updated_at' => '2019-12-10 05:49:11',
            ],
            [
                'panel' => 'project_admin',
                'header_color' => '#5475ed',
                'sidebar_color' => '#292929',
                'sidebar_text_color' => '#cbcbcb',
                'link_color' => '#ffffff',
                'user_css' => null,
                'created_at' => '2019-12-10 05:49:12',
                'updated_at' => '2019-12-10 05:49:12',
            ],
            [
                'panel' => 'employee',
                'header_color' => '#f7c80c',
                'sidebar_color' => '#292929',
                'sidebar_text_color' => '#cbcbcb',
                'link_color' => '#ffffff',
                'user_css' => null,
                'created_at' => '2019-12-10 05:49:12',
                'updated_at' => '2019-12-10 05:49:12',
            ],
            [
                'panel' => 'client',
                'header_color' => '#00c292',
                'sidebar_color' => '#292929',
                'sidebar_text_color' => '#cbcbcb',
                'link_color' => '#ffffff',
                'user_css' => null,
                'created_at' => '2019-12-10 05:49:12',
                'updated_at' => '2019-12-10 05:49:12',
            ],
        ];

        DB::table('theme_settings')->insert($themeSettings);
    }
}
