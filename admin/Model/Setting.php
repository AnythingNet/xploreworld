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

  public function findTheme() {

    $options = array('fields' => 'id', 'conditions' => array('name' => $name));

  }

  public function findIdByName($name) {

    $options = array('fields' => 'id', 'conditions' => array('name' => $name));

    $data = $this->find('first', $options);

    return $data['Setting']['id'];

  }

}
