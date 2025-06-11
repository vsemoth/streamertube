<x-app-layout>
    <x-slot name="title">ClipStream - {{ $video->title }}</x-slot>
    <x-slot name="description">{{ $video->description ?? 'Watch and discover amazing videos on ClipStream' }}</x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Video Section -->
            <div class="lg:col-span-2">
                <div class="aspect-w-16 aspect-h-9 bg-black rounded-lg overflow-hidden mb-4">
                    <video controls poster="{{ $video->thumbnail_url }}" class="w-full h-full" preload="metadata">
                        <source src="{{ asset($video->video_url) }}" type="{{ \Illuminate\Support\Str::endsWith($video->video_url, '.webm') ? 'video/webm' : 'video/mp4' }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <h1 class="text-2xl font-bold mb-2">{{ $video->title }}</h1>
                <div class="flex items-center gap-4 text-sm text-muted-foreground mb-4">
                    <span>{{ $video->views }} views</span>
                    <span>&bull;</span>
                    <span>{{ $video->created_at->diffForHumans() }}</span>
                    <span>&bull;</span>
                    <span>Category: {{ $video->category }}</span>
                </div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ $video->creator_avatar ?? '/images/default-avatar.png' }}" alt="{{ $video->creator }}" class="w-10 h-10 rounded-full">
                    <div>
                        <div class="font-semibold">{{ $video->creator }}</div>
                        <div class="text-xs text-muted-foreground">{{ $video->creator_subscribers ?? '0' }} subscribers</div>
                    </div>
                </div>
                <div class="bg-muted p-4 rounded mb-6">
                    <p class="text-muted-foreground">{{ $video->description }}</p>
                </div>
            </div>

            <!-- Sidebar: Related Videos -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Related Videos</h2>
                <div class="space-y-4">
                    @foreach($relatedVideos as $related)
                        <a href="{{ route('videos.show', $related->id) }}" class="flex gap-3 hover:bg-muted/50 rounded p-2 transition">
                            <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}" class="w-28 h-16 object-cover rounded">
                            <div class="flex-1">
                                <div class="font-medium line-clamp-2">{{ $related->title }}</div>
                                <div class="text-xs text-muted-foreground">{{ $related->creator }}</div>
                                <div class="text-xs text-muted-foreground">{{ $related->views }} views &bull; {{ $related->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
