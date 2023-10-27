<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Slider;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $scategories = ServiceCategory::inRandomOrder()->take(18)->get();
        $f_services = Service::where("featured", 1)->inRandomOrder()->take(8)->get();
        $f_categories = ServiceCategory::where('featured', 1)->inRandomOrder()->get();
        $sid = ServiceCategory::whereIn('slug', ['ac', 'tv', 'Electrical', 'Home Cleaning'])->get()->pluck('id');
        $a_services = Service::whereIn('service_category_id', $sid)->inRandomOrder()->take(8)->get();
        $slides = Slider::where('status',1)->get();

        return view('livewire.home-component', [
            'scategories'=> $scategories,
            'f_services'=> $f_services,
            'f_categories'=> $f_categories,
            'a_services'=> $a_services,
            'slides'=> $slides,
        ])->layout('layouts.base');
    }
}
