<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Events\VoteEvent;
use App\Vote;
use App\Quote;
use App\User;

class VoteController extends Controller
{

    public function postVoteSubmission(Request $request)
    {
        $quote_id = $request['quoteId'];
        $is_vote = $request['isVote'];
        $vote_status = false;
        $quote = Quote::find($quote_id);
        if (!$quote) {
            return Response::json(['message' => 'Aforizmas nerastas.'], 404);
        }
        $user = Auth::user();
        $vote = $user->votes()->where('quote_id', $quote_id)->first();
        if ($vote) {
            $already_voted = $vote->vote;
            $vote_status = true;
            if ($already_voted == $is_vote) {
                $vote->delete();
                return Response::json(['message' => 'Balsas atšauktas!'], 200);
            }
        } else {
            $vote = new Vote();
        }
        $vote->vote = $is_vote;
        $vote->user_id = $user->id;
        $vote->quote_id = $quote->id;
        if ($vote_status) {
            $vote->update();
        } else {
            $vote->save();
            Event::fire(new VoteEvent($quote));
        }        
        return Response::json(['message' => 'Balsas priimtas!'], 200);
    }

}
