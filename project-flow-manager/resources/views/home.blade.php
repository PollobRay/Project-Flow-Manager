
@extends('layout.master') 
<!-- import code from layout/master.blade.php code -->

@section('content') <!-- push some code into at yeild('content') of master.blade --> 

<section class="bg-image"
style="background-image: url({{asset('assets/images/bg1.png')}}); width: 100%; height: 1000px; background-size: cover; background-position: center;">
<div class="mask d-flex align-items-center h-25 gradient-custom-3" >
    <div class="container h-100 mt-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-12">
          <div class="card" style="border-radius: 15px; background-color: rgba(233, 231, 231, 0.863);">
            <div class="card-body p-5" >
              <div class="d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-uppercase fw-bold text-center mb-2">Browse Your Tasks</h2> 
                <a class="btn btn-outline-success btn-lg fw-bold align-items-center text-uppercase mt-4" href="{{route('myTasks')}}">Your Tasks &#8594;</a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="mask d-flex align-items-center h-25 gradient-custom-3" >
    <div class="container h-100 mt-5 ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-12">
          <div class="card" style="border-radius: 15px; background-color: rgba(233, 231, 231, 0.863);">
            <div class="card-body p-5" >
              <div class="d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-uppercase fw-bold text-center mb-2">Browse Project Categories</h2> 
                <a class="btn btn-outline-success btn-lg fw-bold align-items-center text-uppercase mt-4" href="{{route('category')}}">Project Categories &#8594;</a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="mask d-flex align-items-center h-25 gradient-custom-3" >
    <div class="container h-100 mt-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-12">
          <div class="card" style="border-radius: 15px; background-color: rgba(233, 231, 231, 0.863);">
            <div class="card-body p-5" >
              <div class="d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-uppercase fw-bold text-center mb-2">Browse Projects</h2> 
                <a class="btn btn-outline-success btn-lg fw-bold align-items-center text-uppercase mt-4" href="{{route('allprojects')}}">Projects &#8594;</a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!--
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-6">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
            </div>
        </div>
   </div>
  -->
@endsection