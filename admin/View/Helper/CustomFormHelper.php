<?php
App::uses('FormHelper', 'View/Helper');

class CustomFormHelper extends FormHelper {

  public function input($field_name, $options = array()) {

    $options = array_merge($options, array('required' => false, 'label' => false, 'error' => false));

    if ($this->isFieldError($field_name)) {
      $options['div'] = array('class' => 'has-error');
    }

    return parent::input($field_name, $options);

  }

  public function textarea($field_name, $options = array()) {

    $options = array_merge($options, array('required' => false, 'label' => false, 'error' => false));

    return parent::textarea($field_name, $options);

  }

}
