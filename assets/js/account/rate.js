function update_rate() 
{
    $.ajax({
        url: site_url+"/admin/updateRateTable",
        data: $('#updateratetable').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            $('#editRateBtn').modal('hide');
           toastr.success("Rate Has Been Updated");
        }

    });
}

$("form[name='updateratetable']").validate({
    rules: {
        
        gold: {
            required: true,
            regex: "^[0-9]*$",
        },
        silver: {
            required: true,
            regex: "^[0-9]*$",
        }
    },


    messages: {
        gold: {
            required: "Please Provide Price",
            regex:"Only Numbers Allowed ",
        },
        silver: {
            required: "Please Provide Price",
            regex:"Only Numbers Allowed ",
        }
    },

    submitHandler: function (form) {
        update_rate();
       
    }
});