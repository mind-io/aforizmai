@extends('layouts.master')

@section('title')
        Kategorija - {{ $slug->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>{{ $slug->name }} <br><small>{{ $slug->description }}</small></h2>
            </div>
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('submissions.index') }}">Visos kategorijos</a></li>
                  <li class="active">{{ $slug->name }}</li>
                </ol>
            </div>
            <div>
                @foreach ($quotes as $quote)
                    <blockquote>
                        <p>{{ $quote->quote }}</p> 
                        <cite>
                            <a href="{{ route('submissions.authors.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                            <a href="{{ route('submissions.categories.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                        </cite>
                        <p align="right">
                            <a href="#">
                                <i class="fa fa-thumbs-o-up fa-lg fa-hover-hidden fa-fw" aria-hidden="true"></i>
                                <i class="fa fa-thumbs-up fa-lg fa-hover-show fa-fw" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Patinka!"></i>
                            </a>
                            <span class="badge">42</span>
                            <a href="#">
                                <i class="fa fa-thumbs-o-down fa-lg fa-hover-hidden fa-fw" aria-hidden="true"></i>
                                <i class="fa fa-thumbs-down fa-lg fa-hover-show fa-fw" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Nepatinka!"></i>
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
        </div>{{-- /col-md-8 --}}

        <div class="col-md-4">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>            
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            @if(count($category->quotes) > 0)
                                <a href="{{ route('submissions.categories.name', ['slug' => $category->slug]) }}" 
                                    @if (Request::segment(3) == $category->slug)
                                        class="list-group-item list-group-item-info"
                                    @else
                                        class="list-group-item list-group-item-default"
                                    @endif
                                >
                                <span class="badge">{{ $category->quotes()->NotApproved()->count() }}</span>
                                <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                                <p class="list-group-item-text">{{ $category->description }}</p></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>{{-- /panel --}}

        </div>{{-- /col-md-4 --}}
    </div>{{-- /row --}}
</div>
@endsection