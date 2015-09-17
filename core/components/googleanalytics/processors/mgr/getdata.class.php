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

	class GoogleAnalyticsGetDataProcessor extends modProcessor {
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

			$this->setDefaultProperties(array(
				'data' 	=> 'visits',
				'limit'	=> 0
			));
			
			return parent::initialize();
		}

		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function process() {
			$data = $this->googleAnalytics->getData($this->getProperty('data'));
			
			if (0 != ($size = $this->getProperty('size'))) {
				$data = array_slice($data, 0, $size);
			}
			
			return $this->outputArray($data);
		}
	}

	return 'GoogleAnalyticsGetDataProcessor';

?>