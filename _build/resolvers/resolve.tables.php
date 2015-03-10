<?php

	if ($object->xpdo) {
	    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
	        case xPDOTransport::ACTION_INSTALL:
	            $modx =& $object->xpdo;
	            $modx->addPackage('googleanalytics', $modx->getOption('googleanalytics.core_path', null, $modx->getOption('core_path').'components/googleanalytics/').'model/');
	
	            $manager = $modx->getManager();
	
	            $manager->createObjectContainer('GoogleAnalytics404');
	
	            break;
	        case xPDOTransport::ACTION_UPGRADE:
	            break;
	    }
	}
	
	return true;