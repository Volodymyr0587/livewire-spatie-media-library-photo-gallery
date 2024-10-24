<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;


class PhotoUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $title;
    public $description;
    public $selectedCategories = [];
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate([
            'photo' => 'required|image|max:2048',
            'title' => 'required|string|max:255',
            'selectedCategories' => 'array',
            'selectedCategories.*' => 'exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $photo = Photo::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ]);

        $photo->categories()->attach($this->selectedCategories);

        $photo->addMedia($this->photo->getRealPath())
              ->toMediaCollection('photos');

        session()->flash('message', 'Photo uploaded successfully.');
        $this->redirectRoute('photos.index', navigate: true);
    }
    public function render()
    {
        return view('livewire.photo-upload', [
            'categories' => Category::all(),
        ])->layout('layouts.app');
    }
}
