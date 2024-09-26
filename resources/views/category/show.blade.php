<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Show') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">{{ $blog->title }}</h1>
                    @if($blog->image)
                        <img src="{{ asset($blog->image) }}" alt="Blog Image" class="rounded-md mt-3 mb-4" width="200px" height="120px">
                        @endif

                    <p class="text-gray-700 mb-6">{{ $blog->description }}</p>

                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>By {{ $blog->author }}</span>
                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                    </div>

                    <a href="{{ route('blogs.edit', $blog->id) }}"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Edit Blog
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>