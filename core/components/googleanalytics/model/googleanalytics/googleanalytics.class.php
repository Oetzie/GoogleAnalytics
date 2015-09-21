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

	class GoogleAnalytics {
		const URL_AUTH 			= 'https://accounts.google.com/o/oauth2/auth';
		const URL_TOKEN			= 'https://accounts.google.com/o/oauth2/token';
		const URL_TOKEN_REVOKE	= 'https://accounts.google.com/o/oauth2/revoke';
		const URL_PROFILES		= 'https://www.googleapis.com/analytics/v3/management/accounts/~all/webproperties/~all/profiles';
		const URL_DATA			= 'https://www.googleapis.com/analytics/v3/data/ga';
		const URL_DATA_RT		= 'https://www.googleapis.com/analytics/v3/data/realtime';
		
		/**
		 * @acces public.
		 * @var Object.
		 */
		public $modx;
		
		/**
		 * @acces public.
		 * @var Array.
		 */
		public $config = array();
		
		/**
		 * @acces public.
		 * @param Object $modx.
		 * @param Array $config.
		 */
		function __construct(modX &$modx, array $config = array()) {
			$this->modx =& $modx;
		
			$corePath 		= $this->modx->getOption('googleanalytics.core_path', $config, $this->modx->getOption('core_path').'components/googleanalytics/');
			$assetsUrl 		= $this->modx->getOption('googleanalytics.assets_url', $config, $this->modx->getOption('assets_url').'components/googleanalytics/');
			$assetsPath 	= $this->modx->getOption('googleanalytics.assets_path', $config, $this->modx->getOption('assets_path').'components/googleanalytics/');

			$this->modx->lexicon->load('googleanalytics:default');
			
			$this->config = array_merge(array(
				'basePath'				=> $corePath,
				'corePath' 				=> $corePath,
				'modelPath' 			=> $corePath.'model/',
				'processorsPath' 		=> $corePath.'processors/',
				'elementsPath' 			=> $corePath.'elements/',
				'chunksPath' 			=> $corePath.'elements/chunks/',
				'snippetsPath' 			=> $corePath.'elements/snippets/',
				'templatesPath' 		=> $corePath.'templates/',
				'assetsPath' 			=> $assetsPath,
				'jsUrl' 				=> $assetsUrl.'js/',
				'cssUrl' 				=> $assetsUrl.'css/',
				'assetsUrl' 			=> $assetsUrl,
				'connectorUrl'			=> $assetsUrl.'connector.php',
				'helpurl'				=> 'googleanalytics',
				'cacheOptions'			=> array(
					xPDO::OPT_CACHE_KEY 	=> 'googleanalytics'
				),
				'token'					=> $this->modx->getOption('googleanalytics_refresh_token', $config),
				'cachetime'				=> $this->modx->getOption('googleanalytics_cachetime', $config),
				'history'				=> $this->modx->getOption('googleanalytics_history', $config, 7),
				'profile'				=> implode(array_filter(array($this->modx->getOption('googleanalytics_profile_id', $config), $this->modx->getOption('googleanalytics_profile_name', $config))), ':'),
				'profileId'				=> $this->modx->getOption('googleanalytics_profile_id', $config),
				'profileName'			=> $this->modx->getOption('googleanalytics_profile_name', $config),
				'panels'				=> explode(',', $this->modx->getOption('googleanalytics_panels', $config)),
				'startDate'				=> date('Y-m-d', strtotime('-'.($this->modx->getOption('googleanalytics_history', $config, 7) - 1).' day', time())),
				'endDate' 				=> date('Y-m-d'),
				'apiClientId'			=> $this->modx->getOption('googleanalytics_client_id', $config),
				'apiClientSecret'		=> $this->modx->getOption('googleanalytics_client_secret', $config),
				'apiRedirectUri'		=> 'urn:ietf:wg:oauth:2.0:oob',
				'apiScope'				=> 'https://www.googleapis.com/auth/analytics.readonly',
				'context'				=> 2 == $this->modx->getCount('modContext') ? 0 : 1
			), $config);
		
			$this->modx->addPackage('googleanalytics', $this->config['modelPath']);
		}
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function getHelpUrl() {
			return $this->config['helpurl'];
		}
		
		/**
		 * @acces public.
		 * @return Boolean.
		 */
		public function hasPermission() {
			$usergroups = $this->modx->getOption('googleanalytics_admin_groups', null, 'Administrator');
			
			$isMember = $this->modx->user->isMember(explode(',', $usergroups), false);
			
			if (!$isMember) {
				$version = $this->modx->getVersionData();
				
				if (version_compare($version['full_version'], '2.2.1-pl') == 1) {
					$isMember = (bool) $this->modx->user->get('sudo');
				}
			}
			
			return $isMember;
		}
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function getAuthUrl() {
			return $this->getApiUrl(GoogleAnalytics::URL_AUTH, array(
				'response_type'	=> 'code',
				'client_id' 	=> $this->config['apiClientId'],
				'redirect_uri' 	=> $this->config['apiRedirectUri'],
				'scope'			=> $this->config['apiScope']
			));	
		}
		
		/**
		 * @acces public.
		 * @param String $code.
		 * @return Boolean.
		 */
		public function getAuthToken($code) {
			$sessionData = $this->getCallApi(self::URL_TOKEN, array(
				'code' 			=> $code,
				'client_id' 	=> $this->config['apiClientId'],
				'client_secret' => $this->config['apiClientSecret'],
				'redirect_uri'	=> $this->config['apiRedirectUri'],
				'grant_type' 	=> 'authorization_code'
			), true);
			
			if (null !== ($session = json_decode($sessionData, true))) {
				if (false !== $this->modx->getOption('access_token', $session, false)) {
					return $session;
				}
			}
			
			return false;
		}
		
		/**
		 * @acces public.
		 * @return Boolean.
		 */
		public function refreshAuthToken() {
			$sessionData = $this->getCallApi(self::URL_TOKEN, array(
				'refresh_token' 	=> $this->config['token'],
				'client_id' 		=> $this->config['apiClientId'],
				'client_secret' 	=> $this->config['apiClientSecret'],
				'redirect_uri'		=> $this->config['apiRedirectUri'],
				'grant_type' 		=> 'refresh_token'
			), true);
			
			if (null !== ($session = json_decode($sessionData, true))) {
				if (false !== $this->modx->getOption('access_token', $session, false)) {
					$this->modx->getCacheManager()->set('googleanalytics-token', trim($session['access_token']), trim($session['expires_in']), $this->googleAnalytics->config['cacheOptions']);
				
					return $session['access_token'];
				}
			}
			
			return false;
		}
		
		/**
		 * @acces public.
		 * @return Boolean.
		 */
		public function revokeAuthToken() {
			$sessionData = $this->getCallApi(self::URL_TOKEN_REVOKE, array(
				'token'	=> $this->config['token']
			));
			
			return true;
		}
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function getAuthTokenParam() {
			$token = $this->modx->getCacheManager()->get('googleanalytics-token', $this->config['cacheOptions']);
			
			if (empty($accessToken)) {
           		$token = $this->refreshAuthToken();
        	}
        	
        	return $token;
		}
		
		/**
		 * @acces private.
		 * @param String $url.
		 * @param Array $params.
		 * @return String.
		 */
		private function getApiUrl($url, $params = array()) {
			if (empty($params)) {
				return $url;
			}
			
			array_walk($params, function(&$value, $key) {
				$value = $key.'='.$value;
			});


			return $url.'?'.implode($params, '&');
		}
		
		/**
		 * @acces private.
		 * @param String $url.
		 * @param Array $params.
		 * @param Boolean $post.
		 * @return String.
		 */
		private function getCallApi($url, $params = array(), $post = false) {
			$ch = curl_init();

			if ($post) {
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				curl_setopt($ch, CURLOPT_URL, $url);
			} else {
				curl_setopt($ch, CURLOPT_URL, $this->getApiUrl($url, $params));
			}
			
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$output = curl_exec($ch);

			curl_close($ch);
			
			return $output;
		}
		
		/**
		 * @acces public.
		 * @param String $type.
		 * @return Array.
		 */
		public function getData($type) {
			$output = $this->modx->getCacheManager()->get('googleanalytics-'.$type, $this->config['cacheOptions']);
			
			if (empty($output) || $type == 'realtime') {
				switch ($type) {
					case 'profiles':
						$output = $this->getDataProfiles();
					
						break;
					case 'meta':
						$output = $this->getDataMeta();
						
						break;
					case 'traffic-compressed':
						$output = $this->getDataTrafficCompressed();
					
						break;
					default:
						$url = self::URL_DATA;
						
						$params = array();
				
						switch ($type) {
							case 'visits':
								$params = array(
									'metrics'		=> 'ga:visits,ga:visitors,ga:pageviews,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:percentNewVisits,ga:visitBounceRate',
									'dimensions'	=> 'ga:date',
									'sort'			=> 'ga:date'
								);
						
								break;
							case 'visiters':
								$params = array(
									'metrics'		=> 'ga:visits',
									'dimensions'	=> 'ga:visitorType',
									'sort'			=> 'ga:visits'
								);
						
								break;
							case 'traffic':
								$params = array(
									'metrics'		=> 'ga:visits,ga:visitors,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:percentNewVisits,ga:visitBounceRate',
									'dimensions'	=> 'ga:source',
									'sort'			=> '-ga:visits'
								);
						
								break;
							case 'devices':
								$params = array(
									'metrics'		=> 'ga:visits',
									'dimensions'	=> 'ga:deviceCategory',
									'sort'			=> 'ga:visits'
								);
						
								break;
							case 'operatingsystems':
								$params = array(
									'metrics'		=> 'ga:visits',
									'dimensions'	=> 'ga:operatingSystem',
									'sort'			=> 'ga:visits'
								);
					
								break;
							case 'entrances':
								$params = array(
									'metrics'		=> 'ga:entrances,ga:bounces,ga:entranceBounceRate,ga:exits',
									'dimensions'	=> 'ga:pagePath',
									'sort'			=> '-ga:entrances'
								);
						
								break;
							case 'exits':
								$params = array(
									'metrics'		=> 'ga:exits,ga:bounces,ga:pageviews,ga:exitRate',
									'dimensions'	=> 'ga:pagePath',
									'sort'			=> '-ga:exits'
								);
						
								break;
							case 'search':
								$params = array(
									'metrics'		=> 'ga:visits,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:percentNewVisits,ga:visitBounceRate',
									'dimensions'	=> 'ga:keyword',
									'sort'			=> '-ga:visits'
								);
						
								break;
							case 'sitesearch':
								$params = array(
									'metrics'		=> 'ga:searchUniques,ga:searchResultViews,ga:searchExitRate,ga:searchDuration,ga:searchDepth',
									'dimensions'	=> 'ga:searchKeyword',
									'sort'			=> '-ga:searchUniques'
								);
					
								break;
							case 'realtime':
								$url = self::URL_DATA_RT;
								
								$params = array(
									'metrics'		=> 'rt:activeUsers',
									'dimensions'	=> 'rt:userType'
								);
								
								break;
						}

						$output = $this->parseData($this->getCallApi($url, array_merge($params, array(
							'ids'			=> 'ga:'.$this->config['profileId'],
							'start-date'	=> $this->config['startDate'],
							'end-date'		=> $this->config['endDate'],
							'access_token'	=> $this->getAuthTokenParam()
						))));
				}
				
				$this->modx->getCacheManager()->set('googleanalytics-'.$type, $output, $this->config['cachetime'], $this->config['cacheOptions']);
			}
			
			return $output;
		}
		
		/**
		 * @acces private.
		 * @param String $sessionData.
		 * @return Array.
		 */
		private function parseData($sessionData) {
			$output = array();
			
			if (null !== ($data = json_decode($sessionData, true))) {
				if (isset($data['rows'])) {
					foreach ($data['rows'] as $key => $value) {
						$row = array();
								
						foreach ($value as $subKey => $subValue) {
							$name = $data['columnHeaders'][$subKey]['name'];
									
							switch ($name) {
								case 'ga:visitorType':
									$translations = array(
										'new visitor'		=> $this->modx->lexicon('googleanalytics.visitors_new'),
										'returning visitor'	=> $this->modx->lexicon('googleanalytics.visitors_returning')
									);
									
									$row[end(explode(':', $name))] = $translations[strtolower($subValue)];
									
									break;
								case 'ga:deviceCategory':
									$translations = array(
										'tablet'			=> $this->modx->lexicon('googleanalytics.visitors_devices_tablet'),
										'mobile'			=> $this->modx->lexicon('googleanalytics.visitors_devices_mobile'),
										'desktop'			=> $this->modx->lexicon('googleanalytics.visitors_devices_desktop')
									);
									
									$row[end(explode(':', $name))] = $translations[strtolower($subValue)];
									
									break;
								case 'ga:date':
									$row[end(explode(':', $name))] = date($this->modx->getOption('manager_date_format'), strtotime($subValue));
											
									break;
								case 'ga:avgTimeOnSite':
									$row[end(explode(':', $name))] = $this->timeFormat($subValue);
											
									break;
								default:
									$row[end(explode(':', $name))] = $subValue;
											
									break;
							}
						}
								
						$output[] = $row;
					}
				}
			}
					
			return $output;
		}
		
		/**
		 * @acces private.
		 * @return Array.
		 */
		private function getDataProfiles() {
			$output = array();
				
			$call = $this->getCallApi(self::URL_PROFILES, array(
				'access_token' => $this->getAuthTokenParam()
			));
				
			if (null !== ($data = json_decode($call, true))) {
				foreach ($data['items'] as $key => $value) {
					$output[$key] = array(
						'id'			=> $value['id'],
						'account_id'	=> $value['accountId'],
						'property_id'	=> $value['webPropertyId'],
						'name'			=> $value['name'],
						'url'			=> $value['websiteUrl'],
						'value'			=> $value['id'].':'.$value['name']
					);
				}
			}
			
			return $output;
		}
		
		/**
		 * @acces private.
		 * @return Array.
		 */
		private function getDataMeta() {
			$output = array();

			$dates = array(
				'oldData'	=> array(
					'startDate'				=> date('Y-m-d', strtotime('-'.(($this->modx->getOption('googleanalytics_history', $config, 7) * 2) - 1).' day', time())),
					'endDate' 				=> date('Y-m-d', strtotime('-'.$this->modx->getOption('googleanalytics_history', $config, 7).' day', time())),
					'totalsForAllResults'	=> array()
				),
				'newData' 	=> array(
					'startDate'				=> $this->config['startDate'],
					'endDate'				=> $this->config['endDate'],
					'totalsForAllResults'	=> array()
				)
			);
			
			foreach ($dates as $key => $date) {
				$call = $this->getCallApi(self::URL_DATA, array(
					'metrics'		=> 'ga:visits,ga:visitors,ga:pageviews,ga:uniquePageviews,ga:percentNewVisits,ga:exitRate,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:visitBounceRate',
					'dimensions'	=> 'ga:date',
					'sort'			=> 'ga:date',
					'ids'			=> 'ga:'.$this->config['profileId'],
					'start-date'	=> $date['startDate'],
					'end-date'		=> $date['endDate'],
					'access_token'	=> $this->getAuthTokenParam()
				));
				
				if (null !== ($data = json_decode($call, true))) {
					$dates[$key]['totalsForAllResults'] = $data['totalsForAllResults'];
				}
			}
			
			if (!empty($dates['oldData']['totalsForAllResults']) && !empty($dates['newData']['totalsForAllResults'])) {
				foreach($dates['newData']['totalsForAllResults'] as $key => $value) {
					$progression = round(((int) $value - (int) $dates['oldData']['totalsForAllResults'][$key]) / ((int) $value / 100), 1);
		
					if (0 == $progression) {
						$newValue = array(
							'progression'		=> '0',
							'progressionCls'	=> 'equal'	
						);
					} else if (0 < $progression) {
						$newValue = array(
							'progression'		=> '+'.$progression,
							'progressionCls'	=> 'up'	
						);
					} else if (0 > $progression) {
						$newValue = array(
							'progression'		=> $progression,
							'progressionCls'	=> 'down'	
						);
					}
					
					switch ($key) {
						case 'ga:visits':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.visits'),
								'value'		=> round($value, 0)	
							));
							
							break;
						case 'ga:visitors':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.visitors'),
								'value'		=> round($value, 0)	
							));
						
							break;
						case 'ga:pageviews':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.pageviews'),
								'value'		=> round($value, 0)	
							));
							
							break;
						case 'ga:uniquePageviews':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.pageviews_unique'),
								'value'		=> round($value, 0)	
							));
							
							break;
						case 'ga:exitRate':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.exitrate'),
								'value'		=> round($value, 0).'%'
							));
							
							break;
						case 'ga:avgTimeOnSite':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.time_on_site'),
								'value'		=> $this->timeFormat($value)	
							));
							
							break;
						case 'ga:percentNewVisits':
							$output[] = array_merge($newValue, array(
								'name' 		=> $this->modx->lexicon('googleanalytics.visits_new'),
								'value'		=> round($value, 0).'%'	
							));
							
							break;
						case 'ga:visitBounceRate':
							$output[] = array_merge($newValue, array(
								'name' 				=> $this->modx->lexicon('googleanalytics.bouncerate'),
								'value'				=> round($value, 0).'%'		
							));

							break;
					}
				}
			}
			
			return array_chunk($output, 4);
		}
		
		/**
		 * @acces private.
		 * @return Array.
		 */
		private function getDataTrafficCompressed() {
			$output = array(
				array(
					'name' 		=> $this->modx->lexicon('googleanalytics.sources_searchengine'),
					'visits' 	=> 0
				),
				array(
					'name' 		=> $this->modx->lexicon('googleanalytics.sources_direct'),
					'visits' 	=> 0
				),
				array(
					'name' 		=> 'Facebook',
					'visits' 	=> 0
				),
				array(
					'name' 		=> $this->modx->lexicon('googleanalytics.sources_reference'),
					'visits' 	=> 0
				)
			);
						
			foreach ($this->getData('traffic') as $key => $value) {
				switch ($value['source']) {
					case 'bing':
					case 'yahoo':
					case 'google':
					case 'search':
						$output[0]['visits'] += (int) $value['visits'];
									
						break;
					case '(direct)':
						$output[1]['visits'] += (int) $value['visits'];
								
						break;
					case 'm.facebook.com':
					case 'facebook.com':
					case 'l.facebook.com':
					case 'lm.facebook.com':
						$output[2]['visits'] += (int) $value['visits'];
								
						break;
					default:
						$output[3]['visits'] += (int) $value['visits'];
									
						break;
				}
			}
				
			return $output;
		}
			    
	    /**
	     * @acces private.
	     * @param Integer $seconds
	     * @return String
	     */
	    private function timeFormat($seconds) {
        	$minResult = floor($seconds / 60);

        	if ($minResult < 10) {
        		$minResult = 0 . $minResult;
        	}

			$secResult = ($seconds / 60 - $minResult) * 60;
			$secResult = round($secResult);
			
			if ($secResult < 10) {
				$secResult = 0 . $secResult;
			}

			return $minResult.':'.$secResult;
		}
		
		/**
		 * @acces public.
		 * @return Boolean.
		 */
		public function setGoogleAnalytics404() {
			$criteria = array(
				'context'	=> $this->modx->context->key,
				'url'		=> $_SERVER['REQUEST_URI'],
				'referer'	=> '' == $_SERVER['HTTP_REFERER'] ? '(direct)' : $_SERVER['HTTP_REFERER']
			);
			
			if (null === ($report = $this->modx->getObject('GoogleAnalytics404', $criteria))) {
				$report = $this->modx->newObject('GoogleAnalytics404');
			}
			
			if (null !== $report) {
				$report->fromArray(array_merge($criteria, array(
					'hits' 		=> $report->hits + 1
				)));
	
				return $report->save();
			}
			
			return true;
		}
	}
	
?>