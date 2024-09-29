<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog List') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('blogs.search') }}" method="GET" class="mb-5 flex items-center space-x-2 bg-gray-100 p-2 rounded-md shadow-md">
                        <input type="text" name="search" placeholder="Search Blogs"
                            class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                            required>
                        <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">Search</button>
                    </form>
                    <div class="mb-6">
                        <a href="{{ route('blogs.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Create Blog
                        </a>
                    </div>
                    @if($blogs->isEmpty())
                    <div class="text-center">
                        <h1>No Blog</h1>
                    </div>
                    @else

                    @foreach($blogs->sortByDesc('created_at') as $blog)
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h1 class="text-2xl font-bold mb-2 text-indigo-700">{{ $blog->title }}</h1>
                        @if($blog->image)
                        <img src="{{ asset($blog->image) }}" alt="Blog Image" class="rounded-md mt-3 mb-4" width="200px" height="120px">
                        @endif
                        <p class="text-gray-700 mb-4">{{ $blog->description }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>By {{ $blog->author }}</span>
                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="category"><h6>{{ $blog->categorys ? $blog->categorys->title : 'Uncategorized' }}</h6></div>
                        <div class="flex">
                            <a href="{{ route('blogs.edit', $blog->id) }}"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Edit
                            </a>
                            <a href="{{ route('blogs.show', $blog->id) }}"
                                class="ms-4 mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Show
                            </a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-4 mt-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Delete Blog
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        {{ $blogs->links() }}
                    </div>
                    @endif
                    <div class="mt-6">
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>