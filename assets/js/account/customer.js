$(function () {

    $("#customer_table").DataTable({

        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/customer/fetch_details",  
            type:"POST"  
        }, 
        "order": [[ 1, "asc" ]],
        "columnDefs": [ 
            {
                "targets": 0,
                "orderable": false,
                "width":"80px",
                "class": "text-center",
            },
            {
                "targets": 1,
                "class": "text-center",
            },
            {
                "targets": 2,
                "orderable": false,
                "class": "text-center",
            },
            {
                "targets": 3,
                "orderable": false,
                "class": "text-center",
            },
            {
                "targets": 4,
                "class": "text-center",
            },
            {
                "targets": 5,
                "class": "text-center",
            },
            {
                "targets": 6,
                "orderable": false,
                "class": "text-center",
            },
            {
                "targets": 7,
                "orderable": false,
                "class": "white_space text-center",
                "width":"50px",
            }
        ],
    });
});


var name = $('#search_name').val();
function onSelectCustomer()
{
    var name = $('#search_by_name').val();
    $('#search_name').val(name);
    $("#customer_super_admin_table").DataTable().ajax.reload(null, false);
}



$(function () {

    $("#customer_super_admin_table").DataTable({

        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/customer/fetch_super_admin_details",  
            "data": function ( d ) 
                {
                  d.search_name = $('#search_name').val();
            },   
            type:"POST"  
        }, 
        "order": [[ 1, "asc" ]],
        "columnDefs": [ 
            {
                "targets": 0,
                "orderable": false,
                "width":"80px",
            },
            {
                "targets": 1,
                "class": "text-center",
            },
            {
                "targets": 2,
                "orderable": false,
                "class": "text-center",
            },
            {
                "targets": 3,
                "orderable": false,
                "class": "text-center",
            },
            {
                "targets": 4,
                "class": "text-center",
            },
            {
                "targets": 5,
                "class": "text-center",
            },
            {
                "targets": 6,
                "orderable": false,
                "class": "text-center",
            },
            {
                "targets": 7,
                "orderable": false,
                "class": "white_space text-center",
                "width":"50px",
            }
        ],
    });
});

$("form[name='addCustomerDetails']").validate({
    rules: {
        first_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        last_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        parent_name: {
            required:true,
            regex: "^[a-zA-Z ]*$",
        },
        phone: {
            regex: "^[0-9]{10}",
        },
        whatsapp: {
            regex: "^[0-9]{10}",
        },
        gender: {
            required: true,
        },
        city: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        state: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        address: {
            required: true,
            regex: "^[a-zA-Z0-9/, ]*$",
        },
        postal_code: {
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
             regex:  "^[0-9]{12}",
        },
        
    },

    messages: {
        first_name: {
            required: "Please Provide First Name",
            regex:"Only Alphabets Allowed",
        },
        last_name: {
            required: "Please Provide Last Name",
            regex:"Only Alphabets Allowed",
        },
        parent_name: {
            required: "Please Provide Parent Name",
            regex:"Only Alphabets Allowed",
        },
        phone: {
            regex: "Only No's Allowed(max:10)",
        },
        whatsapp: {
            regex: "Only No's Allowed(max:10)",
        },
        gender: {
            required: "Please Select Gender",
        },
        city: {
            required: "Please Provide City",
            regex:"Only Alphabets Allowed",
        },
        state: {
            required: "Please Provide State",
            regex:"Only Alphabets Allowed",
        },
        address: {
            required: "Please Provide Address",
            regex:"No Special Characters Except(/)  Allowed",
        },
        postal_code: {
            required: "Please Provide Postal Code",
            regex:"Only 6 Digits Allowed ",
        },
        aadhar_no: {
             required: "Please Provide Aadhar No.",
            regex:"Only 12 Digits Allowed ",
        },
        
    },

    submitHandler: function (form) {
        addCustomerDetails();
    }
});


function addCustomerDetails() 
{
    var form = $('#addCustomerDetails')[0];
    var data = new FormData(form);
    $.ajax({
        url: site_url+"/customer/addCustomerInfo",
        data:data,
        type: 'POST',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(response)
        {
            loadPageWithoutRefresh(site_url+"/customer/index");
            $("#customer_table").DataTable().ajax.reload(null, false);
            toastr.success("Customer Details added");
        }
    });
}


function readURLCustomer(input)
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#customer_preview')

                .attr('src', e.target.result)
                .width(100)
                .height(100);
        };
        $('#customer_preview').show();
        reader.readAsDataURL(input.files[0]);
    }
}


$("form[name='updateCustomerDetails']").validate({
    rules: {
        first_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        last_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        parent_name: {
            required:true,
            regex: "^[a-zA-Z ]*$",
        },
        phone: {
            regex: "^[0-9]{10}",
        },
        whatsapp: {
            regex: "^[0-9]{10}",
        },
        gender: {
            required: true,
        },
        city: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        state: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        address: {
            required: true,
            regex: "^[a-zA-Z0-9/, ]*$",
        },
        postal_code: {
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
             regex:  "^[0-9]{12}",
        },
        
    },

    messages: {
        first_name: {
            required: "Please Provide First Name",
            regex:"Only Alphabets Allowed",
        },
        last_name: {
            required: "Please Provide Last Name",
            regex:"Only Alphabets Allowed",
        },
        parent_name: {
            required: "Please Provide Parent Name",
            regex:"Only Alphabets Allowed",
        },
        phone: {
            regex: "Only No's Allowed(max:10)",
        },
        whatsapp: {
            regex: "Only No's Allowed(max:10)",
        },
        gender: {
            required: "Please Select Gender",
        },
        city: {
            required: "Please Provide City",
            regex:"Only Alphabets Allowed",
        },
        state: {
            required: "Please Provide State",
            regex:"Only Alphabets Allowed",
        },
        address: {
            required: "Please Provide Address",
            regex:"No Special Characters Except(/)  Allowed",
        },
        postal_code: {
            required: "Please Provide Postal Code",
            regex:"Only 6 Digits Allowed ",
        },
        aadhar_no: {
             required: "Please Provide Aadhar No.",
            regex:"Only 12 Digits Allowed ",
        },
        
    },

    submitHandler: function (form) {
        updateCustomerDetails();

    }
});


function updateCustomerDetails() 
{
    var form = $('#updateCustomerDetails')[0];
    var data = new FormData(form);
    $.ajax({
        url: site_url+"/customer/updateCustomerInfo",
        data:data,
        type: 'POST',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(response)
        {
            loadPageWithoutRefresh(site_url+"/customer/index");
            $("#customer_table").DataTable().ajax.reload(null, false);
            toastr.success("Customer Details Updated");
        }

    });
}