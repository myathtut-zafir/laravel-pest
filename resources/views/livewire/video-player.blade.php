<div>
    <iframe src="https://player.vimeo.com/video/{{$video->vimeo_id}}"
            allowfullscreen></iframe>
    <h3>{{$video->title}} ({{$video->getReadableDuration()}})</h3>
    <p>{{$video->description}}</p>

</div>
