

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
});

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

