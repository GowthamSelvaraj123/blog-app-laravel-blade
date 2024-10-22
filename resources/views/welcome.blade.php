<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Styling for the blog post cards and category cards */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 20px 25px -5px rgba(0, 0, 0, 0.1), 0px 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .category-card:hover {
            background-color: #2563eb;
            color: white;
        }

        .gradient-bg {
            background: linear-gradient(to right, #4f46e5, #3b82f6);
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <!-- Hero Section -->
    <header class="gradient-bg py-20 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">Welcome to the Blog App</h1>
            <p class="text-2xl mb-8">Your go-to platform for sharing thoughts, ideas, and stories.</p>
            <a href="{{ route('blogs.index') }}" class="bg-white text-blue-600 py-3 px-8 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">View Posts</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Latest Posts Section -->
        <section class="mb-16">
            <h2 class="text-4xl font-bold text-center mb-10">Latest Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                <div class="card bg-white shadow-lg rounded-lg overflow-hidden transition transform hover:scale-105 duration-300">
                    <img src="https://via.placeholder.com/600x400" alt="{{ $blog->title }}" width="100%">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold mb-3">{{ $blog->title }}</h3>
                        <p class="text-gray-700 mb-4">{{ Str::limit($blog->body, 100) }}</p>
                        <a href="{{ route('blogs.show', $blog) }}" class="text-blue-500 font-bold hover:underline">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Categories Section -->
        <section class="mb-16">
            <h2 class="text-4xl font-bold text-center mb-10">Explore by Category</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8">
                @foreach($categories as $category)
                <div class="category-card bg-blue-100 shadow-md rounded-lg p-6 text-center transition duration-300 hover:bg-blue-600 hover:text-white">
                    <a href="{{ route('categories.show', $category) }}" class="text-xl font-bold">{{ $category->title }}</a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Create a Post Section -->
        <section class="text-center mb-16">
            <a href="{{ route('blogs.create') }}" class="btn-primary text-lg font-bold hover:bg-green-600 transition duration-300">Write a New Post</a>
        </section>

        <!-- Subscription Section -->
        <section class="bg-gray-800 text-white py-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold mb-6">Subscribe to Our Newsletter</h2>
                <p class="text-xl mb-8">Stay updated with the latest posts and updates from our community!</p>

                <!-- Subscription Form -->
                <form action="" method="POST" class="flex justify-center">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" class="w-full max-w-lg py-3 px-4 rounded-l-lg text-gray-700" required>
                    <button type="submit" class="btn-primary rounded-r-lg font-bold hover:bg-gray-100 hover:text-blue-600">Subscribe</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            <div class="mt-6">
                <a href="#" class="text-gray-400 hover:text-white mx-2">About</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Contact Us</a>
            </div>
        </div>
    </footer>
</body>
</html>
