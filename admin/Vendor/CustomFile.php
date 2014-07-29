<?php
App::uses('File', 'Utility');

class CustomFile extends File {

  private $create = false;
  private $mode = 0644;
  private $max_size = 2097152; //2MB
  private $filepath;
  private $tmp_file_info = null;
  private $message = '';

  //constructor accepts either $_FILE values or file name string
  public function __construct($file) {

    if (is_array($file)) {

      $this->tmp_file_info = $file;
      $this->filepath = Configure::read('File.path') . $this->tmp_file_info['name'];

    } else { 
      $this->filepath = Configure::read('File.path') . $file;
    }

    parent::__construct($this->filepath, $this->create, $this->mode);

  }

  public function move() {

    $result = false;

    if (is_null($this->tmp_file_info)) {
        
      $this->message = 'The file has already been uploaded.';

    } else if (!move_uploaded_file($this->tmp_file_info['tmp_name'], $this->filepath)) {

      $this->message = 'The file could not been uploaded.';

    } else {

      $result = true;

    }

    return $result;
    
  }

  public function getAttribute($attr_name) {

    $attr = null;
    $image_info = getimagesize($this->filepath);

    if (strcmp($attr_name, 'width') == 0) {

      $attr = $image_info[0];

    } else if (strcmp($attr_name, 'height') == 0) {

      $attr = $image_info[1];

    }

    return $attr;

  }

  public function sizeWithUnit() {

    $size = parent::size();
    $result = '';

    $kb = 1000; 
    $mb = $kb * 1000; 

    if ($size > $mb) {

      $size = $size / $mb;
      $result = sprintf('%.2f MB', $size);

    } else {

      $size = $size / $kb;
      $result = sprintf('%.2f KB', $size);

    }

    return $result;

  }

  public function getMessage() {
    return $this->message;
  }

  public function isImage() {

    $result = false;

    if (!preg_match('/^(png|jpg|jpeg|gif)$/i', $this->ext())) {
      $this->message = 'The file is not image file.';
    } else {
      $result = true;
    }

    return $result;

  }

  public function isFileSizeTooBig() {

    $result = false;

    if (isset($this->tmp_file_info['size']) && $this->tmp_file_info['size'] > $this->max_size) {
      $this->message = 'The file size is too big';
      $result = true;
    }

    return $result;

  }

  public function validateAsImage() {

    $result = false;

    if (!$this->exists() && $this->isImage() && !$this->isFileSizeTooBig()) {
      $result = true;
    }

    return $result;

  }

  //@override
  public function exists() {

    $result = parent::exists();

    if ($result) {
      $this->message = 'The file already exists.';
    }

    return $result;

  }

  public function delete() {

    $result = parent::delete();

    if ($result) {
      $this->message = 'The file could not be deleted.';
    }

    return $result;

  }

}
