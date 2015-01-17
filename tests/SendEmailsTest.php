<?php
require_once ( dirname(dirname(__FILE__)) . "/includes/SendEmails.php");

/**
 * Class TestSendEmails
 *
 * Class that extends SendEmails to expose protected methods
 */
class TestSendEmails extends SendEmails {
	public function returnPHPMailerInstance() {
		return parent::returnPHPMailerInstance();
	}
}

/**
 * Class SendEmailsTest
 *
 * Class that Tests the SendEmails Class
 */
class SendEmailsTest extends PHPUnit_Framework_TestCase {

	/**
	 * setup the tests
	 *
	 * @return void
	 */
	public function setUp() {
		$this->SendEmails = new TestSendEmails();
	}

	/**
	 * test the returnPHPMailerInstance method
	 *
	 * @return void
	 */
	public function testReturnPHPMailerInstance() {
		$this->assertInstanceOf('PHPMailer', $this->SendEmails->returnPHPMailerInstance());
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

	/**
	 * test the sendEmail method, with valid data
	 *
	 * @param boolean $expectedOutput   the expected result
	 * @param array   $person           the shuffled person, the email is going out about them
	 * @param int     $key              the key to identify in the array of unshuffled people
	 * @param array   $unshuffledPeople the array of unshuffled people
	 * @param string  $giftValue        the value of the gift to send
	 * @return void
	 * @dataProvider providerValidSendEmail
	 */
	public function testValidSendEmail($expectedOutput, $person, $key, $unshuffledPeople, $giftValue) {

		// Mock the SendEmails Class Instance
		$PHPMailer = $this->getMockBuilder('PHPMailer')
			->setMethods(array('Send'))
			->getMock();
		$PHPMailer->expects($this->once())
			->method('Send')
			->will($this->returnValue(true));

		// Mock the builders for the RandomizePeople and SendEmail classes
		$SendEmails = $this->getMockBuilder('SendEmails')
			->setMethods(array('returnPHPMailerInstance'))
			->getMock();

		$SendEmails->expects($this->once())
			->method('returnPHPMailerInstance')
			->will($this->returnValue($PHPMailer));

		$this->assertNull($SendEmails->sendEmail($person, $key, $unshuffledPeople, $giftValue));
	}

	/**
	 * dataProvider for testValidSendEmail
	 * @return array data inputs for testValidSendEmail
	 */
	public function providerValidSendEmail() {
		return array(
			'Test Send Email, True Result' => array(
				null,
				array(
					'name' => 'Test Person 2',
					'email' => 'test2@testing.com',
					'wishlist' => null,
				),
				1,
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
			'Test Send Email, True Result, Wishlist Information' => array(
				null,
				array(
					'name' => 'Test Person 2',
					'email' => 'test2@testing.com',
					'wishlist' => 'something',
				),
				1,
				array(
					array(
						'name' => 'Test Person 1',
						'email' => 'test1@testing.com',
						'wishlist' => 'something',
					),
					array(
						'name' => 'Test Person 2',
						'email' => 'test2@testing.com',
						'wishlist' => 'something',
					),
				),
				"$25.00",
			),
		);
	}

	/**
	 * test the sendEmail method, with invalid data
	 *
	 * @param boolean $expectedOutput   the expected result
	 * @param array   $person           the shuffled person, the email is going out about them
	 * @param int     $key              the key to identify in the array of unshuffled people
	 * @param array   $unshuffledPeople the array of unshuffled people
	 * @param string  $giftValue        the value of the gift to send
	 * @return void
	 * @dataProvider providerInvalidSendEmail
	 */
	public function testInvalidSendEmail($expectedOutput, $person, $key, $unshuffledPeople, $giftValue) {

		// Mock the SendEmails Class Instance
		$PHPMailer = $this->getMockBuilder('PHPMailer')
			->setMethods(array('Send'))
			->getMock();
		$PHPMailer->expects($this->once())
			->method('Send')
			->will($this->throwException(new Exception));

		// Mock the builders for the RandomizePeople and SendEmail classes
		$SendEmails = $this->getMockBuilder('SendEmails')
			->setMethods(array('returnPHPMailerInstance'))
			->getMock();

		$SendEmails->expects($this->once())
			->method('returnPHPMailerInstance')
			->will($this->returnValue($PHPMailer));

		$this->setExpectedException('Exception');
		$SendEmails->sendEmail($person, $key, $unshuffledPeople, $giftValue);
	}

	/**
	 * dataProvider for testInvalidSendEmail
	 * @return array data inputs for testInvalidSendEmail
	 */
	public function providerInvalidSendEmail() {
		return array(
			'Test Send Email, True Result' => array(
				null,
				array(
					'name' => 'Test Person 2',
					'email' => 'test2@testing.com',
					'wishlist' => null,
				),
				1,
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
