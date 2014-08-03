<?php
App::uses('AppModel', 'Model');
/**
 * Airport Model
 *
 * @property Map $Map
 */
class Airport extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Map' => array(
			'className' => 'Map',
			'joinTable' => 'maps_airports',
			'foreignKey' => 'airport_id',
			'associationForeignKey' => 'map_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	/**
	 * �n�惊�X�g���擾
	 *
	 * @return array $countries �Z���N�g�{�b�N�X�p�̒n�惊�X�g�z��
	 */
	public function getCountries() {

		$options = array(
			'fields' => 'DISTINCT Airport.country'
		);

		$airport = $this->find('all', $options);

		$countries = array();

		foreach ($airport as $_airport) {

			$countries[$_airport['Airport']['country']] = $_airport['Airport']['country'];

		}

		return $countries;

	}

}
