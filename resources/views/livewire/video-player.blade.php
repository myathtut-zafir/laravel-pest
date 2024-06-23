<div>
    <iframe src="https://player.vimeo.com/video/{{$video->vimeo_id}}"
            allowfullscreen></iframe>
    <h3>{{$video->title}} ({{$video->getReadableDuration()}})</h3>
    <p>{{$video->description}}</p>
    <ul>
        @foreach($courseVideos as $v)
            <li>
                <a href="{{ route('page.course-videos', $v) }}">
                {{$v->title}}
            </li>
        @endforeach
    </ul>
</div>

