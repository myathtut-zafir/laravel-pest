<h1>{{$course->title}}</h1>
<h3>{{$course->tagline}}</h3>
<p>{{$course->description}}</p>
<p>{{$course->videos_count }} Videos</p>
<ul>
    @foreach($course->learnings as $learning)

        <li>{{$learning}}</li>
    @endforeach
</ul>

<img src="{{asset('images/' . $course->image_name)}}" alt="Image of {{$course->title}}">

<a href="#!" data-product="{{ $course->paddle_product_id }}" data-theme="none">Buy Now!</a>
<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
<script type="text/javascript">

    Paddle.Setup({vendor: 4736});
</script>
