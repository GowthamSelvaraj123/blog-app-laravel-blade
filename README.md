<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-4">Blog Application</h1><div class="mb-4">
        <h2 class="text-2xl font-semibold mt-6 mb-2">Description</h2>
        <p>
            The Blog Application is a simple yet powerful tool for managing blog posts. Built with Laravel, it allows users to add, edit, delete, and view blog posts. Users can also search for specific blogs using keywords.
        </p>
        <h2 class="text-2xl font-semibold mt-6 mb-2">Features</h2>
        <ul class="list-disc list-inside mb-4">
            <li><strong>Add Blog:</strong> Create new blog posts with a title, description, image, and author name.</li>
            <li><strong>Edit Blog:</strong> Modify existing blog posts.</li>
            <li><strong>Delete Blog:</strong> Remove blog posts from the application.</li>
            <li><strong>Show Blog:</strong> View individual blog details.</li>
            <li><strong>Search Blogs:</strong> Find blogs by title or content.</li>
        </ul>
        <h2 class="text-2xl font-semibold mt-6 mb-2">Fields</h2>
        <p>
            Each blog post contains the following fields:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li><strong>Title:</strong> The title of the blog post.</li>
            <li><strong>Description:</strong> A brief overview of the blog content.</li>
            <li><strong>Image:</strong> An optional image associated with the blog post.</li>
            <li><strong>Author Name:</strong> The name of the person who wrote the blog.</li>
        </ul>
        <h2 class="text-2xl font-semibold mt-6 mb-2">Technologies Used</h2>
        <ul class="list-disc list-inside mb-4">
            <li><strong>Backend:</strong> Laravel</li>
            <li><strong>Frontend:</strong> Blade Templates, Tailwind CSS</li>
            <li><strong>Database:</strong> MySQL</li>
        </ul>
        <h2 class="text-2xl font-semibold mt-6 mb-2">Installation</h2>
        <ol class="list-decimal list-inside mb-4">
            <li><strong>Clone the Repository</strong>
                <pre class="bg-gray-200 p-2 rounded">git clone https://github.com/GowthamSelvaraj123/blog-app.git</pre>
            </li>
            <li><strong>Navigate to the Project Directory</strong>
                <pre class="bg-gray-200 p-2 rounded">cd blog-app</pre>
            </li>
            <li><strong>Install Dependencies</strong>
                <pre class="bg-gray-200 p-2 rounded">composer install</pre>
            </li>
            <li><strong>Set Up Environment Variables</strong>
                <p>Copy the <code>.env.example</code> to <code>.env</code> and update the database credentials.</p>
                <pre class="bg-gray-200 p-2 rounded">cp .env.example .env</pre>
            </li>
            <li><strong>Generate Application Key</strong>
                <pre class="bg-gray-200 p-2 rounded">php artisan key:generate</pre>
            </li>
            <li><strong>Run Migrations</strong>
                <pre class="bg-gray-200 p-2 rounded">php artisan migrate</pre>
            </li>
            <li><strong>Serve the Application</strong>
                <pre class="bg-gray-200 p-2 rounded">php artisan serve</pre>
            </li>
        </ol>
        <h2 class="text-2xl font-semibold mt-6 mb-2">Usage</h2>
        <p>
            Navigate to <code>http://localhost:8000</code> to access the blog application. Use the navigation menu to add, edit, or delete blogs. Use the search bar to find specific blogs by title or content.
        </p>
        <h2 class="text-2xl font-semibold mt-6 mb-2">Contributing</h2>
        <p>
            Contributions are welcome! Please open an issue or submit a pull request for any improvements.
        </p>
        <h2 class="text-2xl font-semibold mt-6 mb-2">License</h2>
        <p>
            This project is open source and available under the <a href="LICENSE" class="text-blue-500 underline">MIT License</a>.
        </p>
    </div>
</body>
