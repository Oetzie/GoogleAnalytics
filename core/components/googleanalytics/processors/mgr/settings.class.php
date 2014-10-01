<?php

	/**
	 * Google Analytics
	 *
	 * Copyright 2014 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Google Analytics, a real estate property listings component
	 * for MODX Revolution.
	 *
	 * Google Analytics is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Coaching is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Google Analytics; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */

	class GoogleAnalyticsSettingsProcessor extends modProcessor {
		/**
		 * @acces public.
		 * @var Object.
		 */
		public $googleAnalytics;
		
		/**
		 * @acces public.
		 * @return Mixed.
		 */
		 public function initialize() {
		 	require_once $this->modx->getOption('googleanalytics.core_path', null, $this->modx->getOption('core_path').'components/googleanalytics/').'/model/googleanalytics/googleanalytics.class.php';
		 	
		 	$this->googleAnalytics = new GoogleAnalytics($this->modx);

			return parent::initialize();
		}

		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function process() {
			foreach ($this->getProperties() as $key => $value) {
				switch($key) {
					case 'token':
						$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_token');
						$setting->set('value', $value);
						$setting->save();
						break;
					case 'profile':
						$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_profile');
						$setting->set('value', $value);
						$setting->save();
						break;
					case 'cachetime':
						$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_cachetime');
						$setting->set('value', $value);
						$setting->save();
						break;
					case 'history':
						$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_history');
						$setting->set('value', $value);
						$setting->save();
						break;
				}
			}
			
			$this->modx->cacheManager->refresh(array('system_settings' => array()));
			$this->modx->cacheManager->delete('googleanalytics-visits');
			$this->modx->cacheManager->delete('googleanalytics-traffic');
			$this->modx->cacheManager->delete('googleanalytics-trafficcompressed');
			$this->modx->cacheManager->delete('googleanalytics-devices');
			$this->modx->cacheManager->delete('googleanalytics-mobile');
			$this->modx->cacheManager->delete('googleanalytics-entrances');
			$this->modx->cacheManager->delete('googleanalytics-exists');
			$this->modx->cacheManager->delete('googleanalytics-search');
			$this->modx->cacheManager->delete('googleanalytics-sitesearch');
			$this->modx->cacheManager->delete('googleanalytics-profiles');
	
			return $this->success($this->modx->lexicon('googleanalytics.settings_saved'));
		}
	}

	return 'GoogleAnalyticsSettingsProcessor';

?>

<?php

	/**
	 * Google Analytics
	 *
	 * Copyright 2014 by Oene Tjeerd de Bruin <info@oetzie.nl>
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
	 
	require_once $this->modx->getOption('googleanalytics.core_path', null, $this->modx->getOption('core_path').'components/googleanalytics/').'/model/googleanalytics/googleanalytics.class.php';
			
	$this->googleAnalytics = new GoogleAnalytics($modx);

	foreach ($_POST as $key => $value) {
		switch ($key) {
			case 'profile':
				$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_profile');
				$setting->set('value', $value);
				$setting->save();
				break;
			case 'cachetime':
				$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_cachetime');
				$setting->set('value', $value);
				$setting->save();
				break;
			case 'history':
				$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_history');
				$setting->set('value', $value);
				$setting->save();
				break;
		}
	}

	$this->modx->cacheManager->refresh(array('system_settings' => array()));
	$this->modx->cacheManager->delete('googleanalytics-visits');
	$this->modx->cacheManager->delete('googleanalytics-traffic');
	$this->modx->cacheManager->delete('googleanalytics-traffic-compressed');
	$this->modx->cacheManager->delete('googleanalytics-devices');
	$this->modx->cacheManager->delete('googleanalytics-mobile');
	$this->modx->cacheManager->delete('googleanalytics-entrances');
	$this->modx->cacheManager->delete('googleanalytics-exists');
	$this->modx->cacheManager->delete('googleanalytics-search');
	$this->modx->cacheManager->delete('googleanalytics-site-search');
	$this->modx->cacheManager->delete('googleanalytics-profiles');
	
	//return $this->modx->error->success($this->modx->lexion('googleanalytics.settings_saved'));
	return $this->modx->error->success('googleanalytics.settings_saved');

?>