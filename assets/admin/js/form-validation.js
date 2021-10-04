// Wait for the DOM to be ready
$(function() {

    var siteUrl = $('#site_url_path_for_external_js').val();
    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );



    // start for date

    jQuery.validator.addMethod("greaterThan", 
    function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) >= Number($(params).val())); 
    },'Must be greater than {0}.');
    //  end



  $("form[name='updatePass']").validate({
        rules: {
            new_password: {
                required: true,
                regex: "^(?=.*\\d)(?=.*[a-z])(?=.*[!@#$%^&*])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}$"
            },
            con_new_password: {
                required: true,
                equalTo: "#newpass"
            }
        },
        messages: {
            new_password: {
                required: "Please provide a password",
                regex: "Password must contain 8 characters with at least one lower case letter, one capital case letter, one special character and one digit"
            },
            con_new_password: {
                required: "Please provide confirm password",
                equalTo: "Password & Confirm Password doesn't match"
            }
            
        },

        submitHandler: function (form) {
            form.submit();
        }
    });




  $("form[name='updateInfo']").validate({
        rules: {
            first_name: {
                required: true,
                regex: "^[A-Za-z .]+$",
            },
            last_name: {
                required: true,
                regex: "^[A-Za-z .]+$",
            }
        },
        messages: {
            first_name: {
                required: "Please enter first name",
                regex: "Allow only aplphabets, dot and space"
            },
            last_name: {
                required: "Please enter last name",
                regex: "Allow only aplphabets, dot and space"
            },
            
        },

        submitHandler: function (form) {
            form.submit();
        }
    });

  $("form[name='updateImg']").validate({
        rules: {
            image: {
                required: true,
            },
        },
        messages: {
            image: {
                required: "Please select an image",
            },
            
        },

        submitHandler: function (form) {
            form.submit();
        }
    });

  $("form[name='createTag']").validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
            
        },

        submitHandler: function (form) {
            // form.submit();
            submitTagForm();
        }
    });




  $("form[name='createBlog']").validate({
        rules: {
            title: {
                required: true,
            },
            image: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Please enter title",
            },
            image: {
                required: "Please select an image",
            }
            
        },

        submitHandler: function (form) {
            // form.submit();
            var des = document.getElementById("WYSIHTML").value;
            var tag_section = document.getElementById("tag_section").value;
            if(des !== "")
            {
                $('#description-error').css('display','none');
            }
            else
            {
                $('#description-error').css('display', 'block');
                $('#description-error').append("Please enter description");
            }
            if(tag_section !== "")
            {
                $('#tags-error').css('display','none');
            }
            else
            {
                $('#tags-error').css('display', 'block');
                $('#tags-error').append("Please select tag");
            }
            if(des !== "" && tag_section !== "")
            {
                form.submit();
            }
        }
    });



  $("form[name='updateBlog']").validate({
        rules: {
            title: {
                required: true,
            },
            image: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Please enter title",
            },
            image: {
                required: "Please select an image",
            }
            
        },

        submitHandler: function (form) {
            // form.submit();
            var des = document.getElementById("WYSIHTML").value;
            var tag_section = document.getElementById("tag_section").value;
            if(des !== "")
            {
                $('#description-error').css('display','none');
            }
            else
            {
                $('#description-error').css('display', 'block');
                $('#description-error').append("Please enter description");
            }
            if(tag_section !== "")
            {
                $('#tags-error').css('display','none');
            }
            else
            {
                $('#tags-error').css('display', 'block');
                $('#tags-error').append("Please select tag");
            }
            if(des !== "" && tag_section !== "")
            {
                form.submit();
            }
        }
    });

});