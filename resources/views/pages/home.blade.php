@guest()
    <a href="{{route('login')}}">Login</a>
@else
    <form method="post" action="{{route('logout')}}">
        @csrf
        <button type="submit">Log out</button>
    </form>
@endguest


@foreach($courses as $course)
    {{$course->title}}
    {{$course->description}}
@endforeach
