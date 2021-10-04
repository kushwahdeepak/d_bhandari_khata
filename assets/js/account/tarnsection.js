$(function () {
    $("#tarnsection_table").DataTable({
        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/transaction/fetch_details",  
            type:"POST",

        }, 
        "order": [[ 0, "asc" ]],
        "columnDefs": [ 
            {
                "targets": 0,
                "orderable": true,
                "width":"40px",
                "background-color":"aqua",
            },            
            {
                "targets": 1,
                "orderable": false,
                "class": "white_space, text-left",
                "width":"230px",
            },

            {
                "targets": 2,
                "orderable": false,
                "width":"30px",
                "text-align":"left"
            },
            {
                "targets": 3,
                "orderable": false,
                "class": "white_space",
                "width":"100px",
            },
        ],
    });
});
var name = $('#search_name').val();
function onSelectCustomer()
{
    var name = $('#search_by_name').val();
    $('#search_name').val(name);
    $("#super_admin_tarnsection_table").DataTable().ajax.reload(null, false);
}

$(function () {
    $("#super_admin_tarnsection_table").DataTable({
        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/transaction/fetch_super_admin_transaction_list",  
            "data": function ( d ) 
                {
                  d.search_name = $('#search_name').val();
            }, 
            type:"POST"  
        }, 
        // "order": [[ 0, "asc" ]],
        "columnDefs": [ 
            {
                "targets": 0,
                "orderable": true,
                "width":"40px",
                "background-color":"aqua",
            },         
            {
                "targets": 1,
                "orderable": false,
                "class": "white_space, text-left",
                "width":"230px",
            },

            {
                "targets": 2,
                "orderable": false,
                "width":"30px",
                "text-align":"left"
            },  
            {
                "targets": 3,
                "orderable": false,
                "class": "white_space",
                "width":"100px",
            },
            {
                "targets": 4,
                "orderable": false,
                "class": "white_space",
                "width":"100px",
            }, 
        ],
    });
});
