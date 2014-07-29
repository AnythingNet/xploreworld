<?php
App::uses('AppModel', 'Model');
/**
 * Setting Model
 *
 */
class Setting extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

  public function getTheme() {

    $theme = null;

    $options = array(
      'fields' => array('value'),
      'conditions' => array('name' => 'theme')
    );

    $data = $this->find('first', $options);

    if (isset($data['Setting']['value'])) {

      $theme = $data['Setting']['value'];

    }

    return $theme;

  }

  public function getHomePageId() {

    $result = null;

    $options = array(
      'fields' => array('name', 'value'),
      'conditions' => array('name' => 'home_page_id')
    );

    $data = $this->find('list', $options);

    if (isset($data['home_page_id'])) {
      $result = $data['home_page_id'];
    }

    return $result;

  }

}
