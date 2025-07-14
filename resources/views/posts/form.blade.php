@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-xl">
    <h1 class="text-2xl font-bold mb-4 dark:text-white">
        {{ $post ? 'Edit Post' : 'Create New Post' }}
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form 
        action="{{ $post ? route('posts.update', $post['id']) : route('posts.store') }}" 
        method="POST" 
        class="bg-white p-6 rounded shadow space-y-4 dark:bg-gray-900 dark:shadow-md"
    >
        @csrf
        @if ($post)
            @method('PUT')
        @endif

        <div>
            <label class="block text-gray-700 dark:text-white">Title</label>
            <input type="text" name="title" class="w-full border p-2 rounded dark:border-indigo-600 dark:text-white" value="{{ old('title', $post['title'] ?? '') }}">
        </div>

        <div>
            <label class="block text-gray-700 dark:text-white">Body</label>
            <textarea name="body" rows="5" class="w-full border p-2 rounded dark:border-indigo-600 dark:text-white">{{ old('body', $post['body'] ?? '') }}</textarea>
        </div>

        @if (!$post)
        <div>
            <label class="block text-gray-700 dark:text-white">User ID</label>
            <input type="number" name="userId" class="w-full border p-2 rounded dark:border-indigo-600 dark:text-white" value="{{ old('userId', 1) }}">
        </div>
        @endif

        <div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $post ? 'Update' : 'Create' }}
            </button>
        </div>
        <div id="loading" class="mt-2 text-sm text-gray-500 hidden">
        <svg class="animate-spin h-5 w-5 mr-2 inline-block" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" 
                    stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" 
                  d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        Submitting...
    </div>
    </form>
</div>

<script>
    const form = document.getElementById('post-form');
    const spinner = document.getElementById('loading');

    form.addEventListener('submit', () => {
        spinner.classList.remove('hidden');
    });
</script>

@endsection