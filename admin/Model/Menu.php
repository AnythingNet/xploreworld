<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property Page $Page
 * @property MenuCustom $MenuCustom
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

  public function truncate() {
    return $this->query(__('TRUNCATE TABLE %s', $this->useTable));
  }

  public function findAllInCollatedArray() {

    $data = $this->find('all');

    $result = array(
      $this->headerId => array(),
      $this->footerId => array(),
    );

    foreach ($data as $i => $menu) {

      foreach ($menu as $item) {

        $section = $item['section'];
        $group = $item['group'];
        $order = $item['order'];

        $result[$section][$group][$order]['label'] = $item['label'];
        $result[$section][$group][$order]['url'] = $item['url'];

      }

    }

    return $result;

  }

  public function getHeaderId() {
    return $this->headerId;
  }

  public function getFooterId() {
    return $this->footerId;
  }

}
