$("form[name='updateprofileimage']").validate(
{
    rules: 
    {
        image: {
            required: true
        }
    },
    messages: 
    {
        image: {
            required: "Please select an image"
        }
    },

    submitHandler: function (form) {
      updateProfileImage();  
       
    }
});


function updateProfileImage() 
{
    var form = $('#updateprofileimage')[0];
    var data = new FormData(form);
    $.ajax({
        url: site_url+"/admin/userProfilePicture",
        data:data,
        type: 'POST',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(response)
        {
            $('#preview').hide();
            $('#updateprofileimage')[0].reset();
            toastr.success("Profile Picture Updated");
            window.location.href = "index.php/admin/index//profile_image"
        }
    });
}


function readURL(input)
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#preview')

                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        $('#preview').show();
        reader.readAsDataURL(input.files[0]);
    }
}