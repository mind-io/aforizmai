<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use Image;
use App\Http\Requests;
use App\Quote;
use App\User;
use App\Category;
use App\Author;


class UserController extends Controller
{
    public function userProfile()
    {
    	return view('user.profile', array('user' => Auth::user()) );
    }

    public function userProfileUpdate(Request $request)
    {
    	// Handle avatar uploead by user
    	if ($request->hasFile('avatar')) {
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save(public_path('/img/uploads/avatars/' . $filename) );

            $username = $request['name'];
    		$user = Auth::user();
    		$user->avatar = $filename;
            $user->name = $username;
    		$user->update();
    	}

        $username = $request['name'];
        $user = Auth::user();
        $user->name = $username;
        $user->update();


    	return redirect()->route('user.profile', array('user' => Auth::user()) )->with([
            'success' => 'Profilis sėkmingai atnaujinatas!'
        ]);;
    }

    public function userQuoteCollectionIndex()
    {
        // $quotes = Quote::whereHas('likes', function ($query) {
        //     $userID = Auth::user()->id;
        //     $query->where('user_id', $userID);
        // })->paginate(5);

        $quotes = Quote::has('userFavoriteQuotes')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(5);      

        $categories = Category::whereHas('quotes.likes', function ($query) {
            $query->userLikes();
        })
        ->withCount(['quotes' => function ($query) {
            $query->has('userFavoriteQuotes');
        }])
        ->orderBy('id')
        ->get();

        $authors = Author::whereHas('quotes.likes', function ($query) {
            $query->userLikes();
        })
        ->withCount(['quotes' => function ($query) {
            $query->has('userFavoriteQuotes');
        }])
        ->orderBy('name')
        ->get();

        return view('user.quote-collection', [
            'user' => Auth::user(), 
            'quotes' => $quotes,
            'categories' => $categories,
            'authors' => $authors
            ]);
    }

    public function userQuoteCollectionCategory($slug)
    {
        $slug = Category::where('slug', $slug)
            ->withCount(['quotes' => function ($query) {
                $query->has('userFavoriteQuotes');
        }])->first();

        $quotes = $slug->quotes()
            ->has('userFavoriteQuotes')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(5);      

        $categories = Category::whereHas('quotes.likes', function ($query) {
            $query->userLikes();
        })
        ->withCount(['quotes' => function ($query) {
            $query->has('userFavoriteQuotes');
        }])
        ->orderBy('id')
        ->get();

        return view('user.quote-collection-category', [
            'user' => Auth::user(),
            'slug' => $slug,
            'quotes' => $quotes,
            'categories' => $categories
            ]);
    }

    public function userQuoteCollectionAuthor($slug)
    {
        $slug = Author::where('slug', $slug)
            ->withCount(['quotes' => function ($query) {
                $query->has('userFavoriteQuotes');
        }])->first();
        
        $quotes = $slug->quotes()
            ->has('userFavoriteQuotes')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(5);      

        $authors = Author::whereHas('quotes.likes', function ($query) {
            $query->userLikes();
        })
        ->withCount(['quotes' => function ($query) {
            $query->has('userFavoriteQuotes');
        }])
        ->orderBy('name')
        ->get();

        return view('user.quote-collection-author', [
            'user' => Auth::user(),
            'slug' => $slug,
            'quotes' => $quotes,
            'authors' => $authors
            ]);        
    }

    // Author selector for User Collection
    public function userQuoteCollectionAuthorSelect(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required|integer'
        ]);
        $authorID = $request['author_id'];
        $author = Author::where('id', $authorID)->first();
        $slug = $author->slug;

        return redirect()->action('UserController@userQuoteCollectionAuthor', ['slug' => $slug]);
    }

}
