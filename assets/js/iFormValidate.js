$.fn.iFormValidate = function () {
    var $form = this;
   
    var nameReg = /^[a-zA-Z ]{2,30}$/;
    var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
//    var phoneReg = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;
    var phoneReg = /^[0-9]{10}$/;
    function showError(element, message) {
        if (element.parent().find('.error_label').length == 0) {
            element.parent('div').append('<br><p class="error_label" style="color:red;">' + message + '</p>');
        }
        element.css('border-color', 'red');
        element.parent('div').find('.error_label').show();
        event.preventDefault();
    }
    function hideError(element) {
        element.css('border-color', '#ccc');
        element.parent('div').find('.error_label').hide();

    }
    $form.find('input[type=password]').keyup(function () {
        if ($(this).val().length < 8) {
            showError($(this),"Enter a Strong Password");
        }else{
            hideError($(this));
        }
    });
    $form.submit(function () {
       
        $form.find('input,textarea').each(function () {
            var $elem = $(this);
            var elem_tag = $elem.prop("tagName").toLowerCase();
            var elem_type = $elem.attr('type');
            var value = $elem.val();
            var validation_type = $elem.attr('data-validation');
            if (elem_tag === "textarea") {

            }
            if (validation_type == "file") {
                if (value != "") {
                    hideError($elem);
                } else {
                    showError($elem, "Please Choose file");
                }
            }
            if (validation_type == "email") {
                if (emailReg.test(value)) {
                    hideError($elem);
                } else {
                    showError($elem, "Enter Valid Email Address");
                }
            }
            if (validation_type == "phone") {
                if (phoneReg.test(value)) {
                    hideError($elem);
                } else {
                    showError($elem, "Enter Valid Phone Number");
                }
            }
            if (validation_type == "character") {
                if (nameReg.test(value)) {
                    hideError($elem);
                } else {
                    showError($elem, "Enter Characters Only");
                }
            }
            if (validation_type == "password") {
                var $re_pass = $($elem.attr('data-target'));
                if (value != "") {
                    if (value != $re_pass.val()) {
                        showError($re_pass, "Passwords are not matching !");
                    } else {
                        hideError($re_pass);
                    }
                    hideError($elem);
                } else {
                    showError($elem, "Enter Password !");
                }
            }
        });
    });

    return this;
    
};
