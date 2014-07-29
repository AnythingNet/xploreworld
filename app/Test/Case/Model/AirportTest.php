<?php
App::uses('Airport', 'Model');

/**
 * Airport Test Case
 *
 */
class AirportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.airport',
		'app.map',
		'app.maps_airport'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Airport = ClassRegistry::init('Airport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Airport);

		parent::tearDown();
	}

}
