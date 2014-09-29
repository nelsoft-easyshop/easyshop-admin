(function ($) {

    $("#table_id").DataTable({
            "order": [6,'desc']
        } );

    $(document).on('click','tr:not(#heading)',function (e) {   
        loader.showPleaseWait();
        var $this = $(this);
        var messageid = $this.find('.id').html();
        var recipient = $this.find('.recipient').html();
        var sender = $this.find('.sender').html();
        var message = $this.find('.message').html();    
        var to_id = $this.find('.to_id').html();    
        var from_id = $this.find('.from_id').html();
        $.ajax({
            url: "getmessage",
            data:{messageid:messageid, sender:sender, recipient:recipient, message:message,
                    to_id:to_id,from_id:from_id},
            type: 'post',
            dataType: 'JSON',                      
            success: function(result){
                $("#mainContent").html(result.html);
                loader.hidePleaseWait();            
            }
        });            
    });

    $(document.body).on('click','#submitMessage',function (e) { 
        var to_id = $("#to_idForm").val();
        var from_id = $("#from_idForm").val();
        var message = $.trim($("#messageForm").val());

        if(message != "") {
            loader.showPleaseWait();        
            $.ajax({
                url: "sendMessage",
                type: 'post',
                data: {to_id:to_id, from_id:from_id, message:message},
                dataType: 'JSON',                      
                success: function(result){
                    var url = "refreshConversation/" + to_id + "/" + from_id;
                    $("#conversations").load(url);
                    $("#messageForm").val("");
                    loader.hidePleaseWait();                   

                }
                    
            });             
        }
         
    }); 

    $(document.body).on('click','#refreshHistory',function (e) { 
        var to_id = $("#to_idForm").val();
        var from_id = $("#from_idForm").val();
        loader.showPleaseWait();        
        $.ajax({
            url: "sendMessage",
            type: 'post',
            data: {to_id:to_id, from_id:from_id},
            dataType: 'JSON',                      
            success: function(result){
                var url = "refreshConversation/" + to_id + "/" + from_id;
                $("#conversations").load(url);
                loader.hidePleaseWait();                   
            }
        });          
    });  

    $( "td #messageDisplay").each(function() {
        $(this).shorten({
            "showChars" :"30",
            "moreText"  : "",
            "lessText"  : "",
        }); 
    });      

})(jQuery);
