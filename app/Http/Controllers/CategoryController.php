<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\Category;

class CategoryController extends Controller
{

    public function getCategoryIndex() 
    {
        $quotes = Quote::approved()
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        $categories = Category::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('id')
            ->get();

		return view('categories.index', compact('quotes', 'categories'));
    }

    public function getCategoryName($slug) 
    {
        $slug = Category::where('slug', $slug)
            ->withCount('approvedQuotes')
            ->first();
        $quotes = $slug->quotes()
            ->approved()
            ->withCount('likes')            
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        $categories = Category::has('approvedQuotes')
            ->withCount('approvedQuotes')
            ->orderBy('id')
            ->get();
        
        return view('categories.name', compact('slug', 'quotes', 'categories'));
    }

    public function getSubmissionsCategoryName($slug)
    {
        $slug = Category::where('slug', $slug)->first();
        $quotes = $slug->quotes()
            ->NotApproved()
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        $categories = Category::has('notApprovedQuotes')
            ->withCount('notApprovedQuotes')
            ->orderBy('id')
            ->get();

        return view('submissions.categories.name', compact('slug', 'quotes', 'categories'));
    }    

}
