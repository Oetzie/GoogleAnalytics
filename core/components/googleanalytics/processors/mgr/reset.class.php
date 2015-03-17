<?php

	/**
	 * Google Analytics 404
	 *
	 * Copyright 2014 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Google Analytics 404, a real estate property listings component
	 * for MODX Revolution.
	 *
	 * Google Analytics 404 is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Google Analytics 404 is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Google Analytics 404; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */
	 
	class GoogleAnalytics404ResetProcessor extends modObjectRemoveProcessor {
		/**
		 * @acces public.
		 * @var String.
		 */
		public $classKey = 'GoogleAnalytics404';
		
		/**
		 * @acces public.
		 * @var Array.
		 */
		public $languageTopics = array('googleanalytics:default');
		
		/**
		 * @acces public.
		 * @var String.
		 */
		public $objectType = 'googleanalytics.404';
		
		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function process() {
			$this->modx->removeCollection($this->classKey);
			
			return $this->outputArray(array());
		}
	}
	
	
	return 'GoogleAnalytics404ResetProcessor';
?>