@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Latest News</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($latestNews as $item)
            <a href="{{ url('/news/'.$item->slug) }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-lg transition flex flex-col">
                <img src="{{ $item->image }}" alt="{{ $item->title }}" class="rounded mb-4 w-full h-48 object-cover">
                <h2 class="text-xl font-semibold mb-2">{{ $item->title }}</h2>
                <div class="text-gray-500 text-sm mb-2">
                    <span>{{ $item->author }}</span> &bull; <span>{{ $item->published_at->format('d M Y') }}</span>
                </div>
                <div class="mb-2">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $item->category?->name }}</span>
                </div>
                <div class="prose mb-4 line-clamp-3">{!! $item->content !!}</div>
                <div class="mt-auto">
                    @foreach($item->tags as $tag)
                        <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded mr-1">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-8 text-center">
        <a href="{{ url('/news') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lihat Semua Berita</a>
    </div>
</div>
@endsection
