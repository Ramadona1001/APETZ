<?php

use Illuminate\Database\Seeder;
use MainSettings\Models\MainSetting;

class MainSettingSeeder extends Seeder
{
    public function run()
    {
        $setting = new MainSetting();
        $setting->main_key = 'title';
        $setting->main_key = 'logo';
        $setting->main_key = 'contents';
        $setting->main_key = 'mobile';
        $setting->main_key = 'email';
        $setting->main_value = '{"en":"test","ar":"test"}';
        $setting->main_value = '{"en":"test","ar":"test"}';
        $setting->main_value = '{"en":"test","ar":"test"}';
        $setting->main_value = '{"en":"test","ar":"test"}';
        $setting->main_value = '{"en":"test","ar":"test"}';
        $setting->save();
    }
}
