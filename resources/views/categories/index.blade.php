@extends('layouts.master')

@section('title')
    Kategorijos
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8" style="padding-left: 30px;">
            <div>
                <h3>Aforizmai pagal temą <small>(visos temos)</small></h3>
            </div>
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('categories.index') }}">Kategorijos</a></li>
                  <li class="active">Visos</li>
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
                            15<a href="#">
                                <i class="fa fa-comment-o fa-hover-hidden fa-lg fa-fw"></i>
                                <i class="fa fa-comment fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Komentuoti..."></i>
                            </a>&nbsp;
                            9<a href="#">
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

        <div class="col-md-4" style="padding-left: 30px; margin-top:21px;">

{{--             <div class="list-group">
                <div class="list-group-item list-group-item-success"><h4><strong>Aforizmų temos</strong></h4></div>
                @foreach ($categories as $category)
                    @if(count($category->quotes) > 0)
                        <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" class="list-group-item list-group-item-default">
                        <span class="badge">{{ $category->quotes()->Approved()->count() }}</span>
                        <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                        <p class="list-group-item-text">{{ $category->description }}</p></a>
                    @endif
                @endforeach
            </div> --}}

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            @if(count($category->quotes) > 0)
                                <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" class="list-group-item">
                                <span class="badge">{{ $category->quotes()->Approved()->count() }}</span>
                                <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                                <p class="list-group-item-text">{{ $category->description }}</p></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection