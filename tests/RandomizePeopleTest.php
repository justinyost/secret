<?php
require_once ( dirname(dirname(__FILE__)) . "/includes/RandomizePeople.php");

class RandomizePeopleTest extends PHPUnit_Framework_TestCase {

	/**
	 * [setUp description]
	 */
	public function setUp() {
		$this->RandomizePeople = new RandomizePeople();
	}

	/**
	 * test the randomize method
	 *
	 * @dataProvider providerRandomize
	 * @param  array $inputArray [description]
	 * @return void
	 */
	public function testRandomize($inputArray) {
		$outputArray = $this->RandomizePeople->randomize($inputArray, $inputArray);

		if (count($inputArray) > 1) {
			foreach ($outputArray as $outputKey => $data) {
				$this->assertNotEquals($data['name'], $inputArray[$outputKey]['name']);
				$this->assertNotEquals($data['email'], $inputArray[$outputKey]['email']);
			}
		} else {
			foreach ($outputArray as $outputKey => $data) {
				$this->assertEquals($data['name'], $inputArray[$outputKey]['name']);
				$this->assertEquals($data['email'], $inputArray[$outputKey]['email']);
			}
		}
	}

	public function providerRandomize() {
		return array(
			'One Person' => array(
				array(
					array(
						'name' => 'test',
						'email' => 'test@test.com',
						'wishlist' => '',
					),
				),
			),

			'Two People' => array(
				array(
					array(
						'name' => 'test',
						'email' => 'test@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'testing',
						'email' => 'testing@test.com',
						'wishlist' => '',
					),
				),
			),

			'Three People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test2',
						'email' => 'test2@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test3',
						'email' => 'test3@test.com',
						'wishlist' => '',
					),
				),
			),

			'Four People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test2',
						'email' => 'test2@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test3',
						'email' => 'test3@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test4',
						'email' => 'test4@test.com',
						'wishlist' => '',
					),
				),
			),

			'Five People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test2',
						'email' => 'test2@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test3',
						'email' => 'test3@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test4',
						'email' => 'test4@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test5',
						'email' => 'test5@test.com',
						'wishlist' => '',
					),
				),
			),

			'Ten People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test2',
						'email' => 'test2@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test3',
						'email' => 'test3@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test4',
						'email' => 'test4@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test5',
						'email' => 'test5@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test6',
						'email' => 'test6@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test7',
						'email' => 'test7@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test8',
						'email' => 'test8@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test9',
						'email' => 'test9@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test10',
						'email' => 'test10@test.com',
						'wishlist' => '',
					),
				),
			),
		);
	}

}
