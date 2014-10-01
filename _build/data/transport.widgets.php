<?php

	$widgets = array();
	
	foreach (glob($sources['widgets'].'/*.php') as $key => $value) {
		$name = str_replace('.widget.php', '', substr($value, strrpos($value, '/') + 1, strlen($value)));
		
		$widgets[$name] = $modx->newObject('modDashboardWidget');
		$widgets[$name]->fromArray(array(
			'id' 			=> 1,
			'name'			=> PKG_NAME_LOWER,
			'description'	=> PKG_NAME_LOWER.'.desc',
			'type'			=> 'file',
			'size' 			=> 'full',
			'content' 		=> '[[++core_path]]components/'.PKG_NAME_LOWER.'/elements/widgets/'.$name.'.widget.php',
			'namespace' 	=> PKG_NAME_LOWER,
			'lexicon' 		=> PKG_NAME_LOWER.':default'
		));
	}
	
	return $widgets;

?>