<?php

namespace App\Livewire\Admin;

use App\Models\ServiceProvider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServiceProvidersComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $serviceProviders = ServiceProvider::paginate(15);
        return view('livewire.admin.admin-service-providers-component', [
            'serviceProviders'=> $serviceProviders
        ])->layout('layouts.base');
    }
}
