@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    @if (isset($error))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ $error }}
        </div>
    @else
    <div class="bg-white p-6 rounded shadow mb-6 dark:bg-gray-600">
        <x-user-info :user="$user" />
        <div>
            <h2 class="text-xl font-semibold mb-4 dark:text-white">Posts by {{ $user['name'] }}</h2>
            @foreach ($posts as $post)
                <div class="bg-gray-100 p-4 mb-2 rounded shadow dark:bg-gray-700">
                    <h3 class="font-semibold dark:text-white">{{ $post['title'] }}</h3>
                    <p class="dark:text-indigo-400">{{ Str::limit($post['body'], 100) }}</p>
                    <a href="{{ route('posts.show', $post['id']) }}" class="text-blue-500 text-sm">Read more</a>
                </div>
            @endforeach
        </div>
    </div>

    @endif
</div>
@endsection
