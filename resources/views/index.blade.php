@extends('layouts.master')

@section('title')
    Pagrindinis puslapis
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">Naujausi aforizmai</a></li>
                <li role="presentation"><a href="#top50-likes" aria-controls="top50-likes" role="tab" data-toggle="tab">Mėgstamiausių TOP-50</a></li>
                <li role="presentation"><a href="#top50-comments" aria-controls="top50-comments" role="tab" data-toggle="tab">Komentuojamų TOP-50</a></li>
            </ul>
{{--             <div class="tab-content">
                <!-- Tab "news" -->
                @include('includes.tab-news')
                <!-- Tab "top50-likes" -->
                @include('includes.tab-top50-likes')
                <!-- Tab "top50-comments" -->
                @include('includes.tab-top50-comments')
            </div><!-- /Tabs --> --}}







            {{-- Vue.js playground  --}}
            <br>
            <br>

            <div id="app">
                <button v-on:click="counter++">Increase</button>
                <button v-on:click="counter--">Decrease</button>
                <button v-on:click="secondCounter++">Increase 2</button>
                <p>Counter: @{{ counter }} | @{{ secondCounter }}</p>
                <p>Result: @{{ result() }} | @{{ output }}</p>
            </div>
            <br>
            <hr>

            <div id="exercise">
                <div>
                    <p>Current value: @{{ value }}</p>
                    <button @click="value += 5">Add 5</button>
                    <button @click="value += 1">Add 1</button>
                    <p>@{{ result }}</p>
                </div>
                <div>
                    <input type="text" name="">
                    <p> @{{ value }}</p>
                </div>
            </div>
            <br>
            <hr>
            
            <div id="likes">
                <a href="#" class="like" v-on:mouseover="mouseOverLike" v-on:mouseleave="mouseLeaveLike">
                    <i :class="['fa', 'fa-lg', 'fa-fw', mouseOnLike]" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Balsuok Patinka!"></i>
                </a>
                <span class="badge likes">@{{ counterBadge }}</span>
                <a href="#" class="dislike" v-on:mouseover="mouseOverDislike" v-on:mouseleave="mouseLeaveDislike">
                    <i :class="['fa', 'fa-lg', 'fa-fw', mouseOnDislike]" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Balsuok Nepatinka!"></i>
                </a>
            </div>

        </div><!-- /col-md-8 -->

        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Bootstrap Examples</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item"><span class="badge">14</span>
                        <h4 class="list-group-item-heading">List group item heading</h4>
                        <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></a>
                        <button type="button" class="list-group-item">Cras justo odio<span class="badge">14</span></button>
                        <button type="button" class="list-group-item">Cras justo odio<span class="badge">14</span></button>
                        <button type="button" class="list-group-item">Cras justo odio<span class="badge">14</span></button>
                        <button type="button" class="list-group-item">Cras justo odio<span class="badge">14</span></button>
                        <button type="button" class="list-group-item">Cras justo odio<span class="badge">14</span></button>
                    </div>
                </div>
            </div>

            <div class="well">
                <h4>Autoriai</h4>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

        </div><!-- /col-md-4 -->

    </div><!-- /row -->
</div><!-- /container -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::to('src/js/vue.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('src/js/appv.js') }}"></script>
@endsection
