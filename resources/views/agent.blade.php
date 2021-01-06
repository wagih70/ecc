@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('partials.sessions')
            <div class="card">
                <div class="card-header">Welcome Agent</div>
                @foreach($requests as $request)
                <div class="card-body">
                  <p><a href='{{ asset("leads/$request->request") }}'>A Request is assigned to you, Download now</a></p>
                    <form action="/activity" method="post">
                      @csrf
                      {{ method_field('PUT') }}
                      <input type="hidden" name="id" value="{{$request->id}}">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Add Activity</label>
                        <select name="status_id" class="form-control" id="exampleFormControlSelect1">
                          <option selected disabled>{{$request->status->name}}</option>
                          @foreach($statuses as $status)
                          <option value="{{$status->id}}" > {{$status->name}} </option>
                          @endforeach
                        </select>
                      </div>                  
                      <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
