<?php
App::uses('Folder', 'Utility');

class CustomFolder extends Folder {

  public function getList() {

    $files = $this->read(true, true);
    $result = array();


    foreach ($files as $i => $file) {

      if ($file) {
        foreach ($file as $j => $name) {
          $result[$name] = $name;
        }
      }

    }

    return $result;

  }

}
