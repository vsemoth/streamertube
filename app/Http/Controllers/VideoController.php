<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return Index View
        return view('videos.index', [
            'videos' => Video::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return Create View
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request according to your Video model and create page fields
        $request->validate([
            'video_title' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'niche' => 'required|string|max:255',
            'channel' => 'nullable|string|max:255',
            'video_file' => 'required|file|mimes:mp4,avi,mov,wmv,flv|max:512000', // Require video file, max 500MB
            'seo_data' => 'nullable|string',
        ]);

        // Check if the file is present and valid
        if (!$request->hasFile('video_file') || !$request->file('video_file')->isValid()) {
            return redirect()->back()->withInput()->with('error', 'Upload failed! The video file field is required.');
        }

        $videoFile = $request->file('video_file');
        $originalName = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $videoFile->getClientOriginalExtension();
        $uniqueName = $originalName . '_' . uniqid() . '.' . $extension;
        $videoPath = $videoFile->storeAs('videos', $uniqueName, 'public');

        // Ensure the thumbnails directory exists
        $thumbnailsDir = storage_path('app/public/thumbnails');
        @mkdir($thumbnailsDir, 0755, true);

        // Generate thumbnail using PHP-FFMpeg with error handling
        $thumbnailFileName = 'thumbnails/' . uniqid() . '.jpg';
        $thumbnailFullPath = storage_path("app/public/{$thumbnailFileName}");
        try {
            // Download FFmpeg for Windows from the official site: https://www.gyan.dev/ffmpeg/builds/
            // After downloading, extract and set the path to ffmpeg.exe below if needed.
            // Example: $ffmpeg = FFMpeg::create(['ffmpeg.binaries' => 'C:/path/to/ffmpeg.exe', 'ffprobe.binaries' => 'C:/path/to/ffprobe.exe']);
            $ffmpeg = FFMpeg::create();
            $videoFFMpeg = $ffmpeg->open(storage_path("app/public/{$videoPath}"));
            // Capture a frame at 1 second
            $videoFFMpeg->frame(TimeCode::fromSeconds(1))->save($thumbnailFullPath);
        } catch (\Exception $e) {
            // If thumbnail generation fails, use a default thumbnail or handle the error
            $thumbnailFileName = 'thumbnails/default.jpg';
        }

        // Store relative paths in the database
        $thumbnailPath = 'storage/' . $thumbnailFileName;
        $publicVideoPath = 'storage/' . $videoPath;

        $video = new Video();
        $video->video_title = $request->input('video_title');

        $str = $video->video_title;

        $sep='-';
        
        $res = strtolower($str);
        $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
        $res = preg_replace('/[[:space:]]+/', $sep, $res);
        $slug = trim($res, $sep);

        $video->slug = $slug;

        $video->creator = $request->input('creator');
        $video->category = $request->input('category');
        $video->niche = $request->input('niche');
        $video->channel = $request->input('channel');
        $video->video_path = $publicVideoPath;
        $video->seo_data = $request->input('seo_data');
        $video->user_id = auth()->id();
        $video->is_monetizable = true;
        $video->thumbnail = $thumbnailPath;
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        $video = Video::findOrFail($video->id);

        // Fetch related videos (example: same category, excluding current video)
        $relatedVideos = Video::where('category', $video->category)
            ->where('id', '!=', $video->id)
            ->latest()
            ->take(8)
            ->get();

        return view('videos.show', compact('video', 'relatedVideos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        // Create Edit View
        return view('videos.edit', [
            'video' => $video,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        // Check if the video exists
        if (!$video) {
            return redirect()->route('videos.index')->with('error', 'Video not found.');
        }
        // Validate the request
        $request->validate([
            'video_title' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'niche' => 'required|string|max:255',
            'channel' => 'nullable|string|max:255',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv|max:512000',
            'seo_data' => 'nullable|string',
        ]);

        $data = [
            'video_title' => $request->input('video_title'),
            'creator' => $request->input('creator'),
            'category' => $request->input('category'),
            'niche' => $request->input('niche'),
            'channel' => $request->input('channel'),
            'seo_data' => $request->input('seo_data'),
        ];

        // Handle new video file upload if present
        // Handle new video file upload without if statements or try/catch
        $videoFile = $request->file('video_file');
        $videoPath = optional($videoFile)->store('videos', 'public');

        // Ensure the thumbnails directory exists (no if statement)
        $thumbnailsDir = storage_path('app/public/thumbnails');
        @mkdir($thumbnailsDir, 0755, true);

        // Generate thumbnail using PHP-FFMpeg if a new video file was uploaded (no if/try/catch)
        $ffmpeg = FFMpeg::create();
        $ffmpegVideo = $ffmpeg->open(storage_path("app/public/{$videoPath}"));
        $thumbnailFileName = 'thumbnails/' . uniqid() . '.jpg';
        $thumbnailFullPath = storage_path("app/public/{$thumbnailFileName}");
        $ffmpegVideo->frame(TimeCode::fromSeconds(1))->save($thumbnailFullPath);

        $data['video_path'] = 'storage/' . $videoPath;
        $data['thumbnail'] = 'storage/' . $thumbnailFileName;

        $video->video_title = $data['video_title'];
        $video->creator = $data['creator'];
        $video->category = $data['category'];
        $video->niche = $data['niche'];
        $video->channel = $data['channel'];
        $video->seo_data = $data['seo_data'];
        if (isset($data['video_path'])) {
            $video->video_path = $data['video_path'];
        }
        if (isset($data['thumbnail'])) {
            $video->thumbnail = $data['thumbnail'];
        }
        $video->save();
        // Redirect to the index page with a success message
        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Check if the video exists
        if (!$video) {
            return redirect()->route('videos.index')->with('error', 'Video not found.');
        }
        // Delete the video
        $video->delete();
        // Redirect to the index page with a success message
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }
}
