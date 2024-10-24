<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class PhotoGallery extends Component
{
    use WithPagination;

    public $selectedCategory = null;
    public $editMode = false;
    public $photoId;
    public $title;
    public $description;
    public $selectedCategories = [];
    public $categories;

    public function mount()
    {
        $this->categories = auth()->user()->categories()->get();
    }

    public function edit($photoId)
    {
        $this->editMode = true;
        $photo = Photo::findOrFail($photoId);

        $this->photoId = $photo->id;
        $this->title = $photo->title;
        $this->description = $photo->description;
        $this->selectedCategories = $photo->categories->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'selectedCategories' => 'array',
            'selectedCategories.*' => 'exists:categories,id',
        ]);

        $photo = Photo::findOrFail($this->photoId);

        $photo->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $photo->categories()->sync($this->selectedCategories);

        session()->flash('message', 'Photo updated successfully.');

        $this->editMode = false;
        $this->reset(['title', 'description', 'selectedCategories']);
    }

    public function delete($photoId)
    {
        $photo = Photo::findOrFail($photoId);

        if ($photo->user_id !== auth()->id()) {
            return;
        }

        $photo->delete();
        session()->flash('message', 'Photo deleted successfully.');
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function render()
    {
        $query = Photo::where('user_id', auth()->id())
            ->with(['categories', 'media']);

        if ($this->selectedCategory) {
            $query->whereHas('categories', function ($q) {
                $q->where('categories.id', $this->selectedCategory);
            });
        }

        $photos = $query->latest()->paginate(6);
        $categories = Category::all();

        return view('livewire.photo-gallery', [
            'photos' => $photos,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
