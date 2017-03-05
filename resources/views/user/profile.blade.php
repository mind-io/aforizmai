@extends('layouts.master')

@section('title')
        Mano duomenys
@endsection

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/src/img/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }} - mano duomenys</h2>
            <form enctype="multipart/form-data" action="{{ route('user.profile.update') }}" method="POST">
                {{ csrf_field() }}
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <button type="submit" class="pull-right btn btn-primary">
                    <i class="fa fa-floppy-o fa-fw"></i> Išsaugoti
                </button>            
            </form>
        </div>
    </div>
</div> --}}
<br>
<div class="container" style="padding-top: 10px; ">
    {{-- <h2 class="page-header text-center">Mano profilis</h2> --}}
    <div class="row">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" action="{{ route('user.profile.update') }}" method="POST">
            {{ csrf_field() }}
            <!-- left column -->
            <div class="col-md-4 col-sm-5 col-xs-12" style="padding-top: 20px;">
                <div class="text-center">
                    <img src="/src/img/uploads/avatars/{{ $user->avatar }}" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h5><i class="fa fa-camera fa-fw"></i> Pakeisti profilio nuotrauką:</h5>
                    <input type="file" name="avatar" class="text-center center-block well well-sm">
                </div>
            </div><!-- //left column -->

            <!-- right column -->
            <div class="col-md-8 col-sm-7 col-xs-12">
                <h2>Mano profilis</h2>
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <i class="fa fa-coffee"></i>
                    This is an <strong>.alert</strong>. Use this to show important messages to the user.
                </div>
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

