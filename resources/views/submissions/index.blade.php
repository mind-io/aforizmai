@extends('layouts.master')

@section('title')
    Nepatvirtinti aforizmai
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('css/select2-bootstrap.min.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 left-column">

            {{-- Header --}}
            <div>
                <h3>Aforizmų atranka į oficialią kolekciją</h3>
            </div>

            {{-- Alert msg --}}
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-lg fa-fw fa-info-circle" aria-hidden="true"></i>
                <strong>Warning!</strong><br>
                Better check yourself, you're not looking too good. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <a href="#" class="alert-link">tempor incididunt</a>
                ut labore et dolore <span class="badge votes">20</span> magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('submissions.index') }}">Nepatvirtinti aforizmai</a></li>
                  <li class="active">Visi</li>
                </ol>
            </div>

            <!-- Blockquote include -->
                @forelse ($quotes as $quote)
                    @include('includes.blockquote-submission')
                @empty
                    <br><p>Nėra nepatvirtintų aforizmų...</p>
                @endforelse

            {{-- Pagination --}}
            <div class="paginate">
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /col-md-8 --}}

        <div class="col-md-4 right-column">

            {{-- Quote categories panel --}}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-lg fa-bookmark-o" aria-hidden="true"></i> Aforizmų temos</h4>
                </div>           
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            <a href="{{ route('submissions.category.name', ['slug' => $category->slug]) }}" class="list-group-item list-group-item-default">
                            <span class="badge">{{ $category->not_approved_quotes_count }}</span>
                            <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                            <p class="list-group-item-text">{{ $category->description }}</p></a>
                        @endforeach
                    </div>
                </div>
            </div>{{-- /Categories panel --}}

            {{-- Quote Author selector --}}
            <div class="well">
                <form class="form" method="POST" action="{{ route('submissions.author.select') }}">
                {{ csrf_field() }}
                    <div class="form-group input-group-lg {{ $errors->has('author_id') ? ' has-error' : '' }}">
                        <label class="control-label" for="author_id">
                        <h4><i class="fa fa-fw fa-lg fa-search" aria-hidden="true"></i> Filtruoti pagal autorių:</h4></label>
                        <select id="author_id" class="form-control select2 input-lg" name="author_id">
                            <option> </option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->not_approved_quotes_count }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-fw fa-filter"></i> Filtruoti
                    </button>
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

    <script type="text/javascript" src="{{ URL::to('js/vote.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlVote = '{{ route('submissions.vote') }}';
    </script>

@endsection
