<?php


namespace Accounts\Repositories;

use App\User;
use File;
use Spatie\Permission\Models\Role;
use Hash;

class UserRepository implements UserRepositoryInterface
{
    public function allData(){
        $users = User::all();
        return $users;
    }

    public function getDataId($id){
        return User::findOrfail($id);
    }

    public function saveData($request)
    {
        $user = new User();

        $pathImage = public_path().'/uploads/backend/users/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);
        if ($request->hasFile('avatar')){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->move($pathImage, $imageName);
            $user->avatar = $imageName;
        }else{
            $user->avatar = 'avatar.png';
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->publish = $request->publish;
        $user->bio = json_encode($request->bio);
        $user->password = Hash::make($request->password);
        $user->save();

        foreach ($request->roles as $role) {
            $roleName = Role::findOrfail($role);
            $user->assignRole($roleName->name);
        }


    }

    public function updateData($request,$id)
    {
        $user = $this->getDataId($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->publish = $request->publish;
        $user->bio = json_encode($request->bio);


        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $pathImage = public_path().'/uploads/backend/users/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->hasFile('avatar')){
            if($user->avatar != 'avatar.png'){
                $image_path = public_path($user->avatar);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->move($pathImage, $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        if (isset($request->roles)) {
            foreach ($request->roles as $role) {
                $roleName = Role::findOrfail($role);
                $user->syncRoles($roleName->name);
            }
        }


    }

    public function deleteData($id)
    {
        $user = $this->getDataId($id);
        if($user->avatar != 'avatar.png'){
            $image_path = public_path($user->avatar);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $user->delete();

    }
}
