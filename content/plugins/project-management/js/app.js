jQuery(document).ready(function($) {
	$('#new_post').validate({
	    errorClass:'error',
	    validClass:'success',
	    errorElement:'span',
	    highlight: function (element, errorClass, validClass) { 
	        $(element).parents("div[class='clearfix']").addClass(errorClass).removeClass(validClass); 
	    }, 
	    unhighlight: function (element, errorClass, validClass) { 
	        $(element).parents(".error").removeClass(errorClass).addClass(validClass); 
	    }
	});
});