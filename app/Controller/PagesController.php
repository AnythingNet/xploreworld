<?php
App::uses('AppController', 'Controller');
App::uses('ExceptionRenderer', 'Error');
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
	public $components = array('Paginator', 'Session');

  public function index() {

    $this->loadModel('Page');
    $this->loadModel('Setting');
    $page;

    //set page, if cannot find render 404
    $slug = $this->request->here(false); 
    $slug = trim($slug, '/'); 

    // if home page, get home page id from settings
    if (empty($slug)) {

      $home_page_id = $this->Setting->getHomePageId();
      $page = $this->Page->findById($home_page_id);
      $this->view = 'airplain';

    } else {

      $page = $this->Page->findPage($slug);

    }

    if (!$page) {
      throw new NotFoundException();
    }

    //sets view variable from page data
    foreach ($page['Page'] as $column_name => $item) {
      $this->set($column_name, $item);
    }

    $this->set('title_for_layout', $page['Page']['title']);
    $this->set('name', $page['Page']['name']);
    $this->set('meta_description', $page['Page']['meta_description']);
    $this->set('content', $page['Page']['content']);

  }

}
