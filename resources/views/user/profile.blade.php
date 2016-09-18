@extends('layouts.master')

@section('title')
        Mano duomenys
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/src/img/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }} - mano duomenys</h2>
            <form enctype="multipart/form-data" action="/user/profile" method="POST">
                {{ csrf_field() }}
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <button type="submit" class="pull-right btn btn-primary">
                    <i class="fa fa-paper-plane"></i> Atnaujinti
                </button>            
            </form>
        </div>{{-- /col-md-10 --}}
    </div>{{-- /row --}}
</div>
@endsection

