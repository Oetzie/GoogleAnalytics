Ext.onReady(function() {
	MODx.load({xtype: 'googleanalytics-panel-home'});
});

GoogleAnalytics.panel.Home = function(config) {
	config = config || {};
	
	var items = [];
	
	if (-1 != GoogleAnalytics.config.panels.indexOf('summary')) {
		items.push({
			xtype		: 'googleanalytics-panel-summary'
		});
	}
	
	if (-1 != GoogleAnalytics.config.panels.indexOf('visitors')) {
		items.push({
			xtype		: 'googleanalytics-panel-visitors'
		});
	}
	
	if (-1 != GoogleAnalytics.config.panels.indexOf('sources')) {
		items.push({
			xtype		: 'googleanalytics-panel-sources'
		});
	}
	
	if (-1 != GoogleAnalytics.config.panels.indexOf('content')) {
		items.push({
			xtype		: 'googleanalytics-panel-content'
		});
	}
	
	if (-1 != GoogleAnalytics.config.panels.indexOf('report404')) {
		items.push({
			xtype		: 'googleanalytics-panel-report404'
		});
	}
	
	if (-1 != GoogleAnalytics.config.panels.indexOf('search')) {
		items.push({
			xtype		: 'googleanalytics-panel-search'
		});
	}
	
	if (GoogleAnalytics.config.admin && -1 != GoogleAnalytics.config.panels.indexOf('settings')) {
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

GoogleAnalytics.panel.Summary = function(config) {
    config = config || {};
    
    var store = new Ext.data.JsonStore({
		url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'visits'
	  	},
	  	root		: 'results',
	  	fields		: ['date', 'visits', 'visitors', 'pageviews', 'pageviewsPerVisit', 'avgTimeOnSite', 'percentNewVisits', 'visitBounceRate'],
	  	autoLoad	: true
	});

    Ext.apply(config, {
		title		: _('googleanalytics.summary_title'),
		items		: [{
			xtype		: 'googleanalytics-panel-realtime',
		}, {
            xtype		: 'columnchart',
            url			: GoogleAnalytics.config.assetsUrl + 'swf/charts.swf',
            height		: 300,
            store		: store,
            xField		: 'date',
            yAxis		: new Ext.chart.NumericAxis({
                displayName		: 'Visits',
                labelRenderer 	: Ext.util.Format.numberRenderer('0,0')
            }),
            chartStyle	: {
            	legend		: {
                	display		: 'bottom',
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
	        xtype	: 'googleanalytics-panel-meta'
        }]
	});

    GoogleAnalytics.panel.Summary.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Summary, MODx.Panel);

Ext.reg('googleanalytics-panel-summary', GoogleAnalytics.panel.Summary);

GoogleAnalytics.panel.Visitors = function(config) {
    config = config || {};
    
    var store = new Ext.data.JsonStore({
		url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'visits'
	  	},
	  	root		: 'results',
	  	fields		: ['date', 'visits', 'visitors', 'pageviews', 'pageviewsPerVisit', 'avgTimeOnSite', 'percentNewVisits', 'visitBounceRate'],
	  	autoLoad	: true
	});

    Ext.apply(config, {
		title		: _('googleanalytics.visitors_title'),
		items		: [{
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: .5,
	        	title		: '<h2>' + _('googleanalytics.visitors_visitors') + '</h2>',
	        	items		: [{
					xtype		: 'piechart',
					url			: GoogleAnalytics.config.assetsUrl + 'swf/charts.swf',
					height		: 200,
					store		: new Ext.data.JsonStore({
						url			: GoogleAnalytics.config.connectorUrl,
						baseParams 	: {
				      		action		: 'mgr/getdata',
				      		data		: 'visiters'
					  	},
					  	root		: 'results',
					  	fields		: ['visitorType', 'visits'],
					  	autoLoad	: true
					}),
					dataField	: 'visits',
					categoryField : 'visitorType',
					series		: [{
		            	style		: {
		                	colors		: ['#0172ce', '#6cb1e8', '#f15906', '#eef200', '#3baa38', '#a638aa']
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
		        title		: '<h2>' + _('googleanalytics.visitors_devices') + '</h2>',
		        style		: 'margin-right: 0;',
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
					  	fields		: ['deviceCategory', 'visits'],
					  	autoLoad	: true
					}),
					dataField	: 'visits',
					categoryField : 'deviceCategory',
					series		: [{
		            	style		: {
		                	colors		: ['#0172ce', '#6cb1e8', '#f15906', '#eef200', '#3baa38', '#a638aa']
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
	        	title		: '<h2>' + _('googleanalytics.visitors_visitors') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-visitors'
				}]
			}]
        }]
	});

    GoogleAnalytics.panel.Visitors.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Visitors, MODx.Panel);

Ext.reg('googleanalytics-panel-visitors', GoogleAnalytics.panel.Visitors);

GoogleAnalytics.panel.Sources = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: _('googleanalytics.sources_title'),
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
				      		data		: 'traffic-compressed'
					  	},
					  	root		: 'results',
					  	fields		: ['name', 'visits'],
					  	autoLoad	: true
					}),
					dataField	: 'visits',
					categoryField : 'name',
					series		: [{
		            	style		: {
		                	colors		: ['#0172ce', '#6cb1e8', '#f15906', '#eef200', '#3baa38', '#a638aa']
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
		title		: _('googleanalytics.content_title'),
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
		title		: _('googleanalytics.search_title'),
		items		: [{
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.search_title') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-search'
				}]
			}]
        }]
	});

    GoogleAnalytics.panel.Search.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Search, MODx.Panel);

Ext.reg('googleanalytics-panel-search', GoogleAnalytics.panel.Search);

GoogleAnalytics.panel.Report404 = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: _('googleanalytics.report404_title'),
		items		: [{
        	layout		: 'column',
        	border		: false,
        	items		: [{
	        	columnWidth	: 1,
	        	title		: '<h2>' + _('googleanalytics.report404_title') + '</h2>',
	        	items		: [{
					xtype		: 'googleanalytics-grid-report404'
				}]
			}]
        }]
	});

    GoogleAnalytics.panel.Report404.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.Report404, MODx.Panel);

Ext.reg('googleanalytics-panel-report404', GoogleAnalytics.panel.Report404);

GoogleAnalytics.panel.Settings = function(config) {
    config = config || {};

    Ext.apply(config, {
		title		: '<i class="icon icon-gear"></i> ' + _('googleanalytics.settings_title'),
		url			: GoogleAnalytics.config.connectorUrl,
		baseParams	: {
       		action		: 'mgr/settings'
	   	},
        defaults	: {
            layout		: 'form',
            labelSeparator : ''
        },
        items		: [{
        	xtype		: 'googleanalytics-combo-profile',
        	fieldLabel	: _('googleanalytics.label_profile'),
        	description	: MODx.expandHelp ? '' : _('googleanalytics.label_profile_desc'),
        	name		: 'profile',
        	anchor		: '50%',
        	value		: GoogleAnalytics.config.profile
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
        }, {
        	xtype		: 'panel',
        	defaults 	: {
	        	hideLabel	: true
        	},
            layout		: 'form',
            fieldLabel	: _('googleanalytics.label_panels'),
            items		: [{
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.summary_title'),
    			name		: 'panels[]',
		        inputValue	: 'summary',
		        checked		: true,
		        disabled	: -1 != GoogleAnalytics.config.panels.indexOf('summary') ? true : false
		    }, {
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.visitors_title'),
    			name		: 'panels[]',
		        inputValue	: 'visitors',
		        checked		: -1 != GoogleAnalytics.config.panels.indexOf('visitors') ? true : false
		    }, {
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.sources_title'),
    			name		: 'panels[]',
		        inputValue	: 'sources',
		        checked		: -1 != GoogleAnalytics.config.panels.indexOf('sources') ? true : false
		    }, {
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.content_title'),
    			name		: 'panels[]',
		        inputValue	: 'content',
		        checked		: -1 != GoogleAnalytics.config.panels.indexOf('content') ? true : false
		    }, {
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.report404_title'),
    			name		: 'panels[]',
		        inputValue	: 'report404',
		        checked		: -1 != GoogleAnalytics.config.panels.indexOf('report404') ? true : false
		    }, {
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.search_title'),
    			name		: 'panels[]',
		        inputValue	: 'search',
		        checked		: -1 != GoogleAnalytics.config.panels.indexOf('search') ? true : false
		    }, {
    			xtype		: 'checkbox',
    			boxLabel	: _('googleanalytics.settings_title'),
    			name		: 'panels[]',
		        inputValue	: 'settings',
		        checked		: true,
		        disabled	: -1 != GoogleAnalytics.config.panels.indexOf('settings') ? true : false
		    }]
        }],
        buttonAlign	: 'left',
	    buttons		: [{
            text		: _('save'),
            cls			:'primary-button',
            handler		: this.submit,
            scope		: this
        }, {
            text		: _('googleanalytics.auth_revoke'),
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
		MODx.msg.confirm({
			title	: _('googleanalytics.auth_revoke'),
			text	: _('googleanalytics.auth_revoke_confirm'),
			url		: GoogleAnalytics.config.connectorUrl,
			params	: {
       			action		: 'mgr/auth',
       			revoke		: 1
	   		},
	   		listeners	: {
	   			'success'	: {
		   			fn			: function(response) {
			   			MODx.msg.status({
			   				title	: _('success'),
			   				message	: response.message
						});
		
		   				window.location.reload();
        			},
        			scope		: true
        		},
        		'failure'	: {
	        		fn 			: function(response) {
		        		MODx.msg.alert(_('failure'), response.message);
	        		},
	        		scope		: true
        		}
   			}
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

GoogleAnalytics.panel.Realtime = function(config) {
    config = config || {};   
     
    this.tpl = new Ext.XTemplate('<tpl if="typeof(results) != &quot;undefined&quot;"><tpl for="results">'
    	+ '<h2>' + _('googleanalytics.summary_active') + '</h2>'
    + '</tpl></tpl>', {
        compiled : true
    });
    
    var scope = this;
    
    setInterval(function() {
    	Ext.Ajax.request({
	   		url 	: GoogleAnalytics.config.connectorUrl,
	   		params 	: { 	
	        	action 	: 'mgr/getdata',
				data	: 'realtime'
	    	},
			method	: 'POST',
			success	: function(result, request) { 
	        	scope.setData(Ext.util.JSON.decode(result.responseText));
			},
			scope	: scope
		});
	}, 5000);
       
	GoogleAnalytics.panel.Realtime.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.panel.Realtime, Ext.Panel, {
    setData: function(data) {      
        this.tpl.overwrite(this.body, data);
    }
});

Ext.reg('googleanalytics-panel-realtime', GoogleAnalytics.panel.Realtime);

GoogleAnalytics.panel.Meta = function(config) {
    config = config || {};   
     
    this.tpl = new Ext.XTemplate('<tpl if="typeof(results) != &quot;undefined&quot;">'
        + '<div class="google-analytics-metas">'
        	+ '<table cellspacing="0" cellpadding="0">'
        		+ '<tbody>'
		            + '<tpl for="results">'
		                + '<tr>'
		                    + '<tpl for=".">'
		                        + '<td class="{cls}">'
		                            + '<div class="highlight {key}">{value}<span class="compare {progressionCls}">{progression} %</span></div>'  
		                            + '{name}'  
		                        + '</td>'
		                    + '</tpl>'
		                + '</tr>'
		            + '</tpl>'
				+ '</tbody>'
			+ '</table><br class="clear"/>'
		+ '</div>'
    + '</tpl>'
    + '<tpl if="typeof(start) != &quot;undefined&quot;">'
        + '<div class="metas-wrapper"><table><tbody><tr><td class="{cls}">{start}</td></tr></tbody></table><br class="clear"/></div>'
    + '</tpl>', {
        compiled : true
    });
    
    Ext.Ajax.request({
	    url 	: GoogleAnalytics.config.connectorUrl,
	    params 	: { 	
	        action 	: 'mgr/getdata',
	        data	: 'meta'
	    },
	    method	: 'POST',
		success	: function(result, request) { 
	        this.setData(Ext.util.JSON.decode(result.responseText));
	    },
	    scope	: this,
	});
    
	GoogleAnalytics.panel.Meta.superclass.constructor.call(this,config);
};

Ext.extend(GoogleAnalytics.panel.Meta, Ext.Panel, {
    setData: function(data) {      
        this.tpl.overwrite(this.body, data);
    }
});

Ext.reg('googleanalytics-panel-meta', GoogleAnalytics.panel.Meta);

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
		  	fields		: ['id', 'account_id', 'property_id', 'name', 'url', 'value'],
		  	autoLoad	: true
		}),
        remoteSort	: ['title', 'asc'],
        hiddenName	: 'profile',
        valueField	: 'value',
        displayField: 'name',
        mode		: 'local',
        emptyText	: _('googleanalytics.select_profile'),
        tpl			: new Ext.XTemplate('<tpl for="."><div class="x-combo-list-item">{name}<br /><small>{url} - {property_id}</small></div></tpl>')
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
    
    for (var i = 1; i <= 4; i = i + 1) {
		data.push([i * 7, (i * 7) + ' ' + _('googleanalytics.days')]); 
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