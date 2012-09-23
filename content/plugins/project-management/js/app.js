function pmaddpost(posttitle, postcontent, postcategory) {

	var postCatergoryArray = new Array();

	for (var i = 0; i < postcategory.length; i++) {
		if (postcategory[i].checked) {
			postCatergoryArray[postCatergoryArray.length] = postcategory[i].value;
		}
	}

	jQuery.ajax({

		type : 'POST',

		url : pmajax.ajaxurl,

		data : {
			action : 'pm_addpost',
			pmtitle : posttitle,
			pmcontents : postcontent,
			pmcategory : postCatergoryArray
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
		categories[i].checked = false;

}