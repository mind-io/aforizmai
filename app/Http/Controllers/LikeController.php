<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Events\VoteEvent;
use App\Like;
use App\Quote;
use App\User;

class LikeController extends Controller
{

    public function postLikeQuote(Request $request)
    {
        if (Auth::check()) {

            $quote_id = $request['quoteId'];
            $is_like = $request['isLike'] === 'true';
            $like_status = false;
            $quote = Quote::find($quote_id);
            if (!$quote) {
                return Response::json(['message' => 'Aforizmas nerastas.'], 404);
            }
            $user = Auth::user();
            $like = $user->likes()->where('quote_id', $quote_id)->first();
            if ($like) {
                $already_liked = $like->like;
                $like_status = true;
                if ($already_liked == $is_like) {
                    $like->delete();
                    return Response::json(['message' => 'Išmesta iš kolekcijos!'], 200);
                }
            } else {
                $like = new Like();
            }
            $like->like = $is_like;
            $like->user_id = $user->id;
            $like->quote_id = $quote->id;
            if ($like_status) {
                $like->update();
            } else {
                $like->save();
            }        
            return Response::json(['message' => 'Pridėta į kolekciją!'], 200);
        }
        return redirect()->guest('login');
    }

}
