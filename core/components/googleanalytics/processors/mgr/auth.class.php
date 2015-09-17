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

	class GoogleAnalyticsAuthProcessor extends modProcessor {
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
			
			foreach ($this->getProperties() as $key => $value) {
				switch($key) {
					case 'revoke':
						if ($this->googleAnalytics->revokeAuthToken()) {
							if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_refresh_token'))) {
								$setting->set('value', '');
								$setting->save();
							}
							
							if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_profile_id'))) {
								$setting->set('value', '');
								$setting->save();
							}
							
							if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_profile_name'))) {
								$setting->set('value', '');
								$setting->save();
							}
							
							$this->modx->getCacheManager()->delete('googleanalytics-token', $this->googleAnalytics->config['cacheOptions']);
							$this->modx->getCacheManager()->refresh(array('system_settings' => array()));
							
							return $this->success($this->modx->lexicon('googleanalytics.auth_revoke_success'));
						}
						
						$this->modx->getCacheManager()->delete('googleanalytics-token', $this->googleAnalytics->config['cacheOptions']);
						$this->modx->getCacheManager()->refresh(array('system_settings' => array()));
						
						return $this->failure($this->modx->lexicon('googleanalytics.auth_revoke_failure'));
							
						break;
					case 'code':
						if (false !== ($token = $this->googleAnalytics->getAuthToken($value))) {
							if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_refresh_token'))) {
								$setting->set('value', trim($token['refresh_token']));
						
								if ($setting->save()) {
									$this->modx->getCacheManager()->set('googleanalytics-token', trim($token['access_token']), trim($token['expires_in']), $this->googleAnalytics->config['cacheOptions']);
									$this->modx->getCacheManager()->refresh(array('system_settings' => array()));
									
									return $this->success($this->modx->lexicon('googleanalytics.auth_success'));
								}
							}
						}
						
						$this->modx->getCacheManager()->refresh(array('system_settings' => array()));
						
						return $this->failure($this->modx->lexicon('googleanalytics.auth_failure'));
						
						break;
				}
			}
		}
	}

	return 'GoogleAnalyticsAuthProcessor';

?>