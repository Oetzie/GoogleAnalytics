<?php

	/**
	 * Google Analytics
	 *
	 * Copyright 2013 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Google Analytics, a real estate property listings component
	 * for MODX Revolution.
	 *
	 * Google Analytics is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Google Analytics is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Google Analytics; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */
	 
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
	require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
	require_once MODX_CONNECTORS_PATH.'index.php';
	
	$corePath = $modx->getOption('googleanalytics.core_path', null, $modx->getOption('core_path').'components/googleanalytics/');
	
	require_once $corePath.'model/googleanalytics/googleanalytics.class.php';
	
	$modx->googleAnalytics = new GoogleAnalytics($modx);
	
	$modx->lexicon->load('googleanalytics:default');
	
	$path = $modx->getOption('processorsPath', $modx->googleAnalytics->config, $corePath.'processors/');
	
	$modx->request->handleRequest(array(
		'processors_path' 	=> $path,
		'location' 			=> ''
	));

?>