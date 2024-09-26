<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Create') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-white text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Create a New Blog</h2>
                    @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{route('blogs.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Blog Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Blog Title</label>
                            <input type="text" name="title" id="title" placeholder="Enter blog title"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Blog Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Blog Description</label>
                            <textarea name="description" id="description" rows="4" placeholder="Enter blog description"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <!-- Author Name -->
                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                            <input type="text" name="author" id="author" placeholder="Author name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- File Upload -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full text-gray-900 px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit"
                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>