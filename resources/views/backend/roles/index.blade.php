@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">User/Roles</div>
              <div class="panel-body">
                  <input type="text" id="myInput" onkeyup="searchUser()" placeholder="Search for Email..">
                <ul class="list-group" id="myUL">
                @foreach ($users as $value) 
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <a href="{{ Route('roles.show', $value->id) }}" class="btn btn-primary">
                        {!! $value->id !!}
                      </a>
                      {!! $value->name !!} | 
                      {!! $value->email !!}
                      <button type="button" class="btn btn-info">
                      @foreach($value->Roles as $key => $val)
                        {!! $val->name !!}
                      @endforeach
                      </button>
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
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          li[i].parentNode.style.display = "";
          console.log('FLAG FOUND');
        } else {
          li[i].parentNode.style.display = "none";
          console.log('NOT FOUND');
        }
      }
    }
    </script>
@endsection