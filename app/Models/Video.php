<?php

// Video model code
namespace App\Models;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Video extends Model
{

    protected $fillable = [
        'video_title',
        'creator',
        'category',
        'niche',
        'channel',
        'video_path',
        'video_url',
        'thumbnail_path',
        'thumbnail_url',
        'description',
        'tags',
        'status',
        'language',
        'privacy',
        'visibility',
        'source',
        'source_url',
        'source_id',
        'source_type',
        'source_format',
        'source_duration',
        'source_size',
        'source_resolution',
        'source_fps',
        'source_codec',
        'source_bitrate',
        'source_audio_codec',
        'source_audio_bitrate',
        'source_audio_channels',
        'source_audio_sample_rate',
        'source_audio_language',
        'source_subtitles',
        'source_subtitles_language',
        'source_subtitles_format',
        'source_subtitles_url',
        'source_thumbnail',
        'source_thumbnail_url',
        'source_license',
        'source_license_url',
        'source_published_at',
        'source_updated_at',
        'source_view_count',
        'source_like_count',
        'source_dislike_count',
        'source_comment_count',
        'source_rating',
        'source_tags',
        'source_keywords',
        'seo_data',
        'user_id',
        'is_monetizable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}