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
	$_lang['googleanalytics.desc'] 							= 'Google Analytics dashboard widget toont de resultaten en statistieken van uw Google Analytics account.';
	
	$_lang['area_googleanalytics']							= 'Google Analytics';
	
	$_lang['setting_googleanalytics_admin_groups']			= 'Gebruikersgroepen';
	$_lang['setting_googleanalytics_admin_groups_desc']		= 'De gebruikersgroepen die toegang hebben tot de instellingen gedeelte van Google Analytics, gebruikersgroepen scheiden met een komma.';
	$_lang['setting_googleanalytics_token']					= 'Sessie token';
	$_lang['setting_googleanalytics_token_desc']			= 'De Google Analytics sessie token waardoor MODx toegang heeft tot Google Analytics.';
	$_lang['setting_googleanalytics_profile']				= 'Website profiel';
	$_lang['setting_googleanalytics_profile_desc']			= 'Het geselecteerde website profiel waar de gegevens van Google Analytics opgehaald moeten worden.';
	$_lang['setting_googleanalytics_cachetime']				= 'Cache tijd';
	$_lang['setting_googleanalytics_cachetime_desc']		= 'Het aantal minuten dat de opgehaalde gegevens van Google Analytics opgeslagen moet worden in de cache voordat er nieuwe gegevens opgehaald worden.';
	$_lang['setting_googleanalytics_history']				= 'Verleden';
	$_lang['setting_googleanalytics_history_desc']			= 'Het aantal dagen dat getoond dient te worden.';
	
	$_lang['googleanalytics.title']							= 'Google Analytics statistieken van [[+profile]] <i>([[+profile_id]])</i>';
	$_lang['googleanalytics.label_profile']					= 'Website profiel';
	$_lang['googleanalytics.label_profile_desc']			= 'Het website profiel waar de gegevens van Google Analytics opgehaald moeten worden';
	$_lang['googleanalytics.label_cachetime']				= 'Cache tijd';
	$_lang['googleanalytics.label_cachetime_desc']			= 'Het aantal minuten dat de opgehaalde gegevens van Google Analytics opgeslagen moet worden in de cache voordat er nieuwe gegevens opgehaald worden';
	$_lang['googleanalytics.label_history']					= 'Verleden';
	$_lang['googleanalytics.label_history_desc']			= 'Het aantal dagen dat getoond dient te worden.';
	$_lang['googleanalytics.visitors']						= 'Bezoekers';
	$_lang['googleanalytics.visits']						= 'Bezoeken';
	$_lang['googleanalytics.visits_on']						= 'bezoeken op';
	$_lang['googleanalytics.new_visits']					= 'Nieuwe bezoeken';
	$_lang['googleanalytics.pageviews']						= 'Paginaweergaves';
	$_lang['googleanalytics.pageviews_on']					= 'paginaweergaves op';
	$_lang['googleanalytics.bounces']						= 'Bounces';
	$_lang['googleanalytics.bouncerate']					= 'Bouncepercentage';
	$_lang['googleanalytics.time_on_site']					= 'Tijd op site';
	$_lang['googleanalytics.days']							= 'dagen';
	$_lang['googleanalytics.minutes']						= 'minuten';
	$_lang['googleanalytics.select_profile']				= 'Selecteer een website profiel';
	$_lang['googleanalytics.select_cachetime']				= 'Selecteer de cache tijd in minuten';
	$_lang['googleanalytics.select_history']				= 'Selecteer het verleden in dagen';
	$_lang['googleanalytics.settings']						= 'Instellingen';
	$_lang['googleanalytics.settings_reset']				= 'Reset Google Analytics toegang';
	$_lang['googleanalytics.settings_reset_confirm']		= 'Weet je zeker dat je Google Analytics toegang wil resetten?';
	$_lang['googleanalytics.settings_saved']				= 'Google Analytics instellingen opgeslagen.';
	$_lang['googleanalytics.auth_link']						= 'Klik hier om toegang te verlenen aan Google Analytics.';
	$_lang['googleanalytics.auth_desc']						= 'Momenteel heeft MODx nog geen toegang tot uw Google Analytics account.';
	$_lang['googleanalytics.sources']						= 'Verkeersbronnen';
	$_lang['googleanalytics.sources_traffic']				= 'Verkeersbronnen';
	$_lang['googleanalytics.sources_devices']				= 'Besturingssysteem';
	$_lang['googleanalytics.sources_mobile']				= 'Mobiel vs Desktop';
	$_lang['googleanalytics.sources_source']				= 'Verkeersbron';
	$_lang['googleanalytics.sources_searchengine']			= 'Zoekmachines';
	$_lang['googleanalytics.sources_direct']				= 'Direct verkeer';
	$_lang['googleanalytics.sources_reference']				= 'Verwijzend verkeer';
	$_lang['googleanalytics.sources_mobile']				= 'Mobiel';
	$_lang['googleanalytics.sources_desktop']				= 'Desktop';
	$_lang['googleanalytics.content']						= 'Populaire pagina\'s';
	$_lang['googleanalytics.content_high']					= 'Belangrijkste instappagina\'s';
	$_lang['googleanalytics.content_low']					= 'Belangrijkste uitstappagina\'s';
	$_lang['googleanalytics.content_source']				= 'Verkeersbron';
	$_lang['googleanalytics.content_entrances']				= 'Instappunten';
	$_lang['googleanalytics.content_exit']					= 'Uitstappunten';
	$_lang['googleanalytics.content_exitrate']				= 'Uitstappercentage';
	$_lang['googleanalytics.search']						= 'Zoekopdrachten';
	$_lang['googleanalytics.search_global']					= 'Zoekopdrachten';
	$_lang['googleanalytics.search_site']					= 'Zoekopdrachten website';
	$_lang['googleanalytics.search_keyword']				= 'Zoekwoord';
	$_lang['googleanalytics.search_unique']					= 'Unieke zoekopdrachten';
	$_lang['googleanalytics.search_pageviews']				= 'Resultaten paginaweergaves';
	$_lang['googleanalytics.search_exit']					= 'Uitstappunten';
	$_lang['googleanalytics.search_duration']				= 'Tijd na zoekopdracht';
	$_lang['googleanalytics.search_depth']					= 'Diepte';
	$_lang['googleanalytics.report404']						= '404 Pagina\'s';
	$_lang['googleanalytics.report404_filter_context']		= 'Filter op context...';
	$_lang['googleanalytics.report404_report']				= '404 Pagina';
	$_lang['googleanalytics.report404_reports']				= '404 Pagina\'s';
	$_lang['googleanalytics.report404_url']					= 'URL';
	$_lang['googleanalytics.report404_referer']				= 'Verkeersbron';
	$_lang['googleanalytics.report404_hits']				= 'Bezoeken';
	$_lang['googleanalytics.report404_remove']						= '404 Pagina verwijderen';
	$_lang['googleanalytics.report404_remove_confirm']				= 'Weet je zeker dat je deze 404 pagina wilt verwijderen?';
	$_lang['googleanalytics.report404_remove_selected']				= 'Geselecteerde 404 pagina\'s verwijderen';
	$_lang['googleanalytics.report404_remove_selected_confirm']		= 'Weet je zeker dat je de geselecteerde 404 pagina\'s wilt verwijderen?';
	$_lang['googleanalytics.report404_reset']						= 'Alle 404 pagina\'s verwijderen';
	$_lang['googleanalytics.report404_reset_confirm']				= 'Weet je zeker dat je alle 404 pagina\'s wilt verwijderen?';
	
?>