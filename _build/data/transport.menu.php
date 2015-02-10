<?php

	$action = $modx->newObject('modAction');
	$action->fromArray(array(
	    'id' 			=> 1,
	    'namespace' 	=> PKG_NAME_LOWER,
	    'parent' 		=> 0,
	    'controller' 	=> 'index',
	    'haslayout' 	=> true,
	    'lang_topics' 	=> PKG_NAME_LOWER.':default',
	    'assets' 		=> ''
	), '', true, true);
	 
	$menu = $modx->newObject('modMenu');
	$menu->fromArray(array(
	    'text' 			=> PKG_NAME_LOWER,
	    'namespace' 	=> PKG_NAME_LOWER,
	    'parent' 		=> 'components',
	    'description' 	=> PKG_NAME_LOWER.'.desc',
	    'icon' 			=> 'bar-chart-o',
	    'menuindex' 	=> 0,
	    'params' 		=> '',
	    'handler' 		=> 'window.open("http://www.google.nl/analytics/", "_blank"); return false;',
	    'permissions'	=> ''
	), '', true, true);
	
	$menu->addOne($action);

	return $menu;

?>