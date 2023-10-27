<?php

namespace App\Livewire\Admin;

use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddServiceCategoryComponent extends Component
{
    public $name;
    public $slug;
    public $image;


    use WithFileUploads;

    public function updates($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function createNewCategory()
    {

        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);

        $scategory = new ServiceCategory();
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('categories',$imageName, 'local');
        $scategory->image = $imageName;
        $scategory->save();
        session()->flash('message', 'Category has been added successfully!.');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layouts.base');
    }
}
