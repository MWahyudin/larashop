<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larashop | @yield("title")</title>
    <link rel="stylesheet" href="{{ asset('polished/polished.min.css') }}">
   <script src="{{ asset('js/jquery.min.js') }}"></script>

    <link rel="stylesheet"
        href="{{ asset('polished/iconic/css/open-iconic-bootstrap.min.css') }}">
       
    <style>
        .grid-highlight {
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: #5c6ac4;
            border: 1px solid #202e78;
            color: #fff;
        }

        hr {
            margin: 6rem 0;
        }

        hr+.display-3,
        hr+.display-2+.display-3 {
            margin-bottom: 2rem;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand p-0">
        <a class="navbar-brand text-center col-xs-12 col-md-3 col-lg-2 mr0" href="index.html"> Larashop </a>
        <button class="btn btn-link d-block d-md-none" datatoggle="collapse" data-target="#sidebar-nav" role="button">
            <span class="oi oi-menu"></span>
        </button>

        <input class="border-dark bg-primary-darkest form-control d-none
d-md-block w-50 ml-3 mr-2" type="text" placeholder="Search" arialabel="Search">
        <div class="dropdown d-none d-md-block">
            @if(\Auth::user())
                <button class="btn btn-link btn-link-primary dropdown-toggle" id="navbar-dropdown"
                    data-toggle="dropdown">
                    {{ Auth::user()->name }}
                </button>
            @endif
            <div class="dropdown-menu dropdown-menu-right" id="navbardropdown">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Setting</a>
                <div class="dropdown-divider"></div>
                <li>
                    <form action="{{ route("logout") }}" method="POST">
                        @csrf
                        <button class="dropdown-item" style="cursor:pointer">Sign
                            Out</button>
                    </form>
                </li>
            </div>
        </div>
    </nav>
    <div class="container-fluid h-100 p-0">
      @include('layouts.inc.sidebar')
            <div class="col-lg-10 col-md-9 p-4">
                <div class="row ">
                    <div class="col-md-12 pl-3 pt-2">
                        <div class="">
                            <h3>@yield("pageTitle")</h3>
                        </div>
                    </div>
                </div>
                @yield("content")
            </div>
        </div>
    </div>
    {{--  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.
min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min
.js" crossorigin="anonymous"></script>
</body>


@yield('jscript')
</html>
