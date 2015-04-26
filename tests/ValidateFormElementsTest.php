<?php
require_once( dirname(dirname(__FILE__)) . "/includes/ValidateFormElements.php");

class ValidateFormElementsTest extends PHPUnit_Framework_TestCase {

	/**
	 * setup the tests
	 *
	 * @return void
	 */
	public function setUp() {
		$this->ValidateFormElements = new ValidateFormElements();
	}

	/**
	 * test the validateName method
	 *
	 * @dataProvider providerValidateName
	 * @param  string $expectedOut [description]
	 * @param  bool $input       [description]
	 * @return void
	 */
	public function testValidateName($expectedOut, $input) {
		$this->assertSame($expectedOut, $this->ValidateFormElements->validateName($input));
	}

	public function providerValidateName() {
		return array(
			'Null Value' => array(
				false,
				null,
			),
			'Empty String' => array(
				false,
				"",
			),
			'Non Empty String' => array(
				true,
				"asdfasdf",
			),
		);
	}

	/**
	 * test the validateEmail method
	 *
	 * @dataProvider providerValidateEmail
	 * @param  string $expectedOut [description]
	 * @param  bool $input       [description]
	 * @return void
	 */
	public function testValidateEmail($expectedOut, $input) {
		$this->assertSame($expectedOut, $this->ValidateFormElements->validateEmail($input));
	}

	public function providerValidateEmail() {
		return array(
			'Null Value' => array(
				false,
				null,
			),
			'Empty String' => array(
				false,
				"",
			),
			'Int' => array(
				false,
				1,
			),
			'Non Safe String' => array(
				false,
				"<>",
			),
			'Non Empty String' => array(
				false,
				"asdfasdf",
			),
			'Fake Email' => array(
				true,
				"test@testing.com",
			),
		);
	}

}
