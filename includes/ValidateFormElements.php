<?php
/**
 * ValidateFormElements
 *
 * Validate form elements as passing certain rules
 */
class ValidateFormElements {

	public function validateName($name = null) {
		$name = filter_var($name, FILTER_SANITIZE_STRING);

		if (!$this->validateStringNotNull($name)) {
			return false;
		}

		if(is_string($name)) {
			return true;
		}
		return false;
	}

	public function validateEmail($email = null) {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		if (!$this->validateStringNotNull($email)) {
			return false;
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}

		return false;
	}

	public function validateWishlist($wishlist = null) {
		$wishlist = filter_var($wishlist, FILTER_SANITIZE_STRING);

		return true;
	}

	protected function validateStringNotNull($string) {
		if (is_null($string)) {
			return false;
		}

		if (empty($string)) {
			return false;
		}

		return true;
	}
}
