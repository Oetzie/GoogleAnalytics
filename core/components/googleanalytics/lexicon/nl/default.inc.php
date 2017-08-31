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
	$_lang['googleanalytics.desc'] 							    = 'Bekijk de bezoekers statistieken via Google Analytics.';
	
	$_lang['area_googleanalytics']							    = 'Google Analytics';

	$_lang['setting_googleanalytics.branding_url']              = 'Branding';
	$_lang['setting_googleanalytics.branding_url_desc']         = 'De URL waar de branding knop heen verwijst, indien leeg wordt de branding knop niet getoond.';
    $_lang['setting_googleanalytics.branding_url_help']         = 'Branding (help)';
    $_lang['setting_googleanalytics.branding_url_help_desc']    = 'De URL waar de branding help knop heen verwijst, indien leeg wordt de branding help knop niet getoond.';
    $_lang['setting_googleanalytics.account']				    = 'Google Analytics account';
	$_lang['setting_googleanalytics.account_desc']			    = 'Het Google Analytics account waarvan de gegevens getoond moeten worden.';
	$_lang['setting_googleanalytics.api_useragent']			    = 'API useragent';
	$_lang['setting_googleanalytics.api_useragent_desc']	    = 'De useragent voor de API\'s. Standaard is "GoogleAnalyticsOAuth v2.0.0".';
	$_lang['setting_googleanalytics.client_id']				    = 'Google Analytics client ID';
	$_lang['setting_googleanalytics.client_id_desc']		    = 'De Google Analytics client ID, deze is te verkrijgen via https://console.developers.google.com/.';
	$_lang['setting_googleanalytics.client_secret']			    = 'Google Analytics client secret';
	$_lang['setting_googleanalytics.client_secret_desc']	    = 'De Google Analytics client secret, deze is te verkrijgen via https://console.developers.google.com/.';
	$_lang['setting_googleanalytics.refresh_token']			    = 'Google Analytics refresh token';
	$_lang['setting_googleanalytics.refresh_token_desc']	    = 'De Google Analytics refresh token, deze is te verkrijgen via oAuth met de minimale scope "https://www.googleapis.com/auth/analytics.readonly".';
	$_lang['setting_googleanalytics.history']				    = 'Dagen';
	$_lang['setting_googleanalytics.history_desc']			    = 'Het aantal dagen waarvan de statistieken getoond moeten worden, minimaal 7 en maximaal 30 dagen.';
	$_lang['setting_googleanalytics.panels']				    = 'Onderdelen';
	$_lang['setting_googleanalytics.panels_desc']			    = 'De onderdelen waarvan de statistieken getoond moeten worden. Onderdelen scheiden met een komma.';

	$_lang['googleanalytics.widget_visitors']				    = 'Google Analytics bezoekers';
	$_lang['googleanalytics.widget_visitors_desc']			    = 'Google Analytics bezoekers widget toont de bezoekers statistieken van Google Analytics.';
	$_lang['googleanalytics.widget_visitors_title']			    = 'Google Analytics bezoekers ([[+property]])';
	$_lang['googleanalytics.widget_realtime']				    = 'Google Analytics realtime';
	$_lang['googleanalytics.widget_realtime_desc']			    = 'Google Analytics realtime widget toont de realtime bezoekers van Google Analytics.';
	$_lang['googleanalytics.widget_realtime_title']			    = 'Google Analytics realtime ([[+property]])';

	$_lang['googleanalytics.label_code']                        = 'Autorisatie code';
	$_lang['googleanalytics.label_code_desc']                   = 'Klik op de knop \'Autorisatie code aanvragen\' om een Google Analytics authorisatie aan te vragen en kopieer/plak die code hier.';
	$_lang['googleanalytics.label_account']					    = 'Google Analytics account';
	$_lang['googleanalytics.label_account_desc']			    = 'Het Google Analytics account waarvan de gegevens getoond moeten worden.';
	$_lang['googleanalytics.label_property']				    = 'Google Analytics property';
	$_lang['googleanalytics.label_property_desc']			    = 'Het Google Analytics property waarvan de gegevens getoond moeten worden.';
	$_lang['googleanalytics.label_profile']					    = 'Google Analytics profiel';
	$_lang['googleanalytics.label_profile_desc']			    = 'Het Google Analytics profiel wat standaard getoond moet worden.';
    $_lang['googleanalytics.label_panels']				        = 'Secties';
    $_lang['googleanalytics.label_panels_desc']			        = '';
    $_lang['googleanalytics.label_history']                     = 'Aantal dagen';
    $_lang['googleanalytics.label_history_desc']                = 'Het aantal dagen waarvan de statistieken getoond moeten worden.';

	$_lang['googleanalytics.stats_desc']					    = 'Google Analytics is een dienst van Google om statistieken van de website te verzamelen en gedetailleerd weer te geven. Het doel van deze dienst is om je een duidelijk beeld te geven van onder andere de bezoekersstromen, verkeersbronnen en paginaweergaves. Aan de hand van deze informatie kun je eventuele reclamecampagnes of zelfs delen van de website aanpassen aan het gedrag van de bezoeker.';
	$_lang['googleanalytics.open_googleanalytics']			    = 'Ga naar Google Analytics';
    $_lang['googleanalytics.auth']						        = 'Autoriseren';
    $_lang['googleanalytics.auth_code']						    = 'Autorisatie code aanvragen';
    $_lang['googleanalytics.auth_revoke']				        = 'Autorisatie intrekken';
    $_lang['googleanalytics.auth_revoke_confirm']		        = 'Weet je zeker dat je de autorisatie wilt intrekken?';
	$_lang['googleanalytics.settings']						    = 'Instellingen';
	$_lang['googleanalytics.filter_account']				    = 'Kies een account';
	$_lang['googleanalytics.filter_property']				    = 'Kies een property';
	$_lang['googleanalytics.filter_profile']				    = 'Kies een weergave';
	$_lang['googleanalytics.online_now']					    = 'Op dit moment';
	$_lang['googleanalytics.online_visitor']				    = 'actieve bezoeker';
	$_lang['googleanalytics.online_visitors']				    = 'actieve bezoekers';
	$_lang['googleanalytics.title_summary']					    = 'Overzicht';
	$_lang['googleanalytics.title_visitors']				    = 'Bezoekers';
	$_lang['googleanalytics.title_sources']					    = 'Verkeersbronnen';
	$_lang['googleanalytics.title_content']					    = 'Pagina\'s';
	$_lang['googleanalytics.title_content_search']			    = 'Zoekopdrachten';
    $_lang['googleanalytics.title_goals']				        = 'Doelen';
	$_lang['googleanalytics.title_block_summary']			    = 'Statistieken afgelopen [[+history]] dagen';
	$_lang['googleanalytics.title_block_meta']				    = 'Statistieken vergeleken met de vorige [[+history]] dagen';
	$_lang['googleanalytics.title_block_visitors']			    = 'Bezoekers';
	$_lang['googleanalytics.title_block_language']			    = 'Taal';
	$_lang['googleanalytics.title_block_country']			    = 'Herkomst';
	$_lang['googleanalytics.title_block_devices']			    = 'Apparaten';
	$_lang['googleanalytics.title_block_sources']			    = 'Verkeersbronnen';
	$_lang['googleanalytics.title_block_content_high']		    = 'Top 15 instappagina\'s';
	$_lang['googleanalytics.title_block_content_low']		    = 'Top 15 uitstappagina\'s';
	$_lang['googleanalytics.title_block_content_search']	    = 'Zoekopdrachten';
	$_lang['googleanalytics.title_block_goals']                 = 'Behaalde doelen';
	$_lang['googleanalytics.visits']						    = 'Bezoeken';
	$_lang['googleanalytics.visits_on']						    = '[[+data]] bezoeken op [[+date_long]]';
	$_lang['googleanalytics.visits_new']					    = 'Nieuwe bezoeken';
	$_lang['googleanalytics.visitors']						    = 'Bezoekers';
	$_lang['googleanalytics.visitors_on']					    = '[[+data]] bezoekers op [[+date_long]]';
	$_lang['googleanalytics.visitors_time']					    = 'Bezoekduur';
	$_lang['googleanalytics.pageviews']						    = 'Paginaweergaven';
	$_lang['googleanalytics.pageviews_on']					    = '[[+data]] paginaweergaven op [[+date_long]]';
	$_lang['googleanalytics.pageviews_unique']				    = 'Unieke paginaweergaven';
	$_lang['googleanalytics.new_visitor']					    = 'Nieuw';
	$_lang['googleanalytics.returning_visitor']				    = 'Terugkerend';
	$_lang['googleanalytics.bounces']						    = 'Bounces';
	$_lang['googleanalytics.bouncerate']					    = 'Bouncepercentage';
	$_lang['googleanalytics.tablet']						    = 'Tablet';
	$_lang['googleanalytics.mobile']						    = 'Mobiel';
	$_lang['googleanalytics.desktop']						    = 'Desktop';
	$_lang['googleanalytics.source']						    = 'Verkeersbron';
	$_lang['googleanalytics.source_search']					    = 'Zoekmachine';
	$_lang['googleanalytics.source_socialmedia']			    = 'Social media';
	$_lang['googleanalytics.source_direct']					    = 'Direct verkeer';
	$_lang['googleanalytics.source_reference']				    = 'Verwijzend verkeer';
	$_lang['googleanalytics.content']						    = 'Pagina';
	$_lang['googleanalytics.entrances']						    = 'Instappunten';
	$_lang['googleanalytics.exits']							    = 'Uitstappunten';
	$_lang['googleanalytics.exitrate']						    = 'Uitstappercentage';
	$_lang['googleanalytics.keyword']						    = 'Zoekopdracht';
    $_lang['googleanalytics.location']                          = 'Lokatie';
    $_lang['googleanalytics.goal']                              = 'Behaalde doel';
    $_lang['googleanalytics.history_1']                         = '7 dagen';
    $_lang['googleanalytics.history_2']                         = '14 dagen';
    $_lang['googleanalytics.history_3']                         = '21 dagen';
    $_lang['googleanalytics.history_4']                         = '28 dagen';
    $_lang['googleanalytics.auth_error']                        = 'Er is een fout opgetreden tijdens het autoriseren, probeer het opnieuw.';
    $_lang['googleanalytics.auth_error_save']                   = 'Er is een fout opgetreden tijdens het opslaan van de autorisatie code, probeer het opnieuw.';

?>