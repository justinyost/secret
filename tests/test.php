<?php
require_once(getcwd() . '/form.php');

class SubmitFormTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->SubmitForm = new SubmitForm();
	}

	/**
	 *
	 * @dataProvider providerCallWithInvalidPostData
	 * @return [type] [description]
	 */
	public function testCallWithInvalidPostData($input) {
		$this->assertFalse($this->SubmitForm->call($input));
	}

	public function providerCallWithInvalidPostData() {
		return array(
			'Empty Array' => array(
				array(),
			),
			'Array without data key' => array(
				array(
					'something else' => array(),
				),
			),
			'Array without data Person key' => array(
				array(
					'data' => array(),
				),
			),
		);
	}
}
