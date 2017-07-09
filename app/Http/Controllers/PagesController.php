<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Category;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function getVue() {
        return view('vue');
    }

    // Index for Approved Quotes
    public function getIndex() {

        $newQuotes = Quote::notApproved()->orderBy('created_at', 'desc')->take(5)->withCount('likes')->get();
        $popularQuotes = Quote::popular()->get()->random(5);
        $randomQuote = Quote::approved()->withCount('likes')->get()->random();
        // dd($randomQuote);
        
        return view('index', compact('newQuotes', 'popularQuotes', 'randomQuote'));
    }

    // Index for NotApproved Quotes (Submissions)
    public function getSubmissionsIndex() {

        $quotes = Quote::notApproved()
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
