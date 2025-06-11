<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Video List') }}
        </h2>
    </x-slot>

<x-slot name="title">
    {{ __('Upload New Video') }}
</x-slot>

  <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="video_title">Video Title</label>
        <input type="text" name="video_title" id="video_title" required>
    </div>

    <div>
        <label for="creator">Creator</label>
        <input type="text" name="creator" id="creator" required>
    </div>

    <div>
        <label for="category">Category</label>
        <input type="text" name="category" id="category" required>
    </div>

    <div>
        <label for="niche">Niche</label>
        <input type="text" name="niche" id="niche" required>
    </div>

    <div>
        <label for="channel">Channel</label>
        <input type="text" name="channel" id="channel">
    </div>

    <div>
        <label for="video_path">Video File</label>
        <input type="file" name="video_path" id="video_path" required>
    </div>

    <div>
        <label for="seo_data">SEO Data</label>
        <textarea name="seo_data" id="seo_data"></textarea>
    </div>

    <div>
        <label for="video_url">Video URL</label>
        <input type="text" name="video_url" id="video_url">
    </div>

    <div>
        <label for="thumbnail_path">Thumbnail Image</label>
        <input type="file" name="thumbnail_path" id="thumbnail_path">
    </div>

    <div>
        <label for="thumbnail_url">Thumbnail URL</label>
        <input type="text" name="thumbnail_url" id="thumbnail_url">
    </div>

    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
    </div>

    <div>
        <label for="tags">Tags</label>
        <input type="text" name="tags" id="tags">
    </div>

    <div>
        <label for="status">Status</label>
        <input type="text" name="status" id="status" value="draft">
    </div>

    <div>
        <label for="language">Language</label>
        <input type="text" name="language" id="language" value="en">
    </div>

    <div>
        <label for="privacy">Privacy</label>
        <input type="text" name="privacy" id="privacy" value="public">
    </div>

    <div>
        <label for="visibility">Visibility</label>
        <input type="text" name="visibility" id="visibility" value="visible">
    </div>

    <div>
        <label for="source">Source</label>
        <input type="text" name="source" id="source" value="manual">
    </div>

    <div>
        <label for="source_url">Source URL</label>
        <input type="text" name="source_url" id="source_url">
    </div>

    <div>
        <label for="source_id">Source ID</label>
        <input type="text" name="source_id" id="source_id">
    </div>

    <div>
        <label for="source_type">Source Type</label>
        <input type="text" name="source_type" id="source_type" value="video">
    </div>

    <div>
        <label for="source_format">Source Format</label>
        <input type="text" name="source_format" id="source_format" value="mp4">
    </div>

    <div>
        <label for="source_duration">Source Duration</label>
        <input type="text" name="source_duration" id="source_duration">
    </div>

    <div>
        <label for="source_size">Source Size</label>
        <input type="text" name="source_size" id="source_size">
    </div>

    <div>
        <label for="source_resolution">Source Resolution</label>
        <input type="text" name="source_resolution" id="source_resolution">
    </div>

    <div>
        <label for="source_fps">Source FPS</label>
        <input type="text" name="source_fps" id="source_fps">
    </div>

    <div>
        <label for="source_codec">Source Codec</label>
        <input type="text" name="source_codec" id="source_codec">
    </div>

    <div>
        <label for="source_bitrate">Source Bitrate</label>
        <input type="text" name="source_bitrate" id="source_bitrate">
    </div>

    <div>
        <label for="source_audio_codec">Source Audio Codec</label>
        <input type="text" name="source_audio_codec" id="source_audio_codec">
    </div>

    <div>
        <label for="source_audio_bitrate">Source Audio Bitrate</label>
        <input type="text" name="source_audio_bitrate" id="source_audio_bitrate">
    </div>

    <div>
        <label for="source_audio_channels">Source Audio Channels</label>
        <input type="text" name="source_audio_channels" id="source_audio_channels">
    </div>

    <div>
        <label for="source_audio_sample_rate">Source Audio Sample Rate</label>
        <input type="text" name="source_audio_sample_rate" id="source_audio_sample_rate">
    </div>

    <div>
        <label for="source_audio_language">Source Audio Language</label>
        <input type="text" name="source_audio_language" id="source_audio_language">
    </div>

    <div>
        <label for="source_subtitles">Source Subtitles</label>
        <input type="text" name="source_subtitles" id="source_subtitles">
    </div>

    <div>
        <label for="source_subtitles_language">Source Subtitles Language</label>
        <input type="text" name="source_subtitles_language" id="source_subtitles_language">
    </div>

    <div>
        <label for="source_subtitles_format">Source Subtitles Format</label>
        <input type="text" name="source_subtitles_format" id="source_subtitles_format">
    </div>

    <div>
        <label for="source_subtitles_url">Source Subtitles URL</label>
        <input type="text" name="source_subtitles_url" id="source_subtitles_url">
    </div>

    <div>
        <label for="source_subtitles_path">Source Subtitles Path</label>
        <input type="text" name="source_subtitles_path" id="source_subtitles_path">
    </div>

    <div>
        <label for="source_thumbnail">Source Thumbnail</label>
        <input type="text" name="source_thumbnail" id="source_thumbnail">
    </div>

    <div>
        <label for="source_thumbnail_url">Source Thumbnail URL</label>
        <input type="text" name="source_thumbnail_url" id="source_thumbnail_url">
    </div>

    <div>
        <label for="source_thumbnail_path">Source Thumbnail Path</label>
        <input type="text" name="source_thumbnail_path" id="source_thumbnail_path">
    </div>

    <div>
        <label for="source_license">Source License</label>
        <input type="text" name="source_license" id="source_license" value="standard">
    </div>

    <div>
        <label for="source_license_url">Source License URL</label>
        <input type="text" name="source_license_url" id="source_license_url">
    </div>

    <div>
        <label for="source_published_at">Source Published At</label>
        <input type="text" name="source_published_at" id="source_published_at">
    </div>

    <div>
        <label for="source_updated_at">Source Updated At</label>
        <input type="text" name="source_updated_at" id="source_updated_at">
    </div>

    <div>
        <label for="source_view_count">Source View Count</label>
        <input type="number" name="source_view_count" id="source_view_count" value="0" min="0">
    </div>

    <div>
        <label for="source_like_count">Source Like Count</label>
        <input type="number" name="source_like_count" id="source_like_count" value="0" min="0">
    </div>

    <div>
        <label for="source_dislike_count">Source Dislike Count</label>
        <input type="number" name="source_dislike_count" id="source_dislike_count" value="0" min="0">
    </div>

    <div>
        <label for="source_comment_count">Source Comment Count</label>
        <input type="number" name="source_comment_count" id="source_comment_count" value="0" min="0">
    </div>

    <div>
        <label for="source_rating">Source Rating</label>
        <input type="number" step="0.01" name="source_rating" id="source_rating" value="0">
    </div>

    <div>
        <label for="source_tags">Source Tags</label>
        <input type="text" name="source_tags" id="source_tags">
    </div>

    <div>
        <label for="source_keywords">Source Keywords</label>
        <input type="text" name="source_keywords" id="source_keywords">
    </div>

    <div>
        <label for="user_id">User ID</label>
        <input type="number" name="user_id" id="user_id" required>
    </div>

    <div>
        <label for="is_monetizable">Is Monetizable</label>
        <input type="checkbox" name="is_monetizable" id="is_monetizable" value="1" checked>
    </div>

    <button type="submit">Upload Video</button>
</form>
</x-app-layout>
