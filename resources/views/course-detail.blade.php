<h1>{{$course->title}}</h1>
<h3>{{$course->tagline}}</h3>
<p>{{$course->description}}</p>
<p>{{count($course->videos) }} Videos</p>
<ul>
    @foreach($course->learnings as $learning)

        <li>{{$learning}}</li>
    @endforeach
</ul>

<img src="{{asset('images/' . $course->image_name)}}" alt="Image of {{$course->title}}">
