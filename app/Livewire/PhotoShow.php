<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;

class PhotoShow extends Component
{
    public $photo;

    public function mount($photoId)
    {
        // Знаходимо фото за ID
        $this->photo = Photo::with('categories')->findOrFail($photoId);
    }

    public function render()
    {
        return view('livewire.photo-show')->layout('layouts.app');;
    }
}
