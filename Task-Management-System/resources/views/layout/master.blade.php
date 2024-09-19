<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets/css/mystyle.css")}}">
    <title>Document</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg " style="background: rgba(198, 211, 240, 0.562)">
      <!-- Container wrapper -->
      <div class="container" >
        <!-- Toggle button -->
        <button
          data-mdb-collapse-init
          class="navbar-toggler"
          type="button"
          data-mdb-target="#navbarButtonsExample"
          aria-controls="navbarButtonsExample"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}" style="font-weight: bold; font-size: 24px; color: black; text-transform: uppercase;">Task Management System</a>
            </li>
          </ul>
          <!-- Left links -->

          <div class="d-flex align-items-center" style="margin-right: 8em">
            <a  class="link-success link-underline-opacity-0 " href="{{route('profile')}}"><p class="h5 fw-bold" style="text-transform: uppercase; margin-right:1em">My Tasks</p></a>
            <a  class="link-success link-underline-opacity-0 " href="{{route('myprojects')}}"><p class="h5 fw-bold" style="text-transform: uppercase;">My Projects</p></a>
          </div>

          <div class="d-flex align-items-center">
            @if (Auth::check())
            <a  class="h5 link-danger" href="{{route('profile')}}">
              {{Auth::user()->name}}
            </a>    
            @else
            <a  class="btn btn-outline-success" href="{{route('login')}}">
              Login
            </a>
            @endif
          </div>
        </div>
        <!-- Collapsible wrapper -->
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

      @yield('content')  <!-- a section is created here and the section content code is will push from another file posts.blade -->

    <script src="{{asset("assets/js/bootstrap.bundle.min.js")}}"></script>
</body>
</html>