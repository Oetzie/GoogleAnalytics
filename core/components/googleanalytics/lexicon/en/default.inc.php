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

	$_lang['googleanalytics'] 								= 'Google Analytics';
	$_lang['googleanalytics.desc'] 							= 'Google Analytics dashboard widget shows the results and statistics from your Google Analytics account.';
	
	$_lang['area_googleanalytics']							= 'Google Analytics';
	
	$_lang['setting_googleanalytics_admin_groups']			= 'Usergroups';
	$_lang['setting_googleanalytics_admin_groups_desc']		= 'The usergroups that are allowed to acces the admin panel of the settings, to separate usergroups use a comma.';
	$_lang['setting_googleanalytics_refresh_token']			= 'Google refresh token';
	$_lang['setting_googleanalytics_refresh_token_desc']	= 'The Google Analytics refresh token that allows MODX to access Google Analytics.';
	$_lang['setting_googleanalytics_client_id']				= 'Google authorization ID';
	$_lang['setting_googleanalytics_client_id_desc']		= 'The Google authorization ID (Client ID) for the acces to the Google API\'s. You can get this at https://console.developers.google.com/.';
	$_lang['setting_googleanalytics_client_secret']			= 'Google secret authorization';
	$_lang['setting_googleanalytics_client_secret_desc']	= 'The Google secret authorization (Client Secret) for the acces to the Google API\'s. You can get this at https://console.developers.google.com/.';
	$_lang['setting_googleanalytics_profile_id']			= 'Site profile';
	$_lang['setting_googleanalytics_profile_id_desc']		= 'The selected site profile where your Google Analytics data should be retrieved from.';
	$_lang['setting_googleanalytics_profile_name']			= 'The profile name';
	$_lang['setting_googleanalytics_profile_name_desc']		= 'The selected site profile name where your Google Analytics data should be retrieved from.';
	$_lang['setting_googleanalytics_cachetime']				= 'Cache time';
	$_lang['setting_googleanalytics_cachetime_desc']		= 'The number of minutes that the retrieved data from Google Analytics should be stored in the cache before retrieve new data.';
	$_lang['setting_googleanalytics_history']				= 'History';
	$_lang['setting_googleanalytics_history_desc']			= 'The number of days that should be shown.';
	$_lang['setting_googleanalytics_panels']				= 'Components';
	$_lang['setting_googleanalytics_panels_desc']			= 'The components that should be shown.';
	
	$_lang['googleanalytics.title']							= 'Google Analytics stats of [[+profile]] <i>([[+profile_id]])</i>';
	$_lang['googleanalytics.settings_title']				= 'Settings';
	$_lang['googleanalytics.settings_saved']				= 'Google Analytics settings saved.';
	$_lang['googleanalytics.auth_desc']						= 'MODX has Currently no access to your Google Analytics account. Click on the button \'Request authorization code\' to give MODX access to your Google Analytics account. A new window will be opent with a Google page, where you may first have to login with your Google account. After the login and accepting the authorization will Google provide you an authorization code. Copy and past this authorization code in the field and click on the \'Validate authorization code\'.';
	$_lang['googleanalytics.auth_button']					= 'Request authorization code';
	$_lang['googleanalytics.auth_validate']					= 'Validate authorization code';
	$_lang['googleanalytics.auth_success']					= 'Google\'s authorization code validated and saved.';
	$_lang['googleanalytics.auth_failure']					= 'Google\'s authorization code could not be validated, please try again.';
	$_lang['googleanalytics.auth_revoke']					= 'Revoke authorization code';
	$_lang['googleanalytics.auth_revoke_confirm']			= 'Are you sure you want to revoke the authorization code?';
	$_lang['googleanalytics.auth_revoke_success']			= 'Google\'s authorization code revoked.';
	$_lang['googleanalytics.auth_revoke_failure']			= 'Google\'s authorization code could not be revoked, please try again.';
	$_lang['googleanalytics.label_code']					= 'Authorization code';
	$_lang['googleanalytics.label_code_desc']				= 'Copy and past the authorization code that Google provided you.';
	$_lang['googleanalytics.label_profile']					= 'Site profiel';
	$_lang['googleanalytics.label_profile_desc']			= 'The site profile where your Google Analytics data should be retrieved from.';
	$_lang['googleanalytics.label_cachetime']				= 'Cache time';
	$_lang['googleanalytics.label_cachetime_desc']			= 'The number of minutes that the retrieved data from Google Analytics should be stored in the cache before retrieve new data.';
	$_lang['googleanalytics.label_history']					= 'History';
	$_lang['googleanalytics.label_history_desc']			= 'The number of days that should be shown.';
	$_lang['googleanalytics.label_panels']					= 'Components';
	$_lang['googleanalytics.label_panel_desc']				= 'Check the components that should be shown..';
	
	$_lang['googleanalytics.select_profile']				= 'Select a site profile';
	$_lang['googleanalytics.select_cachetime']				= 'Select the cache time in minutes';
	$_lang['googleanalytics.select_history']				= 'Select the history in days';
	$_lang['googleanalytics.summary_title']					= 'Overview';
	$_lang['googleanalytics.summary_active']				= 'At this moment are there <strong>{activeUsers}</strong> active visitors';
	$_lang['googleanalytics.visitors_title']				= 'Visitors';
	$_lang['googleanalytics.visitors_visitors']				= 'Visitors';
	$_lang['googleanalytics.visitors_devices']				= 'Devices';
	$_lang['googleanalytics.visitors_devices_tablet']		= 'Tablet';
	$_lang['googleanalytics.visitors_devices_mobile']		= 'Mobile';
	$_lang['googleanalytics.visitors_devices_desktop']		= 'Desktop';
	$_lang['googleanalytics.visitors_new']					= 'New';
	$_lang['googleanalytics.visitors_returning']			= 'Returning';
	$_lang['googleanalytics.sources_title']					= 'Traffic sources';
	$_lang['googleanalytics.sources_traffic']				= 'Traffic sources';
	$_lang['googleanalytics.sources_operatingsystems']		= 'Operatingssystem';
	$_lang['googleanalytics.sources_source']				= 'Source';
	$_lang['googleanalytics.sources_searchengine']			= 'Search engine';
	$_lang['googleanalytics.sources_direct']				= 'Direct traffic';
	$_lang['googleanalytics.sources_reference']				= 'Referring traffic';
	$_lang['googleanalytics.content_title']					= 'Important pages';
	$_lang['googleanalytics.content_high']					= 'Top 15 entrancepoints';
	$_lang['googleanalytics.content_low']					= 'Top 15 exitpoints';
	$_lang['googleanalytics.content_source']				= 'Page';
	$_lang['googleanalytics.content_entrances']				= 'Entrancepoints';
	$_lang['googleanalytics.content_exit']					= 'Exitpoints';
	$_lang['googleanalytics.content_exitrate']				= 'Exitrate';
	$_lang['googleanalytics.search_title']					= 'Search';
	$_lang['googleanalytics.search_keyword']				= 'Keyword';
	$_lang['googleanalytics.search_unique']					= 'Unique searchqueries';
	$_lang['googleanalytics.search_pageviews']				= 'Results pageviews';
	$_lang['googleanalytics.search_exit']					= 'Exitpoints';
	$_lang['googleanalytics.search_duration']				= 'Time after searchquery';
	$_lang['googleanalytics.search_depth']					= 'Depth';
	$_lang['googleanalytics.visits']						= 'Visits';
	$_lang['googleanalytics.visits_on']						= 'Visits at';
	$_lang['googleanalytics.visits_new']					= 'New visits';
	$_lang['googleanalytics.visitors']						= 'Visitors';
	$_lang['googleanalytics.pageviews']						= 'Pageviews';
	$_lang['googleanalytics.pageviews_on']					= 'Pageviews at';
	$_lang['googleanalytics.pageviews_unique']				= 'Unique pageviews';
	$_lang['googleanalytics.bounces']						= 'Bounces';
	$_lang['googleanalytics.bouncerate']					= 'Bouncerate';
	$_lang['googleanalytics.time_on_site']					= 'Time on site';
	$_lang['googleanalytics.exitrate']						= 'Exitrate';
	$_lang['googleanalytics.days']							= 'days';
	$_lang['googleanalytics.minutes']						= 'minutes';
	$_lang['googleanalytics.report404_title']				= 'Error pages';
	$_lang['googleanalytics.report404_filter_context']		= 'Filter op context...';
	$_lang['googleanalytics.report404_report']				= '404 page';
	$_lang['googleanalytics.report404_reports']				= '404 Pages';
	$_lang['googleanalytics.report404_url']					= 'URL';
	$_lang['googleanalytics.report404_referer']				= 'Traffic source';
	$_lang['googleanalytics.report404_hits']				= 'Visits';
	$_lang['googleanalytics.report404_remove']						= 'Delete 404 page';
	$_lang['googleanalytics.report404_remove_confirm']				= 'Are you sure you want to delete this 404 page?';
	$_lang['googleanalytics.report404_remove_selected']				= 'Delete selected 404 pages';
	$_lang['googleanalytics.report404_remove_selected_confirm']		= 'Are you sure you want to delete the selected 404 pages?';
	$_lang['googleanalytics.report404_reset']						= 'Delete all 404 pages';
	$_lang['googleanalytics.report404_reset_confirm']				= 'Are you sure you want to delete all 404 pages?';
	
?>