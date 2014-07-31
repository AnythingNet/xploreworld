<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 */
class Menu extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'menu';
  private $headerId = 0;
  private $footerId = 1;

  public function findHeader() {

    $result = array();

    $options = array(
      'fields' => array(
        'label', 'url', 'order', 'group'
      ),
      'conditions' => array(
        'section' => $this->headerId,
      ),
      'order' => array('Menu.order ASC'),
    );

    $data = $this->find('all', $options);

    if (!$data) {

      $result = $data;

    } else {

      $parent_index = 0;

      foreach ($data as $i => $menu) {

        $menu['Menu']['url'] = $this->_collateUrl($menu['Menu']['url']);
        $order = $menu['Menu']['order'];
        $group = $menu['Menu']['group'];

        if ($order == $parent_index) {
          $result[$group]['parent'] = $menu['Menu'];
        } else {
          $result[$group]['children'][$order] = $menu['Menu'];
        }

      }

    }

    return $result;

  }

  public function findFooter() {

    $result = array();

    $options = array(
      'fields' => array(
        'label', 'url', 'order', 'group'
      ),
      'conditions' => array(
        'section' => $this->footerId,
      ),
      'order' => array('Menu.order ASC'),
    );

    $data = $this->find('all', $options);

    if (!$data) {

      $result = $data;

    } else {

      $parent_index = 0;

      foreach ($data as $i => $menu) {

        $menu['Menu']['url'] = $this->_collateUrl($menu['Menu']['url']);
        $order = $menu['Menu']['order'];
        $group = $menu['Menu']['group'];

        if ($order == $parent_index) {
          $result[$group]['parent'] = $menu['Menu'];
        } else {
          $result[$group]['children'][$order] = $menu['Menu'];
        }

      }

    }

    return $result;

  }

  private function _collateUrl($url) {

    if (!preg_match('/^http+s?:\/\/+/i', $url)) {

      $url = DS . $url . DS;

    }

    return $url;

  }

}
