function updateintialinvestment() 
{
    $.ajax({
        url: site_url+"/admin/updateIntialInvestmentInfo",
        data: $('#intial_investment').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
           toastr.success("Intial Investment Updated");
        }

    });
}

$("form[name='intial_investment']").validate({
    rules: {
        intial_investment: {
            regex: "^[0-9.]*$",
        },
    },
messages: {
        
        intial_investment: {
            required: "Please Provide Intial Investment",
            regex:"Only Numbers Allowed "
        },
    },

    submitHandler: function (form) {
        updateintialinvestment();
       
    }
});