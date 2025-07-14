<div class="bg-white shadow p-4 rounded mb-4 dark:bg-gray-700">
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
</div>