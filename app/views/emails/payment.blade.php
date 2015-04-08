@extends('emails.layout')

@section('email-body')
    <table id="bg" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#ecebeb; table-layout:fixed;">
        <!--Start of Email Header-->
        <tr mc:repeatable="Select" mc:variant="Nav menu" >
            <td mc:hideable valign="top">
                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                    <tr>
                        <td align="center" valign="top">
                            <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container">
                                <tr>
                                    <td valign="top">
                                        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">
                                                <!-- start space -->
                                                <tr>
                                                    <td valign="top" height="20">
                                                    </td>
                                                </tr>
                                                <!-- end space -->
                                                <tr>
                                                    <td valign="middle">
                                                        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="container">
                                                            <tr>
                                                            <td align="center" valign="top" width="100%">
                                                                <a href="{{{ $easyshopLink }}}" style="text-decoration: none; display: inline-block" target="_blank">
                                                                    <center>
                                                                    <img mc:edit="Top logo TB10" mc:allowdesigner mc:allowtex src="{{{ $message->embed('images/email/top-logo.png')  }}}" width="120" style="max-width:120px;" alt="Logo" border="0" hspace="0" vspace="0">
                                                                    </center>
                                                                </a>
                                                            </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- start space -->
                                                <tr>
                                                    <td valign="top" height="20">
                                                    </td>
                                                </tr>
                                                <!-- end space -->
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </table>
            </td>
        </tr>
        <!--End of email header-->

        <!-- Start of paragraph intro -->
        <tr mc:repeatable="Select" mc:variant="layout-1/2">
            <td mc:hideable align="center" valign="top" class="fix-box">
                <!-- start  container width 600px --> 
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color: #ffffff; ">
                    <tr>
                        <td valign="top">
                            <!-- start container width 560px --> 
                            <table width="540" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff" style="background-color:#ffffff;">
                                <!-- start text content --> 
                                <tr>
                                    <td valign="top">
                                        <!-- start content left --> 
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="full-width-text" style="padding-left:20px;">



                                            <!-- start text content --> 
                                            <tr>
                                                <td valign="top">
                                                    <table border="0" cellspacing="0" cellpadding="0" align="left">

                                                        <!--start space height --> 
                                                        <tr>
                                                            <td height="15"></td>
                                                        </tr>
                                                        <!--end space height --> 

                                                        <tr>
                                                            <td mc:edit="content (layout-4) TB27" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:300; text-align:left; ">

                                                                <p style="margin-top: 20px; margin-bottom: 20px;">Dear <span style="color:#ff893b; font-weight: 400;"> {{{ $recipient }}} </span>,</p>
                                                                
                                                                @if($isRefund)
                                                                    We have transfered the payment for your refund request.  
                                                                @else
                                                                    Thank you for selling through Easyshop.ph! The payment for your sales has now been forwarded to your account.
                                                                @endif
                                                                <br/>
                                                                Details for your transactions are included below.

                                                            </td>
                                                        </tr>

                                                        <!--start space height --> 
                                                        <tr>
                                                            <td height="20"></td>
                                                        </tr>
                                                        <!--end space height --> 

                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- end text content --> 

                                            <!--start space height --> 
                                            <tr>
                                                <td height="20"></td>
                                            </tr>
                                            <!--end space height --> 

                                        </table>
                                        <!-- end content left -->
                                    </td>
                                </tr>
                                <!-- end text content --> 
                            </table>
                            <!-- end  container width 560px --> 
                        </td>
                    </tr>
                </table>
                <!-- end  container width 600px --> 
            </td>
        </tr>
        <!-- End of paragraph intro-->

        <!-- Start of title plate --> 
            <tr mc:repeatable="Select" mc:variant="layout-1/1">
            <td mc:hideable align="center" valign="top" class="fix-box">
                <!-- start  container width 600px --> 
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color: #ffffff; ">
                    <tr>
                        <td valign="top">
                            <!-- start container width 560px --> 
                            <table width="540" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff" style="background-color:#ffffff;">
                                <!-- start text content --> 
                                <tr>
                                    <td valign="top">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                <td valign="top" width="auto" align="center">
                                                    <!-- start button -->                         
                                                    <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td mc:edit="heading (layout-1/1) TB13" width="auto" align="center" valign="middle" height="28" style=" background-color:#ffffff; border:1px solid #ececed; background-clip: padding-box; font-size:18px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; text-align:center;  color:#a3a2a2; font-weight: 300; padding-left:18px; padding-right:18px; ">
                                                                <span style="color: #a3a2a2; font-weight: 300;">
                                                                    <span style="text-decoration: none; color: #a3a2a2; font-weight: 300;">
                                                                        ACCOUNT <span style="color: #ff893b; font-weight: 300;">DETAILS</span>
                                                                    </span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- end button -->   
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- end text content --> 
                            </table>
                            <!-- end  container width 560px --> 
                        </td>
                    </tr>
                    <!--start space height --> 
                    <tr>
                        <td height="20"></td>
                    </tr>
                    <!--end space height --> 

                </table>
                <!-- end  container width 600px --> 
            </td>
            </tr>
        <!-- End of title plate --> 

        <!--Start of transaction details records-->
        <tr mc:repeatable="Select" mc:variant="layout-2">
            <td mc:hideable align="center" valign="top" class="fix-box">

                <!-- start layout-2 container width 600px --> 
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" style="background-color: #ffffff;  ">
                    <tr>
                        <td valign="top">

                            <!-- start layout-2 container width 600px --> 
                            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" style="background-color:#ffffff;">
                                <tr>
                                    <td height="20"></td>
                                </tr>
                                <!-- start image and content --> 
                                <tr>
                                    <td valign="top" width="100%">

                                        <!-- start content left --> 
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" style="padding-left:50px;">

                                            <tr>
                                                <td valign="top">
                                                    <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%">
                                                        <tr>
                                                            <td mc:edit="content (layout-2) TB21" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:300; text-align:left;  word-break: break-all;">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td valign="bottom" width="30%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                            Account Name : 
                                                                        </td>
                                                                        <td valign="bottom" align="left" style=" word-break: break-word;">
                                                                            {{{ $bankName }}} - {{{ $accountName }}}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="bottom" width="30%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                            Account Number :
                                                                        </td>
                                                                        <td valign="bottom" align="left" style=" font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                            {{{ $accountNumber }}}
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!--start space height --> 
                                                        <tr>
                                                            <td height="20"></td>
                                                        </tr>
                                                        <!--end space height --> 
                                                    </table>
                                                </td>
                                            </tr>
                                            <!--start space height --> 
                                            <tr>
                                                <td height="20"></td>
                                            </tr>
                                            <!--end space height --> 

                                        </table>
                                        <!-- end content left --> 
                                    </td>
                                </tr>
                                <!-- end image and content --> 
                                <!--start space height --> 
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <!--end space height --> 
                            </table>
                            <!-- end layout-2 container width 600px --> 
                        </td>
                    </tr>
                </table>
                <!-- end layout-2 container width 600px -->
            </td>
        </tr>
        <!--End of transaction details record-->



        <!-- START SHADOW-->
        <tr mc:repeatable="Select" mc:variant="shadow space">
            <td mc:hideable valign="top" align="center" class="fix-box">
                <table width="600" height="11" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff;" class="full-width">
                    <tr>
                        <td valign="top" height="11" class="image-100-percent">  
                            <img mc:edit="shadow 1 TB18" src="{{{ $message->embed('images/email/shadow.png') }}}" width="600" alt="space" style="display:block; max-height:11px; max-width:600px;">
                        </td>
                    </tr>
                    <!--start space height --> 
                    <tr>
                        <td height="40"></td>
                    </tr>
                    <!--end space height --> 
                </table>
            </td>
        </tr>
        <!-- END SHADOW-->
            <!-- Start of title plate --> 
            <tr mc:repeatable="Select" mc:variant="layout-1/1">
            <td mc:hideable align="center" valign="top" class="fix-box">
                <!-- start  container width 600px --> 
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color: #ffffff; ">
                    <tr>
                        <td valign="top">
                            <!-- start container width 560px --> 
                            <table width="540" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff" style="background-color:#ffffff;">
                                <!-- start text content --> 
                                <tr>
                                    <td valign="top">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                <td valign="top" width="auto" align="center">
                                                    <!-- start button -->                         
                                                    <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td mc:edit="heading (layout-1/1) TB13" width="auto" align="center" valign="middle" height="28" style=" background-color:#ffffff; border:1px solid #ececed; background-clip: padding-box; font-size:18px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; text-align:center;  color:#a3a2a2; font-weight: 300; padding-left:18px; padding-right:18px; ">
                                                                <span style="color: #a3a2a2; font-weight: 300;">
                                                                    <span style="text-decoration: none; color: #a3a2a2; font-weight: 300;">
                                                                        SUMMARY OF 
                                                                        <span style="color: #ff893b; font-weight: 300;">
                                                                            @if($isRefund)  
                                                                                REFUND
                                                                            @else
                                                                                SALE
                                                                            @endif
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- end button -->   
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- end text content --> 
                            </table>
                            <!-- end  container width 560px --> 
                        </td>
                    </tr>
                    <!--start space height --> 
                    <tr>
                        <td height="20"></td>
                    </tr>
                    <!--end space height --> 

                </table>
                <!-- end  container width 600px --> 
            </td>
            </tr>

        
        <!-- End of title plate --> 

        <!-- Start of item --> 
        @foreach($orderProducts as $idx => $orderProduct)

            <tr mc:repeatable="Select" mc:variant="layout-2">
                <td mc:hideable align="center" valign="top" class="fix-box">

                    <!-- start layout-2 container width 600px --> 
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" style="background-color: #ffffff;  ">
                        <tr>
                            <td valign="top">

                                <!-- start layout-2 container width 600px --> 
                                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" style="background-color:#ffffff;">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                    <!-- start image and content --> 
                                    <tr>
                                        <td valign="top" width="100%">

                                            <!-- start content left --> 
                                            <table width="230" border="0" cellspacing="0" cellpadding="0" align="left" style="padding-left:50px;">

                                                <tr>
                                                    <td valign="middle" align="center">
                                                        <table width="230" border="0" cellspacing="0" cellpadding="0" align="left">
                                                            <tr>
                                                                <td width="70">
                                                                    <img src="{{{ rtrim($assetsLink, '/') }}}{{{ ltrim($orderProduct->defaultImage->directory, '.') }}}categoryview/{{{ $orderProduct->defaultImage->filename }}}" width="60" height="60" style="width: 60px; height: 60px; border: solid #e2e2e2 1px; text-align: center;">
                                                                </td>
                                                                <td valign="bottom" style="padding-left: 10px;">
                                                                    <a href="{{{ rtrim($easyshopLink, '/') }}}/item/{{{ $orderProduct->product->slug }}}" style="font-size: 15px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#555555; font-weight:400; text-align:left; ">
                                                                        {{{ $orderProduct->product->name }}}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!--start space height --> 
                                                <tr>
                                                    <td height="15"></td>
                                                </tr>
                                                <!--end space height --> 
                                                <tr>
                                                    <td mc:edit="content (layout-2) TB21" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:300; text-align:left; ">
                                                        <span style="text-transform: uppercase; font-size: 15px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#ff893b; font-weight:300; text-align:left; ">
                                                            Product Specifications
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                @set('hasAttributes', false)
                                                @foreach($orderProduct->orderProductAttributes() as $orderProductAttribute)
                                                    <tr>
                                                        <td valign="top" mc:edit="content (layout-2) TB21" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:400; text-align:left; ">
                                                            <span style="color: #555555; font-weight: bold; word-break: break-all;">{{{ $orderProductAttribute->attr_name }}} : </span>{{{ $orderProductAttribute->attr_value }}}
                                                        </td>
                                                    </tr>
                                                    @set('hasAttributes', true)
                                                @endforeach
                                                
                                                @if(!$hasAttributes)
                                                    <tr>
                                                        <td valign="top" mc:edit="content (layout-2) TB21" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:400; text-align:left; ">
                                                            <span style="color: #555555; font-weight: bold; word-break: break-all;"> N/A </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                                <!--start space height --> 
                                                <tr>
                                                    <td height="20"></td>
                                                </tr>
                                                <!--end space height --> 

                                            </table>
                                            <!-- end content left --> 


                                            <!-- start space width --> 
                                            <table class="remove" width="1" border="0" cellpadding="0" cellspacing="0" align="left" style="font-size: 0;line-height: 0;border-collapse: collapse;">
                                                <tr>
                                                    <td width="0" height="2" style="font-size: 0;line-height: 0;border-collapse: collapse;">
                                                        <p style="padding-left: 20px;">&nbsp;</p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- end space width --> 



                                            <!-- start content right --> 
                                            <table width="300" border="0" cellspacing="0" cellpadding="0" align="right" class="full-width-text">
                                                    <tr>
                                                    <td valign="top">
                                                        <table border="0" cellspacing="0" cellpadding="0" align="left" width="100%">
                                                            <tr>
                                                                <td mc:edit="content (layout-2) TB21" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:300; text-align:left; ">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td valign="bottom" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                 @if($isRefund)  
                                                                                    Seller
                                                                                @else
                                                                                    Buyer
                                                                                @endif   
                                                                                Name : 
                                                                            </td>
                                                                            <td valign="bottom" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                @if($isRefund)  
                                                                                    {{{ $orderProduct->seller->getStoreName() }}}
                                                                                @else
                                                                                    {{{ $orderProduct->order->buyer->getStoreName() }}}
                                                                                @endif   
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                Invoice # : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                {{{ $orderProduct->order->invoice_no }}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                Quantity : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                {{{ $orderProduct->order_quantity }}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                Base Price : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                &#8369; {{ number_format($orderProduct->price,2,'.',',') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                Shipment Fee : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                &#8369; {{ number_format($orderProduct->handling_fee,2,'.',',') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                Total Amount : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                &#8369; {{ number_format($orderProduct->total,2,'.',',') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                EasyShop Charge : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                &#8369; {{ number_format($orderProduct->easyshop_charge,2,'.',',') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                Payment Charge : 
                                                                            </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                &#8369; {{ number_format($orderProduct->payment_method_charge,2,'.',',') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" width="50%" style="color: #555555; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                   @if($isRefund)  
                                                                                        Refunded Amount
                                                                                    @else
                                                                                        Net
                                                                                    @endif
                                                                                </td>
                                                                            <td valign="top" width="50%" align="right" style="padding-right: 40px; font-size: 14px; font-weight: bold; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; word-break: break-all;">
                                                                                &#8369; 
                                                                                    {{ number_format($orderProduct->net,2,'.',',') }}
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                            <!--start space height --> 
                                                            <tr>
                                                                <td height="20"></td>
                                                            </tr>
                                                            <!--end space height --> 
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- end text content --> 

                                            </table>
                                            <!-- end content right --> 
                                        </td>
                                    </tr>
                                    <!-- end image and content --> 
                                    <tr>
                                        <td height="10" width="100%" style="border-top: solid #e2e2e2 1px;">

                                        </td>
                                    </tr>
                                </table>
                                <!-- end layout-2 container width 600px --> 
                            </td>
                        </tr>
                    </table>
                    <!-- end layout-2 container width 600px -->
                </td>
            </tr>
            <!-- End of item  -->
        @endforeach
        
        
        <!-- Start of Social Media Footer -->
        <tr mc:repeatable="Select" mc:variant="layout-16">
            <td mc:hideable align="center" valign="top" class="fix-box">

            <!-- start  container width 600px --> 
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color: #ffffff; border-bottom:1px solid #c7c7c7;">

                    <!--start space height -->                      
                    <tr>
                        <td height="10"></td>
                    </tr>
                    <!--end space height --> 

                    <tr>
                        <td valign="top">
                            <!-- start logo footer and address -->  
                            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td valign="top">

                                        <!--start icon socail navigation -->  
                                        <table border="0" align="center" cellpadding="0" cellspacing="0" class="container">
                                            <tr>
                                                <td valign="top" align="left">

                                                    <table border="0" align="left" cellpadding="0" cellspacing="0" class="container">
                                                        <tr>
                                                            <td height="30" align="center" valign="middle" class="clear-padding">
                                                                <a href="{{{ $facebook }}}" target="_blank" style="text-decoration: none;">
                                                                <img mc:edit="icon-facebook-color TB113" src="{{{ $message->embed('images/email/icon-facebook.png')  }}}" width="30" alt="icon-facebook" style="max-width:30px;" border="0" hspace="0" vspace="0">  
                                                                </a>
                                                            </td>
                                                            <td style="padding-left:5px; " height="30" align="center" valign="middle" class="clear-padding">
                                                                <a href="{{{ $twitter }}}" target="_blank" style="text-decoration: none;">
                                                                <img mc:edit="icon-twitter-color TB114" src="{{{ $message->embed('images/email/icon-twitter.png')  }}}" width="30" alt="icon-twitter" style="max-width:30px;" border="0" hspace="0" vspace="0">  
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--end icon socail navigation --> 
                                    </td>
                                </tr>
                            </table>
                            <!-- end logo footer and address --> 

                        </td>
                    </tr>

                    <!--start space height -->                      
                    <tr>
                        <td height="10"></td>
                    </tr>
                    <!--end space height -->
                </table>
            </td>
        </tr>
        <!-- End of Social Media Footer -->

        <!--  Start of Copyright footer -->
        <tr mc:repeatable>
            <td mc:hideable id="mail-color" align="center" valign="top" style="background-color:#4370cc;">
                <table width="600" id="mail-color" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color:#4370cc;">
                    <tr>
                        <td valign="top">
                            <table width="560" id="mail-color" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color:#4370cc;">

                                <!--start space height -->                      
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <!--end space height --> 

                                <tr>
                                    <!-- start COPY RIGHT content -->  
                                    <td mc:edit="company (footer) TB123" valign="top" style="font-size: 13px; line-height: 22px; font-family:Roboto,Open Sans, Arial,Tahoma, Helvetica, sans-serif; color:#ffffff; font-weight:300; text-align:center; ">
                                        Easyshop.ph , all rights reserved 2014 ©
                                    </td>
                                    <!-- end COPY RIGHT content --> 
                                </tr>

                                <!--start space height -->                      
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <!--end space height -->
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--  End of Copyright footer -->
    </table>
@stop
