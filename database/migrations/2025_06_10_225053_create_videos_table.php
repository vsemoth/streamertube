<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_title');
            $table->string('creator');
            $table->string('category');
            $table->string('niche');
            $table->string('channel')->nullable();
            $table->string('video_path');
            $table->text('seo_data')->nullable();
            $table->string('video_url')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->string('description')->nullable();
            $table->string('tags')->nullable();
            $table->string('status')->default('draft'); // draft, published, archived
            $table->string('language')->default('en'); // default language
            $table->string('privacy')->default('public'); // public, private, unlisted
            $table->string('visibility')->default('visible'); // visible, hidden
            $table->string('source')->default('manual'); // manual, api, upload
            $table->string('source_url')->nullable(); // URL of the source if applicable
            $table->string('source_id')->nullable(); // ID of the source if applicable
            $table->string('source_type')->default('video'); // video, audio, image
            $table->string('source_format')->default('mp4'); // mp4, avi, mkv, etc.
            $table->string('source_duration')->nullable(); // Duration of the video
            $table->string('source_size')->nullable(); // Size of the video file
            $table->string('source_resolution')->nullable(); // Resolution of the video
            $table->string('source_fps')->nullable(); // Frames per second of the video
            $table->string('source_codec')->nullable(); // Codec used for the video
            $table->string('source_bitrate')->nullable(); // Bitrate of the video
            $table->string('source_audio_codec')->nullable(); // Audio codec used in the video
            $table->string('source_audio_bitrate')->nullable(); // Audio bitrate of the video
            $table->string('source_audio_channels')->nullable(); // Number of audio channels
            $table->string('source_audio_sample_rate')->nullable(); // Audio sample rate of the video
            $table->string('source_audio_language')->nullable(); // Language of the audio track
            $table->string('source_subtitles')->nullable(); // Subtitles or captions available
            $table->string('source_subtitles_language')->nullable(); // Language of the subtitles
            $table->string('source_subtitles_format')->nullable(); // Format of the subtitles (e.g., SRT, VTT)
            $table->string('source_subtitles_url')->nullable(); // URL of the subtitles file
            $table->string('source_subtitles_path')->nullable(); // Path to the subtitles file
            $table->string('source_thumbnail')->nullable(); // Thumbnail image for the video
            $table->string('source_thumbnail_url')->nullable(); // URL of the thumbnail image
            $table->string('source_thumbnail_path')->nullable(); // Path to the thumbnail image
            $table->string('source_license')->default('standard'); // License type (e.g., standard, creative commons)
            $table->string('source_license_url')->nullable(); // URL of the license information
            $table->string('source_published_at')->nullable(); // Original publish date of the video
            $table->string('source_updated_at')->nullable(); // Last updated date of the video
            $table->unsignedInteger('source_view_count')->default(0); // View count of the video
            $table->unsignedInteger('source_like_count')->default(0); // Like count of the video
            $table->unsignedInteger('source_dislike_count')->default(0); // Dislike count of the video
            $table->unsignedInteger('source_comment_count')->default(0); // Comment count of the video
            $table->decimal('source_rating', 3, 2)->default(0); // Average rating of the video
            $table->string('source_tags')->nullable(); // Tags associated with the video
            $table->string('source_keywords')->nullable(); // Keywords associated with the video
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_monetizable')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};