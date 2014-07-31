<?php
/**
 * MenuFixture
 *
 */
class MenuFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'menu';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'source_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'source_type' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'menu_type' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'enabled' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'source_id' => 1,
			'source_type' => 'Lorem ipsum dolor sit amet',
			'menu_type' => 'Lorem ipsum dolor sit amet',
			'order' => 1,
			'enabled' => 1,
			'created' => '2014-04-28 09:26:46',
			'modified' => '2014-04-28 09:26:46'
		),
	);

}
