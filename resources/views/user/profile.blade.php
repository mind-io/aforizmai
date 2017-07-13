@extends('layouts.master')

@section('title')
        Mano profilis
@endsection

@section('content')

<div class="container">
    {{-- <h2 class="page-header text-center">Mano profilis</h2> --}}
    <div class="row">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" action="{{ route('user.profile.update') }}" method="POST">
            {{ csrf_field() }}

            <!-- left column -->
            <div class="col-md-4 col-sm-5 col-xs-12" style="margin-top: 21px;">
                <div class="text-center">
                    <img src="/img/uploads/avatars/{{ $user->avatar }}" class="avatar img-circle img-thumbnail" alt="avatar">
{{--                     <h5><i class="fa fa-camera fa-fw"></i> Pakeisti profilio nuotrauką:</h5>
                    <input type="file" name="avatar" class="text-center center-block well well-sm"> --}}
                </div>

                <div style="margin-top: 21px;">
                    <h4 class="text-center">Profilio nuotrauka:</h4>
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                <i class="fa fa-camera fa-lg fa-fw"></i><input type="file" name="avatar" style="display: none;" onchange="$('#upload-file-info').val($(this).val());">
                            </span>
                        </label>
                        <input type="text" id="upload-file-info" class="form-control" value="Pasirinkite naują failą..." readonly>
                    </div> 
                </div>
            </div><!-- //left column -->

            <!-- right column -->
            <div class="col-md-8 col-sm-7 col-xs-12">
                <h2>Mano profilis</h2>
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle fa-lg fa-fw" aria-hidden="true"></i> {{ Session::get('success') }}
                    </div>
                @endif                

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Personal info</h3>
                    </div>
                    <div class="panel-body" style="padding-top: 30px;">
                        {{-- <form class="form-horizontal" role="form"> --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Vardas:</label>
                                <div class="col-md-8">
                                    <input id="name" name="name" class="form-control" value="{{ $user->name }}" type="text">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">El. paštas:</label>
                                <div class="col-md-8">
                                    <input id="email"  name="email" class="form-control" value="{{ $user->email }}" type="email" disabled>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o fa-fw"></i> Išsaugoti
                                    </button>       
                                    <span>&nbsp;</span>
                                    <button type="reset" class="btn btn-default">
                                        <i class="fa fa-ban fa-fw"></i> Atšaukti
                                    </button>       
                                </div>
                            </div>
                    </div><!-- //panel-body -->
                </div><!-- //panel -->
            </div><!-- //right column -->

        </form>
    </div><!-- //row -->
</div>

@endsection