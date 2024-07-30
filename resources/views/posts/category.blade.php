<x-app-layout>
    <div class="mx-auto max-w-5xl px-2 sm:px-6 lg:px-8 py-8">
        <h1 class="uppercase text-center text-lg font-bold mb-4">
            Categoría: {{$category->name}}
        </h1>
        @foreach ($posts as $post)
            <x-card-post :post="$post" />
        @endforeach
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>