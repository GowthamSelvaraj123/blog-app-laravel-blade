<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total Posts Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-lg font-semibold text-gray-700">Total Posts</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalPosts }}</p>
                </div>

                <!-- Total Categories Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-lg font-semibold text-gray-700">Total Categories</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalCategories }}</p>
                </div>

                <!-- Posts Last Week Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-lg font-semibold text-gray-700">Posts in Last 7 Days</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $postsLastWeek }}</p>
                </div>

                <!-- Posts Last Month Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-lg font-semibold text-gray-700">Posts in Last Month</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $postsLastMonth }}</p>
                </div>

                <!-- Posts Last Year Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-lg font-semibold text-gray-700">Posts in Last Year</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $postsLastYear }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
