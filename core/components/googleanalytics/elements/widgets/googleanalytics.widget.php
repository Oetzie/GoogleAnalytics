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

	class modDashboardWidgetGoogleAnalytics extends modDashboardFileWidget {
		/**
		 * @acces public.
		 * @var Object.
		 */
		public $googleAnalytics;
		
		/**
		 * @acces public.
		 * @var String.
		 */
		public $cssBlockClass = 'dashboard-google-analytics';
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function render() {
			require_once $this->modx->getOption('googleanalytics.core_path', null, $this->modx->getOption('core_path').'components/googleanalytics/').'/model/googleanalytics/googleanalytics.class.php';
			
			$this->googleAnalytics = new GoogleAnalytics($this->modx);
			
			$this->modx->controller->addLexiconTopic('googleanalytics:default');
			
			$this->modx->regClientCSS($this->googleAnalytics->config['cssUrl'].'mgr/googleanalytics.css');
			$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/googleanalytics.js');
			$this->modx->regClientStartupHTMLBlock('<script type="text/javascript">
				Ext.onReady(function() {
					MODx.config.help_url = "http://rtfm.modx.com/extras/revo/'.$this->googleAnalytics->getHelpUrl().'";
				
					GoogleAnalytics.config = '.$this->modx->toJSON(array_merge(array('admin' => $this->googleAnalytics->hasPermission(), 'authUrl' => $this->googleAnalytics->getAuthUrl()), $this->googleAnalytics->config)).';
				});
			</script>');

			if (empty($this->googleAnalytics->config['token'])) {
				$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/widgets/auth.panel.js');
					
				$this->modx->smarty->assign('authUrl', $this->googleAnalytics->getAuthUrl());
				$this->modx->smarty->assign('_lang', $this->modx->lexicon->fetch($prefix = 'googleanalytics.', $removePrefix = true));
				
				if ($this->modx->hasPermission('administrator')) {
					return $this->modx->smarty->fetch($this->googleAnalytics->config['templatesPath'].'auth.tpl');
				} else {
					return '';
				}
			}
			
			if ('' != $this->googleAnalytics->config['profileId']) {
				$this->widget->name = $this->modx->lexicon('googleanalytics.title', array(
					'profile'		=> $this->googleAnalytics->config['profileName'],
					'profile_id'	=> $this->googleAnalytics->config['profileId']
				));
			}

			$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/widgets/home.grid.js');
			$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/widgets/home.panel.js');
				
			return $this->modx->smarty->fetch($this->googleAnalytics->config['templatesPath'].'home.tpl');
	    }
	}
	
	return 'modDashboardWidgetGoogleAnalytics';
	
?>