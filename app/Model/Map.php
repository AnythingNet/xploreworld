<?php
App::uses('AppModel', 'Model');
/**
 * Map Model
 *
 * @property Airport $Airport
 */
class Map extends AppModel {

	public $actsAs = array('Containable');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'media_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Airport' => array(
			'className' => 'Airport',
			'joinTable' => 'maps_airports',
			'foreignKey' => 'map_id',
			'associationForeignKey' => 'airport_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	public $belongsTo = array(
		'Media' => array(
			'className' => 'Media',
			'foreignKey' => 'media_id'
		)
	);
  
  public function findAllWithAttributes() {

    $result = $this->find('all');

    foreach ($result as $i => $row) {

      $result[$i]['Media']['path'] = Configure::read('File.url') . $row['Media']['path'];
      $result[$i]['Map']['url'] = Router::url('/')  . 'map_' . $row['Map']['slug'];

    }

    return $result;

  }

  public function findPage($slug) {

    $options = array(
      'fields' => array(
        'id', 'name', 'slug'
      ),
      'conditions' => array(
        'slug' => $slug,
      )
    );

    $result = $this->find('first', $options);

    if ($result) {

      $airports = array();

      foreach ($result['Airport'] as $i => $data) {
        $airports[$data['id']] = $data;
      }

      $result['Airport'] = $airports;
      
    }

    return $result;

  }

}
