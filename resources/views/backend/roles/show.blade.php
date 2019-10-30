@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">User/Roles</div>
              <div class="panel-body">
                <a href="{{ Route('roles.index') }}" class="btn btn-default mb-2">List</a>
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
                      <?php
                      $userRole = $val->name;
                      echo $userRole;
                      ?>
                    @endforeach
                  </li>
                  {{ Form::open(['route' => 'roles.update', 'method' => 'POST']) }}
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <strong>Admin?</strong>
                      <input type="checkbox" data-toggle="toggle" <?php if ($userRole === 'admin') { echo 'checked'; } ?> name="user_admin" id="user_admin">
                    </li>
                    <li class="list-group-item text-right">
                      <input type="hidden" name="user_id" id="user_id" value="{!! $userInfo->id; !!}">
                      <input type="submit" class="btn btn-primary" value="Update">
                    </li>
                  {{ Form::close() }}
                </ul>
              </div>
      </div>
    </div>
  </div>
</div>

@endsection