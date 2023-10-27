<?php

namespace App\Livewire\Sprovider;

use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SproviderEditProfileComponent extends Component
{
    use WithFileUploads;
    public $service_provider_id;
    public $image;
    public $about;
    public $city;
    public $service_category_id;
    public $service_locations;
    public $newImage;


    public function mount() {
        $sprovider = ServiceProvider::where('user_id', Auth::user()->id)->first();
        $this->service_provider_id = $sprovider->id;
        $this->image = $sprovider->image;
        $this->about = $sprovider->about;
        $this->city = $sprovider->city;
        $this->service_category_id = $sprovider->service_category_id;
        $this->service_locations = $sprovider->service_location;
    }


    public function updateProfile() {
        $sprovider = ServiceProvider::where('user_id', Auth::user()->id)->first();
        $sprovider->about = $this->about;
        $sprovider->city = $this->city;
        $sprovider->service_category_id = $this->service_category_id;
        $sprovider->service_location = $this->service_locations;

        if ($this->newImage) {
            if (Storage::disk('local')->exists('/service-provider' . '/' . $this->image)) {
                Storage::disk('local')->delete('/service-provider' . '/' . $this->image);
                $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
                $this->newImage->storeAs('service-provider', $imageName, 'local');
                $sprovider->image = $imageName;
            } else {
                $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
                $this->newImage->storeAs('service-provider', $imageName, 'local');
                $sprovider->image = $imageName;
            }
        }

        $sprovider->save();
        session()->flash('message','Profile Has Been Updated Successfully.');
    }


    public function render()
    {
        $scategories = ServiceCategory::all();
        return view('livewire.sprovider.sprovider-edit-profile-component', [
            'scategories' => $scategories,
        ])->layout('layouts.base');
    }
}
