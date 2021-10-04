function change_password() 
{
    $.ajax({
        url: site_url+"/admin/updateUserPasswordInfo",
        data: $('#change_password').serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
           toastr.success("Your password change succesfully");

        }

    });
}

$("form[name='change_password']").validate({
    rules: {
           new_password : {
                 minlength : 5
            },
           con_new_password : {
                minlength : 5,
                equalTo : "#new_password"
            }
          },


    messages: {
        new_password: {
            required: "Please Provide new_password",
        },
        con_new_password: {
            required: "Please Enter confirm new_password",
            
        },
    },

    submitHandler: function (form) {
        change_password();
       }
});