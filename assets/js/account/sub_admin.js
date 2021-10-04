$(function () {

    $("#sub_admin_table").DataTable({

        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/admin/fetch_details",  
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
                "width":"100px",
            },
            {
                "targets": 8,
                "orderable": false,
                "class": "white_space text-center",
                "width":"100px",
            },
            {
                "targets": 9,
                "orderable": false,
                "class": "white_space text-center",
                "width":"50px",
            },
            {
                "targets": 10,
                "orderable": false,
                "class": "white_space text-center",
                "width":"100px",
            },
            {
                "targets": 11,
                "orderable": false,
                "class": "white_space text-center",
                "width":"50px",
            },
            {
                "targets": 12,
                "orderable": false,
                "class": "white_space text-center",
                "width":"50px",
            }
        ],
    });
});


$("form[name='addSubAdminDetails']").validate({
    rules: {
        first_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        last_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        intial_investment: {
            required:true,
            regex: "^[0-9]",
        },
        email: {
            required:true,
            regex: "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",
        },
        phone: {
            required:true,
             regex:  "^[0-9]{10}",
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
            required:true,
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
            required:true,
             regex:  "^[0-9]{12}",
        },
        postal_code: {
            required:true,
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
            required:true,
             regex:  "^[0-9]{12}",
        },
        password : {
                 minlength : 5
        },
       re_password : {
            minlength : 5,
            equalTo : "#password"
        }
    
        
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
        intial_investment: {
            required: "Please Enter Investment",
            regex:"Only Alphabets Allowed",
        },
        phone: {
             required: "Please Provide Email",
            regex:"Only valid email Allowed",
        },
        phone: {
            regex: "Only No's Allowed(max:10)",
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
        password: {
            required: "Please Provide password",
        },
        re_password: {
            required: "Please Enter confirm password",
            
        },
        
    },

    submitHandler: function (form) {
        addSubAdminDetails();
    }
});


function addSubAdminDetails() 
{
    var form = $('#addSubAdminDetails')[0];
    var data = new FormData(form);
    $.ajax({
        url: site_url+"/admin/addSubAdminInfo",
        data:data,
        type: 'POST',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(response)
        {
            $('#addSubAdmin').modal('hide');
            $("#addSubAdminDetails").reset();
            toastr.success("Users Details added");
            $('#sub_admin_table').DataTable().ajax.reload(null, false);
        }
    });
}

function editsubadminDetails(id) 
{
    $.ajax({
        url: site_url+"/admin/editsubadminDetails",
        type: 'POST',
        data : {"id" : id},
        success: function(response)
        {
            $('#editSubAdmindata').html(response);
            $('#editSubAdmin').modal('toggle');
        }
    });
}


function editSubAdminForm() 
{
   
    $.ajax({
        url: site_url+"/admin/editSubadminForm",
        data: $('#editSubAdminForm').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            $('#editSubAdmin').modal('hide');
            toastr.success("Users Details Updated");
            $('#sub_admin_table').DataTable().ajax.reload(null, false);
        }

    });
}

$("form[name='editSubAdminForm']").validate({
    rules: {
        first_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        last_name: {
            required: true,
            regex: "^[a-zA-Z ]*$",
        },
        intial_investment: {
            required:true,
            regex: "^[0-9]",
        },
        email: {
            required:true,
            regex: "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",
        },
        phone: {
            required:true,
             regex:  "^[0-9]{10}",
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
            required:true,
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
            required:true,
             regex:  "^[0-9]{12}",
        },
        postal_code: {
            required:true,
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
            required:true,
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
        intial_investment: {
            required: "Please Enter Investment",
            regex:"Only Alphabets Allowed",
        },
        phone: {
             required: "Please Provide Email",
            regex:"Only valid email Allowed",
        },
        phone: {
            regex: "Only No's Allowed(max:10)",
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
        editSubAdminForm();
    }
});

// function readURLCustomer(input)
// {
//     if (input.files && input.files[0]) 
//     {
//         var reader = new FileReader();
//         reader.onload = function (e) 
//         {
//             $('#customer_preview')

//                 .attr('src', e.target.result)
//                 .width(100)
//                 .height(100);
//         };
//         $('#customer_preview').show();
//         reader.readAsDataURL(input.files[0]);
//     }
// }


// $("form[name='updateCustomerDetails']").validate({
//     rules: {
//         first_name: {
//             required: true,
//             regex: "^[a-zA-Z ]*$",
//         },
//         last_name: {
//             required: true,
//             regex: "^[a-zA-Z ]*$",
//         },
//         parent_name: {
//             required:true,
//             regex: "^[a-zA-Z ]*$",
//         },
//         phone: {
//             regex: "^[0-9]{10}",
//         },
//         whatsapp: {
//             regex: "^[0-9]{10}",
//         },
//         gender: {
//             required: true,
//         },
//         city: {
//             required: true,
//             regex: "^[a-zA-Z ]*$",
//         },
//         state: {
//             required: true,
//             regex: "^[a-zA-Z ]*$",
//         },
//         address: {
//             required: true,
//             regex: "^[a-zA-Z0-9/, ]*$",
//         },
//         postal_code: {
//             regex:  "^[0-9]{6}",
//         },
//         aadhar_no: {
//              regex:  "^[0-9]{12}",
//         },
        
//     },

//     messages: {
//         first_name: {
//             required: "Please Provide First Name",
//             regex:"Only Alphabets Allowed",
//         },
//         last_name: {
//             required: "Please Provide Last Name",
//             regex:"Only Alphabets Allowed",
//         },
//         parent_name: {
//             required: "Please Provide Parent Name",
//             regex:"Only Alphabets Allowed",
//         },
//         phone: {
//             regex: "Only No's Allowed(max:10)",
//         },
//         whatsapp: {
//             regex: "Only No's Allowed(max:10)",
//         },
//         gender: {
//             required: "Please Select Gender",
//         },
//         city: {
//             required: "Please Provide City",
//             regex:"Only Alphabets Allowed",
//         },
//         state: {
//             required: "Please Provide State",
//             regex:"Only Alphabets Allowed",
//         },
//         address: {
//             required: "Please Provide Address",
//             regex:"No Special Characters Except(/)  Allowed",
//         },
//         postal_code: {
//             required: "Please Provide Postal Code",
//             regex:"Only 6 Digits Allowed ",
//         },
//         aadhar_no: {
//              required: "Please Provide Aadhar No.",
//             regex:"Only 12 Digits Allowed ",
//         },
        
//     },

//     submitHandler: function (form) {
//         updateCustomerDetails();

//     }
// });


// function updateCustomerDetails() 
// {
//     var form = $('#updateCustomerDetails')[0];
//     var data = new FormData(form);
//     $.ajax({
//         url: site_url+"/customer/updateCustomerInfo",
//         data:data,
//         type: 'POST',
//         enctype: 'multipart/form-data',
//         processData: false,
//         contentType: false,
//         cache: false,
//         timeout: 600000,
//         success: function(response)
//         {
//             loadPageWithoutRefresh(site_url+"/customer/index");
//             $("#customer_table").DataTable().ajax.reload(null, false);
//             toastr.success("Customer Details Updated");
//         }

    // });
// }