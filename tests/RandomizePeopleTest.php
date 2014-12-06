<?php
require_once ( dirname(dirname(__FILE__)) . "/includes/RandomizePeople.php");

/**
 * RandomizePeopleTest
 *
 * test the RandomizePeople class
 */
class RandomizePeopleTest extends PHPUnit_Framework_TestCase {

	/**
	 * setup the tests
	 *
	 * @return void
	 */
	public function setUp() {
		$this->RandomizePeople = new RandomizePeople();
	}

	/**
	 * test the randomize method
	 *
	 * @param array $inputArray an input array of people
	 * @return void
	 * @dataProvider providerRandomize
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

	/**
	 * data provider for testRandomize
	 *
	 * @return array test inputs for testRandomize
	 */
	public function providerRandomize() {
		return array(
			'One Person' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test1@test.com',
						'wishlist' => '',
					),
				),
			),

			'Two People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test1@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test2',
						'email' => 'test2@test.com',
						'wishlist' => '',
					),
				),
			),

			'Three People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test1@test.com',
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
						'email' => 'test1@test.com',
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
						'email' => 'test1@test.com',
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
						'email' => 'test1@test.com',
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

			'Twenty People' => array(
				array(
					array(
						'name' => 'test1',
						'email' => 'test1@test.com',
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

					array(
						'name' => 'test11',
						'email' => 'test11@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test12',
						'email' => 'test12@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test13',
						'email' => 'test13@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test14',
						'email' => 'test14@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test15',
						'email' => 'test15@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test16',
						'email' => 'test16@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test17',
						'email' => 'test17@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test18',
						'email' => 'test18@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test19',
						'email' => 'test19@test.com',
						'wishlist' => '',
					),
					array(
						'name' => 'test20',
						'email' => 'test20@test.com',
						'wishlist' => '',
					),
				),
			),
		);
	}

}
