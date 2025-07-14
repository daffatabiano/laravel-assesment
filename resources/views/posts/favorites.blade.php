@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 dark:text-white">⭐ Favorite Posts</h1>
    <div id="favorites-list" class="space-y-4"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function () {
    const favs = JSON.parse(localStorage.getItem('favorites') || '[]');
    const container = document.getElementById('favorites-list');

    if (favs.length === 0) {
        container.innerHTML = "<p class='text-gray-500'>No favorites yet.</p>";
        return;
    }

    const requests = favs.map(id => fetch(`https://jsonplaceholder.typicode.com/posts/${id}`).then(r => r.json()));
    const posts = await Promise.all(requests);

    posts.forEach(post => {
        const html = `
            <div class="bg-white dark:bg-gray-900 p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-2 dark:text-white">${post.title}</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-3">${post.body}</p>
                <a href="/posts/${post.id}" class="text-blue-500 text-sm">Read More</a>
            </div>
        `;
        container.innerHTML += html;
    });
});
</script>
@endsection
