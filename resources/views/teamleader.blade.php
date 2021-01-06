@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">   
        @include('partials.sessions')      
            <div class="card">
                <div class="card-header">Welcome TL</div>
                @foreach($requests as $request)
                <div class="card-body">
                  <p><a href='{{ asset("leads/$request->request") }}'>A Request is assigned to you, Download now</a></p>
                    <form action="/user" method="post">
                      @csrf
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <input type="hidden" name="id" value="{{$request->id}}">
                        <label for="exampleFormControlSelect1">Select Agent</label>
                        <select name="user_id" class="form-control" id="exampleFormControlSelect1">
                          @foreach($agents as $agent)
                          <option value="{{$agent->id}}" > {{$agent->name}} </option>
                          @endforeach
                        </select>
                      </div>                  
                      <button type="submit" class="btn btn-primary mb-2">Assign</button>
                    </form>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
