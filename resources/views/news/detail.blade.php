@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-3xl">
    <a href="{{ url('/news') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali ke Daftar Berita</a>
    <div class="bg-white rounded-lg shadow p-6">
        <img src="{{ $news->image }}" alt="{{ $news->title }}" class="rounded mb-6 w-full h-80 object-cover">
        <h1 class="text-3xl font-bold mb-2">{{ $news->title }}</h1>
        <div class="text-gray-500 text-sm mb-4">
            <span>{{ $news->author }}</span> &bull; <span>{{ $news->published_at->format('d M Y') }}</span>
        </div>
        <div class="mb-4">
            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $news->category?->name }}</span>
        </div>
        <div class="prose mb-6">{!! $news->content !!}</div>
        <div>
            @foreach($news->tags as $tag)
                <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded mr-1">#{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection
