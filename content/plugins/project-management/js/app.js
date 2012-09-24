function pmaddpost(posttitle, postcontent, postcategory, postassignto) {

	var postCatergoryArray = [];

	for (var i = 0; i < postcategory.length; i++) {
		if (postcategory[i].selected) {
			postCatergoryArray[postCatergoryArray.length] = postcategory[i].value;
		}
	}

	var postAssignToArray = [];

	for (var i = 0; i < pmassignto.length; i++) {
		if (postassignto[i].selected) {
			postAssignToArray[postAssignToArray.length] = postassignto[i].value;
		}
	}
		
	jQuery.ajax({

		type : 'POST',

		url : pmajax.ajaxurl,

		data : {
			action : 'pm_addpost',
			pmtitle : posttitle,
			pmcontents : postcontent,
			pmcategory : postCatergoryArray,
			pmassignto : postAssignToArray
		},

		success : function(data, textStatus, XMLHttpRequest) {
			var id = '#pm-response';
			jQuery(id).html('');
			jQuery(id).append(data);

			resetvalues();
		},

		error : function(MLHttpRequest, textStatus, errorThrown) {
			alert(errorThrown);
		}
	});
}

function resetvalues() {

	var title = document.getElementById("pmtitle");
	title.value = '';

	var content = document.getElementById("pmcontents");
	content.value = '';

	var categories = document.forms['pmform'].elements['pmcategorycheck'];

	var countCheckBoxes = categories.length;
	for (var i = 0; i < countCheckBoxes; i++)
		categories[i].selected = false;
		
	var users = document.forms['pmform'].elements['pmassigntocheck'];

	var countCheckBoxes = users.length;
	for (var i = 0; i < countCheckBoxes; i++)
		users[i].selected = false;
	
}