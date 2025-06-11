<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Video List') }}
        </h2>
    </x-slot>

    <x-slot name="title">
        {{ __('Upload New Video') }}
        {{-- 
            The fields in the VideoController@store method are:
            - video_title
            - creator
            - category
            - niche
            - channel
            - video_path
            - seo_data
            - user_id (set to authenticated user)
            - is_monetizable (set to true)
        --}}
        @if ($errors->any())
            <div class="max-w-xl mx-auto mt-6 mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Upload failed!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <span class="block mt-2 text-sm">Please fix the highlighted fields below.</span>
            </div>
        @endif
    <div class="max-w-xl mx-auto mt-10 bg-white dark:bg-gray-800 shadow-md rounded-lg p-8">
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="creator" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Creator</label>
                <input type="text" name="creator" id="creator" required
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <input type="text" name="category" id="category" required
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label for="niche" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Niche</label>
                <input type="text" name="niche" id="niche" required
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label for="channel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Channel</label>
                <input type="text" name="channel" id="channel" required
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label for="seo_data" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SEO Data</label>
                <input type="text" name="seo_data" id="seo_data" required
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="is_monetizable" id="is_monetizable" value="1">

            <div>
                <label for="video_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Video Title</label>
                <input type="text" name="video_title" id="video_title" required
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label for="video_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Video File</label>
                <input type="file" name="video_file" id="video_file" required
                    class="w-full text-gray-700 dark:text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-100">
            </div>

            {{-- User ID is set automatically as a hidden field above --}}

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Upload Video
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
