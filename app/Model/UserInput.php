<?php
App::uses('AppModel', 'Model');
/**
 * UserInput Model
 *
 * @property Airport $Airport
 */
class UserInput extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $useTable = false;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter first name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter last name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter email',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter phone',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

}
