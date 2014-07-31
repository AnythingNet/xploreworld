<?php
App::uses('AppController', 'Controller');
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

  public function index() {
  }

}
