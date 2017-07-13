@extends('layouts.master')

@section('title')
    Registracija
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">Užpildyk registracijos formą:</div>
                <div class="panel-body" style="padding-top: 30px;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Vardas</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">El. paštas</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Slaptažodis</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Pakartok slaptažodį</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user-plus fa-fw"></i> Registruotis
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
