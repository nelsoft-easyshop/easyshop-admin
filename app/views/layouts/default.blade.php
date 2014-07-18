<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	@include('includes.head')
</head>
<body>
  <div class="container">
  
	<header class="row">
	    @include('includes.header')
	</header>

	<div id="main" class="row">

	    @yield('content')

	</div>


  </div>
</body>
</html>