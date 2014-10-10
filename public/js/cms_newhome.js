(function () {











    function showErrorModal(messages) {
            loader.hidePleaseWait();
            $("#errorTexts").html(messages); 
            $("#customerror").modal('show');  
    }    
})(jQuery);        