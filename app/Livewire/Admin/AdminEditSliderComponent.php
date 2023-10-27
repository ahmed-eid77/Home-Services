<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditSliderComponent extends Component
{

    use WithFileUploads;
    public $slide_id;
    public $title;
    public $status = 0;
    public $image;
    public $newImage;

    public function mount($slide_id)
    {
        $slide = Slider::find($slide_id);
        $this->slide_id = $slide->id;
        $this->title = $slide->title;
        $this->status = $slide->status;
        $this->image = $slide->image;
    }

    public function updates($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }
    }


    public function updateSlide()
    {
        $this->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }

        $slide = Slider::find($this->slide_id);
        $slide->title = $this->title;
        $slide->status = $this->status;


        if ($this->newImage) {
            if (Storage::disk('local')->exists('/slider' . '/' . $this->image)) {
                Storage::disk('local')->delete('/slider' . '/' . $this->image);
                $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
                $this->newImage->storeAs('slider', $imageName, 'local');
                $slide->image = $imageName;
            } else {
                $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
                $this->newImage->storeAs('slider', $imageName, 'local');
                $slide->image = $imageName;
            }
        }

        $slide->save();
        session()->flash('message', 'Slide Has Been Updated Successfully!.');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slider-component')->layout('layouts.base');
    }
}
