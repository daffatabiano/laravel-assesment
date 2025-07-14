<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Assessment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function() {
            const theme = localStorage.theme;
            const system = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (theme === 'dark' || (!theme && system)) {
            document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="bg-gray-50 min-h-screen dark:bg-gray-800">
    <x-navbar />

     <main class="py-6 max-w-4xl mx-auto ">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');

            document.querySelectorAll('.favorite-btn').forEach(btn => {
                const card = btn.closest('[data-post-id]');
                const postId = parseInt(card.dataset.postId);

                if (favorites.includes(postId)) {
                    btn.classList.remove('grayscale');
                }

                btn.addEventListener('click', () => {
                    let favs = JSON.parse(localStorage.getItem('favorites') || '[]');
                    if (favs.includes(postId)) {
                        favs = favs.filter(id => id !== postId);
                    } else {
                        favs.push(postId);
                    }
                    localStorage.setItem('favorites', JSON.stringify(favs));
                    location.reload();
                });
            });
        });
        </script>

</body>
</html>
