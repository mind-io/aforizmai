@extends('layouts.master')

@section('title')
    Pridėti aforizmą
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <div>
{{--                 @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif --}}
                
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle fa-lg fa-fw" aria-hidden="true"></i> 
                        {{ Session::get('success') }}
                        <strong>Atsiūsk dar</strong> arba balsuok už jau atsiūstus <a href="{{ route('submissions.index') }}" class="alert-link"><i class="fa fa-thumbs-up fa-lg fa-fw" aria-hidden="true"></i> <i class="fa fa-thumbs-down fa-lg fa-fw" aria-hidden="true"></i></a>
                    </div>
                @endif
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Pridėti naują aforizmą: &nbsp;<small>({{-- <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> --}} tik registruotiems vartotojams )</small></h4>
                </div>
                <div class="panel-body" style="padding-left: 20px; padding-right: 20px;">
                    <form class="form" role="form" method="POST" action="{{ route('submissions.store') }}">
                    {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="name" class="control-label">Autoriaus vardas</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search fa-fw" aria-hidden="true"></i></span>
                                        <input id="name" type="text" class="typeahead form-control" name="name" autocomplete="off" placeholder="Vardas Pavardė (Anonimas, Liaudies išmintis ir pan.)" value="{{ old('name') }}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <div>
                                    <label for="category_id" class="control-label">Kategoroja</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list fa-fw" aria-hidden="true"></i></span>
                                        <select id="category_id" class="form-control" name="category_id">
                                            {{-- &#10148; &#9745; --}}
                                            <option disabled selected>Kategorijos pasirinkimas . . . </option>
                                            @foreach ($categories as $category)
                                                @if (old('category_id') == $category->id)
                                                      <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif                                   
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group{{ $errors->has('quote') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="quote" class="control-label">Aforizmo tekstas</label>
                                    <textarea name="quote" id="quote" rows="6" class="form-control" name="quote" placeholder="Aforizmo tekstas be kabučių">{{ old('quote') }}</textarea>
                                    @if ($errors->has('quote'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quote') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 15px">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fa fa-paper-plane fa-fw"></i> Siūsti aforizmą
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-info-circle fa-fw fa-lg" aria-hidden="true"></i> Formos pildymo pastabos</h3>
                        </div>
                        <div class="panel-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div>

                </div>{{-- /panel-body --}}
            </div>{{-- /panel --}}
        </div>{{-- /col-md-8 col-md-offset-2 --}}
    </div>{{-- /row --}}
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        var path = "{{ route('submissions.author.autocomplete') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection