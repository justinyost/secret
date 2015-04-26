<?php
require_once( dirname(__FILE__) . "/includes/SubmitForm.php");

if (isset($_POST) && !empty($_POST)) {
	$SubmitForm = new SubmitForm();
	if ($SubmitForm->call($_POST)) {
		echo true;
	} else {
		echo false;
	}
}
