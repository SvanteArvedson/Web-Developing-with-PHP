(function($, window, document, undefined) {
	'use strict';	

	$("#coursesResults").show();
	$("#coursesResultsDiv").show();
	
	$("#coursesResults").click(function(event) {
		event.preventDefault();
		
		if ($(this).text() === "Öppna") {
			$(this).text("Stäng");
			$("#coursesResultsDiv").show();
		} else {
			$(this).text("Öppna");
			$("#coursesResultsDiv").hide();
		}
	});
	
}(jQuery, window, window.document));