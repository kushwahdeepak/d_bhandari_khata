$(function () {
    $("#bank_details_table").DataTable({

        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/bank/fetch_details",  
            type:"POST"  
        }, 
        "order": [[ 0, "asc" ]],
        "columnDefs": [ 
            {
                "targets": 0,
                "orderable": true,
                "class": "white_space",
                "width":"30px",
            },
            {
                "targets": 1,
                "orderable": false,
            },
            {
                "targets": 2,
                "width":"50px",
                "class": "text-center",
            },
            {
                "targets": 3,
                "width":"50px",
                "class": "text-center",
            },
            // {
            //     "targets": 4,
            //     "width":"50px",
            //     "orderable": false,
            // },
            
        ],
        
    });
});


function editBank(bank_id)
{
    $.ajax({
        url: site_url+"/bank/editBankDetails",
        type: "POST",
        data:{'bank_id':bank_id},
        dataType: "json",
        success: function(response) 
        {
            $('.updateBank').html("");
            $('.updateBank').append(response);
            $('#editBank').modal('show');
        }   
    });
}


function updateBankDetails() 
{
    $.ajax({
        url: site_url+"/bank/updateBankInfo",
        data: $('#updateBankDetails').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            $('#editBank').modal('hide');
            toastr.success("Bank Details Updated");
            $("#bank_details_table").DataTable().ajax.reload(null, false);
        }

    });
}


function addBankDetails() 
{
    $.ajax({
        url: site_url+"/bank/addBankInfo",
        data: $('#addBankDetails').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            $('#addBank').modal('hide');
            $("#addBankDetails")[0].reset();
            toastr.success("Bank Details added");
            $("#bank_details_table").DataTable().ajax.reload(null, false);
        }

    });
}


$("form[name='updateBankDetails']").validate({
    rules: {

        account_no: {
            required: true,

        },
        account_holder_name: {
            required: true,

        },
        ifsc_code: {
            required: true,

        },
        Status: {
            required: true,

        },
        bank_name: {
            required: true,
        }
    },

    messages: {
        account_no: {
            required: "Please Provide Account No"
        },
        account_holder_name: {
            required: "Please Provide Account Holder Name"
        },
        ifsc_code: {
            required: "Please Provide IFSC Code"
        },
        // Type: {
        //     required: "Please Provide Account Type"
        // },
        Status: {
            required: "Please Provide Status"
        },
        bank_name: {
            required: "Please Provide Bank Name"
        }

    },

    submitHandler: function (form) {
        updateBankDetails();

    }
});


$("form[name='addBankDetails']").validate({
    rules: {

        account_no: {
            required: true,

        },
        account_holder_name: {
            required: true,

        },
        ifsc_code: {
            required: true,

        },
        Type: {
            required: true,

        },
        bank_name: {
            required: true,
        }
    },

    messages: {
        account_no: {
            required: "Please Provide Account No"
        },
        account_holder_name: {
            required: "Please Provide Account Holder Name"
        },
        ifsc_code: {
            required: "Please Provide IFSC Code"
        },
        Type: {
            required: "Please Provide Account Type"
        },
        bank_name: {
            required: "Please Provide Bank Name"
        }

    },

    submitHandler: function (form) {
        addBankDetails();

    }
});


function disableBankStatus(bank_id)
{
   $.ajax({
        url: site_url+"/bank/disableBankStatus",
        data: {'bank_id':bank_id},
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            toastr.success("Bank Status Changed");
            $("#bank_details_table").DataTable().ajax.reload(null, false);
        }
    });
}


function enableBankStatus(bank_id)
{
   $.ajax({
        url: site_url+"/bank/enableBankStatus",
        data: {'bank_id':bank_id},
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            toastr.success("Bank Status Changed");
            $("#bank_details_table").DataTable().ajax.reload(null, false);
        }
    });
}


function checkAccountActiveTab(activeTab="")
{
    if(activeTab=="bank_details")
    {
        $("#addbankbtn").css("display","block");
    }
    else
    {
        $("#addbankbtn").css("display",'none');
    }

    if(activeTab=="rate_table")
    {
        $("#editratebtn").css("display","block");
    }
    else
    {
        $("#editratebtn").css("display",'none');
    }

}