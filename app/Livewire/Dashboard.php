<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $recentPhotos = Photo::where('user_id', auth()->id())
            ->with(['categories', 'media'])
            ->latest()
            ->take(6)
            ->get();

        $totalPhotos = Photo::where('user_id', auth()->id())->count();

        return view('livewire.dashboard', [
            'recentPhotos' => $recentPhotos,
            'totalPhotos' => $totalPhotos,
        ])->layout('layouts.app');
    }
}
