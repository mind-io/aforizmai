<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Category;
use App\Like;
use App\User;
use App\Events\LikeEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;

class QuoteController extends Controller
{

    public function getSubmitForm() 
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('submissions.create', ['categories' => $categories]);
    }

    public function getAuthorAutocomplete(Request $request)
    {
        $data = Author::select("name")->where("name","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }

    public function submitQuote(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:60|alpha_spaces',
            'category_id'   => 'required|integer',
            'quote'         => 'required|max:800'
        ]);
        $authorName = ucwords(strtolower($request['name']));
        $categoryID = $request['category_id'];
        $quoteText = $request['quote'];
        $slug = str_slug($authorName, "-");
        $userID = Auth::user()->id;

        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            $author = new Author();
            $author->name = $authorName;
            $author->slug = $slug;
            $author->save();
        }

        $quote = new Quote();
        $quote->category_id = $categoryID;
        $quote->user_id = $userID;
        $quote->quote = $quoteText;
        $quote->approved = false;
        $author->quotes()->save($quote);

        return redirect()->route('submissions.create')->with([
            'success' => 'Puiku! Aforizmas priimtas.'
        ]);
    }

    public function postLikeSubmission(Request $request)
    {
        $quote_id = $request['quoteId'];
        $is_like = $request['isLike'];
        $like_status = false;
        $quote = Quote::find($quote_id);
        if (!$quote) {
            return Response::json(['message' => 'Aforizmas nerastas.'], 404);
        }
        $user = Auth::user();
        $like = $user->likes()->where('quote_id', $quote_id)->first();
        if ($like) {
            $already_like = $like->like;
            $like_status = true;
            if ($already_like == $is_like) {
                $like->delete();
                return Response::json(['message' => 'Balsas atšauktas!'], 200);
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
            Event::fire(new LikeEvent($quote));
        }        
        return Response::json(['message' => 'Balsas priimtas!'], 200);
    }


    // CSV import for Apprtoved Quotes
    public function getCSV() 
    {
        if (($handle = fopen('quotes.csv',"r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ';')) !==FALSE)
            {
                $authorName = ucwords(strtolower($data[1]));
                $categoryID = $data[2];
                $quoteText = $data[0];
                $slug = str_slug($authorName, "-");
                $userID = 1;

                $author = Author::where('name', $authorName)->first();
                    if (!$author) {
                        $author = new Author();
                        $author->name = $authorName;
                        $author->slug = $slug;
                        $author->save();
                    }

                $quote = new Quote();
                $quote->category_id = $categoryID;
                $quote->user_id = $userID;
                $quote->quote = $quoteText;
                $quote->approved = true;
                $author->quotes()->save($quote);
            }
            fclose($handle);
        }
        return Category::withCount('quotes')->get();
    }


    // public function getCSV() {

    //     if (($handle = fopen('authors.csv',"r")) !== FALSE)
    //     {
    //         while (($data = fgetcsv($handle, 1000, ',')) !==FALSE)
    //         {
    //                 $author = new Author();
    //                 $author->name = $data[0];
    //                 $author->slug = $data[1];
    //                 $author->save();
    //         }
    //         fclose($handle);
    //     }
    //     return Author::all();
    // }
  
}
