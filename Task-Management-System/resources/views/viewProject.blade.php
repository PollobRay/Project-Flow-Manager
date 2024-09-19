
@extends('layout.master') 
<!-- import code from layout/master.blade.php code -->

@section('content')
<div class="container">
     {{-- Alert Message--}}
     @if(session('status'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{session('status')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>  
     @endif
</div>

     <!----------------------------------- Project View ------------------------------------------->
<div class="container">
    <div class="row text-center mt-5">
        <img class="card-img-top" src="{{asset($project->image)}}" alt="project picture" style="height: 35em">
    </div>
	<div class="row">
        <h2 class="big-4 text-uppercase font-weight-bold">{{$project->name}}</h2>
    </div>
    <br>
    <div class="row">
        <p class="h4">{{$project->description}}</p>
    </div>  
    <div class="d-flex flex-row justify-content-between mt-5 ">
        <div class="d-flex">
            <div class="p-2"><img src="{{asset('assets/images/bg.png')}}" alt="Leader Photo" class="img-thumbnail" style="height: 10em; width:10em"></div>
            <div class="">
                <div class="p-2 text-uppercase"><h4 class="fw-bold text-danger">Project Leader : </h4></div>
                <div class="p-2"><h3 class="fw-bold text-success">{{$leader->name}}</h3></div>
                <div class="p-2"><h4 class="fw-bold">{{$leader->email}}</h4></div>
            </div>
        </div>
        <div class="d-flex flex-column">
            <a href="{{ route('addProjectUser', ['id' => $project_id]) }}" type="button" class="btn btn-outline-primary text-uppercase mb-2">Add User</a>
            <a type="button" class="btn btn-outline-success text-uppercase mb-2">Update</a>
            <a type="button" class="btn btn-outline-danger text-uppercase">Delete</a>
            <h2 class="text-uppercase fw-bold text-primary mt-2">Completed: <span class="text-danger">90%</span></h2>
        </div>
        
    </div> 
    
    <div class="row mt-5 mb-5">
        <h1 class="big-4 ">Tasks for the Project</h1>
        <div class="underline"></div>
    </div>

    <div class="row">

        <a class="col-md-12 block-20 zoom-effect" href="#" style="text-decoration: none;">
          <div class="resume-wrap ftco-animate">
            <span class="date">Name</span>
            <h2 class="">Assign to : <span class="fw-bold">Pollob Ray</span></h2>
            <div class="d-flex flex-row justify-content-between">
                <span class="position">Progress</span>
                <span class="fw-bold text-danger" class="">Private</span>
            </div>
          </div>
        </a>

        <a class="col-md-12 block-20 zoom-effect" href="{{ route('addTask', ['id' => $project_id]) }}" style="text-decoration: none;">
            <div class="resume-wrap ftco-animate"> 
              <div class="d-flex flex-row justify-content-between">
                <span class="date text-danger text-uppercase fw-bold" >Add New Task</span>
                <i class="bi bi-pencil"></i>
              </div>
            </div>
          </a>
    <div>
</div>
@endsection