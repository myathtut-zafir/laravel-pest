<h1>{{$course->title}}</h1>
<h3>{{$course->tagline}}</h3>
<p>{{$course->description}}</p>
<ul>
    @foreach($course->learnings as $learning)

        <li>{{$learning}}</li>
    @endforeach
</ul>

<img src="{{$course->image}}" alt="Image of {{$course->title}}">
