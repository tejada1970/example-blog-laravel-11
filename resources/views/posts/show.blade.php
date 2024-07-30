<x-app-layout>
    <div class="container py-8">
        <h1 class="text-2xl font-bold text-gray-600 pb-2">{{$post->name}}</h1>
        <div class="text-lg text-gray-500 mt-2 ck-content">
            {!! $post->extract !!}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- contenido principal --}}
            <div class="lg:col-span-2">
                <figure class="py-4">
                    @if ($post->image)
                        <img class="w-full h-80 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="imagen del post">
                    @else
                        <img class="w-full h-80 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg" alt="imagen del post">
                    @endif
                </figure>
                <div class="text-base text-gray-500 ck-content">
                    {!! $post->body !!}
                </div>
            </div>
            {{-- contenido relacionado --}}
            <aside>
                <h1 class="text-lg font-bold text-gray-500 py-4">Más en {{$post->category->name}}</h1>
                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-4">
                            <a class="flex" href="{{route('posts.show', $similar)}}">
                                @if ($similar->image)
                                    <img class="max-w-36 min-w-36 h-20 object-cover object-center" src="{{Storage::url($similar->image->url)}}" alt="imagen del post relacionado">
                                @else
                                    <img class="max-w-36 min-w-36 h-20 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg" alt="imagen del post relacionado">
                                @endif
                                <span class="ml-2 text-gray-500 text-[15px]">{{$similar->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />
    <style>
        .ck-content ul, .ck-content ol {
            padding-left: 2em;
            margin-bottom: 20px;
        }
        .ck-content li {
           padding-top: 20px;
        }
        .ck-content blockquote {
            font-style: normal;
        }
    </style>
</x-app-layout>