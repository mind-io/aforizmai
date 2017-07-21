<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Quote;


class AuthorController extends Controller
{

    public function getAuthorIndex() 
    {
        $quotes = Quote::Approved()
            ->withCount('likes')        
            ->orderBy('created_at', 'desc')
            ->paginate(7);
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
            ->paginate(7);
        $authors = Author::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('name')
            ->get();
 
        return view('authors.name', compact('slug', 'quotes', 'authors'));
    }

    public function getSubmissionsAuthorName($slug)
    {
        $slug = Author::where('slug', $slug)->first();
        $quotes = $slug->quotes()
            ->NotApproved()
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        $authors = Author::has('notApprovedQuotes')
            ->withCount('notApprovedQuotes')
            ->orderBy('name')
            ->get();

        return view('submissions.authors.name', compact('slug', 'quotes', 'authors'));
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

        return redirect()->action('AuthorController@getAuthorName', ['slug' => $slug]);
    }

    // Author selector for NotApproved
    public function postSubmissionsAuthorSelect(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required|integer'
        ]);
        $authorID = $request['author_id'];
        $author = Author::where('id', $authorID)->first();
        $slug = $author->slug;

        return redirect()->action('AuthorController@getSubmissionsAuthorName', ['slug' => $slug]);
    }

	// Method for Typehead script
    public function getAuthorAutocomplete(Request $request)
    {
        $data = Author::select("name")->where("name","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }

}
