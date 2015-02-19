<div id="header_banner">

    <div>

        <h1 class='tagline'>
            @yield('header_tagline')
        </h1>

    </div>

</div>

<div id="nav">

    <div style="">

        <a href="/">
            <img src="{{{ asset('images/es_32x32.png') }}}"/>
            <span>EASYSHOP</span>
        </a>

    </div>
    @if($username)
    <div class='ul_cont'>

        <div>Signed-in as:</div>

        <div>

            <ul>
                    <li>{{{ $username }}}</li>
                    <li>|</li>
                    <li><a href="/logout">Sign-out</a></li>
            <ul>

        </div>

    </div>
    @endif

</div>
