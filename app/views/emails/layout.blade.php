<html>
    <body style="color:#494949;">
            <table cellspacing="0" cellpadding="10" style="width:100%; max-width:780px; margin:0 auto; font-family: Arial, sans-serif;">
                <thead>
                    <tr>
                        <td>
                            <div style="border-bottom:3px solid #f18200; padding-bottom:10px;">
                                <a href="">
                                    <img src="{{{ $message->embed('images/img_logo.png') }}}" alt="Easyshop.ph">
                                </a>
                            </div>
                        </td>
                    </tr>
                </thead>
                
                @yield('email-tbl-body')

            </table>
            
            @yield('email-sub-tbl')
            
    </body>
</html>