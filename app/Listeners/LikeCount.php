<?php

namespace App\Listeners;

use App\Events\LikeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LikeCount
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
     * @param  LikeEvent  $event
     * @return void
     */
    public function handle(LikeEvent $event)
    {
        $quote = $event->quote;
        $like_count = $quote->likes()->sum('like');
        if ($like_count >= 10) {
            $quote->approved = true;
            $quote->update();
        }
    }
}
