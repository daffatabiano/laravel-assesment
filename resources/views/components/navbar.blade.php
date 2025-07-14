<nav class="bg-white dark:bg-gray-800 border-b shadow px-4 py-3">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-xl font-bold text-blue-600 dark:text-indigo-400">
            <a href="{{ route('posts.index') }}">Laravel Blog</a>
        </div>

        <div class="md:hidden">
            <button id="menu-toggle" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" 
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <div id="menu" class="hidden md:flex space-x-4 items-center">
            <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-500 dark:text-indigo-400">Posts</a>
            <a href="{{ route('posts.create') }}" class="text-gray-700 hover:text-blue-500 hover:text-blue-500 dark:text-indigo-400">Create</a>
            <a href="{{ route('posts.favorites') }}" class="text-gray-700 hover:text-blue-500 hover:text-blue-500 dark:text-indigo-400">Favorites</a>
                <button id="theme-toggle" aria-label="Toggle light/dark mode"
                    class="relative w-14 h-8 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center px-1 transition-colors duration-300 focus:outline-none">
                
                    <div id="toggle-thumb" class="w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300 z-10"></div>

                    <span id="sun-icon"
                        class="absolute left-1 text-yellow-500 transition-opacity duration-300 opacity-100 z-0">🌙</span>
                    <span id="moon-icon"
                        class="absolute right-1 text-yellow-300 transition-opacity duration-300 opacity-0 z-0">☀️</span>
                </button>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden mt-2">
        <a href="{{ route('posts.index') }}" class="block py-2 text-gray-700 hover:text-blue-500">Posts</a>
        <a href="{{ route('posts.create') }}" class="block py-2 text-gray-700 hover:text-blue-500">Create</a>
        <button 
            id="theme-toggle" 
            class="ml-4 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-sm border border-gray-300 dark:border-gray-600">
            Toggle Theme
        </button>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });

        const toggleBtn = document.getElementById('theme-toggle');
        const toggleThumb = document.getElementById('toggle-thumb');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const theme = localStorage.getItem('theme') || (isSystemDark ? 'dark' : 'light');

        setTheme(theme);

        toggleBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            toggleThumb.classList.toggle('translate-x-6');

            sunIcon.classList.toggle('opacity-0', isDark);
            moonIcon.classList.toggle('opacity-0', !isDark);

            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });

        function setTheme(theme) {
            const isDark = theme === 'dark';
            if (isDark) {
            document.documentElement.classList.add('dark');
            toggleThumb.classList.add('translate-x-6');
            sunIcon.classList.add('opacity-0');
            moonIcon.classList.remove('opacity-0');
            } else {
            document.documentElement.classList.remove('dark');
            toggleThumb.classList.remove('translate-x-6');
            sunIcon.classList.remove('opacity-0');
            moonIcon.classList.add('opacity-0');
            }
        }
</script>
