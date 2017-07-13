@extends('layouts.master')

@section('title')
    Prisijungimas
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">Įvesk prisijungimo duomenis:</div>
                <div class="panel-body" style="padding-top: 30px;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">El. pašto adresas</label>
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Prisiminti mane
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in fa-fw"></i> Prisijungti
                                </button>

                                <br><br>
                                <a class="btn btn-default btn-xs" href="{{ url('/password/reset') }}" style="margin-right: 7px;">
                                <i class="fa fa-key fa-fw" aria-hidden="true"></i> Užmiršai savo slaptažodį?</a>
                                <a class="btn btn-default btn-xs" href="{{ url('/register') }}">
                                <i class="fa fa-btn fa-user-plus fa-fw" aria-hidden="true"></i> Neturi paskyros?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
