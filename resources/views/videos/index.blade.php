<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Video List') }}
        </h2>
    </x-slot>
    <style>
        /* Hide default table borders for a cleaner Tailwind look */
        table.table {
            @apply w-full text-left border-collapse;
        }
        table.table th, table.table td {
            @apply px-4 py-3;
        }
        table.table th {
            @apply bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold;
        }
        table.table tr:nth-child(even) td {
            @apply bg-gray-50 dark:bg-gray-900;
        }
        table.table tr:hover td {
            @apply bg-blue-50 dark:bg-gray-700;
        }
    </style>

    <!-- Success and Error Alerts -->
    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 border border-green-400 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-700 px-4 py-3">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Video List</h1>
                    <a href="{{ route('videos.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Add New Video</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="line-height: 13.5;" class="md:px-8">Thumbnail</th>
                                <th style="line-height: 13.5;" class="md:px-8">Title</th>
                                <th style="line-height: 13.5;" class="md:px-8">Description</th>
                                <th style="line-height: 13.5;" class="md:px-8">Created At</th>
                                <th style="line-height: 13.5;" class="md:px-8">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($videos as $index => $video)
                            <tr>
                                @php
                                    // Alternate row and column for checkerboard effect
                                    function highlightCell($row, $col) {
                                        // Row: even/odd
                                        $rowClass = $row % 2 === 0 ? 'bg-blue-50 dark:bg-gray-700' : 'bg-gray-50 dark:bg-gray-900';
                                        // Column: even/odd
                                        $colClass = $col % 2 === 0 ? 'bg-yellow-100 dark:bg-yellow-900' : 'bg-green-100 dark:bg-green-900';
                                        // Checkerboard
                                        return ($row + $col) % 2 === 0 ? $rowClass : $colClass;
                                    }
                                @endphp
                                <td class="{{ highlightCell($index, 0) }} md:px-8" style="line-height: 13.5;">
                                    @if($video->thumbnail)
                                        <img src="{{ asset($video->thumbnail) }}" alt="Thumbnail" class="w-60 h-36 object-cover rounded shadow">
                                    @else
                                        <span class="text-gray-400">No image</span>
                                    @endif
                                </td>
                                <td class="font-medium {{ highlightCell($index, 1) }} md:px-8" style="line-height: 13.5;">{{ $video->title }}</td>
                                <td class="{{ highlightCell($index, 2) }} md:px-8" style="line-height: 13.5;">{{ Str::limit($video->description ?? '', 50) }}</td>
                                <td class="{{ highlightCell($index, 3) }} md:px-8" style="line-height: 13.5;">{{ $video->created_at ? $video->created_at->format('Y-m-d') : '' }}</td>
                                <td class="space-x-2 {{ highlightCell($index, 4) }} md:px-8" style="line-height: 13.5;">
                                    <a href="{{ route('videos.show', $video->id) }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">View</a>
                                    <a href="{{ route('videos.edit', $video->id) }}" class="inline-block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Edit</a>
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm"
                                            onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4 md:px-8" style="line-height: 13.5;">No videos found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if($videos->count() > 0)
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-300">
                        @if(method_exists($videos, 'firstItem'))
                            Showing {{ $videos->firstItem() }} to {{ $videos->lastItem() }} of {{ $videos->total() }} videos.
                        @else
                            Showing {{ $videos->count() }} videos.
                        @endif
                    </div>
                @endif
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('videos.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Add New Video</a>
                </div>
            </div>
            <div class="mt-6 flex justify-center">
                {{ $videos->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
