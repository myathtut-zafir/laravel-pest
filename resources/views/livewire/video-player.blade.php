<div>
    <iframe src="https://player.vimeo.com/video/{{$video->vimeo_id}}"
            allowfullscreen></iframe>
    <h3>{{$video->title}} ({{$video->getReadableDuration()}})</h3>
    <p>{{$video->description}}</p>
    @if(auth()->user()?->watchedVideos()->where('video_id',$video->id)->count())
        <button wire:click="markVideoAsNotCompleted"> Mark as not completed</button>
    @else
        <button wire:click="markVideoAsCompleted"> Mark as completed</button>

    @endif
    <ul>
        @foreach($courseVideos as $v)
            <li>
                @if($this->isCurrentVideo($v))
                    {{$v->title}}
                @else
                    <a href="{{ route('page.course-videos', $v) }}">
                    {{$v->title}}
                @endif

            </li>
        @endforeach
    </ul>
</div>

