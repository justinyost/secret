<?php

class SendEmails {

}

class RandomizePeople {

}

class SubmitForm {

	public function call($postData) {
		$people = ($postData['data']) ? $postData['data'] : null;

		// Person should contain: name/email/wishlist
		foreach($people['Person'] as $person) {
			var_dump($person);
		}
	}
}


$SubmitForm = new SubmitForm();
$SubmitForm->call($_POST);
