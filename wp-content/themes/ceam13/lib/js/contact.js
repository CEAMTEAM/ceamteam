jQuery(function ($) {
	var submitURL = '/wp-content/themes/saintchicago1/submit.php';
	var errorMsg = $('#response');
	var contactForm = $('#contactForm');

	$('#submit').on('click',function(){
		var button = $(this);

		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var emailFrom = $('#emailFrom').val();
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		//var urlFrom = $('#urlFrom').val();
		var phoneFrom = $('#phoneFrom').val();
		var comment	= $('#comment').val();
		//var emailRoute = $('#mailbox input:radio:checked').val();
		var honeypot = $('#jerkNet').val();
		var hasError = false;

		// We use the working class not only for styling the submit button,
		// but also as kind of a "lock" to prevent multiple submissions.

		if(firstname.length < 1 ){
			errorMsg.html('<h2>Please enter your First Name :)</h2>');
			hasError = true;
		} else

		if (lastname.length < 1 ){
			errorMsg.html('<h2>Please enter your Last Name :)</h2>');
			hasError = true;
		} else

		if (!emailReg.test(emailFrom) || emailFrom.length === 0){
			errorMsg.html('<h2>Please enter a correct E-mail address :)</h2>');
			hasError = true;
		} else

		if (comment.length < 5 ){
			errorMsg.html('<h2>Please enter a comment :)</h2>');
			hasError = true;
		} else
		/*
		if (! $('#mailbox input').is(':checked')){
			errorMsg.html('<h2>You must select a mailbox :)</h2>');
			hasError = true;
		} else
		*/
		if (honeypot.length != 0){
			hasError = true;

		}

		if (!hasError) {
			// Locking the form and changing the button style:
			button.addClass('working');

			$.ajax({
				url		: submitURL,
				type	: 'post',
				data	: { firstname : firstname,
							lastname  : lastname,
							emailFrom : emailFrom,
							//urlFrom   : urlFrom,
							phoneFrom : phoneFrom,
							comment	  : comment
							//emailRoute: emailRoute
						},
				complete	: function (xhr){

					var text = xhr.responseText;

					// This will help users troubleshoot their form:
					if (xhr.status === 404){
						text = 'Your path to submit.php is incorrect.';
					}

					// Hiding the button and the textarea, after which
					// we are showing the received response from submit.php

					button.fadeOut();

					$('fieldset').fadeOut(function(){
						contactForm.html('<h2 class="em2 pad1to1sm"><span class=bold>' + firstname + ',</span><br/> Your message has been sent. <br/> Thank\'s for the message! <br/>I will respond shortly :)</h2>');
					});
				}
			});
		}
		return false;
	});


    $('textarea').expandable();
	$('label.inField').inFieldLabels();
});