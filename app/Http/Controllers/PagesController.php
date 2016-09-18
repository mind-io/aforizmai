<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Category;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    // Pages for Approved Quotes

    public function getIndex() {

		$quotes = Quote::orderByRaw('RAND()')->take(5)->get();
        // $quotes = Quote::orderBy(DB::raw('RAND()'))->paginate(5);
        // $quotes = Quote::all()->random(10)->paginate(5);
 
        return view('index', ['quotes' => $quotes]);
    }

    public function getCategoriesIndex() {

        $quotes = Quote::Approved()->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::whereHas('quotes', function ($query) {
            $query->where('approved', true);
        })->orderBy('id', 'asc')->get();

		return view('categories.index', ['quotes' => $quotes, 'categories' => $categories]);
    }

    public function getCategoriesName($slug) {

        $slug = Category::where('slug', $slug)->first();
        $categories = Category::whereHas('quotes', function ($query) {
            $query->where('approved', true);
        })->orderBy('id', 'asc')->get();
        $quotes = $slug->quotes()->Approved()->orderBy('created_at', 'desc')->paginate(5);
 
        return view('categories.name', ['quotes' => $quotes, 'slug' => $slug, 'categories' => $categories]);
    }
    
    public function getAuthorsIndex() {
    
        $quotes = Quote::Approved()->orderBy('created_at', 'desc')->paginate(5);
        $authors = Author::whereHas('quotes', function ($query) {
            $query->where('approved', true);
        })->orderBy('name', 'asc')->get();
 
        return view('authors.index', ['quotes' => $quotes, 'authors' => $authors]);
    }

    public function getAuthorsName($slug)
    {
        $slug = Author::where('slug', $slug)->first();
        $authors = Author::whereHas('quotes', function ($query) {
            $query->where('approved', true);
        })->orderBy('name', 'asc')->get();
        $quotes = $slug->quotes()->Approved()->orderBy('created_at', 'desc')->paginate(5);

        return view('authors.name', ['quotes' => $quotes, 'slug' => $slug, 'authors' => $authors]);
    }

    // Author selector for Approved
    public function postAuthorsSelect(Request $request)
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

        $quotes = Quote::NotApproved()->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::whereHas('quotes', function ($query) {
            $query->where('approved', false);
        })->get();
        $authors = Author::whereHas('quotes', function ($query) {
            $query->where('approved', false);
        })->get();
        
        return view('submissions.index', ['quotes' => $quotes, 'categories' => $categories, 'authors' => $authors]);
    }

    public function getSubmissionsCategoriesName($slug) {

        $slug = Category::where('slug', $slug)->first();
        $categories = Category::whereHas('quotes', function ($query) {
            $query->where('approved', false);
        })->orderBy('id', 'asc')->get();
        $quotes = $slug->quotes()->NotApproved()->orderBy('created_at', 'desc')->paginate(5);
        return view('submissions.categories.name', ['quotes' => $quotes, 'slug' => $slug, 'categories' => $categories]);
    }
    
    public function getSubmissionsAuthorsName($slug)
    {
        $slug = Author::where('slug', $slug)->first();
        $authors = Author::whereHas('quotes', function ($query) {
            $query->where('approved', false);
        })->orderBy('name', 'asc')->get();
        $quotes = $slug->quotes()->NotApproved()->orderBy('created_at', 'desc')->paginate(5);
        return view('submissions.authors.name', ['quotes' => $quotes, 'slug' => $slug, 'authors' => $authors]);
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
