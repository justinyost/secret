/* Copyright (c) 2009 Justin Yost
 * MIT Lincese (see copyright.txt)
 */
 
var number_ppl = null;
var addedString = null;
var names = null;
var i = 0;
var names=new Array();
var emails=new Array();

function addAnotherPerson(){
	number_ppl = $("div#form :input#number_ppl").val();
	number_ppl++;
	$("div#form :input#number_ppl").val(number_ppl);
	
	addedString = "<p><label for='name_" + number_ppl + "'>Name:</label><br/><input type='text' maxlength='255' value='' name='name_" + number_ppl + "' class='formNames'></input></p>";
	$("div#form div#formName").append(addedString);
	addedString = "<p><label for='email_" + number_ppl + "'>Email:</label><br/><input type='text' maxlength='255' value='' name='email_" + number_ppl + "'  class='formEmails'></input></p>";
	$("div#form div#formEmail").append(addedString);
	
}

function submitSendEmails(){
	$("div#form :submit").toggleClass("hidden", true);
	$("div#onSubmit").toggleClass("hidden", false);
	$("div#form").toggleClass("hidden", true);
	
	$("div#form :input.formNames").each(function(i) { names[i] = $(this).val(); });
	
	$("div#form :input.formEmails").each(function(i) { emails[i] = $(this).val(); });
	
	$.get($("div#form :input#script").val(), {
			rand_key: $("div#form :input#rand_key").val(),
			form_key: $("div#form :input#form_key").val(),
			number_ppl: $("div#form :input#number_ppl").val(),
			'names[]': names,
			'emails[]': emails,
			gift_value: $("div#form :input#gift_value").val(),
		},
		function(data){
  			$("div#results").html(data);
  			$("div#results").toggleClass("hidden", false);
  			$("div#form :submit").toggleClass("hidden", false);
  			$("div#form").toggleClass("hidden", true);
  			$("div#onSubmit").toggleClass("hidden", true);
		}
	);
}

function displayForm(){
	$("div#form").toggleClass("hidden", false);
	$("div#form :submit").toggleClass("hidden", false);
	$("div#results").toggleClass("hidden", true);
	$("div#onSubmit").toggleClass("hidden", true);
}