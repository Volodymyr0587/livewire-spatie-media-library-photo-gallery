<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;
use Illuminate\Support\Str;

class PhotoShow extends Component
{
    public $photo;

    public function mount($photoId)
    {
        // Знаходимо фото за ID
        $this->photo = Photo::with('categories')->findOrFail($photoId);
    }

    public function download()
    {
        $media = $this->photo->getFirstMedia('photos');

        if ($media) {
            $fileName = now()->format('Y_m_d_u') . '_' . Str::of($this->photo->title)->slug() . '.' . $media->extension;
            return response()->download($media->getPath(), $fileName);
        }

        abort(code: 404);
    }

    public function render()
    {
        return view('livewire.photo-show')->layout('layouts.app');
    }
}
