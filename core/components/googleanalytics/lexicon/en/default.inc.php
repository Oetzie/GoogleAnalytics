<?php

	/**
	 * Google Analytics
	 *
	 * Copyright 2017 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
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

	$_lang['googleanalytics'] 								    = 'Google Analytics';
	$_lang['googleanalytics.desc'] 							    = 'View the visitor stats with Google Analytics.';
	
	$_lang['area_googleanalytics']							    = 'Google Analytics';

    $_lang['setting_googleanalytics.branding_url']              = 'Branding';
    $_lang['setting_googleanalytics.branding_url_desc']         = 'The URL of the branding button, if the URL is empty the branding button won\'t be shown.';
    $_lang['setting_googleanalytics.branding_url_help']         = 'Branding (help)';
    $_lang['setting_googleanalytics.branding_url_help_desc']    = 'The URL of the branding help button, if the URL is empty the branding help button won\'t be shown.';
	$_lang['setting_googleanalytics.account']				    = 'Google Analytics account';
	$_lang['setting_googleanalytics.account_desc']			    = 'Het Google Analytics account whose data should be displayed.';
	$_lang['setting_googleanalytics.api_useragent']			    = 'API useragent';
	$_lang['setting_googleanalytics.api_useragent_desc']	    = 'The useragent for the API\'s. Default is "GoogleAnalyticsOAuth v2.0.0".';
	$_lang['setting_googleanalytics.client_id']				    = 'Google Analytics client ID';
	$_lang['setting_googleanalytics.client_id_desc']		    = 'The Google Analytics client ID, you can get this at https://console.developers.google.com/.';
	$_lang['setting_googleanalytics.client_secret']			    = 'Google Analytics client secret';
	$_lang['setting_googleanalytics.client_secret_desc']	    = 'The Google Analytics client secret, you can get this at https://console.developers.google.com/.';
	$_lang['setting_googleanalytics.refresh_token']			    = 'Google Analytics refresh token';
	$_lang['setting_googleanalytics.refresh_token_desc']	    = 'The Google Analytics refresh token, you can get this with oAuth with the minimum scope "https://www.googleapis.com/auth/analytics.readonly".';
	$_lang['setting_googleanalytics.history']				    = 'Days';
	$_lang['setting_googleanalytics.history_desc']			    = 'The number of days that should be shown, minimum 7 and maximum 30 days.';
	$_lang['setting_googleanalytics.panels']				    = 'Components';
	$_lang['setting_googleanalytics.panels_desc']			    = 'The stats components that should be shown, to separate components use a comma.';

	$_lang['googleanalytics.widget_visitors']				    = 'Google Analytics visitors';
	$_lang['googleanalytics.widget_visitors_desc']			    = 'Google Analytics visitors widgets shows the visitors stats from Google Analytics.';
	$_lang['googleanalytics.widget_visitors_title']			    = 'Google Analytics visitors ([[+property]])';
	$_lang['googleanalytics.widget_realtime']				    = 'Google Analytics realtime';
	$_lang['googleanalytics.widget_realtime_desc']			    = 'Google Analytics realtime widget shows the realtime visitors of Google Analytics.';
	$_lang['googleanalytics.widget_realtime_title']			    = 'Google Analytics realtime ([[+property]])';

    $_lang['googleanalytics.label_code']                        = 'Authorization token';
    $_lang['googleanalytics.label_code_desc']                   = 'Click on the button \'Get authorization token\' to get a Google Analytics authorization and copy/past that token here.';
    $_lang['googleanalytics.label_account']					    = 'Google Analytics account';
	$_lang['googleanalytics.label_account_desc']			    = 'The Het Google Analytics account whose data should be displayed.';
	$_lang['googleanalytics.label_property']				    = 'Google Analytics property';
	$_lang['googleanalytics.label_property_desc']			    = 'Het Google Analytics property whose data should be displayed.';
	$_lang['googleanalytics.label_profile']					    = 'Google Analytics profiel';
	$_lang['googleanalytics.label_profile_desc']			    = 'Het Google Analytics profiel what will displayed as default.';
    $_lang['googleanalytics.label_panels']				        = 'Sections';
    $_lang['googleanalytics.label_panels_desc']			        = '';
    $_lang['googleanalytics.label_history']                     = 'Number of of days';
    $_lang['googleanalytics.label_history_desc']                = 'The number of days where the stats will desplayed of.';

	$_lang['googleanalytics.stats_desc']					    = 'Google Analytics is a Google service to collect and detail statistics from the website. The purpose of this service is to give you a clear picture of, among other things, visitor flows, traffic sources and pageviews. Using this information, you can customize advertising campaigns or even parts of the website to the behavior of the visitor.';
	$_lang['googleanalytics.open_googleanalytics']			    = 'Go to Google Analytics';
    $_lang['googleanalytics.auth']						        = 'Authorize';
    $_lang['googleanalytics.auth_code']						    = 'Get authorization token';
    $_lang['googleanalytics.auth_revoke']				        = 'Revoke authorization';
    $_lang['googleanalytics.auth_revoke_confirm']		        = 'Are you sure you want to revoke the authorization?';
	$_lang['googleanalytics.settings']						    = 'Settings';
	$_lang['googleanalytics.filter_account']				    = 'Choose an account';
	$_lang['googleanalytics.filter_property']				    = 'Choose a property';
	$_lang['googleanalytics.filter_profile']				    = 'Choose a profile';
	$_lang['googleanalytics.online_now']					    = 'At this moment';
	$_lang['googleanalytics.online_visitor']				    = 'acitve visitor';
	$_lang['googleanalytics.online_visitors']				    = 'acitve visitors';
	$_lang['googleanalytics.title_summary']					    = 'Summary';
	$_lang['googleanalytics.title_visitors']				    = 'Visitors';
	$_lang['googleanalytics.title_sources']					    = 'Traffic sources';
	$_lang['googleanalytics.title_content']					    = 'Content';
	$_lang['googleanalytics.title_content_search']			    = 'Search';
    $_lang['googleanalytics.title_goals']				        = 'Goals';
	$_lang['googleanalytics.title_block_summary']			    = 'Stats last [[+history]] days';
	$_lang['googleanalytics.title_block_meta']				    = 'Stats compared last [[+history]] days';
	$_lang['googleanalytics.title_block_visitors']			    = 'Visitors';
	$_lang['googleanalytics.title_block_language']			    = 'Language';
	$_lang['googleanalytics.title_block_country']			    = 'Countries';
	$_lang['googleanalytics.title_block_devices']			    = 'Devices';
	$_lang['googleanalytics.title_block_sources']			    = 'Traffic sources';
	$_lang['googleanalytics.title_block_content_high']		    = 'Top 15 entrancepoints';
	$_lang['googleanalytics.title_block_content_low']		    = 'Top 15 exitpoints';
	$_lang['googleanalytics.title_block_content_search']	    = 'Searchqueries';
    $_lang['googleanalytics.title_block_goals']                 = 'Completed goals';
	$_lang['googleanalytics.visits']						    = 'Visits';
	$_lang['googleanalytics.visits_on']						    = '[[+data]] visits at [[+date_long]]';
	$_lang['googleanalytics.visits_new']					    = 'New visits';
	$_lang['googleanalytics.visitors']						    = 'Visitors';
	$_lang['googleanalytics.visitors_on']					    = '[[+data]] visitors at [[+date_long]]';
	$_lang['googleanalytics.visitors_time']					    = 'Time on site';
	$_lang['googleanalytics.pageviews']						    = 'Pageviews';
	$_lang['googleanalytics.pageviews_on']					    = '[[+data]] pageviews at [[+date_long]]';
	$_lang['googleanalytics.pageviews_unique']				    = 'Unique pageviews';
	$_lang['googleanalytics.new_visitor']					    = 'New';
	$_lang['googleanalytics.returning_visitor']				    = 'Returning';
	$_lang['googleanalytics.bounces']						    = 'Bounces';
	$_lang['googleanalytics.bouncerate']					    = 'Bouncerate';
	$_lang['googleanalytics.tablet']						    = 'Tablet';
	$_lang['googleanalytics.mobile']						    = 'Mobile';
	$_lang['googleanalytics.desktop']						    = 'Desktop';
	$_lang['googleanalytics.source']						    = 'Source';
	$_lang['googleanalytics.source_search']					    = 'Search engine';
	$_lang['googleanalytics.source_socialmedia']			    = 'Social media';
	$_lang['googleanalytics.source_direct']					    = 'Direct traffic';
	$_lang['googleanalytics.source_reference']				    = 'Referring traffic';
	$_lang['googleanalytics.content']						    = 'Page';
	$_lang['googleanalytics.entrances']						    = 'Entrancepoints';
	$_lang['googleanalytics.exits']							    = 'Exitpoints';
	$_lang['googleanalytics.exitrate']						    = 'Exitrate';
	$_lang['googleanalytics.keyword']						    = 'Keyword';
    $_lang['googleanalytics.location']                          = 'Location';
    $_lang['googleanalytics.goal']                              = 'Completed goals';
    $_lang['googleanalytics.history_1']                         = '7 days';
    $_lang['googleanalytics.history_2']                         = '14 days';
    $_lang['googleanalytics.history_3']                         = '21 days';
    $_lang['googleanalytics.history_4']                         = '28 days';
    $_lang['googleanalytics.auth_error']                        = 'An error has occurred while authorizing, please try again.';
    $_lang['googleanalytics.auth_error_save']                   = 'An error has occurred while saving the authorization token, please try again.';
	$_lang['googleanalytics.view_more']							= 'View more';
	
?>