<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Projects\Models\Project;

class CompareDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $results = Project::where('title','like','%'.$this->search.'%')->get();
        return view('livewire.compare-dropdown',compact('results'));
    }
}
