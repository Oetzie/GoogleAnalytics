<?php

	$settings = array();

    $settings[0] = $modx->newObject('modSystemSetting');
    $settings[0]->fromArray(array(
        'key' 		=> PKG_NAME_LOWER.'.branding_url',
        'value' 	=> 'http://www.oetzie.nl',
        'xtype' 	=> 'textfield',
        'namespace' => PKG_NAME_LOWER,
        'area' 		=> PKG_NAME_LOWER
    ), '', true, true);

    $settings[1] = $modx->newObject('modSystemSetting');
    $settings[1]->fromArray(array(
        'key' 		=> PKG_NAME_LOWER.'.branding_url_help',
        'value' 	=> '//www.werkvanoetzie.nl/extras/googleanalytics',
        'xtype' 	=> 'textfield',
        'namespace' => PKG_NAME_LOWER,
        'area' 		=> PKG_NAME_LOWER
    ), '', true, true);

	$settings[2] = $modx->newObject('modSystemSetting');
	$settings[2]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.account',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[3] = $modx->newObject('modSystemSetting');
	$settings[3]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.api_useragent',
		'value' 	=> 'GoogleAnalyticsOAuth v'.PKG_VERSION,
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[4] = $modx->newObject('modSystemSetting');
	$settings[4]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.client_id',
		'value' 	=> '982162475360-urumknfu4ck7has1ulruse4tog8493g4.apps.googleusercontent.com',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[5] = $modx->newObject('modSystemSetting');
	$settings[5]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.client_secret',
		'value' 	=> '22YOcG-lqrdDx6uRk23r_Ciw',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[6] = $modx->newObject('modSystemSetting');
	$settings[6]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.history',
		'value' 	=> '14',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[7] = $modx->newObject('modSystemSetting');
	$settings[7]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.panels',
		'value' 	=> 'summary,visitors,sources,content,content_search,goals',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[8] = $modx->newObject('modSystemSetting');
	$settings[8]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'.refresh_token',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	return $settings;
	
?>