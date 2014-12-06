<?php
require_once ( dirname(dirname(__FILE__)) . "/includes/SubmitForm.php");

class SubmitFormTest extends PHPUnit_Framework_TestCase {

	/**
	 * [setUp description]
	 */
	public function setUp() {
		$this->SubmitForm = new SubmitForm();
	}

	/**
	 * [testCallWithInvalidPostData description]
	 *
	 * @dataProvider providerCallWithInvalidPostData
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	public function testCallWithInvalidPostData($expectedOutput, $input) {
		$this->assertSame($expectedOutput, $this->SubmitForm->call($input));
	}

	public function providerCallWithInvalidPostData() {
		return array(
			'Empty Array' => array(
				false,
				array(),
			),
			'Array without data key' => array(
				false,
				array(
					'something else' => array(),
				),
			),
			'Array without data Person key' => array(
				false,
				array(
					'data' => array(),
				),
			),
			'Single Person with Invalid Name' => array(
				false,
				array(
					'data' => array(
						'Person' => array(
							0 => array(
								'name' => '',
								'email' => 'testing@test.com',
								'wishlist' => '',
							),
						),
					),
				),
			),

			'Single Person with Invalid Email' => array(
				false,
				array(
					'data' => array(
						'Person' => array(
							0 => array(
								'name' => '',
								'email' => 'notanemailaddress',
								'wishlist' => '',
							),
						),
					),
				),
			),

			'Multiple People, 2nd with Invalid Name' => array(
				false,
				array(
					'data' => array(
						'Person' => array(
							0 => array(
								'name' => 'Test Name',
								'email' => 'testing@test.com',
								'wishlist' => '',
							),
							1 => array(
								'name' => '',
								'email' => 'testing@test.com',
								'wishlist' => '',
							),
						),
					),
				),
			),

			'Multiple People, 2nd with Invalid Email' => array(
				false,
				array(
					'data' => array(
						'Person' => array(
							0 => array(
								'name' => 'Test Name',
								'email' => 'testing@test.com',
								'wishlist' => '',
							),
							1 => array(
								'name' => '',
								'email' => 'notanemailaddress',
								'wishlist' => '',
							),
						),
					),
				),
			),
		);
	}
}
