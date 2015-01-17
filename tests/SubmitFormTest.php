<?php
require_once ( dirname(dirname(__FILE__)) . "/includes/SubmitForm.php");

/**
 * Class TestSubmitForm
 *
 */
class TestSubmitForm extends SubmitForm {
	public function returnRandomizePeopleInstance() {
		return parent::returnRandomizePeopleInstance();
	}

	public function returnSendEmailsInstance() {
		return parent::returnSendEmailsInstance();
	}
}

/**
 *
 */
class SubmitFormTest extends PHPUnit_Framework_TestCase {

	/**
	 * setup the tests
	 *
	 * @return void
	 */
	public function setUp() {
		$this->SubmitForm = new TestSubmitForm();
	}

	public function testReturnRandomizePeopleInstance() {
		$this->assertInstanceOf('RandomizePeople', $this->SubmitForm->returnRandomizePeopleInstance());
	}

	public function testReturnSendEmailsInstance() {
		$this->assertInstanceOf('SendEmails', $this->SubmitForm->returnSendEmailsInstance());
	}

	/**
	 * test call with invalid post data
	 *
	 * @param  boolean $expectedOutput expected output of the method
	 * @param  array   $input          the sample input to the call method
	 * @return void
	 * @dataProvider providerCallWithInvalidPostData
	 */
	public function testCallWithInvalidPostData($expectedOutput, $input) {
		$this->assertSame($expectedOutput, $this->SubmitForm->call($input));
	}

	/**
	 * dataProvider for testCallWithInvalidPostData
	 *
	 * @return array data inputs to testCallWithInvalidPostData
	 */
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

	/**
	 * test call with valid post data
	 *
	 * @param  [type] $expectedOutput   [description]
	 * @param  [type] $sendEmailsResult [description]
	 * @param  [type] $randomizeResult  [description]
	 * @param  [type] $input            [description]
	 * @return [type]                   [description]
	 * @dataProvider providerCallWithValidPostData
	 */
	public function testCallWithValidPostData($expectedOutput, $sendEmailsResult, $randomizeResult, $input) {

		// Mock the SendEmails Class Instance
		$SendEmails = $this->getMockBuilder('SendEmails')
			->setMethods(array('send'))
			->getMock();
		$SendEmails->expects($this->once())
			->method('send')
			->will($this->returnValue($sendEmailsResult));

		// Mock the RandomizePeople Class Instance
		$RandomizePeople = $this->getMockBuilder('RandomizePeople')
			->setMethods(array('randomize'))
			->getMock();
		$RandomizePeople->expects($this->once())
			->method('randomize')
			->will($this->returnValue($randomizeResult));

		// Mock the builders for the RandomizePeople and SendEmail classes
		$SubmitForm = $this->getMockBuilder('SubmitForm')
			->setMethods(array('returnRandomizePeopleInstance', 'returnSendEmailsInstance'))
			->getMock();

		$SubmitForm->expects($this->once())
			->method('returnRandomizePeopleInstance')
			->will($this->returnValue($RandomizePeople));
		$SubmitForm->expects($this->once())
			->method('returnSendEmailsInstance')
			->will($this->returnValue($SendEmails));

		$this->assertSame($expectedOutput, $SubmitForm->call($input));
	}

	/**
	 * dataProvider for testCallWithValidPostData
	 *
	 * @return array data inputs to testCallWithValidPostData
	 */
	public function providerCallWithValidPostData() {
		return array(

			'2 People, True sendEmails Result' => array(
				true,
				true,
				array(
					array(
						'name' => 'Testing Second Name',
						'email' => 'testing2@localhost.com',
						'wishlist' => '',
					),
					array(
						'name' => 'Test Name',
						'email' => 'testing1@localhost.com',
						'wishlist' => '',
					),
				),
				array(
					'data' => array(
						'Dollar' => array(
							'value' => "$25.00",
						),
						'Person' => array(
							0 => array(
								'name' => 'Test Name',
								'email' => 'testing1@localhost.com',
								'wishlist' => '',
							),
							1 => array(
								'name' => 'Testing Second Name',
								'email' => 'testing2@localhost.com',
								'wishlist' => '',
							),
						),
					),
				),
			),

			'2 People, False sendEmails Result' => array(
				false,
				false,
				array(
					array(
						'name' => 'Testing Second Name',
						'email' => 'testing2@localhost.com',
						'wishlist' => '',
					),
					array(
						'name' => 'Test Name',
						'email' => 'testing1@localhost.com',
						'wishlist' => '',
					),
				),
				array(
					'data' => array(
						'Dollar' => array(
							'value' => "$25.00",
						),
						'Person' => array(
							0 => array(
								'name' => 'Test Name',
								'email' => 'testing1@localhost.com',
								'wishlist' => '',
							),
							1 => array(
								'name' => 'Testing Second Name',
								'email' => 'testing2@localhost.com',
								'wishlist' => '',
							),
						),
					),
				),
			),

		);
	}

}
