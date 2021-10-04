

function addLoanDetails()
{
    var form = $('#addLoanDetails')[0];
    var data = new FormData(form);
    $.ajax({
        url: site_url+"/loan/addLoanDetails",
        data:data,
        type: 'POST',
        dataType: 'json',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(response)
        {
            if(response == "true")
            {
                toastr.success("Loan succesfully");
                window.location.href = "index.php/loan/index"
            }
            else
            {
                toastr.error("Amount should be less than or qual to initial amount");
            }
           
        }
    });
}


$("form[name='addLoanDetails']").validate({
    rules: {
           
            "gold_item_name[]" : {
                required: true,
            },
            "gold_item_weight[]" : {
                 required: true,
            },
            "gold_item_purity[]" : {
                required: true,
            },
            // "gold_item_value[]" : {
            //      required: true,
            // },
            // "gold_item_quantity[]" : {
            //      required: true,
            // },

            "silver_item_name[]" : {
                required: true,
            },
            "silver_item_weight[]" : {
                 required: true,
            },
            "silver_item_purity[]" : {
                 required: true,
            },
            // "silver_item_value[]" : {
            //      required: true,
            // },
            // "silver_item_quantity[]" : {
            //      required: true,
            // },
            loan_date : {
                required: true,
            },
            security : {
                required: true,
            },
            amount : {
                required: true,
            },
            percentage : {
                required: true,
            },
            trasactionType : {
                required: true,
            },
            
          },


    messages: {
            
           
            "gold_item_name[]" : {
               required: "Please Enter Name",
            },
            "gold_item_weight[]" : {
                required: " Required ",
            },
            "gold_item_purity[]" : {
                required: " Required  ",
            },
            // "gold_item_value[]" : {
            //     required: " required  ",
            // },
            // "gold_item_quantity[]" : {
            //     required: "required",
            // },

            
            "silver_item_name[]" : {
                required: "Please Enter Name",
            },
            "silver_item_weight[]" : {
                required: " Required ",
            },
            "silver_item_purity[]" : {
                required: " Required  ",
            },
            // silver_item_value[] : {
            //     required: " required  ",
            // },
            // silver_item_quantity[] : {
            //     required: " required  ",
            // },
            loan_date : {
                 required: "Please Select date",
            },
            security : {
                 required: "Please Select security",
            },
            amount : {
                  required: "Please Enter amount",
            },
            percentage : {
                required: "Please Enter percentage",
            },
            trasactionType : {
                 required: "Please Select payment",
            },
            
    },

    submitHandler: function (form) {
        addLoanDetails();
       }
});


$("form[name='CompliteLoan']").validate({
    rules: {
           
            "customer_id" : {
                required: true,
            },
            "lone_id" : {
                 required: true,
            },
             "amount" : {
                 required: true,
            },
           },  
 messages: {
             "customer_id" : {
               required: "customer_id not selected",
            },
            "lone_id" : {
                required: " loan_id not selected",
            },
            "amount" : {
                required: " loan_id not selected",
            },
        },

    submitHandler: function (form) {
        Complite_customer_Loan();
       }
});

function compliteCustomerLoan()
{
    var recivable_type = $('#recivable_type').val();
    var account_no_input = $('#account_no_input').val();
    var account_holder_name_input = $('#account_holder_name_input').val();
    var bank_name_input = $('#bank_name_input').val();
    var ifsc_code_input = $('#ifsc_code_input').val();
    var cheque_detail_input = $('#Cheque_Number_input').val();

    if(recivable_type != "cash")
    {
        if(account_no_input == "")
        {
            $('#account_no_error').css('display', 'block');
        }
        else
        {
            $('#account_no_error').css('display', 'none');
        }
        if(account_holder_name_input == "")
        {
            $('#account_holder_name_error').css('display', 'block');        
        }
        else
        {
            $('#account_holder_name_error').css('display', 'none'); 
        }
        if(bank_name_input == "")
        {
            $('#bank_name_error').css('display', 'block');        
        }
        else
        {
            $('#bank_name_error').css('display', 'none');  
        }
        if(ifsc_code_input == "")
        {
            $('#ifsc_code_error').css('display', 'block');        
        }
        else
        {
            $('#ifsc_code_error').css('display', 'none'); 
        }

        if(account_no_input != "" && account_holder_name_input != "" && bank_name_input != "" && ifsc_code_input != "")
        {
            $('#account_no_error').css('display', 'none'); 
            $('#account_holder_name_error').css('display', 'none');  
            $('#bank_name_error').css('display', 'none');  
            $('#ifsc_code_error').css('display', 'none');    
            Complite_customer_Loan();    
        }
    }
    else
    {
        Complite_customer_Loan();
    }
}

function Complite_customer_Loan()
{
    // var form = $('#CompliteLoan')[0];
    var form = $('#completeTransactionForm')[0];
        var data = new FormData(form);
        $.ajax({
            url: site_url+"/loan/CompliteLoan",
            data:data,
            type: 'POST',
            dataType: 'json',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(response)
            {  
                $('.close').click(); 
                if (response == "true")
                {
                    toastr.success("Loan completed succesfully");
                    window.location.href = "index.php/loan/index"
                }
                else if(response == "false")
                {
                    toastr.error(" sorry! Loan completed already");
                    window.location.href = "index.php/loan/index"
                }   
                // window.location.href = "index.php/loan/index"
               
            }
        });
}

$("form[name='completeTransactionForm']").validate({
    rules: 
    {
           
        "customer_id" : {
            required: true,
        },
        "lone_id" : {
             required: true,
        },
         "amount" : {
             required: true,
        },
    },  
    messages: 
    {
        "customer_id" : {
           required: "customer_id not selected",
        },
        "lone_id" : {
            required: " loan_id not selected",
        },
        "amount" : {
            required: " loan_id not selected",
        },
    },

    submitHandler: function (form) {
        compliteCustomerLoan();
       }
});
