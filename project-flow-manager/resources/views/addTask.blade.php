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
                    <h2 class="text-center text-success text-uppercase fw-bold">Create a new Task</h2>
                </div>
        
                {{-- Alert Message--}}
                @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('status')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>  
                @endif

                <div class="mt-4">
                    <form action="{{route('storeTask', ['id' => $proj_id])}}" class="mx-auto" enctype="multipart/form-data" method="POST">
                        @csrf
                        <!-- Name input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form4Example1">Name</label>
                            <input name="name" type="text" id="form4Example1" class="form-control" />
                        </div>

                        <!-- Description input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form4Example3">Description</label>
                            <textarea name="description" class="form-control" id="form4Example3" rows="4"></textarea> 
                        </div>
                        
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="categoryOption">Assign to </label>
                            <select id="user_id" name="user_id" style="margin-left: 20px">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name}} - {{ $user->email}}</option>
                            @endforeach
                            </select> 
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="privacyOption">Privacy </label>
                            <select id="privacyOption" name="privacy" style="margin-left: 20px">
                              <option value="public">public</option>
                              <option value="private">private</option>
                            </select> 
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="categoryOption">Deadline</label>
                            <input name="due_date" type="date" id="categoryOption" class="form-control">
                        </div>
                        <input type="hidden" name='project_id' value={{$proj_id}}>
                        <!-- Submit button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
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