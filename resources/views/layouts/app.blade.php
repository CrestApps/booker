<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-dir="{{ trans('lang.dir') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="local-tax-rate" content="{{ config('booker.tax_rate') }}">
    <title>{{ trans('lang.app_name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" media="all" href="{{ mix('/css/app.css') }}">

    @if(trans('lang.dir') == 'rtl')
        <link rel="stylesheet" media="all" href="{!! asset('css/bootstrap-flipped.min.css') !!}">
    @endif

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top flip">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar">A</span>
            <span class="icon-bar">B</span>
            <span class="icon-bar">C</span>
          </button>
          <a href="{!! url('/' . App::getLocale() ) !!}" class="navbar-brand">{{ trans('lang.app_name') }}</a>
        </div>

         @include('partials._languages', [
                                            'languages' => config('app.locales'),
                                            'currentLanguage' => App::getLocale()
                                        ])

        <div id="navbar" class="collapse navbar-collapse">

          @if (Route::has('login'))
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li><a href="{{ url('/logout') }}" id="globalLogOut">{{ trans('lang.logout') }}</a></li>
            @else
                <li><a href="{{ url('/login') }}">{{ trans('lang.login') }}</a></li>
                <li><a href="{{ url('/register') }}">{{ trans('lang.register') }}</a></li>
            @endif
            </ul>
          @endif
        </div><!--/.nav-collapse -->


      </div>
    </nav>

   <div id="wrapper" class="{{ (Auth::check() ? 'toggled' : '')  . (trans('lang.dir') == 'rtl' ? ' flip' : '') }}">
        @if (Auth::check())
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="{{ trans('lang.dir') == 'rtl' ? 'flip' : '' }}">
            @include('partials._sidebar_menu')
        </div>
        @endif
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" class="{{ trans('lang.dir') == 'rtl' ? 'flip' : '' }}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <form id="globalLogOutForm" action="{{ url( '/'. App::getLocale()  . '/logout') }}" method="POST" class="hidden">
            {{ csrf_field() }}
        </form>

    </div>
    <!-- /#wrapper -->

    @routes
    <!-- JavaScripts -->
    <script src="{!! asset('js/app.js') !!}"></script>
    <script src="{!! asset('js/app_addons.js') !!}"></script>
</body>
</html>
