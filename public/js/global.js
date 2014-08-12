
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


var loader;
loader = loader || (function () {
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


