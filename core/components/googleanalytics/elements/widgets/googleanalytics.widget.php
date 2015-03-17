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
		 * @return String.
		 */
		public function render() {
			require_once $this->modx->getOption('googleanalytics.core_path', null, $this->modx->getOption('core_path').'components/googleanalytics/').'/model/googleanalytics/googleanalytics.class.php';
			
			$this->googleAnalytics = new GoogleAnalytics($this->modx);
			
			$this->modx->controller->addLexiconTopic('googleanalytics:default');

			if (empty($this->googleAnalytics->config['token'])) {
				if (array_key_exists('token', $_GET)) {
					$token = trim($this->googleAnalytics->getSessionToken($_GET['token']));
					
					$setting = $this->modx->getObject('modSystemSetting', 'googleanalytics_token');
					$setting->set('value', $token);
					$setting->save();
					
					$this->googleAnalytics->config['token'] = $token;
					
					$this->modx->cacheManager->refresh(array('system_settings' => array()));
				}
				
				if (empty($this->googleAnalytics->config['token'])) {
					$this->modx->smarty->assign('authUrl', $this->googleAnalytics->getApiUrl(GoogleAnalytics::URL_AUTH, array('url' => rtrim($this->modx->getOption('site_url'), '/').$this->modx->getOption('manager_url'))));
					$this->modx->smarty->assign('_lang', $this->modx->lexicon->fetch($prefix = 'googleanalytics.', $removePrefix = true));
				
					if ($this->modx->hasPermission('administrator')) {
						return $this->modx->smarty->fetch($this->googleAnalytics->config['templatesPath'].'auth.tpl');
					}
				}
				
				return '';
			}
			
			if ('' != $this->googleAnalytics->config['web_property_id']) {
				$this->widget->name = $this->modx->lexicon('googleanalytics.title', array(
					'profile'		=> $this->googleAnalytics->config['profile_name'],
					'profile_id'	=> $this->googleAnalytics->config['web_property_id']
				));
			}

			$this->modx->regClientCSS($this->googleAnalytics->config['cssUrl'].'mgr/googleanalytics.css');
			$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/googleanalytics.js');
			$this->modx->regClientStartupHTMLBlock('<script type="text/javascript">
				Ext.onReady(function() {
					MODx.config.help_url = "http://rtfm.modx.com/extras/revo/'.$this->googleAnalytics->getHelpUrl().'";
				
					GoogleAnalytics.config = '.$this->modx->toJSON(array_merge(array('admin' => $this->googleAnalytics->hasPermission()), $this->googleAnalytics->config)).';
				});
			</script>');
			$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/widgets/home.grid.js');
			$this->modx->regClientStartupScript($this->googleAnalytics->config['jsUrl'].'mgr/widgets/home.panel.js');
				
			return $this->modx->smarty->fetch($this->googleAnalytics->config['templatesPath'].'home.tpl');
	    }
	}
	
	return 'modDashboardWidgetGoogleAnalytics';
	
?>