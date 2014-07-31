<?php
App::uses('AppController', 'Controller');
App::uses('CustomFolder', 'Vendor');
/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SettingsController extends AppController {

/**
 * Components
 *
 * @var array
 */

  public function index() {

    $this->loadModel('Page');

    if ($this->request->isPost()) {

      foreach ($this->request->data['Setting'] as $name => $value) {

        $existing_setting = $this->Setting->findByName($name);

        //set id for update if data already exists. if not just insert
        if ($existing_setting) {

          $this->Setting->create();
          $this->Setting->id = $this->Setting->findIdByName($name);
          $params = array(
            'Setting' => array(
              'name' => $name,
              'value'  => $value
            )
          );
          $this->Setting->save($params);

        } else {

          $this->Setting->create();
          $params = array(
            'Setting' => array(
              'name' => $name,
              'value'  => $value
            )
          );
          $this->Setting->save($params);

        }

      }

      $this->Session->setFlash('The settings have been saved', 'default', array('class' => 'alert alert-success'));

    } else {

      $data = $this->Setting->find('all');
      $formdata = array();

      foreach ($data as $i => $item) {

        $formdata[$item['Setting']['name']] = $item['Setting']['value'];

      }

      $this->request->data = array('Setting' => $formdata);

    }

    $pages = $this->Page->findListPublished();
    $this->set('pages', $pages);

    $folder = new CustomFolder(Configure::read('Theme.location'));
    $themes = $folder->getList();
    $this->set('themes', $themes);

  }

}
