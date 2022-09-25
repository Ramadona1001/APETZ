<?php


namespace Pets\Repositories;

use App\User;
use Pets\Models\Pet;
use File;
use Spatie\Permission\Models\Role;
use Hash;
use Pets\Models\PetGallery;
use Pets\Models\PetType;

class PetRepository implements PetRepositoryInterface
{
    public function allData(){
        $pets = Pet::all();
        return $pets;
    }

    public function getDataId($id){
        return Pet::findOrfail($id);
    }

    public function saveData($request,$id=null)
    {
        if ($id == null) {
            $pet = new Pet();
        }else{
            $pet = $this->getDataId($id);
        }
        $pet->name = $request->name;
        $pet->type_id = $request->type_id;
        $pet->gender = $request->gender;
        $pet->location = $request->location;
        $pet->pet_lat = $request->pet_lat;
        $pet->pet_long = $request->pet_long;
        $pet->age = $request->age;
        $pet->nationality = $request->nationality;
        $pet->user_id = $request->user_id;
        $pet->available_match = $request->available_match;
        $pet->publish = $request->publish;
        $pet->save();
    }

    public function allTypes()
    {
        return PetType::all();
    }

    public function allUsers()
    {
        return User::all();
    }

    public function deleteData($id)
    {
        $pet = $this->getDataId($id);
        $media = PetGallery::where('pet_id',$id)->get();
        foreach ($media as $img) {
            $media_explode = explode('/pets/',$img->media_path)[1];
            $image_path = public_path('/uploads/backend/pets/'.$media_explode);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $pet->delete();
    }

    public function viewGallery($id)
    {
        return PetGallery::where('pet_id',$id)->get();
    }

    public function uploadGallery($request,$id)
    {
        $pathImage = public_path().'/uploads/backend/pets/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);
        $gallery = new PetGallery();
        $imageName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move($pathImage, $imageName);
        $gallery->pet_id = $id;
        $gallery->media_path = $imageName;
        $gallery->save();
    }

    public function deleteMediaData($id)
    {
        $media = PetGallery::findOrfail($id);
        $media_explode = explode('/pets/',$media->media_path)[1];
        $image_path = public_path('/uploads/backend/pets/'.$media_explode);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $media->delete();
    }

}
