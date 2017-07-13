@extends('layouts.master')

@section('title')
    Mano kolekcija - {{ $slug->name }}
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('css/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="row">

        {{-- Left col --}}
        <div class="col-md-8 left-column">

            {{-- Header --}}
            <div>
                <h3>{{ $slug->name }} 
                    <span class="badge">&nbsp;Aforizmų: {{ $slug->quotes_count }}&nbsp;</span>
                    <br><small>{{ $slug->description }}</small>
                </h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('user.quote.collection.index') }}">Mano kolekcija</a></li>
                  <li class="active">{{ $slug->name }}</li>
                </ol>
            </div>

            <!-- Blockquote include -->
            @foreach ($quotes as $quote)
                @include('includes.blockquote-user')
            @endforeach

            {{-- Pagination --}}
            <div class="paginate">
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /Left col-md-8 --}}

        {{-- Right col --}}
        <div class="col-md-4 right-column">

            {{-- Author selector --}}
            <div class="well">
                <form class="form" method="POST" action="{{ route('user.quote.collection.author.select') }}">
                {{ csrf_field() }}
                    <div class="form-group input-group-lg {{ $errors->has('author_id') ? ' has-error' : '' }}">
                        <label class="control-label" for="author_id">
                        <h4><i class="fa fa-fw fa-lg fa-search" aria-hidden="true"></i> Filtruoti pagal autorių:</h4></label>
                        <select id="author_id" class="form-control select2 input-lg" name="author_id">
                            <option> </option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->quotes_count }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-info btn-block">
                            <i class="fa fa-fw fa-filter"></i> Filtruoti
                        </button>
                        <br>
                    </div>
                </form>
            </div>{{-- /Author selector --}}            

        </div>{{-- /Right col-md-4 --}}
    </div>{{-- /row --}}
</div>{{-- /container --}}
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

    <script type="text/javascript" src="{{ URL::to('js/like.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like.quote') }}';
    </script>

@endsection
