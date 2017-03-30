<?php

namespace App\Listeners;

use App\Events\VoteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoteCount
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
     * @param  VoteEvent  $event
     * @return void
     */
    public function handle(VoteEvent $event)
    {
        $quote = $event->quote;
        $vote_count = $quote->votes()->sum('vote');
        if ($vote_count >= 10) {
            $quote->approved = true;
            $quote->update();
        } else if ($vote_count <= -10) {
            $quote->delete();
        }
    }
}
