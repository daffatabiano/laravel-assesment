<form method="GET" action="{{ route('posts.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-indigo-400">Search</label>
        <input type="text" name="search" value="{{ request('search') }}" 
               class="border border-gray-300 dark:text-white rounded px-3 py-2 w-48">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-indigo-400">User ID</label>
        <input type="number" name="userId" value="{{ request('userId') }}" 
               class="border border-gray-300 dark:text-white rounded px-3 py-2 w-24">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-indigo-400">Post ID</label>
        <input type="number" name="postId" value="{{ request('postId') }}" 
               class="border border-gray-300 dark:text-white rounded px-3 py-2 w-24">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Filter
    </button>

    <a href="{{ route('posts.index') }}" 
       class="text-gray-500 hover:text-black text-sm underline mt-2">
        Reset
    </a>
</form>
