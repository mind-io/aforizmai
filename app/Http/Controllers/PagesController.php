<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function getIndex() {

		$quotes = Quote::orderBy('created_at', 'desc')->paginate(5);
		return view('index', ['quotes' => $quotes]);
    }

    public function getCategories() {

        $quotes = Quote::orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
		return view('categories.index', ['quotes' => $quotes, 'categories' => $categories]);
    }

    public function getCategoryName($slug) {

        $slug = Category::where('slug', $slug)->first();
        $categories = Category::all();
        $quotes = $slug->quotes()->orderBy('created_at', 'desc')->paginate(5);

        return view('categories.name', ['quotes' => $quotes, 'slug' => $slug, 'categories' => $categories]);
    }
    
    public function getAuthors() {
    
   		$quotes = Quote::orderBy('created_at', 'desc')->paginate(5);
        $authors = Author::all();
        return view('authors.index', ['quotes' => $quotes, 'authors' => $authors]);
    }

    public function getAuthorName($slug)
    {
        $slug = Author::where('slug', $slug)->first();
        $authors = Author::all();
        $quotes = $slug->quotes()->orderBy('created_at', 'desc')->paginate(5);

        return view('authors.name', ['quotes' => $quotes, 'slug' => $slug, 'authors' => $authors]);
    }

}
