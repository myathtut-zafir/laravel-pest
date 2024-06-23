<?php

namespace App\Livewire;


use Illuminate\Contracts\View\View;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video;
    public $courseVideos;

    public function mount($video): void
    {
        $this->courseVideos = $this->video->course->videos;
    }

    public function render(): View
    {
        return view('livewire.video-player');
    }

    public function markVideoAsCompleted(): View
    {
        auth()->user()->videos()->attach($this->video);

        return view('livewire.video-player');
    }

    public function markVideoAsNotCompleted(): View
    {
        auth()->user()->videos()->detach($this->video);

        return view('livewire.video-player');
    }
}
