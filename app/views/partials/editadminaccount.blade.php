<div>
    <div class="table-responsive table-payment">   
        <table class="table table-striped table-hover" id="order-tbl">
            {{ Form::open(array('url' => 'register','class'=>'form-horizontal','id'=>'form')) }}
            <tr style="border-top: none !important;">
                <td style="vertical-align: text-top;border-top: 0px !important;">Password</td>
                <td style="border-top: 0px !important;">
                    <center>
                     <div class=''>
                    {{Form::password('password', array('class' => 'form-control', 'id' => 'editPassword'))}}
                    </div>
                    </center>
                </td>
            </tr>             
            <tr>
                <td style="vertical-align: text-top;text-align:center; background-color:white; border-top: 0px !important;" colspan='2'><a href="javascript:void(0)" id="updateBtn" data-id="{{{ $adminObj->id_admin_member }}}"class="btn btn-primary" >Update Account</a></td>
                <td style="background-color:white; border-top: 0px !important;"></td>
            </tr>  
            {{ Form::close() }}                       
        </table>
        <div id="hidden-inputs">
            <input type="hidden" name="orderproductid" value="" class="form-control pull-left" id="order-product-id" />
        </div>
    </div>
</div>