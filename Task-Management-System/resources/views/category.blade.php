
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

     <!----------------------------------- Categories ------------------------------------------->
<div class="container">
		<div class="row mt-5 mb-5">
            <h1 class="big-4 ">Project Categories</h1>
            <div class="underline"></div>
        </div>
        <br>

        <div class="row d-flex">
            @foreach ($categories as $category)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                <a href="" class="block-20 zoom-effect" style="background-image: url({{asset($category->image)}});"></a>
                <div class="text mt-3 float-right d-block">
                    <h3 class="heading"><a href="">{{$category->name}}</a></h3>
                    <p>{{$category->description}}</p>
                </div>
                </div>
            </div>
            @endforeach

            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end" style="padding: 30px">
                <a href="{{route('addCategory')}}" class="block-20 zoom-effect" style="background-image: url({{'assets/images/add.png'}});"></a>
                <div class="text mt-3 float-right d-block">
                    <h3 class="heading"><a href="{{route('addCategory')}}">   Add New Project Category   </a></h3>
                    <p></p>
                </div>
                </div>
            </div>
            
        </div>
            
</div>
@endsection