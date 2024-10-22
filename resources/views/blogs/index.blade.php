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

                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('blogs.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Create Blog
                        </a>
                        <form action="{{ route('blogs.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center ml-4">
                            @csrf
                            <label class="flex items-center border border-gray-300 rounded-md px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 transition duration-200 cursor-pointer">
                                <input type="file" name="blogs_file" accept=".csv" required class="hidden" onchange="updateFileName(this)">
                                <span class="mr-2" id="file-name">Choose a CSV file</span>
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M11.293 9.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L13.586 15H3a1 1 0 110-2h10.586l-2.293-2.293a1 1 0 010-1.414z" />
                                </svg>
                            </label>
                            <button type="submit" class="ml-4 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200">
                                Import Blogs
                            </button>
                        </form>
                        <script>
                            function updateFileName(input) {
                                const fileName = input.files[0] ? input.files[0].name : 'Choose a CSV file';
                                document.getElementById('file-name').textContent = fileName;
                            }
                        </script>

                    </div>

                    @if($blogs->isEmpty())
                    <div class="text-center">
                        <h1>No Blog</h1>
                    </div>
                    @else
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Image</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Title</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Author</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs->sortByDesc('created_at') as $blog)
                            <tr class="hover:bg-gray-100 transition-colors duration-300">
                                <td class="py-4 px-4 border-b border-gray-300">
                                    @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="Blog Image" class="rounded-md" width="100px" height="60px">
                                    @else
                                    <span>No Image</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 border-b border-gray-300 text-indigo-700 font-bold">{{ $blog->title }}
                                    <div class="flex space-x-2 items-center mt-2">
                                        <a href="{{ route('blogs.edit', $blog->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm font-normal">Edit</a>
                                        <a href="{{ route('blogs.show', $blog->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm font-normal">Show</a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-normal">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $blog->author }}</td>
                                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $blog->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
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