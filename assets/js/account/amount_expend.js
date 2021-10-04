function amountExpendForm() 
{

    $.ajax({
        url: site_url+"/expend/amountExpendForm",
        data: $('#amountExpendForm').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            if(response == "true")
            {
                toastr.success("succesfully");
                $('#addPersonal_expenses').modal('hide');
                $("#expend_table").DataTable().ajax.reload(null, false);
            }
            else
            {
                toastr.error("Amount should be less than or qual to initial amount");
            }

        }

    });
}

$("form[name='amountExpendForm']").validate({
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
                required: false,
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
        amountExpendForm();
       }
});


