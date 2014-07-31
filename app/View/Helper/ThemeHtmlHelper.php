<?php
App::uses('HtmlHelper', 'View/Helper');

class ThemeHtmlHelper extends HtmlHelper {

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

}
