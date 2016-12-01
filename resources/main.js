function submitContactInfo() {
	if (validateContactInfo()) {
		var contactInfo = $('#update-contact-info-form').serialize();
		console.log('contactInfo: ', contactInfo);

		$.post('php/updateContactInfo.php', contactInfo, function (data) {
			alert(data);
		});
	}
}

function validateContactInfo() {
	var contactInfo = $('#update-contact-info-form').serializeArray();
	console.log('contactInfo: ', contactInfo);
	
	var email = contactInfo.find(function (serial) { return serial.name == 'updateEmail' }).value	
	var resHall = contactInfo.find(function (serial) { return serial.name == 'updateResHall' }).value;
	var room = contactInfo.find(function (serial) { return serial.name == 'updateRoom' }).value;
	
	if (!email || validateEmail(email)) {
		return true;
	}
	else {
		alert('Please enter a valid email address.');
		$('[name="updateEmail"]').focus();
	}
	
	return false;
}

function validateEmail(email) {
  var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
	return re.test(email);
}

function filterTicketsByHall(hall) {
	// TODO filter tickets by hall
	
	$('.res-hall-filter').text(hall)
		.append(' <span class="caret"></span>');
}

function submitNewTicket() {
	// TODO limit number of characters
	var newTicketSummary = $('#new-ticket-summary').val();
	
	if (!newTicketSummary) {
		alert('Please enter a summary of your issue.');
		$('#new-ticket-summary').focus();
	}
	else {
		$.post('php/createNewTicket.php', 'summary=' + newTicketSummary, function (data) {
			alert(data);
		});
	}
}