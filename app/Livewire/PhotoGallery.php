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

    public function delete($photoId)
    {
        $photo = Photo::findOrFail($photoId);

        if ($photo->user_id !== auth()->id()) {
            return;
        }

        $photo->delete();
        session()->flash('message', 'Photo deleted successfully.');
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
