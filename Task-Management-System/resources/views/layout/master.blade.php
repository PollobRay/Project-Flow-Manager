<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/mystyle.css")}}">
    <title>Document</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
      <!-- Container wrapper -->
      <div class="container">
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

          <div class="d-flex align-items-center">
            @if (Auth::check())
            <a  class="h5" href="{{route('profile')}}">
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