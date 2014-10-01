Ext.onReady(function() {
	MODx.load({xtype: 'googleanalytics-panel-home'});
});

GoogleAnalytics.panel.Home = function(config) {
	config = config || {};
	
	var items = [{
		xtype		: 'googleanalytics-panel-visitors'
	}, {
		xtype		: 'googleanalytics-panel-sources'
	}, {
		xtype		: 'googleanalytics-panel-content'
	}, {
		xtype		: 'googleanalytics-panel-search'
	}]
	
	if (GoogleAnalytics.config.admin) {
		items.push({
			xtype		: 'googleanalytics-panel-settings'
		});
	}
	
    Ext.apply(config, {
        id			: 'googleanalytics-panel-home',
        renderTo	: 'googleanalytics-panel-home-div',
	    defaults	: {
			collapsible	: false,
			autoHeight	: true,
			autoWidth	: true,
			border		: false
		},
		items		: [{
        	xtype		: 'modx-vtabs',
            items		: items
        }]
    });

	GoogleAnalytics.panel.Home.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Home, MODx.Panel);

Ext.reg('googleanalytics-panel-home', GoogleAnalytics.panel.Home);

GoogleAnalytics.panel.Visitors = function(config) {
    config = config || {};
    
    var store = new Ext.data.JsonStore({
		url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'visits'
	  	},
	  	root		: 'results',
	  	fields		: ['date', 'visits', 'visitors', 'pageviews', 'pageviewsPerVisit', 'vgTimeOnSite', 'percentNewVisits', 'visitBounceRate'],
	  	autoLoad	: true
	});

    Ext.apply(config, {
		title		: _('googleanalytics.visitors'),
		items		: [{
            xtype		: 'columnchart',
            url			: GoogleAnalytics.config.assetsUrl + 'swf/charts.swf',
            height		: 200,
            store		: store,
            xField		: 'date',
            yAxis		: new Ext.chart.NumericAxis({
                displayName		: 'Visits',
                labelRenderer 	: Ext.util.Format.numberRenderer('0,0')
            }),
            chartStyle	: {
            	legend		: {
                	display		: 'right',
                    padding		: 5,
                    font		: {
                    	family		: 'Tahoma',
                        size		: 13
                    }
				},  
                animationEnabled	: true,
                dataTip		: {
                    padding		: 5,
                    border		: {
                        color		: '#99bbe8',
                        size		:2
                    },
                    background	: {
                        color		: '#ffffff',
                        alpha		: .9
                    },
                    font		: {
                        name		: 'Tahoma',
                        color		: '#15428B',
                        size		: 10,
                        bold		: true
                    }
                },
                xAxis		: {
                    color		: '#69aBc8',
                    majorGridLines : {
                    	size		: 1,
                    	color		: '#eeeeee'
                    }
                },
                yAxis		: {
                    color		: '#69aBc8',
                    majorGridLines : {
                    	size		: 1,
                    	color		: '#dfe8f6'
                    }
                }
            },
            series		: [{
                type		: 'line',
                displayName	: _('googleanalytics.pageviews'),
                yField		: 'pageviews',
                style		: {
                    color		: '#0172ce'
                }
            }, {
                type		:'line',
                displayName	: _('googleanalytics.visits'),
                yField		: 'visits',
                style		: {
                    color		: '#6cb1e8'
                }
            }],
            tipRenderer	: function(chart, record, index, series){
                if ('visits' == series.yField) {
                    return record.data.visits + ' ' + _('googleanalytics.visits_on') + ' ' + record.data.date;
                }else{
                    return record.data.pageviews + ' ' + _('googleanalytics.pageviews_on') + ' ' + record.data.date;
                }
            },
        }, {
	        xtype		: 'googleanalytics-grid-visitors'
        }]
	});

    GoogleAnalytics.panel.Visitors.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Visitors, MODx.Panel);

Ext.reg('googleanalytics-panel-visitors', GoogleAnalytics.panel.Visitors);

GoogleAnalytics.panel.Sources = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: _('googleanalytics.sources'),
		items		: [{
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: .5,
	        	title		: '<h2>' + _('googleanalytics.sources_traffic') + '</h2>',
	        	items		: [{
					xtype		: 'piechart',
					url			: GoogleAnalytics.config.assetsUrl + 'swf/charts.swf',
					height		: 200,
					store		: new Ext.data.JsonStore({
						url			: GoogleAnalytics.config.connectorUrl,
						baseParams 	: {
				      		action		: 'mgr/getdata',
				      		data		: 'trafficcompressed'
					  	},
					  	root		: 'results',
					  	fields		: ['name', 'visits'],
					  	autoLoad	: true
					}),
					dataField	: 'visits',
					categoryField : 'name',
					series		: [{
		            	style		: {
		                	colors		: ['#0172ce', '#6cb1e8', '#f15906', '#eef200']
		                }
		            }],
		            extraStyle	: {
			        	legend		: {
			            	display		: 'right',
			                padding		: 5,
			                font		: {
			                	family		: 'Tahoma',
			                    size		: 13
			                }
			                
			            }
			        }
				}]
	        }, {
		        columnWidth	: .5,
		        title		: '<h2>' + _('googleanalytics.sources_mobile') + '</h2>',
		        style		: 'margin-right: 0;',
		        items		: [{
					xtype		: 'piechart',
					url			: GoogleAnalytics.config.assetsUrl + 'swf/charts.swf',
					height		: 200,
					store		: new Ext.data.JsonStore({
						url			: GoogleAnalytics.config.connectorUrl,
						baseParams 	: {
				      		action		: 'mgr/getdata',
				      		data		: 'mobile'
					  	},
					  	root		: 'results',
					  	fields		: ['isMobile', 'visits'],
					  	autoLoad	: true
					}),
					dataField	: 'visits',
					categoryField : 'isMobile',
					series		: [{
		            	style		: {
		                	colors		: ['#0172ce', '#6cb1e8', '#f15906', '#eef200']
		                }
		            }],
		            extraStyle	: {
			        	legend		: {
			            	display		: 'right',
			                padding		: 5,
			                font		: {
			                	family		: 'Tahoma',
			                    size		: 13
			                }
			                
			            }
			        }
				}]
	        }]	
	    }, {
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: .5,
	        	title		: '<h2>' + _('googleanalytics.sources_devices') + '</h2>',
	        	items		: [{
					xtype		: 'piechart',
					url			: GoogleAnalytics.config.assetsUrl + 'swf/charts.swf',
					height		: 200,
					store		: new Ext.data.JsonStore({
						url			: GoogleAnalytics.config.connectorUrl,
						baseParams 	: {
				      		action		: 'mgr/getdata',
				      		data		: 'devices'
					  	},
					  	root		: 'results',
					  	fields		: ['operatingSystem', 'visits'],
					  	autoLoad	: true
					}),
					dataField	: 'visits',
					categoryField : 'operatingSystem',
					series		: [{
		            	style		: {
		                	colors		: ['#0172ce', '#6cb1e8', '#f15906', '#eef200']
		                }
		            }],
		            extraStyle	: {
			        	legend		: {
			            	display		: 'right',
			                padding		: 5,
			                font		: {
			                	family		: 'Tahoma',
			                    size		: 13
			                }
			                
			            }
			        }
				}]
	        }]	
	    }, {
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.sources_traffic') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-traffic'
				}]
			}]
        }]
	});

    GoogleAnalytics.panel.Sources.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Sources, MODx.Panel);

Ext.reg('googleanalytics-panel-sources', GoogleAnalytics.panel.Sources);

GoogleAnalytics.panel.Content = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: _('googleanalytics.content'),
		items		: [{
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.content_high') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-content-high'
				}]
			}]
        }, {
        	html 		: '<br />'
        }, {
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.content_low') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-content-low'
				}]
			}]
        }]
	});

    GoogleAnalytics.panel.Content.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Content, MODx.Panel);

Ext.reg('googleanalytics-panel-content', GoogleAnalytics.panel.Content);

GoogleAnalytics.panel.Search = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: _('googleanalytics.search'),
		items		: [{
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.search_global') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-search-global'
				}]
			}]
        }, {
	        html	: '<br />'
        }, {
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.search_site') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-search-site'
				}]
			}]
        }]
	});

    GoogleAnalytics.panel.Search.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Search, MODx.Panel);

Ext.reg('googleanalytics-panel-search', GoogleAnalytics.panel.Search);

GoogleAnalytics.panel.Settings = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: '<i class="icon icon-gear"></i> ' + _('googleanalytics.settings'),
		url			: GoogleAnalytics.config.connectorUrl,
		baseParams	: {
       		action		: 'mgr/settings'
	   	},
        defaults	: {
            layout		: 'form',
            labelSeparator : ''
        },
        items		: [{
	        xtype		: 'hidden',
	        name		: 'token',
	        id			: 'googleanalytics-token',
	        value		: GoogleAnalytics.config.token
        }, {
        	xtype		: 'googleanalytics-combo-profile',
        	fieldLabel	: _('googleanalytics.label_profile'),
        	description	: MODx.expandHelp ? '' : _('googleanalytics.label_profile_desc'),
        	name		: 'profile',
        	id			: 'googleanalytics-profile',
        	anchor		: '50%',
        	value		: GoogleAnalytics.config.profile_json
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_profile_desc'),
            cls			: 'desc-under'
        }, {
        	xtype		: 'googleanalytics-combo-cachetime',
        	fieldLabel	: _('googleanalytics.label_cachetime'),
        	description	: MODx.expandHelp ? '' : _('googleanalytics.label_cachetime_desc'),
        	name		: 'cachetime',
        	anchor		: '50%',
        	allowBlank	: false,
        	value		: GoogleAnalytics.config.cachetime
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_cachetime_desc'),
            cls			: 'desc-under'
        }, {
        	xtype		: 'googleanalytics-combo-history',
        	fieldLabel	: _('googleanalytics.label_history'),
        	description	: MODx.expandHelp ? '' : _('googleanalytics.label_history_desc'),
        	name		: 'history',
        	anchor		: '50%',
        	allowBlank	: false,
        	value		: GoogleAnalytics.config.history
        }, {
        	xtype		: MODx.expandHelp ? 'label' : 'hidden',
            html		: _('googleanalytics.label_history_desc'),
            cls			: 'desc-under'
        }],
        buttonAlign	: 'left',
	    buttons		: [{
            text		: _('save'),
            cls			:'primary-button',
            handler		: this.submit,
            scope		: this
        }, {
            text		: _('googleanalytics.settings_reset'),
            handler		: this.reset,
            scope		: this
        }],
        listeners	: {
            'success'	: {
            	fn			: this.success,
            	scope		: this
			}
        }
	});

    GoogleAnalytics.panel.Settings.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Settings, MODx.FormPanel, {
	reset: function() {
		Ext.MessageBox.show({
			title	: _('googleanalytics.settings_reset'),
			msg		: _('googleanalytics.settings_reset_confirm'),
			icon 	: Ext.MessageBox.QUESTION,
			buttons : Ext.MessageBox.YESNO,
			fn		: function(btn) {
				if ('yes' == btn) {
					Ext.getCmp('googleanalytics-token').setValue();
					Ext.getCmp('googleanalytics-profile').setValue();
					
					this.submit();
				}	
			},
			scope	: this
		});
	},
    success: function(response) {
    	MODx.msg.status({
			title	: _('success'),
			message	: response.result.message
		});
		
		window.location.reload();
    }
});

Ext.reg('googleanalytics-panel-settings', GoogleAnalytics.panel.Settings);

GoogleAnalytics.combo.Profiles = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        store: new Ext.data.JsonStore({
			url			: GoogleAnalytics.config.connectorUrl,
			baseParams 	: {
	      		action		: 'mgr/getdata',
		  		data		: 'profiles'
		  	},
		  	root		: 'results',
		  	fields		: ['title', 'accountid', 'profileid', 'webpropertyid', 'json'],
		  	autoLoad	: true
		}),
        remoteSort	: ['title', 'asc'],
        hiddenName	: 'profile',
        valueField	: 'json',
        displayField: 'title',
        mode		: 'local',
        emptyText	: _('googleanalytics.select_profile')
    });
    
    GoogleAnalytics.combo.Profiles.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.Profiles, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-profile', GoogleAnalytics.combo.Profiles);

GoogleAnalytics.combo.CacheTime = function(config) {
    config = config || {};
    
    var data = [];
    
    for (var i = 10; i <= 60; i = i + 10) {
		data.push([i * 60, i + ' ' + _('googleanalytics.minutes')]); 
    }
    
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
		  	fields		: ['value', 'label'],
		  	data		: data
		}),
        remoteSort	: ['value', 'asc'],
        hiddenName	: 'cachetime',
        valueField	: 'value',
        displayField: 'label',
        mode		: 'local',
        emptyText	: _('googleanalytics.select_cachetime')
    });
    
    GoogleAnalytics.combo.CacheTime.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.CacheTime, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-cachetime', GoogleAnalytics.combo.CacheTime);

GoogleAnalytics.combo.History = function(config) {
    config = config || {};
    
    var data = [];
    
    for (var i = 2; i <= 28; i = i + 1) {
		data.push([i, i + ' ' + _('googleanalytics.days')]); 
    }

    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
		  	fields		: ['value', 'label'],
		  	data		: data
		}),
        remoteSort	: ['value', 'asc'],
        hiddenName	: 'history',
        valueField	: 'value',
        displayField: 'label',
        mode		: 'local',
        emptyText	: _('googleanalytics.select_history')
    });
    
    GoogleAnalytics.combo.History.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.combo.History, MODx.combo.ComboBox);

Ext.reg('googleanalytics-combo-history', GoogleAnalytics.combo.History);