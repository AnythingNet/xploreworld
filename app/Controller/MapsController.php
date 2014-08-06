<?php
App::uses('AppController', 'Controller');
App::uses('ExceptionRenderer', 'Error');
App::uses('CakeEmail', 'Network/Email');
/**
 * Maps Controller
 *
 * @property Map $Map
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MapsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

  private $slugprefix = 'map_';

  public function beforeFilter() {
    $this->helpers = array_merge($this->helpers, array('Js'));
    parent::beforeFilter();
  }

  public function index() {

    $this->set('meta_description', 'test');

    //set page, if cannot find render 404
    $slug = $this->request->here(false); 
    $slug = trim($slug, '/'); 
    $slug = str_replace($this->slugprefix, '', $slug); 

    $page = $this->Map->findPage($slug);

    if (!$page) {
      throw new NotFoundException();
    }

    $this->set('map_object', $page);
    $this->set('add_url', Router::url(array('controller' => 'maps', 'action' => 'add')));
    $this->set('home_url', Router::url('/'));

  }

  public function add() {

    $this->autoRender = false;

    if (!$this->request->isPost()) {
      throw new NotFoundException();
    }

    $this->loadModel('UserInput');
    $this->autoRender = false;
    $result = array();
    
    $data = array(
      'UserInput' => array(
        'first_name' => $this->request->data('first_name'),
        'last_name' => $this->request->data('last_name'),
        'email' => $this->request->data('email'),
        'phone' => $this->request->data('phone'),
      )
    );

    $this->UserInput->create($data);

    if (!$this->UserInput->validates()) {
    
      $result['status'] = 'forminvalid';

      $invalid_fields = array();

      foreach ($this->UserInput->validationErrors as $field => $messages) {
        $invalid_field = array();
        $invalid_field['id'] = $field;
        $invalid_field['message'] = '';

        foreach ($messages as $message) {
          $invalid_field['message'] .= $message;
        }
    
        $invalid_fields[] = $invalid_field;
      }

      $result['fields'] = $invalid_fields;

    } else {

      $this->loadModel('Setting');
    
      $email = new CakeEmail();
      //$email->config('default');
      $email->config('test');
      $email->subject('Xploreworld: Thank you for visting us');
      $email->to($this->request->data('email'));
      $email->viewVars(array(
        'email_heading' => 'Thank you for visiting Xploreworld',
        'email_subheading' => 'Your enquiry has been sent to Xploreworld admin and we will contact you as soon as possible',
        'name' => $this->request->data('first_name') . ' ' . $this->request->data('last_name'),
        'email' => $this->request->data('email'),
        'phone' => $this->request->data('phone'),
        'seat' => $this->request->data('seat'),
        'comment' => $this->request->data('comment'),
        'adventure' => $this->request->data('adventure'),
        'destinations' => $this->request->data('destinations'),
      ));
      $email->send();

      $email = new CakeEmail();
      //$email->config('default');
      $email->config('test');
      $email->subject('Xploreworld: Someone has sent a message to you');
      $email->to($this->Setting->getEmailAddress(), $this->request->data('email'));
      $email->viewVars(array(
        'email_heading' => 'Someone has created an itenerary from Xploreworld',
        'email_subheading' => 'See the details below',
        'name' => $this->request->data('first_name') . ' ' . $this->request->data('last_name'),
        'email' => $this->request->data('email'),
        'phone' => $this->request->data('phone'),
        'seat' => $this->request->data('seat'),
        'comment' => $this->request->data('comment'),
        'adventure' => $this->request->data('adventure'),
        'destinations' => $this->request->data('destinations'),
      ));
      $email->send();

      $result = array('status' => 'success', 'message' => 'Thank you. We\'ll get back to you as soon as possible');

    }

    $this->response->body(json_encode($result));
  
  }

}
