<?php

Class CustomRoute extends Router {

  //extends Router::connect to make 'maps_' request to be handled by MapsController
  public static function connect($template, $defaults = array(), $options = array()) {

  	$request = parent::getRequest();


  	if (preg_match('/^map_+/', $request->url)) {

  		$defaults['controller'] = 'maps';
  		$defaults['action'] = 'index';

  	} else if (preg_match('/^maps\/+/', $request->url)) {

      $template = '/maps';
  		$defaults['controller'] = 'maps';
      unset($defaults['action']);

  	}

  	return parent::connect($template, $defaults, $options);

  }

}
