<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MenusController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Security->validatePost = false;
  }

  public function index() {

    $this->loadModel('Page');

    if ($this->request->isPost()) {

      if ($this->Menu->truncate()) {

        $data = $this->request->data['Menu'];
        $all_params = array();

        foreach ($data as $section => $section_menu) {
          foreach ($section_menu as $group_id => $group_menu) {

            if (strcmp($group_id, 'section') == 0) {
              continue;
            }

            foreach ($group_menu as $order => $item) {

              $params = array(
                'Menu' => array(
                  'group' => $group_id,
                  'order' => $order,
                  'section' => $section,
                  'label' => $item['label'],
                  'url' => $item['url'],
                )
              );

              $all_params[] = $params;

            }

          }
        }

        if ($this->Menu->saveMany($all_params)) {
          $this->Session->setFlash('The menu has been saved.', 'default', array('class' => 'alert alert-success'));
        }

      }

    }

    $menu = $this->Menu->findAllInCollatedArray();
    $this->set('menu', $menu);

    $pages = $this->Page->findAllPublished();
    $this->set('pages', $pages);

    $this->set('header_id', $this->Menu->getHeaderId());
    $this->set('footer_id', $this->Menu->getFooterId());

  }

}
