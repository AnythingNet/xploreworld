<?php
App::uses('AppModel', 'Model');

/**
 * MapsAirport Model
 */
class MapsAirport extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'airport_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	public $belongsTo = array(
		'Map' => array(
			'className' => 'Map',
			'foreignKey' => 'map_id'
		)
		,'Airport' => array(
			'className' => 'Airport',
			'foreignKey' => 'airport_id'
		)
	);

}
