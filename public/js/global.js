
(function ($) {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });


})(jQuery);


var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
};


/**
 * Checks if a javascript object is empty. This method only checks direct properties
 * of the object and not inherited properties. In most cases, this is all that is needed
 * for the context of checking of the emptiness of an object. 
 * 
 * @param object obj
 * @return boolean
 */
function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key)){
            return false;
        }
    }
    return true;
}

function escapeHtml(string) {

    return String(string).replace(/[<>"'\/]/g, function (s) {

        return entityMap[s];
    });
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var loader = loader || (function () {
    var pleaseWaitDiv = $('<div style="text-align:center"><hr/> <p><img src = "images/orange_loader.gif" /></p> <p style="font-size:13px;"><strong>One moment please </strong> </p> <hr/></div>');
    var dialog = new BootstrapDialog({
            message: pleaseWaitDiv,
            cssClass: 'loader-dialog',
    });
    dialog.realize();
    dialog.getModalHeader().hide();
    
    return {
        showPleaseWait: function() {
            dialog.open();
        },
        hidePleaseWait: function () {
            dialog.close();
        },

    };
})();
