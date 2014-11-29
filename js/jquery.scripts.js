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

	formString += "<div class='form-group'><label for='name" + numberOfPeople + "' class='col-sm-2 control-label'>Name</label><div class='col-sm-10'><input type='text' class='form-control' id='name" + numberOfPeople + "' placeholder='Enter name'></div></div>";

	formString += "<div class='form-group'><label for='email" + numberOfPeople + "' class='col-sm-2 control-label'>Email</label><div class='col-sm-10'><input type='email' class='form-control' id='email" + numberOfPeople + "' placeholder='Enter email'></div></div>";

	formString += "<div class='form-group'><label for='wishlist" + numberOfPeople + "' class='col-sm-2 control-label'>Wishlist</label><div class='col-sm-10'><input type='text' class='form-control' id='wishlist" + numberOfPeople + "' placeholder='Enter wishlist or other details'></div></div>";

	formString += "<hr/></div>";

	return formString;
}

jQuery(document).ready(function(){
	$('button._add_person').on('click', function() {
		addAnotherPerson();
	});
});
