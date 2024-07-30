<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <article class="shadow-lg shadow-slate-400 transition-all duration-1000 hover:scale-95 w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url(@if($post->image) {{Storage::url($post->image->url)}} @else https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg @endif)">
                    <div class="w-full h-full px-8 flex flex-col justify-center">
                        {{-- nombre de las etiquetas --}}
                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{route('posts.tag', $tag)}}" class="inline-block px-3 h-6 bg-gray-700 text-white rounded-full">{{$tag->name}}</a>
                            @endforeach
                        </div>
                        {{-- nombre de los posts --}}
                        <a href="{{route('posts.show', $post)}}">
                            <h1 class="text-xl text-yellow-300 bg-black/75 leading-8 font-bold mt-2 p-3 rounded-lg">
                                {{$post->name}}
                            </h1>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
        {{-- paginación --}}
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>