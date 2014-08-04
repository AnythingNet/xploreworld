<?php
App::uses('AppController', 'Controller');
App::uses('ExceptionRenderer', 'Error');
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

    $this->set('maps_object', $page['Airport']);
    $this->set('add_url', Router::url(array('controller' => 'maps', 'action' => 'add')));
    $this->set('home_url', Router::url('/'));

  }

  public function add() {

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

      /** temporary logic - must be changed later **/
      $message = 'name: ' . $this->request->data('first_name') . ' ' . $this->request->data('last_name') . "\n";
      $message .= 'email: ' . $this->request->data('email') . "\n";
      $message .= 'phone: ' . $this->request->data('phone') . "\n";
      $message .= 'seat: ' . $this->request->data('seat') . "\n";
      $message .= 'comment: ' . $this->request->data('comment') . "\n";
    
      mail('shuhei.nakahodo@anythingnet.com.au', 'Xploreworld: Someone has sent a message to you', $message);

      $result = array('status' => 'success', 'message' => 'Thank you. We\'ll get back to you as soon as possible');

    }

    $this->response->body(json_encode($result));

    /*
    invalid:
    {status:'forminvalid', fields:[
        {
          id: 'first-name',
          message: 'can not be empty'
        },
        {
          id: 'last-name',
          message: 'can not be empty'
        }
        ...
      ]
    }

    error
    {status:'error', message: 'something has occured' }

    success
    {status:'success'}
    */

  
  }

}
