<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddSliderComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $status;
    public $image;


    public function updates($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);
    }


    public function createSlide() {
        $this->validate([
            'title' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);

        $slide = new Slider();
        $slide->title = $this->title;
        $slide->status = $this->status;

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('slider',$imageName, 'local');
        $slide->image = $imageName;

        $slide->save();
        $this->reset();
        session()->flash('message','Slide has been added successfully!.');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-slider-component')->layout('layouts.base');
    }
}
