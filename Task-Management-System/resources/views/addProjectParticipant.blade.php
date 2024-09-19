@extends('layout.master') 
<!-- import code from layout/master.blade.php code -->

@section('content') <!-- push some code into at yeild('content') of master.blade --> 

<section class="bg-image"
style="background-image: url({{asset('assets/images/bg.png')}}); width: 100%; height: 800px; background-size: cover; background-position: center;">
<div class="mask d-flex align-items-center h-50 gradient-custom-3" >
    <div class="container h-100 mt-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-12">
          <div class="card" style="border-radius: 15px; background-color: rgba(233, 231, 231, 0.863);">
            <div class="card-body p-4" >
              <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="d-flex justify-content-evenly">
                    <h2 class="text-center text-success text-uppercase fw-bold">Add Project Participants</h2>
                </div>
        
                {{-- Alert Message--}}
                @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="mt-8">
                    @foreach ($users as $user)
                    <div class="d-flex flex-row justify-content-between mt-5 ">
                        <div class="d-flex">
                            <div class="p-2"><img src="{{asset('assets/images/bg.png')}}" alt="User Photo" class="img-thumbnail" style="height: 10em; width:10em"></div>
                            <div class="">
                                <div class="p-2 text-uppercase"><h4 class="fw-bold text-danger">User : </h4></div>
                                <div class="p-2"><h3 class="fw-bold text-success">{{$user->name}}</h3></div>
                                <div class="p-2"><h4 class="fw-bold">{{$user->email}}</h4></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="{{route('storeProjectParticipant', ['proj_id' => $project_id, 'user_id' => $user->id])}}" type="button" class="btn btn-lg btn-outline-success text-uppercase mb-2">Add Participant</a>
                        </div>
                    </div> 
                    @endforeach
                </div>
              </div>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</section>    

@endsection