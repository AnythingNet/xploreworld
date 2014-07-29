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
	public $displayField = 'name';
	private $status_draft = 0;
	private $status_publish = 1;

  public function findPage($slug) {

    $options = array(
      'fields' => array(
        'title', 'name', 'slug', 'meta_description', 'content'
      ),
      'conditions' => array(
        'slug' => $slug,
        'status' => $this->status_publish,
      )
    );

    return $this->find('first', $options);

  }

}
