@props(['post'])

<article class="mb-8 bg-white shadow-xl rounded-lg overflow-hidden">
    @if ($post->image)
        <img class="w-full h-72 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="imagen del post">
    @else
        <img class="w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg" alt="imagen del post">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show', $post)}}">
                {{$post->name}}
            </a>
        </h1>
        <div class="text-gray-700 text-base">
            {!!$post->extract!!}
        </div>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{route('posts.tag', $tag)}}" class="inline-block bg-gray-200 rounded-full px-3 py-1 mt-2 text-sm text-gray-700 mr-2">
                {{$tag->name}}
            </a>
        @endforeach
    </div>
</article>


{{-- <x-card-post /> se utiliza en (/resources/views/posts/category.blade.php) y en (/resources/views/posts/tag.blade.php) --}}