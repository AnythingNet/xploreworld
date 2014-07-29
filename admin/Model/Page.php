<?php
App::uses('AppModel', 'Model');
/**
 * Page Model
 *
 */
class Page extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'title';
	private $status_draft = 0;
	private $status_publish = 1;
	private $label_draft = 'draft';
	private $label_publish = 'published';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
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
		'status' => array(
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

  public function findAllWithLabel($options = array()) {

    $data = $this->find('all', $options);

    foreach ($data as $i => $row) {
      
      if ($row['Page']['status'] == $this->status_draft) {

        $data[$i]['Page']['status'] = $this->label_draft;

      } else if ($row['Page']['status'] == $this->status_publish) {

        $data[$i]['Page']['status'] = $this->label_publish;

      }

    }

    return $data;

  }

  public function findAllPublished() {

    $options = array(
      'conditions' => array(
        'status' => $this->status_publish
      )
    );

    return $this->find('all', $options);

  }

  public function findListPublished() {

    $options = array(
      'conditions' => array(
        'status' => $this->status_publish
      )
    );

    return $this->find('list', $options);

  }

  public function getStatusPublish() {
    return $this->status_publish;
  }

  public function getStatusDraft() {
    return $this->status_draft;
  }

}
