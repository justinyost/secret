function addAnotherPerson(){
	var formDiv = $("#form");
	
	var number_ppl = formDiv.find("#number_ppl").val();
	number_ppl++;
	
	formDiv.find("#number_ppl").val(number_ppl);
	
	var addedString = null;
	addedString = "<p><label for='name_" + number_ppl + "'>Name:</label><br/><input type='text' maxlength='255' value='' name='name_" + number_ppl + "' class='formNames span-5' tabIndex='" + (number_ppl * 2) +"'></input></p>";
	formDiv.find("#formName").append(addedString);
	
	addedString = null;
	
	addedString = "<p><label for='email_" + number_ppl + "'>Email:</label><br/><input type='email' maxlength='255' value='' name='email_" + number_ppl + "'  class='formEmails span-5' tabIndex='" + (number_ppl * 2) +"'></input></p>";
	formDiv.find("#formEmail").append(addedString);
	
	addedString = null;
	addedString = "<p><label for='other_" + number_ppl + "'>Other Information:</label><br/><textarea value='' name='other_" + number_ppl + "'  class='formOther' rows='3' cols='30' tabIndex='" + ((number_ppl * 2) + 1) +"'></textarea></p>";
	formDiv.find("#formOther").append(addedString);
}

function submitSendEmails(){
	var formDiv = $("#form");
	formDiv
		.toggleClass("hidden", true)
		.find("#submit").toggleClass("hidden", true);
	$("#onSubmit").toggleClass("hidden", false);
	formDiv.toggleClass("hidden", true);
	
	var names=new Array();
	formDiv.find(".formNames").each(function(i) { names[i] = $(this).val(); });
	
	var emails=new Array();
	formDiv.find(".formEmails").each(function(i) { emails[i] = $(this).val(); });
	
	var others=new Array();
	formDiv.find(".formOther").each(function(i) { others[i] = $(this).val(); });
	
	$.post(formDiv.find("#script").val(), {
			rand_key: formDiv.find("#rand_key").val(),
			form_key: formDiv.find("#form_key").val(),
			number_ppl: formDiv.find("#number_ppl").val(),
			'names[]': names,
			'emails[]': emails,
			'others[]': others,
			gift_value: formDiv.find("#gift_value").val(),
		},
		function(data){
  			$("#results").html(data).toggleClass("hidden", false);
  			formDiv
  				.toggleClass("hidden", true)
  				.find("#submit").toggleClass("hidden", false);
  			$("#onSubmit").toggleClass("hidden", true);
		}
	);
}

function displayForm(){
	var formDiv = $("div#form");
	
	formDiv
		.toggleClass("hidden", false)
		.find(":submit").toggleClass("hidden", false);
	
	$("div#results").toggleClass("hidden", true);
	$("div#onSubmit").toggleClass("hidden", true);
}

$(document).ready(function(){
	$('#addAnotherPerson').live('click', function(){
		addAnotherPerson();
	});
	
	$('#form form').live('submit', function(){
		submitSendEmails();
		return false;
	});
});