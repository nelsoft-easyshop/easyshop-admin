$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

});
var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
};

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
