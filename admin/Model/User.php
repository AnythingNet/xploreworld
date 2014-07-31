<?php
App::uses('UserConfig', 'AppConfig');
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

  //public $useTable = 'users';
  public $useTable = false;

  //temporary method for authentication from UserConfig
  public function find($type = null, $options = null) {

    $passwordHasher = new SimplePasswordHasher();

    $username = $options['conditions']['User.username'];
    $result = array();

    $username_result = strcmp($username, UserConfig::$admin_user);

    if ($username_result == 0) {

      $result = array(
        'User' => array(
          'username' => UserConfig::$admin_user,
          'password' => $passwordHasher->hash(UserConfig::$admin_pass),
        )
      );

    }

    return $result;

  }
  

/*
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
*/

  public function beforeSave($options = array()) {
    if (isset($this->data['User']['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data['User']['password'] = $passwordHasher->hash(
            $this->data['User']['password']
        );
    }
    return true;
  }
}
