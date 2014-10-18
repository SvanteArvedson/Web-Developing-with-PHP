(function($, window, document) {
	
	$("#courseTeachers").multiSelect({
		selectableHeader: "<label>Samtliga lärare</label>",
		selectionHeader: "<label>Kurslärare</label>",
		afterSelect: function() { 
			$("#changeTeachers").val("true");
			$("#editCourseSubmit").prop('disabled', false);
		},
		afterDeselect: function() { 
			$("#changeTeachers").val("true");
			$("#editCourseSubmit").prop('disabled', false); 
		}
	});
	
	$("#courseStudents").multiSelect({
		selectableHeader: "<label>Samtliga studenter</label>",
		selectionHeader: "<label>Kursdeltagare</label>",
		afterSelect: function() { 
			$("#changeStudents").val("true");
			$("#editCourseSubmit").prop('disabled', false);
		},
		afterDeselect: function() { 
			$("#changeStudents").val("true"); 
			$("#editCourseSubmit").prop('disabled', false);
		}
	});
	
	$("#courseName").change(function(event) {
		$("#changeInfo").val("true");
		$("#editCourseSubmit").prop('disabled', false);
	});
	
	$("#courseDescription").change(function(event) {
		$("#changeInfo").val("true");
		$("#editCourseSubmit").prop('disabled', false);
	});
	
}(jQuery, window, window.document));
