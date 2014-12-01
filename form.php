<?php

class SendEmails {

}

class RandomizePeople {

}

class SubmitForm {

	/**
	 * calls the necessary logic to process the form, randomize the people and send
	 * the emails
	 *
	 * @param  array  $postData array of post data from the form
	 * @return boolean
	 */
	public function call(array $postData = array()) {
		if (
			!is_array($postData)
			|| !array_key_exists('data', $postData)
		) {
			return false;
		}

		$people = ($postData['data']) ? $postData['data'] : null;

		if (
			!is_array($people)
			|| !array_key_exists('Person', $people)
		) {
			return false;
		}

		// Person should contain: name/email/wishlist
		foreach($people['Person'] as $person) {

		}
	}
}

if (isset($_POST) && !empty($_POST)) {
	$SubmitForm = new SubmitForm();
	$SubmitForm->call($_POST);
}
