<?php
require_once ( dirname(dirname(__FILE__)) . "/includes/SendEmails.php");

class SendEmailsPost extends PHPUnit_Framework_TestCase {

	/**
	 * setup the tests
	 *
	 * @return void
	 */
	public function setUp() {
		$this->SendEmails = new SendEmails();
	}

	/**
	 * test the send method
	 *
	 * @param  [type] $expectedOutput   [description]
	 * @param  [type] $shuffledPeople   [description]
	 * @param  [type] $unshuffledPeople [description]
	 * @param  [type] $giftValue        [description]
	 * @return void
	 * @dataProvider providerSendValid
	 */
	public function testSendValid($expectedOutput, $shuffledPeople, $unshuffledPeople, $giftValue) {

		// Create a stub for the SomeClass class.
		$SendEmails = $this->getMockBuilder('SendEmails')
			->setMethods(array('sendEmail'))
			->getMock();

		// Configure the stub.
		$SendEmails->expects($this->any())
			->method('sendEmail')
			->will($this->returnValue(true));
		$this->assertSame($expectedOutput, $SendEmails->send($shuffledPeople, $unshuffledPeople, $giftValue));
	}

	public function providerSendValid() {
		return array(
			'Test Send Method - Two People' => array(
				array(
					"Test Person 2 has been assigned to a random person.",
					"Test Person 1 has been assigned to a random person.",
				),
				array(
					array(
						'name' => 'Test Person 2',
						'email' => 'test2@testing.com',
						'wishlist' => null,
					),
					array(
						'name' => 'Test Person 1',
						'email' => 'test1@testing.com',
						'wishlist' => null,
					),
				),
				array(
					array(
						'name' => 'Test Person 1',
						'email' => 'test1@testing.com',
						'wishlist' => null,
					),
					array(
						'name' => 'Test Person 2',
						'email' => 'test2@testing.com',
						'wishlist' => null,
					),
				),
				"$25.00",
			),
		);
	}

	/**
	 * test the send method with a failed sending
	 *
	 * @param  array $shuffledPeople
	 * @param  array $unshuffledPeople
	 * @param  string $giftValue
	 * @return void
	 * @dataProvider providerSendFails
	 */
	public function testSendFails($shuffledPeople, $unshuffledPeople, $giftValue) {

		// Create a stub for the SomeClass class.
		$SendEmails = $this->getMockBuilder('SendEmails')
			->setMethods(array('sendEmail'))
			->getMock();

		// Configure the stub.
		$SendEmails->expects($this->any())
			->method('sendEmail')
			->will($this->throwException(new Exception));
		$this->assertFalse($SendEmails->send($shuffledPeople, $unshuffledPeople, $giftValue));
	}

	public function providerSendFails() {
		return array(
			'Test Send Method - Two People' => array(
				array(
					array(
						'name' => 'Test Person 2',
						'email' => 'test2@testing.com',
						'wishlist' => null,
					),
					array(
						'name' => 'Test Person 1',
						'email' => 'test1@testing.com',
						'wishlist' => null,
					),
				),
				array(
					array(
						'name' => 'Test Person 1',
						'email' => 'test1@testing.com',
						'wishlist' => null,
					),
					array(
						'name' => 'Test Person 2',
						'email' => 'test2@testing.com',
						'wishlist' => null,
					),
				),
				"$25.00",
			),
		);
	}

}
