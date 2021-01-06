@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('partials.sessions')
            <div class="card">
                <div class="card-header">Welcome Admin</div>
                
                <div class="card-body">
                    <form action="/user" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                          <label for="exampleFormControlFile1">Add Lead</label>
                          <input name ='request' type="file" class="form-control-file" id="exampleFormControlFile1">
                      </div> 
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Team Leader</label>
                        <select name="user_id" class="form-control" id="exampleFormControlSelect1">
                          @foreach($teamleaders as $teamleader)
                          <option value="{{$teamleader->id}}" > {{$teamleader->name}} </option>
                          @endforeach
                        </select>
                      </div>                  
                      <button type="submit" class="btn btn-primary mb-2">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
