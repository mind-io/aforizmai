@extends('layouts.master')

@section('title')
        Kategorija - {{ $slug->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            {{-- Header --}}
            <div>
                <h3>{{ $slug->name }} <br><small>{{ $slug->description }}</small></h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('submissions.index') }}">Visos kategorijos</a></li>
                  <li class="active">{{ $slug->name }}</li>
                </ol>
            </div>

            <!-- Blockquote include -->
            @include('includes.blockquote-submission')

            {{-- Pagination --}}
            <div>
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /col-md-8 --}}

        <div class="col-md-4">

            {{-- Quote categories panel --}}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>            
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            @if(count($category->quotes) > 0)
                                <a href="{{ route('submissions.categories.name', ['slug' => $category->slug]) }}" 
                                    @if (Request::segment(3) == $category->slug)
                                        class="list-group-item list-group-item-primary disabled"
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
            </div>{{-- /Categories panel --}}

        </div>{{-- /col-md-4 --}}
    </div>{{-- /row --}}
</div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ URL::to('src/js/vote.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlVote = '{{ route('submissions.vote') }}';
    </script>

@endsection