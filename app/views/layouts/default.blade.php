<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}" type="image/x-icon">
        <link type="text/css" href="{{{ asset('css/src/bootstrap.min.css')  }}}" rel="stylesheet"  media="screen"/>
        <link type="text/css" href="{{{ asset('css/src/bootstrap-dialog.css')  }}}" rel="stylesheet"  media="screen"/>
        <link type="text/css" href="{{{ asset('css/src/jquery.datetimepicker.css')  }}}" rel="stylesheet"  media="screen"/>

        <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
        <meta name="description" content = "@yield('description')" />
        <meta name="keywords" content=  "@yield('keywords')"   />
        <meta name="_token" content="{{ csrf_token() }}" />
		<title> @yield('title')  </title>
	</head>

	<body>
		<div class="container">

			<header class="row">
				@yield('page_header')
			</header>

			<div id="main" class="row">
				@yield('content')
			</div>

		</div>

	</body>


    @yield('javascript')

        </div>

    {{ HTML::script('js/src/jquery-2.0.0.min.js') }}
    {{ HTML::script('js/src/bootstrap.min.js') }}
    {{ HTML::script('js/src/jquery.datetimepicker.js') }}
    {{ HTML::script('js/src/bootstrap-dialog.js') }}
    {{ HTML::script('js/global.js') }}
     @yield('page_js')

</html>
