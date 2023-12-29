@foreach ($posts as $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->description }}</p>
@endforeach