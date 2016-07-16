<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}"><img alt="Aforizmų galerija" src="{{ URL::to('src/img/open-book-icon2.png') }}">Aforizmų galerija </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> Apie projektą<span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database" aria-hidden="true"></i> Oficiali kolekcija <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('categories.index') }}">Pagal temą</a></li>
            <li><a href="{{ route('authors.index') }}">Pagal autorių</a></li>
            <li><a href="#">Naujienos</a></li>
            <li><a href="#">Mėgstamiausių TOP-50</a></li>
            <li><a href="#">Komentuojamų TOP-50</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Prisidėk <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/submissions/create') }}">Atsiūsk aforizmą!</a></li>
            <li><a href="#">Balsuok už kitus aforizmus</a></li>
          </ul>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> Komentarai</a></li>
        <!-- Authentication Links -->
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in"></i> Prisijungti</a></li>
          <li><a href="{{ url('/register') }}"><i class="fa fa-btn fa-user-plus"></i> Užsiregistruoti</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} 
            <span class="fa fa-caret-down"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
              <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
              <li><a href="#"><i class="fa fa-ban fa-fw"></i> Ban</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Atsijungti</a></li>
            </ul>
          </li>
        @endif
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        