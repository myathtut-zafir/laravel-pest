@guest()
    <a href="{{route('login')}}">Login</a>
@else
    <form method="post" action="{{route('logout')}}">
        @csrf
        <button type="submit">Log out</button>
    </form>
@endguest


@foreach($courses as $course)
    <b><h2>{{$course->title}}</h2> </b>
    {{$course->description}}
@endforeach
