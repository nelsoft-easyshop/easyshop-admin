(function ($) {    

    $("#table1").DataTable({
            "iDisplayLength": 13,
            "bSort" : false,            
            "bFilter": false,         
            "bProcessing": true,         
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy",  {"sExtends": "xls","sTitle": "monthly_signup_statistics"} ]                
            },
    });     
 
    $("#table2").DataTable({
            "bSort" : false,
            "bProcessing": true,          
            "bPaginate": false,
            "bFilter": false,             
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy",  {"sExtends": "xls","sTitle": "users_with_and_without_products"} ]                
            },
    }); 

    $("#table3").DataTable({
            "order": [1,'desc'],
            "bProcessing": true,            
            "bPaginate": false,                                   
            "dom": 'T<"clear">lfrtip',
            "info": false,
            "oTableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy", {"sExtends": "xls","sTitle": "number_of_uploaded_products_per_account"} ]                
            },
    });
   
    $("#table4").DataTable({
            "iDisplayLength": 13,
            "bProcessing": true,  
            "bSort" : false,            
            "bFilter": false,                           
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy",  {"sExtends": "xls","sTitle": "number_of_uploaded_items_per_account"} ]                
            },             
    });            

    $("#table5").DataTable({
            "bPaginate": false,
            "bProcessing": true,                         
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "misc/TableTools/copy_csv_xls_pdf.swf",
                "aButtons": [ "copy",  {"sExtends": "xls","sTitle": "number_of_items_per_parent_category"} ]                
            },
    });
                             
})(jQuery);
