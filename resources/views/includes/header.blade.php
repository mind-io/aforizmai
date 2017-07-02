<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}"><img alt="Aforizmų galerija" src="{{ URL::to('src/img/logo2b.png') }}">Aforizmų<br>galerija </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li class="dropdown">
          <a href="{{ route('category.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book fa-lg fa-fw" aria-hidden="true"></i> Oficiali kolekcija <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('category.index') }}">Aforizmai pagal temą</a></li>
            <li><a href="{{ route('author.index') }}">Aforizmai pagal autorių</a></li>
            <li><a href="#">Naujienos</a></li>
            <li><a href="#">Mėgstamiausių TOP-50</a></li>
            <li><a href="#">Komentuojamų TOP-50</a></li>
          </ul>
        </li>

        <li {{ Request::is('submissions*') ? 'class=active' : '' }}>
          <a href="{{ route('submissions.index') }}"><i class="fa fa-fw fa-lg fa-thumbs-up" aria-hidden="true"></i> Balsuojam !</a>
        </li>

        <li style="padding-left:16px;">
          <form action="{{ route('submissions.create') }}">
            <button class="btn btn-success btn-sm navbar-btn" href="{{ route('submissions.create') }}">
            <i class="fa fa-fw fa-lg fa-plus" aria-hidden="true"></i> Naujas aforizmas</button>
          </form>
        </li>

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">

        {{-- <li class="active"><a href="#"><i class="fa fa-comments fa-lg" aria-hidden="true"></i> Komentarai</a></li> --}}

        <li style="padding-right:20px">
          <a href="#"><i class="fa fa-info-circle fa-lg fa-fw" aria-hidden="true"></i> Apie projektą<span class="sr-only">(current)</span></a>
        </li>

        <!-- Authentication Links -->
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in fa-lg fa-fw"></i> Prisijungti</a></li>
          <li><a href="{{ url('/register') }}"><i class="fa fa-btn fa-user-plus fa-lg fa-fw"></i> Užsiregistruoti</a></li>
        @else
          <li class="dropdown">
            <a href="{{ route('user.profile') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="position:relative; padding-left:50px;">
            <img src="/src/img/uploads/avatars/{{ Auth::user()->avatar }}" class="avatar-img"> 
            {{ Auth::user()->name }}
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('user.profile') }}"><i class="fa fa-user-circle fa-fw"></i> Mano profilis</a></li>
              <li><a href="{{ route('user.quote.collection.index') }}"><i class="fa fa-book fa-fw"></i> Mano aforizmai</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Atsijungti</a></li>
            </ul>
          </li>
        @endif
        
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
        