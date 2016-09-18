@extends('layouts.master')

@section('title')
        Autorius - {{ $slug->name }}
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('src/css/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>{{ $slug->name }} <span class="badge">&nbsp;Aforizmų: {{ $slug->quotes()->NotApproved()->count() }}&nbsp;</span></h2>
            </div>
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('submissions.index') }}">Visi autoriai</a></li>
                  <li class="active">{{ $slug->name }} </li>
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
            <div class="well">
                <form class="form" method="POST" action="{{ route('submissions.authors.select') }}">
                {{ csrf_field() }}
                    <div class="form-group input-group-lg {{ $errors->has('author_id') ? ' has-error' : '' }}">
                        <label class="control-label" for="author_id"><h4>Filtruoti pagal autorių:</h4></label>
                        <select id="author_id" class="form-control select2 input-lg" name="author_id">
                            <option> </option>
                            @foreach ($authors as $author)
                                @if(count($author->quotes) > 0)
                                    <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->quotes()->NotApproved()->count() }})</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-filter"></i> Filtruoti
                    </button>
                </form>
            </div>{{-- /well --}}
        </div>{{-- /col-md-4 --}}
    </div>{{-- /row --}}
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $("#author_id").select2({
            theme: "bootstrap",
            placeholder: "Autoriaus paieška...",
            allowClear: true,
            minimumResultsForSearch: 2
        });
    </script>                
@endsection
