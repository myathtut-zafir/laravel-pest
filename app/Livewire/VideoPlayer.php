<?php

namespace App\Livewire;


use Illuminate\Contracts\View\View;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video;

    public function render(): View
    {
        return view('livewire.video-player');
    }
}
