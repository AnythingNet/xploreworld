<?php
App::uses('AppModel', 'Model');
App::uses('CustomFile', 'Vendor');
/**
 * Media Model
 *
 */
class Media extends AppModel {

	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'path' => array(
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

  public function findAllWithAttributes() {

    $result = $this->find('all');

    foreach ($result as $i => $row) {

      $file_obj = new CustomFile($row['Media']['path']);

      $result[$i]['Media']['abs_path'] = Configure::read('File.url') . $row['Media']['path'];
      $result[$i]['Media']['width'] = $file_obj->getAttribute('width') . 'px';
      $result[$i]['Media']['height'] = $file_obj->getAttribute('height') . 'px';
      $result[$i]['Media']['size'] = $file_obj->sizeWithUnit();

    }

    return $result;

  }

}
