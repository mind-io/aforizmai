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

    public function getVue() {
        return view('vue');
    }


    // Index for Approved Quotes
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

    // Index for NotApproved Quotes (Submissions)
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

}
