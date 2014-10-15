(function($, window, document) {
	
	$("#teachers").multiSelect({
		selectableHeader: "<label>Samtliga lärare</label>",
		selectionHeader: "<label>Valda lärare</label>"
	});
	
	$("#students").multiSelect({
		selectableHeader: "<label>Samtliga studenter</label>",
		selectionHeader: "<label>Valda studenter</label>"
	});	   
	
}(jQuery, window, window.document));
