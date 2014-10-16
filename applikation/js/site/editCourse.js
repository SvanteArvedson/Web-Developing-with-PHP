(function($, window, document) {
	
	$("#courseTeachers").multiSelect({
		selectableHeader: "<label>Samtliga lärare</label>",
		selectionHeader: "<label>Kurslärare</label>",
		afterSelect: function() { $("#changeTeachers").val("true"); },
		afterDeselect: function() { $("#changeTeachers").val("true"); }
	});
	
	$("#courseStudents").multiSelect({
		selectableHeader: "<label>Samtliga studenter</label>",
		selectionHeader: "<label>Kursdeltagare</label>",
		afterSelect: function() { $("#changeStudents").val("true"); },
		afterDeselect: function() { $("#changeStudents").val("true"); }
	});
	
	$("#courseName").change(function(event) {
		$("#changeInfo").val("true");
	});
	
	$("#courseDescription").change(function(event) {
		$("#changeInfo").val("true");
	});
	
}(jQuery, window, window.document));
