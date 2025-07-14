@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    @if(isset($error)) 
        <div class="text-red-700 bg-red-100 p-4 rounded mb-4">
            {{ $error }}
        </div>
    @else 
        <div class="bg-white p-6 rounded shadow dark:bg-gray-700 ">
            <h1 class="text-2xl font-bold mb-2 dark:text-white">{{$post['title']}}</h1>
            <p class="text-gray-700 mb-4 dark:text-indigo-400">{{$post['body']}}</p>
            <a href="{{route('posts.index')}}" class="text-blue-500 text-sm">Back To Posts</a>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2 dark:text-white">Comments</h2>
            @foreach ($comments as $comment) 
                <x-comment-box :comment="$comment" />
            @endforeach
            
        </div>
    @endif
</div>

@endsection