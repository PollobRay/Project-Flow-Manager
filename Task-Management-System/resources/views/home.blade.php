
@extends('layout.master') 
<!-- import code from layout/master.blade.php code -->

@section('content') <!-- push some code into at yeild('content') of master.blade --> 
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
@endsection