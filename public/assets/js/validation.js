$(document).ready(function(){

    $("#loginform").validate({
        errorClass:'text-danger',
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:4
            }
        },
        messages:{
            email:{
                required:"Enter your email",
                email:"Enter valid mail id"
            },
            password:{
                required:"Enter your password"
            }
        }
    });

    $("#masterSettings").validate({
        errorClass:'text-danger',
        rules:{
            default_email:{
                required:true,
                email:true
            },
            default_name:{
                required:true,
                minlength:4
            },
            default_phone:{
                required:true,
                maxlength:10,
                digits:true
            }
        },
        messages:{
            default_email:{
                required:"Enter your email",
                email:"Please enter a valid email address"
            },
            default_name:{
                required:"Enter application name"
            },
            default_phone:{
                required:"Enter phone number",
                digits:"Please enter in numeric"
            }
        }
    });

    $("#createCustomerForm").validate({
        errorClass:'text-danger',
        rules:{
            name:{
                required:true,
                minlength:4
            },
            phone:{
                required:true,
                maxlength:10,
                digits:true
                
            },
            email:{
                email:true
            },
            tax_number:{
                maxlength:15
            }
        },
        messages:{
            email:{
                email:"Please enter a valid email address"
            },
            name:{
                required:"Enter application name"
            },
            phone:{
                required:"Enter phone number",
                digits:"Please enter in numeric"
            }
        }
    });

    $("#updateCustomerForm").validate({
        errorClass:'text-danger',
        rules:{
            up_name:{
                required:true,
                minlength:4
            },
            up_phone:{
                required:true,
                maxlength:10,
                digits:true
                
            },
            up_email:{
                email:true
            },
            up_tax_number:{
                maxlength:15
            }
        },
        messages:{
            up_email:{
                email:"Please enter a valid email address"
            },
            up_name:{
                required:"Enter application name"
            },
            up_phone:{
                required:"Enter phone number",
                digits:"Please enter in numeric"
            }

        }
    });

    //expense category create form
    $("#createCategoryForm").validate({
        errorClass:'text-danger',
        rules:{
            category_name:{
                required:true,
                minlength:4
            },
            category_type:{
                required:true
            }
        },
        messages:{
            category_name:{
                required:"Enter category name"
            },
            category_type:{
                required:"Please select category type"
            }
        }
    });

        //expense category update form
    $("#updateCategoryForm").validate({
        errorClass:'text-danger',
        rules:{
            up_category_name:{
                required:true,
                minlength:4
            },
            up_category_type:{
                required:true
            }
        },
        messages:{
            up_category_name:{
                required:"Enter category name"
            },
            up_category_type:{
                required:"Please select category type"
            }
        }
    });

    $("#cExpenseListForm").validate({
        errorClass:'text-danger',
        rules:{
            date:{
                required:true,
                date:true
            },
            categorylist:{
                required:true,
            },
            amount:{
                required:true,
                number:true
            }
        },
        messages:{
            date:{
                required:"Date field missing !",
                date:"Please select a valid date"
            },
            categorylist:{
                required:"Category type missing !",
            },
            amount:{
                required:"Expense amount field missing !",
                number:"Please enter valid amount"
            }
        }
    });

    $("#upExpenseListForm").validate({
        errorClass:'text-danger',
        rules:{
            edit_date:{
                required:true,
                date:true
            },
            edit_categorylist:{
                required:true,
            },
            edit_amount:{
                required:true,
                number:true
            }
        },
        messages:{
            edit_date:{
                required:"Date field missing !",
                date:"Please select a valid date"
            },
            edit_categorylist:{
                required:"Category type missing !",
            },
            edit_amount:{
                required:"Expense amount field missing !",
                number:"Please enter valid amount"
            }
        }
    });

});