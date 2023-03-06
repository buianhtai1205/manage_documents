//Đối tượng Validator
function Validator(options) {
    function getParent(element, selector) {
        while(element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};

    //hàm thực hiện validate
    function validatate(inputElement, rule) {
        var errorMessage ;
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);

        //lấy ra các rule của selector
        var rules = selectorRules[rule.selector];

        //lặp qua và check
        for(let i = 0; i < rules.length; i++) {
            switch (inputElement.type)
            {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    );
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            //nếu có lỗi dừng kiểm tra
            if(errorMessage) { break;}
        }

        if(errorMessage) {
            errorElement.innerHTML = errorMessage;
            inputElement.parentElement.classList.add('invalid');
        } else {
            errorElement.innerHTML = '';
            inputElement.parentElement.classList.remove('invalid');
        }
        return !errorMessage;
    }

    //Lấy element của form cần validate
    var formElement = document.querySelector(options.form);

    if (formElement) {
        formElement.onsubmit = function(e) {
            e.preventDefault();

            var isFormValid = true;

            //lặp qua và validate
            options.rules.forEach(function(rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validatate(inputElement, rule);
                if(!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                if (typeof options.onSubmit == 'function') {
                    var enableInputs = formElement.querySelectorAll("[name]");
                    var formValues = Array.from(enableInputs).reduce(function(values, input) {
                        switch(input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }

                        return values;
                    }, {})
                    options.onSubmit(formValues);
                } else {
                    formElement.submit();
                }

            }

        }



        //Xử lý lặp qua mỗi rules và lắng nghe sự kiện
        options.rules.forEach(function(rule) {

            //lưu lại các rules cho mỗi input element
            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElement = formElement.querySelector(rule.selector);

            if(inputElement) {
                //Xử lý trường hợp blur khỏi input
                inputElement.onblur = function() {
                    validatate(inputElement, rule);
                }
                //Xử lý mỗi khi người dùng nhập
                inputElement.oninput = function() {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerHTML = '';
                    inputElement.parentElement.classList.remove('invalid');
                }
            }
        })

    }

}

//Định nghĩa các rules
//Nguyên tắc các rules
//1. Khi có lỗi trả message lỗi
//2. Khi hợp lệ trả undefined
Validator.isRequired = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            return value.trim() ? undefined : message || "Please enter this field";
        }
    }
}
Validator.isEmail = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message || "The field must be Email";
        }
    }
}
Validator.isMinLength = function(selector, min, message) {
    return {
        selector: selector,
        test: function(value) {
            return value.trim().length >= min ? undefined : message || `Please enter at least ${min} characters`;
        }
    }
}
Validator.isConfirmed = function(selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function(value) {
            return value === getConfirmValue() ? undefined : message || "Input value doesn't match";
        }
    }
}
