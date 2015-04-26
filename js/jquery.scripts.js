function addAnotherPerson(){
	var formDiv = $("form");

	var numberOfPeople = formDiv.data("number-of-people");
	var newNumberOfPeople = (numberOfPeople + 1);

	var formString = newFormElementsString(newNumberOfPeople);

	formDiv.find("div#person" + numberOfPeople).after(formString);
	formDiv.data("number-of-people", newNumberOfPeople);
}

function newFormElementsString(numberOfPeople) {
	var formString = "<div id='person" + numberOfPeople + "'>";

	formString += "<div class='form-group'><label for='name" + numberOfPeople + "' class='col-sm-2 control-label'>Name</label><div class='col-sm-10'><input type='text' class='form-control' id='name" + numberOfPeople + "' name='data[Person][" + numberOfPeople + "][name]' placeholder='Enter name'></div></div>";

	formString += "<div class='form-group'><label for='email" + numberOfPeople + "' class='col-sm-2 control-label'>Email</label><div class='col-sm-10'><input type='email' class='form-control' id='email" + numberOfPeople + "' name='data[Person][" + numberOfPeople + "][email]' placeholder='Enter email'></div></div>";

	formString += "<div class='form-group'><label for='wishlist" + numberOfPeople + "' class='col-sm-2 control-label'>Wishlist</label><div class='col-sm-10'><input type='text' class='form-control' id='wishlist" + numberOfPeople + "'  name='data[Person][" + numberOfPeople + "][wishlist]' placeholder='Enter wishlist or other details'></div></div>";

	formString += "<hr/></div>";

	return formString;
}

function formFeedback(status) {
	if (status == 1) {
		$('.feedback').html("<div class='alert alert-success' id='_formFeedback' role='alert'>Every person was randomly assigned a Secret Santa.</div>");
	} else {
		$('.feedback').html("<div class='alert alert-warning' id='_formFeedback' role='alert'>Something failed and the emails did not go out. Please <a href="/">try again</a>.</div>");
	}

}

function formStarted() {
	$('.feedback').html("<div class='alert alert-info' id='_formStarted' role='alert'>Randomizing and Sending out the emails</div>");
}

function submitForm(form) {
	formStarted();
	$.post(
		form.attr('action'),
		form.serialize(),
		function(data, textStatus) {
			formFeedback(data);
		}
	);
}

jQuery(document).ready(function(){
	$('button._add_person').on('click', function() {
		addAnotherPerson();
	});

	$('form').on('submit', function(event){
		submitForm($(this));
		event.preventDefault();
	});
});
