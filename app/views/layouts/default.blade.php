<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}" type="image/x-icon">
        <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
        

        <meta name="description" content = "@yield('description')" />
        <meta name="keywords" content=  "@yield('keywords')"   />

        
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
</html>