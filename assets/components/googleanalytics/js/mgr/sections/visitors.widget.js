Ext.onReady(function() {
	MODx.load({xtype: 'googleanalytics-widget-visitors'});
});

GoogleAnalytics.panel.WidgetVisitors = function(config) {
	config = config || {};
	
	Ext.applyIf(config, {
		renderTo	: 'googleanalytics-widget-visitors-div',
		items		: [{
			items		: [{
	            xtype		: 'columnchart',
	            url			: GoogleAnalytics.config.assets_url + 'swf/charts.swf',
	            height		: 200,
	            store		: new Ext.data.JsonStore({
					url			: GoogleAnalytics.config.connector_url,
					baseParams 	: {
						action		: 'mgr/getdata',
						data		: 'visits'
					},
					root		: 'results',
					fields		: ['date', 'date_long', 'visits', 'pageviews'],
					autoLoad	: true
				}),
	            xField		: 'date',
	            chartStyle	: {
	            	legend		: {
	                	display		: 'bottom',
	                    padding		: 5,
	                    font		: {
	                    	family		: 'Helvetica Neue',
	                        size		: 12
	                    }
					},  
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
	                        name		: 'Helvetica Neue',
	                        color		: '#15428B',
	                        size		: 11,
	                        bold		: true
	                    }
	                },
	                xAxis		: {
	                    color		: '#e4e4e4',
	                    majorGridLines : {
	                    	size		: 1,
	                    	color		: '#e4e4e4'
	                    }
	                },
	                yAxis		: {
	                    color		: '#e4e4e4',
	                    majorGridLines : {
	                    	size		: 1,
	                    	color		: '#e4e4e4'
	                    }
	                }
	            },
	            series		: [{
	                type		: 'line',
	                style		: {
	                    color		: '#0172ce'
	                },
	                yField		: 'pageviews',
	                displayName	: _('googleanalytics.pageviews')
	            }, {
	                type		: 'line',
	                style		: {
	                    color		: '#6cb1e8'
	                },
	                yField		: 'visits',
	                displayName	: _('googleanalytics.visits')
	            }],
	            tipRenderer	: function(chart, record, index, series){
	                return _('googleanalytics.' + series.yField + '_on', {
	                    data		: record.data[series.yField],
	                    date		: record.data.date,
	                    date_long	: record.data.date_long
	                });
	            }
	        }]
	    }]
	});
	
	GoogleAnalytics.panel.WidgetVisitors.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.panel.WidgetVisitors, MODx.FormPanel);

Ext.reg('googleanalytics-widget-visitors', GoogleAnalytics.panel.WidgetVisitors);