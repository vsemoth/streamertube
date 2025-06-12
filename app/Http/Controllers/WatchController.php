<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class WatchController extends Controller
{
    public function getSingle($value='{slug}')
    {
        // Fetch slug data from database
        $video = Video::where('slug', '=', $value)->first();

        // Return view with post object
        return view('single')->withVideo($video);
    }
}
