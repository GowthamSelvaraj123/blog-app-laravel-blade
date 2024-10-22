<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category List') }}
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

                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('categories.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Create Categories
                        </a>
                        <form action="{{ route('categories.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center ml-4">
                            @csrf
                            <label class="flex items-center border border-gray-300 rounded-md px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 transition duration-200 cursor-pointer">
                                <input type="file" name="categories_file" accept=".csv" required class="hidden" onchange="updateFileName(this)">
                                <span class="mr-2" id="file-name">Choose a CSV file</span>
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M11.293 9.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L13.586 15H3a1 1 0 110-2h10.586l-2.293-2.293a1 1 0 010-1.414z" />
                                </svg>
                            </label>
                            <button type="submit" class="ml-4 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200">
                                Import Categories
                            </button>
                        </form>

                        <script>
                            function updateFileName(input) {
                                const fileName = input.files[0] ? input.files[0].name : "Choose a CSV file";
                                document.getElementById('file-name').innerText = fileName;
                            }
                        </script>
                    </div>

                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Category Title</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Created At</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b">{{ $category->title }}</td>
                                    <td class="py-2 px-4 border-b">{{ $category->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="py-2 px-4 border-b text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="inline-flex items-center px-3 py-1 bg-indigo-500 text-white rounded-md text-sm font-medium hover:bg-indigo-600 transition duration-200">
                                                Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md text-sm font-medium hover:bg-red-600 transition duration-200">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <!-- Pagination or other controls can go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>