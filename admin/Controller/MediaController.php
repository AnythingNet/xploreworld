<?php
App::uses('AppController', 'Controller');
App::uses('CustomFile', 'Vendor');
/**
 * Media Controller
 *
 * @property Media $Media
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MediaController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Security->csrfCheck = false;
    $this->Security->validatePost = false;
  }

  public function index() {

    $files = $this->Media->findAllWithAttributes();

    $this->set('files', $files);

  }

  public function new_upload() {

    $this->autoRender = false;
    $result = array();

    if ($this->request->isPost()) {

      $file_obj = new CustomFile($this->data['Media']['file']);
    
      if (!$file_obj->validateAsImage() || !$file_obj->move()) {

        $result = array('status' => 'error', 'message' => $file_obj->getMessage());

      } else {

        $params = array(
          'Media' => array(
            'alt' => $this->data['Media']['alt'],
            'path' => $this->data['Media']['file']['name'],
          )
        );

        if ($this->Media->save($params)) {

          $result = array('status' => 'success');
          $this->Session->setFlash('The image has been updated', 'default', array('class' => 'alert alert-success'));

        } else {

          $result = array('status' => 'error', 'message' => 'file was not saved to database');

        }

      }

    }

    $this->response->body(json_encode($result));

  }

  public function edit() {

    if ($this->request->isPost()
          && isset($this->request->data['Media']['id'])
          && isset($this->request->data['Media']['alt'])) {

      $params = array('alt' => $this->request->data['Media']['alt']);

      $this->Media->id = $this->request->data['Media']['id'];

      if ($this->Media->save($params)) {
        $this->Session->setFlash('The image has been updated', 'default', array('class' => 'alert alert-success'));
      } else {
        $this->Session->setFlash('The image could not be saved.', 'default', array('class' => 'alert alert-danger'));
      }

    }

    $this->redirect('index');

  }

  public function delete() {

    if ($this->request->isPost() && isset($this->request->data['Media']['id'])) {

      $id = $this->request->data['Media']['id'];

      $file = $this->Media->find('list', array(
        'fields' => array('id', 'path'),
        'conditions' => array('id' => $id)
      ));

      $file_obj = new CustomFile($file[$id]);

      if (!$file_obj->delete()) {

        $this->Session->setFlash($file_obj->getMessage(), 'default', array('class' => 'alert alert-danger'));

      } else if (!$this->Media->delete($id)) {

        $this->Session->setFlash('The image could not be deleted.', 'default', array('class' => 'alert alert-danger'));

      } else {

        $this->Session->setFlash('The image has been deleted', 'default', array('class' => 'alert alert-success'));

      }

    }

    $this->redirect('index');

  }

}
