<?php

	$output = '';
	
	$translations = array(
		'nl'		=> array(
			'admin_groups'		=> 'Gebruikersgroepen',
			'admin_groups_desc'	=> 'De gebruikersgroepen die toegang hebben tot de instellingen gedeelte van Google Analytics, gebruikersgroepen scheiden met een komma.',
			'cachetime'			=> 'Cache tijd',
			'cachetime_desc'	=> 'Het aantal minuten dat de opgehaalde gegevens van Google Analytics opgeslagen moet worden in de cache voordat er nieuwe gegevens opgehaald worden.',
			'history'			=> 'Verleden',
			'history_desc'		=> 'Het aantal dagen dat getoond dient te worden.'
		),
		'en'		=> array(
			'admin_groups'		=> 'Usergroups',
			'admin_groups_desc'	=> 'The usergroups that are allowed to acces the admin panel of the settings, to separate usergroups use a comma.',
			'cachetime'			=> 'Cache time',
			'cachetime_desc'	=> 'The number of minutes that the retrieved data from Google Analytics should be stored in the cache before retrieve new data.',
			'history'			=> 'History',
			'history_desc'		=> 'The number of days that should be shown.'
		)
	);
	
	$translations = $modx->getOption($language, $modx->getOption('manager_language'), $translations['en']);
	
	$settings = array(
		'googleanalytics_admin_groups'	=> 'Administrator',
		'googleanalytics_cachetime'		=> 3600,
		'googleanalytics_history'		=> 7
	);

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
   		case xPDOTransport::ACTION_INSTALL:
   		case xPDOTransport::ACTION_UPGRADE:
   			foreach (array_keys($settings) as $key => $value) {
	   			if (null !== ($setting = $modx->getObject('modSystemSetting', $value))) {
		   			$settings[$value] = $setting->get('value');
	   			}
   			}

        	$output = '<div class="x-form-item">
				<label for="ext-comp-googleanalytics1" class="x-form-item-label" style="width: 100px;">'.$modx->getOption('admin_groups', $translations).'</label>
				<div class="x-form-element" style="padding-left: 105px">
					<input type="text" name="googleanalytics_admin_groups" id="ext-comp-googleanalytics1" value="'.$modx->getOption('googleanalytics_admin_groups', $settings).'" class="x-form-text x-form-field" msgtarget="under" autocomplete="on" size="20" style="width: 413px;">
				</div>
				<div class="x-form-clear-left"></div>
			</div>
			<label class="desc-under" style="font-weight: normal;">'.$modx->getOption('admin_groups_desc', $translations).'</label>
			<div class="x-form-item">
				<label for="ext-comp-googleanalytics2" class="x-form-item-label" style="width: 100px;">'.$modx->getOption('cachetime', $translations).'</label>
				<div class="x-form-element" style="padding-left: 105px">
					<input type="text" name="googleanalytics_cachetime" id="ext-comp-googleanalytics2" value="'.$modx->getOption('googleanalytics_cachetime', $settings).'" class="x-form-text x-form-field" msgtarget="under" autocomplete="on" size="20" style="width: 413px;">
				</div>
				<div class="x-form-clear-left"></div>
			</div>
			<label class="desc-under" style="font-weight: normal;">'.$modx->getOption('cachetime_desc', $translations).'</label>
			<div class="x-form-item">
				<label for="ext-comp-googleanalytics3" class="x-form-item-label" style="width: 100px;">'.$modx->getOption('history', $translations).'</label>
				<div class="x-form-element" style="padding-left: 105px">
					<input type="text" name="googleanalytics_history" id="ext-comp-googleanalytics3" value="'.$modx->getOption('googleanalytics_history', $settings).'" class="x-form-text x-form-field" msgtarget="under" autocomplete="on" size="20" style="width: 413px;">
				</div>
				<div class="x-form-clear-left"></div>
			</div>
			<label class="desc-under" style="font-weight: normal;">'.$modx->getOption('history_desc', $translations).'</label>';
					
       		break;
	   	case xPDOTransport::ACTION_UNINSTALL:
        	break;
	}

	return $output;
	
?>