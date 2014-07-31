<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	//public $components = array('Paginator', 'Session');
  public $helpers = array(
    'Form' => array('className' => 'CustomForm')
  );

  public function index() {

    $this->set('pages', $this->Page->findAllWithLabel());

  }

  public function add() {

    if ($this->request->isPost()) {

      $status;

      if (isset($this->request->data['publish'])) {
        $status = $this->Page->getStatusPublish();
      } else if (isset($this->request->data['draft'])) {
        $status = $this->Page->getStatusDraft();
      }

      $params = array(
        'Page' => array(
          'title' => $this->request->data['Page']['title'],
          'name' => $this->request->data['Page']['name'],
          'meta_description' => $this->request->data['Page']['meta_description'],
          'slug' => $this->request->data['Page']['slug'],
          'content' => $this->request->data['Page']['content'],
          'status' => $status,
        )
      );

      $this->Page->create($params);

      if (!$this->Page->validates()) {

        $this->Session->setFlash('Please fill in the required fields.', 'default', array('class' => 'alert alert-danger'));

      } else if (!$this->Page->save()) {

        $this->Session->setFlash('The page could not be saved. Please try again.', 'default', array('class' => 'alert alert-danger'));

      } else if ($status == $this->Page->getStatusDraft()) {

        $this->Session->setFlash('The page has been saved as a draft.', 'default', array('class' => 'alert alert-warning'));
        $this->redirect('index');

      } else {

        $this->Session->setFlash('The page has been saved and published.', 'default', array('class' => 'alert alert-success'));
        $this->redirect('index');

      }

    }

    $this->loadModel('Media');
    $this->loadModel('Setting');

    $this->set('images', $this->Media->findAllWithAttributes());

   

  }

  public function edit($id = null) {

    if ($this->request->isPost()) {

      $status;

      if (isset($this->request->data['publish'])) {
        $status = $this->Page->getStatusPublish();
      } else if (isset($this->request->data['draft'])) {
        $status = $this->Page->getStatusDraft();
      }

      $params = array(
        'Page' => array(
          'title' => $this->request->data['Page']['title'],
          'name' => $this->request->data['Page']['name'],
          'meta_description' => $this->request->data['Page']['meta_description'],
          'slug' => $this->request->data['Page']['slug'],
          'content' => $this->request->data['Page']['content'],
          'status' => $status,
        )
      );

      $this->Page->create($params);
      $id = $this->request->data['Page']['id'];
      $this->Page->id = $this->request->data['Page']['id'];

      if (!$this->Page->validates()) {

        $this->Session->setFlash('Please fill in the required fields.', 'default', array('class' => 'alert alert-danger'));

      } else if (!$this->Page->save()) {

        $this->Session->setFlash('The page could not be saved. Please try again.', 'default', array('class' => 'alert alert-danger'));

      } else if ($status == $this->Page->getStatusDraft()) {

        $this->Session->setFlash('The page has been saved as a draft.', 'default', array('class' => 'alert alert-warning'));
        $this->redirect('index');

      } else {

        $this->Session->setFlash('The page has been saved and published.', 'default', array('class' => 'alert alert-success'));
        $this->redirect('index');

      }

    } else if (is_null($id) || !$this->Page->findById($id)) {

      $this->redirect('index');

    } else {

      $this->request->data = $this->Page->findById($id);

    }

    $this->set('id', $id);

    $this->loadModel('Media');
    $this->set('images', $this->Media->findAllWithAttributes());

  }

  public function delete() {

    if ($this->request->isPost()) {

      if ($this->Page->delete($this->request->data['Page']['id'])) {
        $this->Session->setFlash('The page has been deleted.', 'default', array('class' => 'alert alert-success'));
      }

    }

    $this->redirect('index');

  }

}
