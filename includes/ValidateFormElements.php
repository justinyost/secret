<?php
/**
 * ValidateFormElements
 *
 * Validate form elements as passing certain rules
 */
class ValidateFormElements {

	/**
	 * validate a name value, ensures is a string and not null
	 *
	 * @param  string $name a name to validate
	 * @return bool
	 */
	public function validateName($name = null) {
		if (!$this->validateStringNotNull($name)) {
			return false;
		}

		if(is_string($name)) {
			return true;
		}
		return false;
	}

	/**
	 * validate a email value, ensures is a string and not null and passes as a
	 * valid email
	 *
	 * @param  string $email a email to validate
	 * @return bool
	 */
	public function validateEmail($email = null) {
		if (!$this->validateStringNotNull($email)) {
			return false;
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}

		return false;
	}

	/**
	 * validate a wishlist value, merely returns true
	 *
	 * @param  string $wishlist a wishlist to validate
	 * @return bool
	 */
	public function validateWishlist($wishlist = null) {
		return true;
	}

	/**
	 * validate a string value as not null or empty
	 *
	 * @param  string $string a string to validate
	 * @return bool
	 */
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
