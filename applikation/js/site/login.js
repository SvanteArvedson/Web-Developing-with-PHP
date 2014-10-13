(function($, window, document, undefined) {
	'use strict';	

	$("#loginform").submit(function(event) {
		
		if ($("#username").val() === "") {
			displayErrorMessage("Användarnamn saknas");
		} else if ($("#password").val() === "") {
			displayErrorMessage("Lösenord saknas");
		} else {
			return;
		}
		
		$("#username").focus();
		$("#password").val("");
		event.preventDefault();
	});
	
	$(":text").focus(function(event) {
		$(this).select();
	});

	function displayErrorMessage(message) {
		if ($("#errorMessage").length) {
			var alertBox = $("#errorMessage");
			alertBox.html("<p class='error-message'>" + message + "</p><a href='#'aria-label='Stäng' class='close'>&times;</a>");
		} else {
			var HTML = "<div data-alert id='errorMessage' class='alert-box alert radius'><p class='error-message'>" + message + "</p><a href='#'aria-label='Stäng' class='close'>&times;</a></div>";
			var alertBox = $(HTML);
		}
		
		alertBox.find(".close").click( function(event) {
			event.preventDefault();
			
			if (Modernizr.csstransitions) {
				alertBox.addClass("alert-close");
				alertBox.on('transitionend webkitTransitionEnd oTransitionEnd', function() {
            		alertBox.remove();
           		});
			} else {
				alertBox.fadeOut(300, function() {
					alertBox.remove();
				});
			}
		});
		
		$("#loginform").prepend(alertBox);
	}
	
	// focus on field "username" when page loads
	$("#username").focus();
	
}(jQuery, window, window.document));