$("form[name='updatebasicinfo']").validate({
    rules: {
        
        f_name: {
            required: true,
            regex: "^[a-zA-Z. ]*$",
        },
        l_name: {
            required: true,
            regex: "^[a-zA-Z. ]*$",
        },
        phone: {
            required: true,
            regex: "^[0-9]{10}",
        },
        name_of_organisation: {
            required: true,
            regex: "^[a-zA-Z. 0-9]*$",
        },
        establish_year: {
            required: true,
            regex: "^[0-9]{4}",
        },
        registration_no: {
             required: true,
            regex: "^[a-zA-Z0-9]*$",
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
        },
        postal_code: {
             required: true,
            regex:  "^[0-9]{6}",
        },
        aadhar_no: {
             required: true,
            regex:  "^[0-9]{12}",
        }
    },


    messages: {
        f_name: {
            required: "Please Provide First Name",
            regex:"Only Alphabets Allowed, Space and Dot(.)"
        },
        l_name: {
            required: "Please Provide Last Name",
            regex:"Only Alphabets Allowed, Space and Dot(.)"
        },
        phone: {
            required: "Please Provide Phone",
            regex:"Only Numbers Allowed "
        },
        name_of_organisation: {
            required: "Please Provide Name Of Organisation",
            regex:"Only Alphabets , Numbers, Space and Dot(.) Allowed "
        },
        establish_year: {
            required: "Please Provide Establish Year",
            regex:"Only Year Allowed "
        },
        registration_no: {
            required: "Please Provide Registration No.",
            regex:"No Special Character Allowed"
        },
        city: {
            required: "Please Provide City",
            regex:"Only Alphabets Allowed "
        },
        state: {
            required: "Please Provide State",
            regex:"Only Alphabets Allowed ",
        },
        address: {
            required: "Please Provide Address",
        },
        postal_code: {
            required: "Please Provide Postal Code",
            regex:"Only 6 Digits Allowed "
        },
        aadhar_no: {
            required: "Please Provide Aadhar No.",
            regex:"Only 12 Digits Allowed "
        } 
    },

    submitHandler: function (form) {
        updatebasic();       
    }
});


function updatebasic() 
{
    $.ajax({
        url: site_url+"/admin/updateUserInfo",
        data: $('#updatebasicinfo').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
           toastr.success("Basic Info Updated");
        }

    });
}


function amountAddForm() 
{

    $.ajax({
        url: site_url+"/admin/addInitialAmount",
        data: $('#amountAddForm').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            $("#intial_investment").val("");
            $("#intial_investment").val(response);
            
            toastr.success("succesfully");
            $('#addInitialAmount').modal('hide');

        }

    });
}

$("form[name='amountAddForm']").validate({
    rules: {
            amount_add : {
                required: true,
            },
            created_date : {
                required: true,
            },
            payable_type : {
                required: true,
            },
            Cheque_Number : {
                required: false,
            },
            
          },


    messages: {
            amount_add : {
                required: "Please Enter amount",
            },
            created_date : {
                required: "Please Select date",
            },
            payable_type : {
                required: "Please Select payment type",      
            },
            
    },

    submitHandler: function (form) {
        amountAddForm();
       }
});