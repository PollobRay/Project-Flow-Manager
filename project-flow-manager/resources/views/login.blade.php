@extends('layout.master') 
<!-- import code from layout/master.blade.php code -->

@section('content') <!-- push some code into at yeild('content') of master.blade --> 

<section class="vh-100 bg-image"
style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100 ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px; background-color: rgba(233, 231, 231, 0.842);">
            <div class="card-body p-5" >
              <h2 class="text-uppercase text-center mb-2">User Login</h2>
              <form action="{{route('loginMatch')}}" method="POST">
                @csrf
                <div data-mdb-input-init class="form-outline mb-2">
                  <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example3cg">Email</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-2">
                  <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label mb-4" for="form2Example3g">
                    Remember Me 
                  </label>
                </div>
                <div class="d-flex justify-content-center">
                  <button  type="submit"  class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                </div>
                <p class="text-center text-muted mt-1 mb-0">Not have an account? <a href="{{route('signup')}}"
                    class="fw-bold text-body"><u>Register here</u></a></p>
              </form>
            </div>
            
            @if ($errors->any())
              <div class="card-footer text-body-secondary">
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection