<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

  public function beforeFilter() {
    $this->layout = '';
    $this->Auth->allow('add', 'login');
    $this->Security->blackHoleCallback = 'preventReload';
  }


  public function login() {

    if ($this->request->is('post')) {

      if ($this->Auth->login()) {
        $this->redirect($this->Auth->loginRedirect);
      } else {
        $this->Session->setFlash($this->Auth->authError, 'default', array('class' => 'alert alert-danger'));
      }

    }

  }

  public function logout() {
    $this->Session->setFlash('You have logged out successfully.', 'default', array('class' => 'alert alert-success'));
    $this->Auth->logout();
    $this->redirect($this->Auth->loginAction);
  }

  public function add() {

    if ($this->request->is('post')) {
      $this->User->create();
      $this->User->save($this->request->data);
    }

  }

  public function preventReload() {
    $this->redirect($this->Auth->loginAction);
  }

}
