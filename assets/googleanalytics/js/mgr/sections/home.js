Ext.onReady(function() {
	MODx.load({xtype: 'googleanalytics-page-home'});
});

GoogleAnalytics.page.Home = function(config) {
	config = config || {};
	
	config.buttons = [];
	
	if (GoogleAnalytics.config.branding) {
		config.buttons.push({
			text 		: 'GoogleAnalytics ' + GoogleAnalytics.config.version,
			cls			: 'x-btn-branding',
			handler		: this.loadBranding
		});
	}
	
	if (GoogleAnalytics.config.authorized_profile) {
		config.buttons.push({
			xtype 		: 'googleanalytics-combo-profiles',
			name 		: 'googleanalytics-filter-profiles',
	        id			: 'googleanalytics-filter-profiles',
	        emptyText	: _('googleanalytics.filter_profiles'),
	        value 		: MODx.request.profile || GoogleAnalytics.config.authorized_profile.id,
	        listeners	: {
		        'change'	: {
		        	fn			: this.filterProfile,
		        	scope		: this
		        }
		    },
		    baseParams 	: {
	        	action		: 'mgr/data/getprofiles',
	            account		: GoogleAnalytics.config.authorized_profile.account_id,
	            property	: GoogleAnalytics.config.authorized_profile.property_id
	        },
		    width		: 200
		});
	}
	
	config.buttons.push({
		text 		: _('googleanalytics.open_googleanalytics'),
		cls 		: 'primary-button',
		handler		: this.loadGoogleAnalytics
	});
	
	if (GoogleAnalytics.config.has_permission) {
		config.buttons.push({
			text 		: _('googleanalytics.settings'),
			handler		: this.updateSettings
		});
	}
	
	config.buttons.push({
		text		: _('help_ex'),
		handler		: MODx.loadHelpPane,
		scope		: this
	});
	
	if (GoogleAnalytics.config.authorized_profile) {
		Ext.applyIf(config, {
			components	: [{
				xtype		: 'googleanalytics-panel-home',
				renderTo	: 'googleanalytics-panel-home-div'
			}]
		});
	} else {
		Ext.applyIf(config, {
			components	: [{
				xtype		: 'googleanalytics-panel-access',
				renderTo	: 'googleanalytics-panel-access-div'
			}]
		});
	}
	
	GoogleAnalytics.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.page.Home, MODx.Component, {
	loadBranding: function(btn) {
		window.open(GoogleAnalytics.config.branding_url);
	},
	loadGoogleAnalytics: function(btn) {
		window.open(GoogleAnalytics.config.google_analytics_url);
	},
	filterProfile: function(tf, nv, ov) {
		var request = MODx.request || {};
		
        Ext.apply(request, {
	    	'profile' : tf.getValue()  
	    });
        
        MODx.loadPage('?' + Ext.urlEncode(request));
	},
	updateSettings: function(btn, e) {
        if (this.updateSettingsWindow) {
	        this.updateSettingsWindow.destroy();
        }
        
        this.updateSettingsWindow = MODx.load({
	        modal		: true,
	        xtype		: 'googleanalytics-window-settings-update',
	        closeAction	: 'close',
	        listeners	: {
		        'success'	: {
		        	fn			: function() {
			        	window.location.reload(); 
			        },
		        	scope		: this
		        }
	        }
        });
        
        this.updateSettingsWindow.show(e.target);
    },
});

Ext.reg('googleanalytics-page-home', GoogleAnalytics.page.Home);

GoogleAnalytics.window.UpdateSettings = function(config) {
    config = config || {};

    Ext.applyIf(config, {
    	autoHeight	: true,
        title 		: _('googleanalytics.settings'),
        url			: GoogleAnalytics.config.connector_url,
        baseParams	: {
            action		: 'mgr/settings/save'
        },
        fields		: [{
	        xtype		: 'googleanalytics-combo-accounts',
	        fieldLabel	: _('googleanalytics.label_account'),
	        description	: MODx.expandHelp ? '' : _('googleanalytics.label_account_desc'),
	        id			: 'google-analytics-setting-account',
        	name		: 'account',
        	anchor		: '100%',
        	value		: null,
        	listeners	: {
	        	'change'	: {
		        	fn			: this.unLockPropertyField,
		        	scope		: this
	        	}
        	}
	    }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_account_desc'),
            cls			: 'desc-under'
        }, {
	        xtype		: 'googleanalytics-combo-properties',
	        fieldLabel	: _('googleanalytics.label_property'),
	        description	: MODx.expandHelp ? '' : _('googleanalytics.label_property_desc'),
	        id			: 'google-analytics-setting-property',
        	name		: 'property',
        	anchor		: '100%',
        	value		: null,
        	listeners	: {
	        	'change'	: {
		        	fn			: this.unLockProfileField,
		        	scope		: this
	        	}
        	}
	    }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_property_desc'),
            cls			: 'desc-under'
        }, {
	        xtype		: 'googleanalytics-combo-profiles',
	        fieldLabel	: _('googleanalytics.label_profile'),
	        description	: MODx.expandHelp ? '' : _('googleanalytics.label_profile_desc'),
	        id			: 'google-analytics-setting-profile',
        	name		: 'profile',
        	anchor		: '100%',
        	value		: null
	    }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_profile_desc'),
            cls			: 'desc-under'
        }]
    });
    
    GoogleAnalytics.window.UpdateSettings.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.window.UpdateSettings, MODx.Window, {
	unLockPropertyField: function() {
		var account = Ext.getCmp('google-analytics-setting-account').getValue();
		
		if (undefined !== (propertyField = Ext.getCmp('google-analytics-setting-property'))) {
			propertyField.getStore().setBaseParam('account', account);
			propertyField.getStore().load();

			propertyField.fireEvent('change');
			
			propertyField.reset();
		}
	},
	unLockProfileField: function() {
		var account = Ext.getCmp('google-analytics-setting-account').getValue();
		var property = Ext.getCmp('google-analytics-setting-property').getValue();

		if (undefined !== (profileField = Ext.getCmp('google-analytics-setting-profile'))) {
			profileField.getStore().setBaseParam('account', account);
			profileField.getStore().setBaseParam('property', property);
			profileField.getStore().load();
			
			profileField.fireEvent('change');
			
			profileField.reset();
		}
	}
});

Ext.reg('googleanalytics-window-settings-update', GoogleAnalytics.window.UpdateSettings);

GoogleAnalytics.combo.Accounts = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        url			: GoogleAnalytics.config.connector_url,
        baseParams 	: {
            action		: 'mgr/data/getaccounts'
        },
        fields		: ['id', 'name'],
        hiddenName	: 'account',
        valueField	: 'id',
        displayField: 'name',
        editable	: true,
        typeAhead	: true
    });
    
    GoogleAnalytics.combo.Accounts.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.Accounts, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-accounts', GoogleAnalytics.combo.Accounts);

GoogleAnalytics.combo.Properties = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        url			: GoogleAnalytics.config.connector_url,
        baseParams 	: {
            action		: 'mgr/data/getproperties'
        },
        fields		: ['id', 'name'],
        hiddenName	: 'property',
        valueField	: 'id',
        displayField: 'name',
        editable	: true,
        typeAhead	: true,
    });
    
    GoogleAnalytics.combo.Properties.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.Properties, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-properties', GoogleAnalytics.combo.Properties);

GoogleAnalytics.combo.Profiles = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        url			: GoogleAnalytics.config.connector_url,
        baseParams 	: {
            action		: 'mgr/data/getprofiles'
        },
        fields		: ['id', 'name'],
        hiddenName	: 'profile',
        valueField	: 'id',
        displayField: 'name',
        editable	: true,
        typeAhead	: true
    });
    
    GoogleAnalytics.combo.Profiles.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.Profiles, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-profiles', GoogleAnalytics.combo.Profiles);

/*GoogleAnalytics.combo.PropertiesGrouped = function(config) {
    config = config || {};
    
    Ext.applyIf(config, {
        url			: GoogleAnalytics.config.connector_url,
        baseParams 	: {
            action		: 'mgr/data/getproperties'
        },
        fields		: ['id', 'name', 'account_id', 'account_name', 'value'],
        hiddenName	: 'property',
        valueField	: 'value',
        displayField: 'name',
        editable	: true,
        typeAhead	: true,
        tpl			: new Ext.XTemplate('<tpl for=".">' +
    			'<tpl if="!this.isHeader(values.account_id)">' +
    				'<div class="x-combo-list-group">'	+
						'<div class="x-combo-list-item">{name}</div>' + 
					'</div>' +
				'</tpl>' +
				'<tpl if="this.isHeader(values.account_id)">' +
					'<div class="x-combo-list-header">{[this.getHeader(values.account_id, values.account_name)]}</div>' +
					'<div class="x-combo-list-group">' +
						'<div class="x-combo-list-item">{name}</div>' + 
					'</div>' +
				'</tpl>' +
			'</tpl>',
			{
				isHeader: function(header) {
					return this.header != header;
				},
				getHeader: function(header, label) {
					this.header = header;
					
					return label;
				}
			}
		)
    });
    
    GoogleAnalytics.combo.PropertiesGrouped.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.PropertiesGrouped, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-properties-grouped', GoogleAnalytics.combo.PropertiesGrouped);*/