(function ($) {    
    $("#table1").DataTable({
            "order": [0,'desc'],
            "bPaginate": false,

        });      
    $("#table2").DataTable({
            "bSort" : false,
            paging: false,
            "bFilter": false

        }); 
    $("#table3").DataTable({
            "order": [0,'desc'],
            paging: false

        });    
    $("#table5").DataTable({
            paging: false
        });
    $("#table4").DataTable({
            paging: false

        });                                
})(jQuery);