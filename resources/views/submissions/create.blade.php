@extends('layouts.master')

@section('title')
    Pridėti aforizmą
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Naujas aforizmas (tik registruotiems vartotojams):</div>
                <div class="panel-body">
                    <form class="form" role="form" method="POST" action="{{ route('submissions.store') }}">
                        {{ csrf_field() }}
{{--                         @if(count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach($errors->all() as $error)
                                    {{$error}}
                                @endforeach
                            </div>
                        @endif
 --}}                        
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ Session::get('success') }}
                                <a href="{{ route('submissions.create') }}" class="alert-link"> Atsiūsk dar!</a>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">Autoriaus vardas</label>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Vardas..." value="{{ old('name') }}">
                                    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">                            
                            <div class="col-md-12 form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <div>
                                    <label for="category_id" class="control-label">Kategoroja</label>
                                    <select id="category_id" class="form-control" name="category_id">
                                        <option>Pasirinkite kategoriją...</option>
                                        @foreach ($categories as $category)
                                            <option value={{ $category->id }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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
                                    <textarea name="quote" id="quote" rows="6" class="form-control" name="quote" placeholder="Aforizmo tekstas...">{{ old('quote') }}</textarea>
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
                                    <i class="fa fa-paper-plane"></i> Siūsti aforizmą
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
