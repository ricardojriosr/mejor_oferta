<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/fileinput.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

</head>
<body>
    <div id="app">
      <nav class="navbar navbar-light bg-light navbar-static-top navbar-expand-md white-background">
            <div class="container ">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse"> <span class="sr-only">Toggle Navigation</span>
                </button>
                <!-- Branding
                Image --> <a class="navbar-brand" href="{{ url('/') }}">

                                {{ config('app.name', 'Laravel') }}

                            </a>
                <!--<div class="collapse navbar-collapse" id="app-navbar-collapse">-->
                    <!-- Left Side Of Navbar -->
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="{{ Route('categories.index') }}" class="nav-link">Categories</a>
                        </li>
                        <li class="nav-item"><a href="{{ Route('subcategories.index') }}" class="nav-link">Subcategories</a>
                        </li>
                        <li class="nav-item"><a href="{{ Route('articles.index')}}" class="nav-link">Articles</a>
                        </li>
                        <li class="nav-item"><a href="{{ Route('conditions.index')}}" class="nav-link">Conditions</a>
                        </li>
                        <li class="nav-item"><a href="{{ Route('offers.index')}}" onclick="delete_cookie('selectedArticleOffer')"
                            class="nav-link">Offers</a>
                        </li>
                        <li class="nav-item"><a href="{{ Route('acceptedoffers.index')}}" class="nav-link">Accepted Offers</a>
                        </li>
                    </ul>
                  </div>
                    <!-- Right Side Of Navbar -->
                    <div>
                    <ul class="nav navbar-nav">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="nav-item"><a href="{{ url('/login') }}"  class="nav-link">Login</a></li>
                            <li class="nav-item"><a href="{{ url('/register') }}"  class="nav-link">Register</a></li>
                        @else

                        <li class="dropdown nav-item"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                            aria-expanded="false">

                                            {{ Auth::user()->name }}

                                        </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-item"> <a href="{{ url('/logout') }}" onclick="event.preventDefault();

                                                             document.getElementById('logout-form').submit();">

                                                    Logout

                                                </a>
                                    <form id="logout-form" action="{{ url('/logout') }}"
                                    method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                  </div>
                <!--</div>-->
            </div>
          </nav>
        @if(count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script src="/js/fileinput.min.js"></script>
    <script>
    $(function() {
        $("body").on("click", ".delete-button", function() {
            var r = confirm("Are You Sure to Delete This Record?");
            return r;
        });
    });
    var delete_cookie = function(name) {
        document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    };
    function loadXMLDoc(urlAjax) {
        var oReq = new XMLHttpRequest();
        var response;
        oReq.open('GET', urlAjax, true);
        oReq.responseType = 'json';
        oReq.send();
    }
    </script>
    @yield('js')

</body>
</html>
