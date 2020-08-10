<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function getVideo(Type $var = null)
    {
        return view('video');
    }
}
