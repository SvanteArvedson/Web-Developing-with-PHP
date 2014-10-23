(function($, window, document, undefined) {
	'use strict';	

	$("#allResults").show();
	$("#allResultsDiv").hide();
	
	$("#coursesResults").show();
	$("#coursesResultsDiv").hide();
	
	$("#allResults").click(function(event) {
		event.preventDefault();
		
		if ($(this).text() === "Öppna") {
			$(this).text("Stäng");
			$("#allResultsDiv").show();
		} else {
			$(this).text("Öppna");
			$("#allResultsDiv").hide();
		}
	});
	
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