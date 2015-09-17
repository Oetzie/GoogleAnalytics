Ext.onReady(function() {
	MODx.load({xtype: 'googleanalytics-panel-home'});
});

GoogleAnalytics.panel.Home = function(config) {
	config = config || {};
	
    Ext.apply(config, {
        id			: 'googleanalytics-panel-auth',
        renderTo	: 'googleanalytics-panel-auth-div',
	    defaults	: {
			collapsible	: false,
			autoHeight	: true,
			autoWidth	: true,
			border		: false
		},
		items		: [{
        	html			: '<p>' + _('googleanalytics.auth_desc') + '</p>',
            bodyCssClass	: 'panel-desc'
        }, {
			xtype		: 'googleanalytics-panel-auth',
			cls				: 'main-wrapper',
            preventRender	: true
		}]
    });

	GoogleAnalytics.panel.Home.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Home, MODx.Panel);

Ext.reg('googleanalytics-panel-home', GoogleAnalytics.panel.Home);

GoogleAnalytics.panel.Auth = function(config) {
    config = config || {};

    Ext.apply(config, {
		url			: GoogleAnalytics.config.connectorUrl,
		layout		: 'form',
		baseParams	: {
       		action		: 'mgr/auth'
	   	},
        defaults	: {
            labelSeparator : '',
        },
        items		: [{
        	xtype		: 'textfield',
        	fieldLabel	: _('googleanalytics.label_code'),
        	description	: MODx.expandHelp ? '' : _('googleanalytics.label_code_desc'),
        	name		: 'code',
        	anchor		: '50%',
        	allowBlank	: false
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_code_desc'),
            cls			: 'desc-under'
        }],
        buttonAlign	: 'left',
	    buttons		: [{
            text		: _('googleanalytics.auth_button'),
            handler		: this.auth,
            scope		: this
        }, {
            text		: _('googleanalytics.auth_validate'),
            cls			:'primary-button',
            handler		: this.submit,
            scope		: this
        }],
        listeners	: {
            'success'	: {
            	fn			: this.success,
            	scope		: this
			},
			'failure'	: {
				fn			: this.failure,
				scope		: this
			}
        }
	});

    GoogleAnalytics.panel.Auth.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Auth, MODx.FormPanel, {
	auth: function() {
		window.authorizeWindow = window.open(GoogleAnalytics.config.authUrl, 'google_analytics_auth', 'height=400,width=450');
	},
    success: function(response) {
    	MODx.msg.status({
			title	: _('success'),
			message	: response.result.message
		});
		
		if (window.authorizeWindow) {
        	window.authorizeWindow.close();
        }
		
		window.location.reload();
    },
    failure: function(response) {
	    MODx.msg.alert(_('failure'), response.result.message);
		
		if (window.authorizeWindow) {
        	window.authorizeWindow.close();
        }
    }
});

Ext.reg('googleanalytics-panel-auth', GoogleAnalytics.panel.Auth);