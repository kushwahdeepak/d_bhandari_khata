$(function () {
    $("#expend_table").DataTable({
        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/expend/fetch_details",  
            type:"POST"  
        }, 
        "order": [[ 0, "asc" ]],
        "columnDefs": [ 
        {
            "targets": 0,
            "orderable": true,
            "width":"100px",
            "background-color":"aqua",
        },
        {
            "targets": 1,
            "orderable": false,
            "width":"150px",
        },
        {
            "targets": 2,
            "orderable": false,
            "width":"150px",
        },
        {
            "targets": 3,
            "orderable": false,
            "width":"150px",
        },
        {
            "targets": 4,
            "orderable": false,
            "class": "white_space, text-left",
            "width":"250px",
        },
         {
            "targets": 5,
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
    $("#super_admin_expend_table").DataTable().ajax.reload(null, false);
}


$(function () {
    $("#super_admin_expend_table").DataTable({
        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/expend/fetch_super_admin_details", 
            "data": function ( d ) 
                {
                  d.search_name = $('#search_name').val();
            },   
            type:"POST"  
        }, 
        "order": [[ 0, "asc" ]],
        "columnDefs": [ 
        {
            "targets": 0,
            "orderable": true,
            "width":"100px",
            "background-color":"aqua",
        },
        {
            "targets": 1,
            "orderable": false,
            "width":"150px",
        },
        {
            "targets": 2,
            "orderable": false,
            "width":"150px",
        },
        {
            "targets": 3,
            "orderable": false,
            "width":"150px",
        },
        {
            "targets": 4,
            "orderable": false,
            "class": "white_space, text-left",
            "width":"250px",
        },
         {
            "targets": 5,
            "orderable": false,
            "class": "white_space",
            "width":"200px",
        },
        ],
    });
});


function editExpendForm() 
{

    $.ajax({
        url: site_url+"/expend/editamountExpendForm",
        data: $('#editExpendForm').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            if(response == "true")
            {
                toastr.success("succesfully");
                $('#editPersonal_expenses').modal('hide');
                $("#expend_table").DataTable().ajax.reload(null, false);
            }
            else
            {
                toastr.error("Amount should be less than or qual to initial amount");
            }

        }

    });
}

$("form[name='editExpendForm']").validate({
    rules: {
            amount_expend : {
                required: true,
            },
            created_date : {
                required: true,
            },
            payable_type : {
                required: true,
            },
            Cheque_Number : {
                required: true,
            },
            region : {
                required: true,
            },
            
          },


    messages: {
            amount_expend : {
                required: "Please Enter amount",
            },
            created_date : {
                required: "Please Select date",
            },
            payable_type : {
                required: "Please Select payment type",      
            },
            region : {
                required: "Please Enter region note",
            },
        },

    submitHandler: function (form) {
        editExpendForm();
       }
});



function editDetails(id) 
{
    $.ajax({
        url: site_url+"/expend/editExpenseDetails",
        type: 'POST',
        data : {"id" : id},
        success: function(response)
        {
            $('#edit_expenses').html(response);
            $('#editPersonal_expenses').modal('toggle');
        }
    });
}

function editexpendTrasactionTypeCase()
    {
        var type = $("#case_payable_type").val();
       
        if (type == "" || type == "cash" ) 
        {
            $("#cheque_details").css("display", "none");
        }
        else
        {   
            $("#cheque_details").css("display", "block");
        }   
    }

function editexpendTrasactionType()
    {
        var type = $("#bank_payable_type").val();

        if (type == "" || type == "cash" ) 
        {
            $("#cheque_details").css("display", "none");
        }
        else
        {     
            $("#cheque_details").css("display", "block");
        }   
    }    

