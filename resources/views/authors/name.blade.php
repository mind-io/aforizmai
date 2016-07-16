@extends('layouts.master')

@section('title')
        Autorius - {{ $slug->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>{{ $slug->name }} <small>Subtext for header</small></h2>
            </div>
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('authors.index') }}">Visi autoriai</a></li>
                  <li class="active">{{ $slug->name }}</li>
                </ol>
            </div>
            <div>
                @foreach ($quotes as $quote)
                    <blockquote>
                        <p>{{ $quote->quote }}</p> 
                        <cite>
                            <a href="{{ route('authors.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                            <a href="{{ route('categories.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                        </cite>
                        <p align="right">
                            <a href="#">
                                <i class="fa fa-comment-o fa-hover-hidden fa-lg fa-fw"></i>
                                <i class="fa fa-comment fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Komentuoti..."></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-heart-o fa-hover-hidden fa-lg fa-fw"></i>
                                <i class="fa fa-heart fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                            </a>
                        </p>
                    </blockquote>
                @endforeach
            </div>
            <div>
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>
        </div>

        <div class="col-md-4">

            <div class="well">
                <h4>Filtruoti pagal autorių: </h4>
                <select class="form-control">
                    @foreach ($authors as $author)
                        <option>{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
</div>
@endsection