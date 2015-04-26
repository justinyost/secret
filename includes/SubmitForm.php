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
	 * @param array $postData array of post data from the form
	 * @return bool
	 */
	public function call(array $postData = array()) {
		if (
			!is_array($postData)
			|| !array_key_exists('data', $postData)
			|| !is_array($postData['data'])
			|| !array_key_exists('Person', $postData['data'])
		) {
			return false;
		}

		$data = $postData['data'];
		$unshuffledPeople = $data['Person'];

		// Person should contain: name/email/wishlist
		foreach ($unshuffledPeople as &$person) {
			// sanitize the inputs
			$person['name'] = filter_var($person['name'], FILTER_SANITIZE_STRING);
			$person['email'] = filter_var($person['email'], FILTER_SANITIZE_EMAIL);
			$person['wishlist'] = filter_var($person['wishlist'], FILTER_SANITIZE_STRING);

			$ValidateFormElements = new ValidateFormElements();
			if (
				!$ValidateFormElements->validateName($person['name'])
				|| !$ValidateFormElements->validateEmail($person['email'])
			) {
				return false;
			}
		}

		$SendEmails = $this->returnSendEmailsInstance();
		$RandomizePeople = $this->returnRandomizePeopleInstance();

		$shuffledPeople = $unshuffledPeople;
		$shuffledPeople = $RandomizePeople->randomize($shuffledPeople, $unshuffledPeople);
		$result = $SendEmails->send($shuffledPeople, $unshuffledPeople, $data['Dollar']['value']);
		return $result;
	}

	/**
	 * return an instance of RandomizePeople
	 *
	 * @return object RandomizePeople instance
	 */
	protected function returnRandomizePeopleInstance() {
		return new RandomizePeople();
	}

	/**
	 * return an instance of SendEmails
	 *
	 * @return object SendEmails instance
	 */
	protected function returnSendEmailsInstance() {
		return new SendEmails();
	}
}
