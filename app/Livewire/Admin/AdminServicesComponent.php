<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServicesComponent extends Component
{
    use WithPagination;


    public function deleteService(Service $service){
        if($service->thumbnail){
            if (Storage::exists(public_path('images/services' . '/' . $service->thumbnail))){
                unlink(public_path('images/services/thumbnails' . '/' . $service->thumbnail));
            }
        }

        if($service->image){
            if (Storage::exists(public_path('images/services' . '/' . $service->image))){
                unlink(public_path('images/services' . '/' . $service->image));
            }
        }
        $service->delete();
        session()->flash('message','Service has been deleted successfully.');
    }

    public function render()
    {

        $services = Service::paginate(15);

        return view('livewire.admin.admin-services-component', [
            'services'=> $services
        ])->layout('layouts.base');
    }
}
