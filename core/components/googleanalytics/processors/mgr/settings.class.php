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
					case 'profile':
						$values = explode(':', $value);
						
						if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_profile_id'))) {
							$setting->set('value', array_shift($values));
							$setting->save();
						}
							
						if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_profile_name'))) {
							$setting->set('value', array_shift($values));
							$setting->save();
						}
						
						break;
					case 'cachetime':
						if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_cachetime'))) {
							$setting->set('value', $value);
							$setting->save();
						}
						
						break;
					case 'history':
						if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_history'))) {
							$setting->set('value', $value);
							$setting->save();
						}
						
						break;
					case 'panels':
						if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_panels'))) {
							$setting->set('value', implode(array_merge($value, array('summary', 'settings')), ','));
							$setting->save();
						}
						
						break;
				}
			}
			
			$this->modx->getCacheManager()->refresh(array('system_settings' => array()));
			$this->modx->getCacheManager()->delete('googleanalytics-visits', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-visiters', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-meta', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-traffic', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-traffic-compressed', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-devices', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-operatingsystems', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-entrances', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-exists', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-search', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-sitesearch', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-realtime', $this->googleAnalytics->config['cacheOptions']);
			$this->modx->getCacheManager()->delete('googleanalytics-profiles', $this->googleAnalytics->config['cacheOptions']);
	
			return $this->success($this->modx->lexicon('googleanalytics.settings_saved'));
		}
	}

	return 'GoogleAnalyticsSettingsProcessor';

?>