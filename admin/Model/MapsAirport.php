<?php
App::uses('AppModel', 'Model');

class MapsAirport extends AppModel {

	public $actsAs = array('Containable');

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
