
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

     <!----------------------------------- MyTasks ------------------------------------------->
<div class="container">
    <div class="row mt-5 mb-5">
        <h1 class="big-4 ">My Tasks</h1>
        <div class="underline"></div>
    </div>

    <div class="row">
        @foreach ($tasks as $task)
        <a class="col-md-12 block-20 zoom-effect" href="{{route('viewTask',['proj_id'=>$task->project_id ,'id'=>$task->id])}}" style="text-decoration: none;">
          <div class="resume-wrap ftco-animate">
            <span class="date">{{$task->name}}</span>
            <h2 class="">Assign to : <span class="fw-bold">{{$users[$task->user_id]}}</span></h2>
            <div class="d-flex flex-row justify-content-between">
                <span class="position">{{$task->status}}</span>
                <span class="fw-bold text-danger" class="">{{$task->privacy}}</span>
            </div>
          </div>
        </a>
        @endforeach
    <div>
</div>
@endsection