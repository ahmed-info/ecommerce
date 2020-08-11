<?php

namespace App\Http\Controllers;

use App\Events\VideoViewerEvent;
use App\Models\Video;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function getVideo(){
        $video = Video::first();
        event(new VideoViewerEvent($video));
        return view('video')->with('video',$video);
    }
}
