<?php
App::uses('HtmlHelper', 'View/Helper');

class ThemeHtmlHelper extends HtmlHelper {

  //private $_assetPath = '/theme/xploreworld';
  private $_assetPath = '/xploreworld/app/webroot/xploreworld';

  public function getHeader($dataoptions) {

    $parent_index = 0;
    $html = '';

    foreach ($data as $group => $menu) {

      if (count($menu) > 0) {

        foreach ($menu as $i => $item) {

          if ($i == $parent_index) {

            

          } else {

            $html .= '<li>';
            //$html .= '<a href="' . $menu['url'] . '">' . $menu['label'] . '</a>';
            $html .= $this->link($menu['label'], $menu['url']);
            $html .= '</li>';

          }

        }

      } else {

        $html .= '<li>';
        //$html .= '<a href="' . $menu['url'] . '">' . $menu['label'] . '</a>';
        $html .= $this->link($menu['label'], $menu['url']);
        $html .= '</li>';

      }

    }
     

  }

  public function css($path, $options = array()) {

    if (!preg_match('/^(http|\/\/)+/', $path)) {

      $options = array(
        'rel' => 'stylesheet',
        'type' => 'text/css',
        'href' => $this->_assetPath . '/css/' . $path . '.css',
      );

    } else {

      $options = array(
        'rel' => 'stylesheet',
        'type' => 'text/css',
        'href' => $path,
      );

    }

    return $this->tag('link', null, $options);

  }

  public function script($path, $options = array()) {

    if (!preg_match('/^(http|\/\/)+/', $path)) {

      $options = array(
        'type' => 'text/javascript',
        'src' => $this->_assetPath . '/js/' . $path . '.js',
      );

    } else {

      $options = array(
        'type' => 'text/javascript',
        'src' => $path,
      );

    }

    return $this->tag('script', '', $options);
    //return parent::script($path, array());

  }

  public function image($path, $options = array()) {

    if (preg_match('/^(http|\/\/)+/', $path)) {

      $location = $path;

    } else if (preg_match('/^\/+/', $path)) {

      $location = $this->_assetPath . $path;

    } else {

      $location = $this->_assetPath . '/img/' . $path;

    }

    $options = array_merge($options, array('src' => $location));

    return $this->tag('img', '', $options);
    //return parent::script($path, array());

  }

}
