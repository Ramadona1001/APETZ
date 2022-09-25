<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Ahmed';
        $user->last_name = 'Ramadan';
        $user->password = \Hash::make('password');
        $user->email = 'admin@admin.com';
        $user->avatar = 'avatar.png';
        $user->mobile = '0123456789';
        $user->gender = 'Male';
        $user->birthdate = '1/1/1991';
        $user->address = 'Cairo';
        $user->bio = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum";
        $user->publish = 1;
        $user->save();

        if(Role::where('name','Admin')->get()->count() == 0){
            Role::create(['name' => 'Admin']);
            $user->assignRole('Admin');
        }else{
            $user->assignRole('Admin');
        }
    }
}
