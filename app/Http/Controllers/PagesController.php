<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Category;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Scopes\QuoteScope;
// use App\Scopes\SubmissionScope;

class PagesController extends Controller
{
    // Pages for Approved Quotes

    public function getIndex() {

        $newQuotes = Quote::Approved()->take(10)->orderBy('created_at', 'desc')->paginate(5);
        $likedQuotes = Quote::Approved()->has('likes')->withCount('likes')->orderBy('likes_count', 'desc')->paginate(5);
        // dd($quotes);
		// $quotes = Quote::orderByRaw('RAND()')->take(10)->paginate(5);
        // $quotes = Quote::orderBy(DB::raw('RAND()'))->paginate(5);
        // $quotes = Quote::all()->random(10)->paginate(5);
        
        // return $quotes;

        return view('index', [
            'newQuotes' => $newQuotes,
            'likedQuotes' => $likedQuotes
        ]);
    }

    public function getVue() {
        return view('vue');
    }

    public function getCategoryIndex() {

        $quotes = Quote::approved()
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $categories = Category::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('id')
            ->get();

		return view('categories.index', compact('quotes', 'categories'));
    }

    public function getCategoryName($slug) {

        $slug = Category::where('slug', $slug)
            ->withCount('approvedQuotes')
            ->first();

        $quotes = $slug->quotes()
            ->approved()
            ->withCount('likes')            
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        
        $categories = Category::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('id')
            ->get();
        
        return view('categories.name', compact('slug', 'quotes', 'categories'));
    }
    
    public function getAuthorIndex() 
    {
    
        $quotes = Quote::Approved()
            ->withCount('likes')        
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $authors = Author::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('name')
            ->get();

        $topauthors = Author::popular()->orderBy('likes_count', 'desc')->take(10)->get();
 
        return view('authors.index', compact('quotes', 'authors', 'topauthors'));
    }

    public function getAuthorName($slug)
    {
        $slug = Author::where('slug', $slug)
            ->withCount('approvedQuotes')
            ->first();
        
        $quotes = $slug->quotes()
            ->Approved()
            ->withCount('likes')            
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $authors = Author::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('name')
            ->get();
 
        return view('authors.name', compact('slug', 'quotes', 'authors'));
    }

    // Author selector for Approved
    public function postAuthorSelect(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required|integer'
        ]);
        $authorID = $request['author_id'];
        $author = Author::where('id', $authorID)->first();
        $slug = $author->slug;

        return redirect()->action('PagesController@getAuthorsName', ['slug' => $slug]);
    }

    // Pages for NotApproved Quotes (Submissions)

    public function getSubmissionsIndex() {

        $quotes = Quote::NotApproved()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $categories = Category::has('notApprovedQuotes')
            ->withCount('notApprovedQuotes')
            ->orderBy('id')
            ->get();

        $authors = Author::has('notApprovedQuotes')
            ->withCount('notApprovedQuotes')
            ->orderBy('name')
            ->get();

        return view('submissions.index', compact('quotes', 'categories', 'authors'));
    }

    public function getSubmissionsCategoriesName($slug) {

        $slug = Category::where('slug', $slug)->first();

        $quotes = $slug->quotes()
            ->NotApproved()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $categories = Category::has('notApprovedQuotes')
            ->withCount('notApprovedQuotes')
            ->orderBy('id')
            ->get();

        return view('submissions.categories.name', compact('slug', 'quotes', 'categories'));
    }
    
    public function getSubmissionsAuthorsName($slug)
    {
        $slug = Author::where('slug', $slug)->first();

        $quotes = $slug->quotes()
            ->NotApproved()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $authors = Author::has('notApprovedQuotes')
            ->withCount('notApprovedQuotes')
            ->orderBy('name')
            ->get();

        return view('submissions.authors.name', compact('slug', 'quotes', 'authors'));
    }

    // Author selector for NotApproved
    public function postSubmissionsAuthorsSelect(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required|integer'
        ]);
        $authorID = $request['author_id'];
        $author = Author::where('id', $authorID)->first();
        $slug = $author->slug;

        return redirect()->action('PagesController@getSubmissionsAuthorsName', ['slug' => $slug]);
    }


}
