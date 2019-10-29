@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">User/Roles</div>
              <div class="panel-body">
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>ID: </strong>
                    {!! $userInfo->id; !!}
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Name: </strong>
                    {!! $userInfo->name; !!}
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Email: </strong>
                    {!! $userInfo->email; !!}
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Role: </strong>
                    @foreach($userInfo->Roles as $key => $val)
                      {!! $val->name !!}
                    @endforeach
                  </li>
                </ul>
              </div>
      </div>
    </div>
  </div>
</div>

@endsection