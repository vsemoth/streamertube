<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('videos.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            {{ __('Upload Video') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach (\App\Models\Video::paginate(12) as $video)
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                                <a href="{{ route('videos.show', $video->id) }}">
                                    <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->video_title }}" class="w-full h-48 object-cover">
                                </a>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                                        <a href="{{ route('videos.show', $video->id) }}">{{ $video->video_title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 truncate">{{ $video->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ \App\Models\Video::paginate(12)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
