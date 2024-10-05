
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
	
    <br>
    <div class="d-flex flex-row justify-content-between mt-5 ">
        <div class="d-flex">
            <div class="p-2"><img src="@if($user->image){{asset($user->image)}}@else{{asset('assets/images/bg.png')}} @endif" alt="user Photo" class="img-thumbnail" style="height: 10em; width:10em"></div>
            <div class="">
                <div class="p-2 text-uppercase"><h4 class="fw-bold text-danger">Assign To: </h4></div>
                <div class="p-2"><h3 class="fw-bold text-success">{{$user->name}}</h3></div>
                <div class="p-2"><h4 class="fw-bold">{{$user->email}}</h4></div>
            </div>
        </div>
        <div class="d-flex flex-column">
            <a href="{{route('markAsComplete', ['proj_id'=> $proj_id, 'id'=>$task->id])}}" type="button" class="btn btn-outline-primary text-uppercase fw-bold mb-2">Mark As Complete</a>
            <a type="button" href="{{route('updateTaskWindow', ['proj_id'=> $proj_id, 'id'=>$task->id])}}" class="btn btn-outline-success text-uppercase fw-bold mb-2">Update</a>
            <a type="button" href="{{route('deleteTask', ['id'=>$task->id])}}" class="btn btn-outline-danger text-uppercase fw-bold">Delete</a>
            <h2 class="text-uppercase fw-bold text-primary mt-2">{{$task->status}}</h2>
            <div class="p-2"><h4 class="fw-bold">Deadline: <span>{{$task->due_date}}</span></h4></div>
        </div>   
    </div> 
    <br>
    <div class="row">
        <h2 class="big-4 text-uppercase font-weight-bold">{{$task->name}}</h2>
        <div class="underline"></div>
    </div>
    <div class="row">
        <p class="h4">{{$task->description}}</p>
    </div>  
    <div class="row mt-5 mb-5">
    </div>
    <div class="row">
        <form action="{{route('addTaskResponse',['proj_id'=>$proj_id ,'id'=>$task->id])}}" method="post">
            @csrf
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label h4 text-uppercase fw-bold" for="form4Example3">Response Message:</label>
                <textarea name="message" class="form-control" id="form4Example3" rows="4" style="background-color: rgba(211, 229, 247, 0.658)">@if($response) {{ $response->message }} @endif</textarea> 
            </div>
            <div class="d-flex justify-content-center mb-5">
                <button type="submit" class="btn btn-outline-danger btn-lg h5 fw-bold">@if($response) {{"Update Response"}} @else {{"Submit Response"}} @endif</button>
            </div>
        </form>
    </div>
    
</div>
@endsection