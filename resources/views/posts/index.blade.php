@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 ">
    <h1 class="text-2xl font-bold mb-4 dark:text-indigo-400">Posts</h1>

    <div class="grid gap-4">
        <a href="{{ route('posts.create') }}" class="text-blue-500 dark:text-indigo-200 ">+ New Post</a>
        <x-post-filter-form />
        @if($search || $userId || $postId)
            <div class="text-sm text-gray-600 mb-4 dark:text-indigo-400">
                <span>Filter Aktif:</span>
                @if($search) <span class="font-semibold">Search:</span> "{{ $search }}" @endif
                @if($userId) <span class="font-semibold">User ID:</span> {{ $userId }} @endif
                @if($postId) <span class="font-semibold">Post ID:</span> {{ $postId }} @endif
            </div>
        @endif

        <div id="post-container">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
            <div id="loader" class="text-center my-6 hidden">
                <span class="text-gray-500">Loading...</span>
            </div>
        </div>

    </div>
</div>

<script>
    let page = 2;
    let isLoading = false;

    window.addEventListener('scroll', () => {
        const scrollPosition = window.innerHeight + window.scrollY;
        const bottom = document.body.offsetHeight - 100;

        if (scrollPosition >= bottom && !isLoading) {
            loadMorePosts();
        }
    });

    function loadMorePosts() {
        isLoading = true;
        document.getElementById('loader').classList.remove('hidden');

        fetch(`{{ route('posts.load') }}?page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type' : 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('Network response was not ok');
            }
            console.log(res);
            return res.json();
        })
        .then(data => {
            if (!data.data || data.data.length === 0) {
                document.getElementById('loader').innerText = "No more posts.";
                return;
            }

            const container = document.getElementById('post-container');
            data.data.forEach(post => {
                const card = document.createElement('div');
                card.className = "bg-white shadow rounded p-4 mb-4 dark:bg-gray-700";
                card.innerHTML = `
                   <h2 class="text-xl font-semibold dark:text-white">{{ $post['title'] }}</h2>
                        <div class="flex gap-2 items-center text-sm opacity-[0.7] mb-2">
                            <p class="text-gray-700 dark:text-indigo-400 font-light">Created By</p>
                            <a href="{{ route( 'users.show', $post['userId'] ) }}" class="text-blue-500 text-sm dark:text-indigo-200"># {{$post['userId']}}</a>
                        </div>
                        <p class="text-gray-700 mb-3 dark:text-indigo-400 text-light">{{ Str::limit($post['body'], 100) }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('posts.show', $post['id']) }}" class="text-blue-500 text-sm">Read More</a>
                            <button data-post-id="{{ $post['id'] }}" class="favorite-btn grayscale hover:grayscale-0 hover:cursor-pointer" aria-label="Toggle Favorite">
                                ⭐
                            </button>
                        </div>
                `;
                container.appendChild(card);
            });
            page++;
            isLoading = false;
            document.getElementById('loader').classList.add('hidden');
        })
        .catch((err) => {
            console.error(err);
            isLoading = false;
            document.getElementById('loader').innerText = "Error loading posts.";
        });
    }

    
</script>
@endsection
