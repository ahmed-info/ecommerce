<?php

namespace App\Listeners;

use App\Events\VideoViewerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    //listner with event
    public function handle(VideoViewerEvent $event)
    {
        $this-> updateViewer($event->video);
    }

    public function updateViewer($video)
    {
       $video->viewer = $video->viewer+1;
       $video->save();
    }

}
