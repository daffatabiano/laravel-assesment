<div class="bg-white p-6 rounded shadow mb-6 dark:bg-gray-900">
    <h1 class="text-2xl font-bold mb-2 dark:text-white">{{ $user['name'] }}</h1>
    <p class="dark:text-indigo-400"><strong>Email:</strong> {{ $user['email'] }}</p>
    <p class="dark:text-indigo-400"><strong>Username:</strong> {{ $user['username'] }}</p>
    <p class="dark:text-indigo-400 pb-8"><strong>Company:</strong> {{ $user['company']['name'] }}</p>
    <a href="{{ route('posts.index') }}" class="text-blue-500 text-sm">← Back to Posts</a>
</div>
