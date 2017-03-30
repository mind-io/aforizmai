<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use Image;
use App\Http\Requests;
use App\Events\VoteEvent;
use App\Vote;
use App\Like;
use App\Quote;
use App\User;
use App\Category;
use App\Author;



class UserController extends Controller
{
    public function userProfile() {
    
    	return view('user.profile', array('user' => Auth::user()) );
    }

    public function userProfileUpdate(Request $request) {
    	// Handle avatar uploead by user
    	if ($request->hasFile('avatar')) {
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save(public_path('/src/img/uploads/avatars/' . $filename) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('user.profile', array('user' => Auth::user()) );
    }

    public function userQuoteCollectionIndex()
    {
        $quotes = Quote::whereHas('likes', function ($query) {
            $userID = Auth::user()->id;
            $query->where('user_id', $userID);
        })->paginate(5);
        
        $categories = Category::whereHas('quotes.likes', function ($query) {
            $userID = Auth::user()->id;
            $query->where('user_id', $userID);
        })->get();

        $authors = Author::whereHas('quotes.likes', function ($query) {
            $userID = Auth::user()->id;
            $query->where('user_id', $userID);
        })->get();        

        return view('user.quote-collection', [
            'user' => Auth::user(), 
            'quotes' => $quotes,
            'categories' => $categories,
            'authors' => $authors
            ]);
    }

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
