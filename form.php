<?php
require_once( dirname(__FILE__) . "/inclues/SubmitForm.php");

if (isset($_POST) && !empty($_POST)) {
	$SubmitForm = new SubmitForm();
	$SubmitForm->call($_POST);
}
