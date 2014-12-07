<?php
require_once ( dirname(__FILE__) . "/ValidateFormElements.php");
require_once ( dirname(__FILE__) . "/RandomizePeople.php");
require_once ( dirname(__FILE__) . "/SendEmails.php");

/**
 * SubmitForm
 *
 * Submit and process the form
 */
class SubmitForm {

	/**
	 * calls the necessary logic to process the form, randomize the people and send
	 * the emails
	 *
	 * @param  array  $postData array of post data from the form
	 * @return bool
	 */
	public function call(array $postData = array()) {
		if (
			!is_array($postData)
			|| !array_key_exists('data', $postData)
		) {
			return false;
		}

		$data = ($postData['data']) ? $postData['data'] : null;

		if (
			!is_array($data)
			|| !array_key_exists('Person', $data)
		) {
			return false;
		}

		$unshuffledPeople = $data['Person'];

		// Person should contain: name/email/wishlist
		foreach($unshuffledPeople as &$person) {
			// sanitize the inputs
			$person['name'] = filter_var($person['name'], FILTER_SANITIZE_STRING);
			$person['email'] = filter_var($person['email'], FILTER_SANITIZE_EMAIL);
			$person['wishlist'] = filter_var($person['wishlist'], FILTER_SANITIZE_STRING);

			$ValidateFormElements = new ValidateFormElements();
			if (
				!$ValidateFormElements->validateName($person['name'])
				|| !$ValidateFormElements->validateEmail($person['email'])
				|| !$ValidateFormElements->validateWishlist($person['wishlist'])
			) {
				return false;
			}
		}

		$shuffledPeople = $unshuffledPeople;
		$RandomizePeople = new RandomizePeople();
		$shuffledPeople = $RandomizePeople->randomize($shuffledPeople, $unshuffledPeople);

		$SendEmails = new SendEmails();
		return $SendEmails->send($shuffledPeople, $unshuffledPeople);
	}
}
