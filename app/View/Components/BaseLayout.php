<?php

namespace App\View\Components;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\View\Component;
use Illuminate\View\View;

class BaseLayout extends Component
{

   public $scategories = [1, 2];
   public $a_services;


    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {


        return view('layouts.base');
}
