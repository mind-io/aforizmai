@extends('layouts.master')

@section('title')
    Autoriai
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('src/css/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="row">

        {{-- Left col --}}
        <div class="col-md-8 left-column">

            {{-- Header --}}
            <div>
                <h3>Aforizmai pagal autorių <small>(visi autoriai)</small></h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('authors.index') }}">Autoriai</a></li>
                  <li class="active">Visi autoriai</li>
                </ol>
            </div>

            <!-- Blockquote include -->
            @include('includes.blockquote')

            {{-- Pagination --}}
            <div class="paginate">
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /Left --}}

        {{-- Right div --}}
        <div class="col-md-4 right-column">

            {{-- Autoriu topas --}}
            <div class="well">
                <h4><i class="fa fa-fw fa-lg fa-bar-chart" aria-hidden="true"></i> Populiariausi autoriai:</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                        @foreach ($topauthors as $topauthor)
                        <tr>
                            <td><a href="{{ route('authors.name', ['slug' => $topauthor->slug]) }}">{{ $topauthor->name }}</a></td>
                            <td><span class="badge">{{ $topauthor->likes_count }} <i class="fa fa-heart-o fa-fw"></i></span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>{{-- /Autoriu topas --}}

            {{-- Author selector --}}
            <div class="well">
                <form class="form" method="POST" action="{{ route('authors.select') }}">
                {{ csrf_field() }}
                    <div class="form-group input-group-lg {{ $errors->has('author_id') ? ' has-error' : '' }}">
                        <label class="control-label" for="author_id"><h4>Filtruoti pagal autorių:</h4></label>
                        <select id="author_id" class="form-control select2 input-lg" name="author_id">
                            <option> </option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->approved_quotes_count }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-fw fa-filter"></i> Filtruoti
                        </button>
                        <br>
                    </div>
                </form>
            </div>{{-- /Author selector --}}


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

    <script type="text/javascript" src="{{ URL::to('src/js/like.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like.quote') }}';
    </script>

@endsection
