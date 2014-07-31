<?php
App::uses('MenuCustom', 'Model');

/**
 * MenuCustom Test Case
 *
 */
class MenuCustomTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_custom',
		'app.menu',
		'app.page'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuCustom = ClassRegistry::init('MenuCustom');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuCustom);

		parent::tearDown();
	}

}
