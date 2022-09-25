<?php

namespace Pets\Controllers;

use App\Http\Controllers\Controller;
use Pets\Repositories\PetRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PetsController extends Controller
{
    public $path;
    private $petRepository;

    public function __construct(PetRepository $petRepository)
    {
        $this->middleware('auth');
        $this->path = 'Pets::';
        $this->petRepository = $petRepository;
    }

    public function index()
    {
        $title = transWord('Pets');
        $pages = [
            [transWord('Pets'),'pets']
        ];
        $pets = $this->petRepository->allData();
        return view($this->path.'index',compact('pets','pages','title'));
    }

    public function create()
    {
        $title = transWord('Create New Pet');
        $pages = [
            [transWord('Pets'),'pets'],
            [transWord('Create New Pet'),'create_pets']
        ];
        $types = $this->petRepository->allTypes();
        $users = $this->petRepository->allUsers();
        return view($this->path.'create',compact('types','pages','title','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'location' => 'required',
            'pet_lat' => 'required',
            'pet_long' => 'required',
            'age' => 'required',
            'nationality' => 'required',
            'available_match' => 'required',
        ]);

        $this->petRepository->saveData($request,null);
        return redirect()->route('pets')->with('success');
    }

    public function show($id)
    {
        $title =transWord('Show Pet Data');
        $pet = $this->petRepository->getDataId($id);
        $pages = [
            [transWord('Pets'),'pets'],
            [$pet->name,'']
        ];
        $gallery = $this->petRepository->viewGallery($id);
        return view($this->path.'show',compact('pet','pages','title','gallery'));
    }

    public function edit($id)
    {
        $title =transWord('Edit Pet Data');
        $pet = $this->petRepository->getDataId($id);
        $showUrl = route('show_pets', ['id'=>$pet->id]);
        $pages = [
            [transWord('Pets'),'pet'],
            [$pet->name,['show_pet',$pet->id]]
        ];
        $types = $this->petRepository->allTypes();
        $users = $this->petRepository->allUsers();
        return view($this->path.'edit',compact('pet','types','pages','title','users'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'location' => 'required',
            'pet_lat' => 'required',
            'pet_long' => 'required',
            'age' => 'required',
            'nationality' => 'required',
            'available_match' => 'required',
        ]);

        $this->petRepository->saveData($request,$id);
        return redirect()->route('pets')->with('success','');
    }

    public function destroy($id)
    {
        $this->petRepository->deleteData($id);
        return redirect()->route('pets')->with('success','');
    }

    public function gallery($id)
    {
        $title =transWord('Pet Gallery');
        $pet = $this->petRepository->getDataId($id);
        $showUrl = route('show_pets', ['id'=>$pet->id]);
        $pages = [
            [transWord('Pets'),'pet'],
            [$pet->name,['show_pet',$pet->id]]
        ];
        $gallery = $this->petRepository->viewGallery($id);
        return view($this->path.'gallery',compact('pet','pages','title','gallery'));
    }

    public function viewGallery($id)
    {
        $this->petRepository->viewGallery($id);
    }

    public function uploadGallery(Request $request,$id)
    {
        $this->petRepository->uploadGallery($request,$id);
    }

    public function destroyMedia($id)
    {
        $this->petRepository->deleteMediaData($id);
        return back()->with('success','');
    }
}
