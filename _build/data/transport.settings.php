<?php

	$settings = array();

	$settings[0] = $modx->newObject('modSystemSetting');
	$settings[0]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_admin_groups',
		'value' 	=> 'Administrator',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[1] = $modx->newObject('modSystemSetting');
	$settings[1]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_cachetime',
		'value' 	=> '3600',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[2] = $modx->newObject('modSystemSetting');
	$settings[2]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_client_id',
		'value' 	=> '982162475360-urumknfu4ck7has1ulruse4tog8493g4.apps.googleusercontent.com',
		'xtype' 	=> 'text-password',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[3] = $modx->newObject('modSystemSetting');
	$settings[3]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_client_secret',
		'value' 	=> '22YOcG-lqrdDx6uRk23r_Ciw',
		'xtype' 	=> 'text-password',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[4] = $modx->newObject('modSystemSetting');
	$settings[4]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_history',
		'value' 	=> '7',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[5] = $modx->newObject('modSystemSetting');
	$settings[5]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_panels',
		'value' 	=> 'summary,visitors,sources,content,report404,search,settings',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
		
	$settings[6] = $modx->newObject('modSystemSetting');
	$settings[6]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_profile_id',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[7] = $modx->newObject('modSystemSetting');
	$settings[7]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_profile_name',
		'value' 	=> '',
		'xtype' 	=> 'textfield',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
	
	$settings[8] = $modx->newObject('modSystemSetting');
	$settings[8]->fromArray(array(
		'key' 		=> PKG_NAME_LOWER.'_refresh_token',
		'value' 	=> '',
		'xtype' 	=> 'text-password',
		'namespace' => PKG_NAME_LOWER,
		'area' 		=> PKG_NAME_LOWER
	), '', true, true);
		
	return $settings;
	
?>