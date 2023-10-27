<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSliderComponent extends Component
{
    use WithPagination;


    public function deleteSlide(Slider $slide){
        if($slide->image){
            if (Storage::disk('local')->exists('/slider' . '/' . $slide->image)){
                Storage::disk('local')->delete('/slider' . '/' . $slide->image);
            }
        }
        $slide->delete();
        session()->flash('message','Slide has been deleted successfully.');
    }

    public function render()
    {
        $slides = Slider::paginate(10);
        return view('livewire.admin.admin-slider-component', [
            'slides'=> $slides,
        ])->layout('layouts.base');
    }
}
