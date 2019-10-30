@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">User/Roles</div>
              <div class="panel-body">
                  <input type="text" id="myInput" onkeyup="searchUser()" placeholder="Search for Email.." class="form-control mb-3">
                <ul class="list-group" id="myUL">
                @foreach ($users as $value) 
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <a href="{{ Route('roles.show', $value->id) }}" class="btn btn-primary">
                        {!! $value->id !!}
                      </a>
                      {!! $value->name !!}
                      <span>{!! $value->email !!}</span>
                      <button type="button" class="btn btn-info">
                      @foreach($value->Roles as $key => $val)
                        {!! $val->name !!}
                      @endforeach
                      </button>
                      <a href="{{ Route('roles.destroy', $value->id ) }}" class="btn btn-danger delete-button">Delete</a>
                  </li>
                @endforeach
                </ul>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
    function searchUser() {
      // Declare variables
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li');
      
      // Loop through all list items, and hide those who don't match the search query
      for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          li[i].style.setProperty('display', 'flex', 'important');
        } else {
          li[i].style.setProperty('display', 'none', 'important');
        }
      }
    }
    </script>
@endsection