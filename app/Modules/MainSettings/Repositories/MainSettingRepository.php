<?php


namespace MainSettings\Repositories;

use MainSettings\Models\MainSetting;
use File;

class MainSettingRepository implements MainSettingRepositoryInterface
{
    public function allData(){
        return MainSetting::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return MainSetting::$wheres->get();
    }

    public function getDataId($id){
        return MainSetting::findOrfail($id);
    }

    public function saveData($request)
    {
        $lang = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();

        $pathImage = public_path().'/uploads/backend/settings/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);
        $inputs = $request->all();
        $settings = $this->allData();
        foreach ($settings as $setting){
            $main = MainSetting::where('main_key',$setting->main_key)->first();

            if ($setting->main_key == 'logo') {
                if ($request->logo) {
                    foreach ($request->logo as $key => $value) {
                        $logos = (array)json_decode($setting->main_value);
                        $imageName = $key.'_logo.'.$value->getClientOriginalExtension();
                        $value->move($pathImage, $imageName);
                        $logos[$key] = $imageName;
                    }
                    $logo = json_encode($logos);
                    $main->main_value = $logo;
                }
            }elseif ($setting->main_key == 'icon') {
                if ($request->icon) {
                    foreach ($request->icon as $key => $value) {
                        $icons = (array)json_decode($setting->main_value);
                        $imageName = $key.'_icon.'.$value->getClientOriginalExtension();
                        $value->move($pathImage, $imageName);
                        $icons[$key] = $imageName;
                    }
                    $icon = json_encode($icons);
                    $main->main_value = $icon;
                }
            }else{
                $data = [];
                foreach ($lang as $lan)
                {
                    $data[$lan] = $inputs[$setting->main_key][$lan];
                }
                $main->main_value = json_encode($data);
            }
            $main->save();
        }
    }
}
