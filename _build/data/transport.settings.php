<?php

	$settings = array();

	$settings[0] = $modx->newObject('modSystemSetting');
	$settings[0]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.account',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[1] = $modx->newObject('modSystemSetting');
	$settings[1]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.api_useragent',
		'value' 	=> 'GoogleAnalyticsOAuth v'.PKG_VERSION,
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[2] = $modx->newObject('modSystemSetting');
	$settings[2]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.client_id',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[3] = $modx->newObject('modSystemSetting');
	$settings[3]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.client_secret',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[4] = $modx->newObject('modSystemSetting');
	$settings[4]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.history',
		'value' 	=> '7',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[5] = $modx->newObject('modSystemSetting');
	$settings[5]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.panels',
		'value' 	=> 'summary,visitors,sources,content,content_search',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[6] = $modx->newObject('modSystemSetting');
	$settings[6]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.refresh_token',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	return $settings;
	
?>