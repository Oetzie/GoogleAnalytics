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
		const URL_AUTH 			= 'https://www.google.com/accounts/AuthSubRequest?next={url}&scope=https://www.google.com/analytics/feeds/&secure=0&session=1';
		const URL_TOKEN			= 'https://www.google.com/accounts/AuthSubSessionToken';
		const URL_VISITS		= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:date&metrics=ga:visits,ga:visitors,ga:pageviews,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:percentNewVisits,ga:visitBounceRate&sort=ga:date';
		const URL_TRAFFIC		= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:source&metrics=ga:visits,ga:visitors,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:percentNewVisits,ga:visitBounceRate&sort=-ga:visits';
		const URL_DEVICES		= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:operatingSystem&metrics=ga:visits&sort=ga:visits';
		const URL_MOBILE		= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:isMobile&metrics=ga:visits&sort=ga:visits';
		const URL_ENTRANCES		= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:pagePath&metrics=ga:entrances,ga:bounces,ga:entranceBounceRate,ga:exits&sort=-ga:entrances';
		const URL_EXITS			= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:pagePath&metrics=ga:exits,ga:pageviews,ga:exitRate&sort=-ga:exits';
		const URL_SEARCH		= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:keyword&metrics=ga:visits,ga:pageviewsPerVisit,ga:avgTimeOnSite,ga:percentNewVisits,ga:visitBounceRate&sort=-ga:visits';
		const URL_SITESEARCH 	= 'https://www.google.com/analytics/feeds/data?ids=ga:{profile_id}&start-date={start_date}&end-date={end_date}&dimensions=ga:searchKeyword&metrics=ga:searchUniques,ga:searchResultViews,ga:searchExitRate,ga:searchDuration,ga:searchDepth&sort=-ga:searchUniques';
		const URL_PROFILES		= 'https://www.googleapis.com/analytics/v2.4/management/accounts/~all/webproperties/~all/profiles';
		
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

			$siteProfile = $this->modx->fromJSON($this->modx->getOption('googleanalytics_profile', $config));

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
				'token'					=> trim($this->modx->getOption('googleanalytics_token', $config)),
				'cachetime'				=> trim($this->modx->getOption('googleanalytics_cachetime', $config)),
				'history'				=> trim($this->modx->getOption('googleanalytics_history', $config, 7)),
				'profile'				=> trim($this->modx->getOption('title', $siteProfile)),
				'profile_id'			=> trim($this->modx->getOption('profileid', $siteProfile)),
				'account_id'			=> trim($this->modx->getOption('accountid', $siteProfile)),
				'web_property_id'		=> trim($this->modx->getOption('webpropertyid', $siteProfile)),
				'profile_json'			=> trim($this->modx->getOption('googleanalytics_profile', $config)),
				'start_date'			=> date('Y-m-d', strtotime('-'.($this->modx->getOption('googleanalytics_history', $config, 7) - 1).' day', time())),
				'end_date' 				=> date('Y-m-d'),
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
		 * @param String $url.
		 * @return Mixed.
		 */
		public function getSessionToken($token) {
			$output = $this->getCallApi($token, self::URL_TOKEN);
			
			if (preg_match('/Token=(.*)/', $output, $matches)) {
				return $matches[1];
			}
			
			return false;
		}
		
		/**
		 * @acces public.
		 * @param string $sessionToken
		 * @param string $url
		 * @return Mixed.
    	 */
		public function getCallApi($token, $url) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(sprintf("Authorization: AuthSub token=\"%s\"/n", $token)));
			
			$output = curl_exec($ch);
			
			curl_close($ch);
			
			return $output;
	    }
		
		/**
		 * @acces public.
		 * @param String $url.
		 * @param Array $params.
		 * @return String.
		 */
		public function getApiUrl($url, $params = array()) {
			$params = array_merge(array(
				'profile_id'	=> $this->config['profile_id'],
				'start_date'	=> $this->config['start_date'],
				'end_date'		=> $this->config['end_date']
			), $params);
			
			if (preg_match_all('/{(.+?)}/si', $url, $matches)) {
				foreach ($matches[0] as $key => $value) {
					if (array_key_exists($matches[1][$key], $params)) {
						$url = str_replace($value, $params[$matches[1][$key]], $url);
					} else {
						$url = str_replace($value, '', $url);
					}
				}
			}
			
			return $url;
		}
		
		/**
		 * @acces public.
		 * @param String $type.
		 * @param String $url.
		 * @return Array.
		 */
		public function getData($type, $url = null) {
			switch ($type) {
				case 'profiles':
					$output = $this->getDataProfiles();
					break;
				case 'trafficcompressed':
					$output = $this->getDataTraffic();
					break;
				default:
					$output = $this->getDataType($type, $url);
					break;
			}
			
			return $output;
		}
		
		/**
		 * @acces public.
		 * @return Array.
		 */
		public function getDataType($type, $url = null) {
			$types = array(
				'visits' 		=> self::URL_VISITS,
				'traffic'		=> self::URL_TRAFFIC,
				'devices' 		=> self::URL_DEVICES,
				'mobile' 		=> self::URL_MOBILE,
				'entrances' 	=> self::URL_ENTRANCES,
				'exits' 		=> self::URL_EXITS,
				'search' 		=> self::URL_SEARCH,
				'sitesearch' 	=> self::URL_SITESEARCH
			);
			
			$url = array_key_exists($type, $types) ? $types[$type] : $url;

			$output = $this->modx->cacheManager->get('googleanalytics-'.$type);
				
			if (empty($output)) {
				$output = $this->parseData($this->getCallApi($this->config['token'], $this->getApiUrl($url)));
				
				$this->modx->cacheManager->set('googleanalytics-'.$type, $output, $this->config['cachetime']);
			}
			
			return $output;
		}
		
				/**
		 * @acces public.
		 * @return Array.
		 */
		public function getDataTraffic() {
			$output = $this->modx->cacheManager->get('googleanalytics-trafficcompressed');
			
			if (empty($output)) {
				$compress = $output = $this->getDataType('traffic');
				
				if (!empty($compress)) {
					$output = array(
						array('name' => $this->modx->lexicon('googleanalytics.sources_searchengine'), 'visits' => 0),
						array('name' => $this->modx->lexicon('googleanalytics.sources_direct'), 'visits' => 0),
						array('name' => $this->modx->lexicon('googleanalytics.sources_reference'), 'visits' => 0)
					);
					
					foreach ($compress as $key => $value) {
						switch ($value['source']) {
							case 'google':
							case 'search':
								$output[0]['visits'] += (int) $value['visits'];
								break;
							case '(direct)':
								$output[1]['visits'] += (int) $value['visits'];
								break;
							default:
								$output[2]['visits'] += (int) $value['visits'];
								break;
						}
					}
				}

				$this->modx->cacheManager->set('googleanalytics-trafficcompressed', $output, $this->config['cachetime']);
			}
			
			return $output;
		}
		
		/**
		 * @acces public.
		 * @return Array.
		 */
		public function getDataProfiles() {
			$output = $this->modx->cacheManager->get('googleanalytics-profiles');
			
			if (empty($output)) {
				$output = array();
				
				$dom = new DOMDocument();
				$dom->loadXML($this->getCallApi($this->config['token'], self::URL_PROFILES));
		    
				foreach ($dom->getElementsByTagName('entry') as $key => $value) {
					$output[$key] = array(
						'id'	=> $value->getElementsByTagName('id')->item(0)->nodeValue,
						'title'	=> $value->getElementsByTagName('title')->item(0)->nodeValue,
					);
		
				    foreach ($value->getElementsByTagName('property') as $property) {
						$name = $property->getAttribute('name');
					    		
					    $output[$key] = array_merge($output[$key], array(
							strtolower(substr($name, strrpos($name, ':') + 1, strlen($name))) => $property->getAttribute('value')
						));
					}
					
					$output[$key] = array_merge($output[$key], array(
						'json' => $this->modx->toJSON($output[$key])
					));
				}
				
				$this->modx->cacheManager->set('googleanalytics-profiles', $output, $this->config['cachetime']);
			}
			
			return $output;
		}
		
		/**
		 * @acces protected.
		 * @param String $xml.
		 * @return Array.
		 */
		protected function parseData($xml) {
			$output = array();
			
			$doc = new DOMDocument();
			$doc->loadXML($xml);

			foreach ($doc->getElementsByTagName('entry') as $key => $value) {
				$output[$key] = array();
				
				foreach ($value->getElementsByTagName('dimension') as $dimension) {
					switch ($dimension->getAttribute('name')) {
						case 'ga:isMobile':
							$type = array(
								'yes' 	=> $this->modx->lexicon('googleanalytics.sources_mobile'), 
								'no' 	=> $this->modx->lexicon('googleanalytics.sources_desktop')
							);
							
							$dimensionValue = $type[strtolower($dimension->getAttribute('value'))];
							break;
						case 'ga:date':
							$dimensionValue = date($this->modx->getOption('manager_date_format'), strtotime($dimension->getAttribute('value')));
							break;
						default:
							$dimensionValue = $dimension->getAttribute('value');
							break;
					}
					
					$output[$key] = array_merge($output[$key], array(
						ltrim($dimension->getAttribute('name'), 'ga:') => $dimensionValue
					));
				}
	
				foreach ($value->getElementsByTagName('metric') as $metric) {
					switch ($metric->getAttribute('name')) {
						case 'ga:avgTimeOnSite':
							$metricValue = $this->secondMinute($metric->getAttribute('value'));
							break;
						default:
							$metricValue = $metric->getAttribute('value');
							break;
					}
					
					$output[$key] = array_merge($output[$key], array(
						ltrim($metric->getAttribute('name'), 'ga:') => $metricValue
					));
				}
			}
			
			return $output;
	    }
	    
	    /**
	     * @acces protected.
	     * @param Integer $seconds
	     * @return String
	     */
	    protected function secondMinute($seconds) {
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