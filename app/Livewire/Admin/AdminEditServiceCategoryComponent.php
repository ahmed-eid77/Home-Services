<?php

namespace App\Livewire\Admin;

use App\Models\ServiceCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditServiceCategoryComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $newImage;
    public $featured;

    use WithFileUploads;

    public function mount($category_id){
        $scategory = ServiceCategory::find($category_id);
        $this->category_id = $scategory->id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->image = $scategory->image;

    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updates($fields){
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'featured'  => 'required',
        ]);

        if($this->newImage){
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }
    }


    public function updateServicecategory() {

        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'featured'  => 'required',
        ]);

        if($this->newImage){
            $this->validate([
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }

        $scategory = ServiceCategory::find($this->category_id);
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;

        if($this->newImage){
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('categories', $imageName);
            $scategory->image = $imageName;
        }
        $scategory->featured = $this->featured;
        $scategory->save();
        session()->flash('message', 'Category has been updated successfully!.');

    }

    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layouts.base');
    }
}
