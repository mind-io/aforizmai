<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{

    public function getSubmit() {

        $categories = Category::orderBy('name', 'desc')->get();
        return view('submissions.create', ['categories' => $categories]);
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

        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            $author = new Author();
            $author->name = $authorName;
            $author->slug = $slug;
            $author->save();
        }

        $quote = new Quote();
        $quote->category_id = $categoryID;
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);

        return redirect()->route('submissions.create')->with([
            'success' => 'Puiku! Aforizmas priimtas ir laukia mūsų balsų...'
        ]);
    }

  
}
