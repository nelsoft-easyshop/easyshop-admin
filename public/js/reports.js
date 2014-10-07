(function ($) {    
    $("#table1").DataTable({
            "order": [0,'asc'],
            "bProcessing": true,         
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy", "csv" ]                
            },
        });      
    $("#table2").DataTable({
            "bSort" : false,
            "bProcessing": true,          
            "bPaginate": false,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy", "csv" ]                
            },

        }); 
    $("#table3").DataTable({
            "order": [0,'desc'],
            "bProcessing": true,          
            "bPaginate": false,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy", "csv" ]                
            },
        });    
    $("#table5").DataTable({
            "bPaginate": false,
            "bProcessing": true,              
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy", "csv" ]                
            },

        });
    $("#table4").DataTable({
            "bPaginate": false,
            "bProcessing": true,              
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy", "csv" ]                
            },             

        });                                
})(jQuery);
