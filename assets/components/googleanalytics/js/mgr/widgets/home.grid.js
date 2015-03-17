GoogleAnalytics.grid.Visitors = function(config) {
	config = config || {};
	
	columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('date'),
            dataIndex	: 'date',
            sortable	: true,
            editable	: false,
            width		: 125
        }, {
            header		: _('googleanalytics.visits'),
            dataIndex	: 'visits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.visitors'),
            dataIndex	: 'visitors',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.pageviews'),
            dataIndex	: 'pageviews',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.time_on_site'),
            dataIndex	: 'vgTimeOnSite',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.new_visits'),
            dataIndex	: 'percentNewVisits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }, {
            header		: _('googleanalytics.bouncerate'),
            dataIndex	: 'visitBounceRate',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }]
    });
	    
    Ext.applyIf(config, {
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'visits'
	  	},
	  	fields		: ['date', 'visits', 'visitors', 'pageviews', 'pageviewsPerVisit', 'vgTimeOnSite', 'percentNewVisits', 'visitBounceRate'],
        paging		: false,
        sortBy		: 'date'
    });
    
    GoogleAnalytics.grid.Visitors.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.Visitors, MODx.grid.Grid, {
	renderPercent: function(d, c) {
    	return Ext.util.Format.number(d, '0,0') + ' %';
    }
});

Ext.reg('googleanalytics-grid-visitors', GoogleAnalytics.grid.Visitors);

GoogleAnalytics.grid.Traffic = function(config) {
	config = config || {};
	
	columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('googleanalytics.sources_source'),
            dataIndex	: 'source',
            sortable	: true,
            editable	: false,
            width		: 125,
            renderer	: this.renderUrl
        }, {
            header		: _('googleanalytics.visits'),
            dataIndex	: 'visits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.visitors'),
            dataIndex	: 'visitors',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.time_on_site'),
            dataIndex	: 'vgTimeOnSite',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.new_visits'),
            dataIndex	: 'percentNewVisits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }, {
            header		: _('googleanalytics.bouncerate'),
            dataIndex	: 'visitBounceRate',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }]
    });
	    
    Ext.applyIf(config, {
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'traffic'
	  	},
	  	fields		: ['source', 'visits', 'visitors', 'pageviewsPerVisit', 'vgTimeOnSite', 'percentNewVisits', 'visitBounceRate'],
        paging		: false,
        sortBy		: 'visits'
    });
    
    GoogleAnalytics.grid.Traffic.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.Traffic, MODx.grid.Grid, {
	renderUrl: function(d, c) {
    	if ('' != d && '(direct)' != d && /\./.test(d)) {
	    	if (!/^(http)/.test(d)) {
		    	d = 'http://' + d;
	    	}
	    	
    		return '<a href="' + d + '" target="_blank">' + d + '</a>';
    	}
    	
    	return d;
	},
	renderPercent: function(d, c) {
    	return Ext.util.Format.number(d, '0,0') + ' %';
    }
});

Ext.reg('googleanalytics-grid-traffic', GoogleAnalytics.grid.Traffic);

GoogleAnalytics.grid.ContentHigh = function(config) {
	config = config || {};
	
	columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('googleanalytics.content_source'),
            dataIndex	: 'pagePath',
            sortable	: true,
            editable	: false,
            width		: 125
        }, {
            header		: _('googleanalytics.content_entrances'),
            dataIndex	: 'entrances',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.bounces'),
            dataIndex	: 'bounces',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.bouncerate'),
            dataIndex	: 'entranceBounceRate',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }]
    });
	    
    Ext.applyIf(config, {
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'entrances'
	  	},
	  	fields		: ['pagePath', 'entrances', 'bounces', 'entranceBounceRate', 'exits'],
        paging		: false,
        sortBy		: 'entrances'
    });
    
    GoogleAnalytics.grid.ContentHigh.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.ContentHigh, MODx.grid.Grid, {
	renderPercent: function(d, c) {
    	return Ext.util.Format.number(d, '0,0') + ' %';
    }
});

Ext.reg('googleanalytics-grid-content-high', GoogleAnalytics.grid.ContentHigh);

GoogleAnalytics.grid.ContentLow = function(config) {
	config = config || {};
	
	columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('googleanalytics.content_source'),
            dataIndex	: 'pagePath',
            sortable	: true,
            editable	: false,
            width		: 125
        }, {
            header		: _('googleanalytics.content_exit'),
            dataIndex	: 'exits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.pageviews'),
            dataIndex	: 'pageviews',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.content_exitrate'),
            dataIndex	: 'exitRate',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }]
    });
	    
    Ext.applyIf(config, {
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'exits'
	  	},
	  	fields		: ['pagePath', 'exits', 'pageviews', 'exitRate'],
        paging		: false,
        sortBy		: 'exits'
    });
    
    GoogleAnalytics.grid.ContentLow.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.ContentLow, MODx.grid.Grid, {
	renderPercent: function(d, c) {
    	return Ext.util.Format.number(d, '0,0') + ' %';
    }
});

Ext.reg('googleanalytics-grid-content-low', GoogleAnalytics.grid.ContentLow);

GoogleAnalytics.grid.SearchGlobal = function(config) {
	config = config || {};
	
	columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('googleanalytics.search_keyword'),
            dataIndex	: 'keyword',
            sortable	: true,
            editable	: false,
            width		: 125
        }, {
            header		: _('googleanalytics.visits'),
            dataIndex	: 'visits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.pageviews'),
            dataIndex	: 'pageviewsPerVisit',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }, {
            header		: _('googleanalytics.time_on_site'),
            dataIndex	: 'vgTimeOnSite',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
            
        }, {
            header		: _('googleanalytics.new_visits'),
            dataIndex	: 'percentNewVisits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }, {
            header		: _('googleanalytics.bouncerate'),
            dataIndex	: 'visitBounceRate',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }]
    });
	    
    Ext.applyIf(config, {
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'search'
	  	},
	  	fields		: ['keyword', 'visits', 'pageviewsPerVisit', 'vgTimeOnSite', 'percentNewVisits', 'visitBounceRate'],
        paging		: false,
        sortBy		: 'visits'
    });
    
    GoogleAnalytics.grid.SearchGlobal.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.SearchGlobal, MODx.grid.Grid, {
	renderPercent: function(d, c) {
    	return Ext.util.Format.number(d, '0,0') + ' %';
    }
});

Ext.reg('googleanalytics-grid-search-global', GoogleAnalytics.grid.SearchGlobal);

GoogleAnalytics.grid.SearchSite = function(config) {
	config = config || {};
	
	columns = new Ext.grid.ColumnModel({
        columns: [{
            header		: _('googleanalytics.search_keyword'),
            dataIndex	: 'searchKeyword',
            sortable	: true,
            editable	: false,
            width		: 125
        }, {
            header		: _('googleanalytics.search_unique'),
            dataIndex	: 'searchUniques',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }, {
            header		: _('googleanalytics.search_pageviews'),
            dataIndex	: 'searchResultViews',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
        }, {
            header		: _('googleanalytics.search_exit'),
            dataIndex	: 'searchExitRate',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125,
            renderer	: this.renderPercent
            
        }, {
            header		: _('googleanalytics.search_duration'),
            dataIndex	: 'searchDuration',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125   
        }, {
            header		: _('googleanalytics.search_depth'),
            dataIndex	: 'searchDepth',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 125
        }]
    });
	    
    Ext.applyIf(config, {
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getdata',
      		data		: 'sitesearch'
	  	},
	  	fields		: ['searchKeyword', 'searchUniques', 'searchResultViews', 'searchExitRate', 'searchDuration', 'searchDepth'],
        paging		: false,
        sortBy		: 'searchResultViews'
    });
    
    GoogleAnalytics.grid.SearchSite.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.SearchSite, MODx.grid.Grid, {
	renderPercent: function(d, c) {
    	return Ext.util.Format.number(d, '0,0') + ' %';
    }
});

Ext.reg('googleanalytics-grid-search-site', GoogleAnalytics.grid.SearchSite);

GoogleAnalytics.grid.Report404 = function(config) {
	config = config || {};
	
	config.tbar = [{
		text		: _('bulk_actions'),
		cls			:'primary-button',
		menu		: [{
			text		: _('googleanalytics.report404_remove_selected'),
			handler		: this.removeSelectedReport404,
			scope		: this
		}, '-', {
			text		: _('googleanalytics.report404_reset'),
			handler		: this.resetReport404,
			scope		: this
		}]
	}, '->', {
    	xtype		: 'modx-combo-context',
    	hidden		: 0 == parseInt(GoogleAnalytics.config.context) ? true : false,
    	name		: 'googleanalytics-report404-filter-filter-context',
        id			: 'googleanalytics-report404-filter-filter-context',
        emptyText	: _('googleanalytics.report404_filter_context'),
        listeners	: {
        	'select'	: {
	            	fn			: this.filterContext,
	            	scope		: this   
		    }
		},
		width: 250
    }, {
        xtype		: 'textfield',
        name 		: 'googleanalytics-report404-filter-search',
        id			: 'googleanalytics-report404-filter-search',
        emptyText	: _('search')+'...',
        listeners	: {
	        'change'	: {
	        	fn			: this.filterSearch,
	        	scope		: this
	        },
	        'render'		: {
		        fn			: function(cmp) {
			        new Ext.KeyMap(cmp.getEl(), {
				        key		: Ext.EventObject.ENTER,
			        	fn		: this.blur,
				        scope	: cmp
			        });
		        },
		        scope	: this
	        }
        }
    }, {
    	xtype	: 'button',
    	cls		: 'x-form-filter-clear',
    	id		: 'googleanalytics-report404-filter-clear',
    	text	: _('filter_clear'),
    	listeners: {
        	'click': {
        		fn		: this.clearFilter,
        		scope	: this
        	}
        }
    }];
	
	sm = new Ext.grid.CheckboxSelectionModel();
	
	columns = new Ext.grid.ColumnModel({
        columns: [sm, {
            header		: _('googleanalytics.report404_url'),
            dataIndex	: 'url',
            sortable	: true,
            editable	: false,
            width		: 125
        }, {
            header		: _('googleanalytics.report404_referer'),
            dataIndex	: 'referer',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 300,
            renderer	: this.renderUrl
        }, {
            header		: _('googleanalytics.report404_hits'),
            dataIndex	: 'hits',
            sortable	: true,
            editable	: false,
            fixed		: true,
            width		: 200
        }, {
            header		: _('context'),
            dataIndex	: 'context',
            sortable	: true,
            hidden		: true,
            editable	: false
        }]
    });
	    
    Ext.applyIf(config, {
	    sm			: sm,
    	cm			: columns,
    	url			: GoogleAnalytics.config.connectorUrl,
		baseParams 	: {
      		action		: 'mgr/getlist'
	  	},
	  	fields		: ['id', 'context', 'url', 'referer', 'hits'],
        paging		: true,
        pageSize	: MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        sortBy		: 'hits',
        grouping	: 0 == parseInt(GoogleAnalytics.config.context) ? false : true,
        groupBy		: 'context',
        singleText	: _('googleanalytics.report404_report'),
        pluralText	: _('googleanalytics.report404_reports')
    });
    
    GoogleAnalytics.grid.Report404.superclass.constructor.call(this, config);
};

Ext.extend(GoogleAnalytics.grid.Report404, MODx.grid.Grid, {
    filterSearch: function(tf, nv, ov) {
        this.getStore().baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
    },
    filterContext: function(tf, nv, ov) {
        this.getStore().baseParams.context = tf.getValue();
        this.getBottomToolbar().changePage(1);
    },
    clearFilter: function() {
	    this.getStore().baseParams.context = '';
	    this.getStore().baseParams.query = '';
	    Ext.getCmp('googleanalytics-report404-filter-filter-context').reset();
	    Ext.getCmp('googleanalytics-report404-filter-clear').reset();
        this.getBottomToolbar().changePage(1);
    },
    getMenu: function() {
        return [{
		    text	: _('googleanalytics.report404_remove'),
		    handler	: this.removeReport404
		 }];
    },
    removeReport404: function(btn, e) {
    	MODx.msg.confirm({
        	title 	: _('googleanalytics.report404_remove'),
        	text	: _('googleanalytics.report404_remove_confirm'),
        	url		: this.config.url,
        	params	: {
            	action	: 'mgr/remove',
            	id		: this.menu.record.id
            },
            listeners: {
            	'success': {
            		fn		: this.refresh,
            		scope	: this
            	}
            }
    	});
    },
    removeSelectedReport404: function(btn, e) {
    	var cs = this.getSelectedAsList();
    	
        if (cs === false) {
        	return false;
        }
        
    	MODx.msg.confirm({
        	title 	: _('googleanalytics.report404_remove_selected'),
        	text	: _('googleanalytics.report404_remove_selected_confirm'),
        	url		: this.config.url,
        	params	: {
            	action	: 'mgr/removeSelected',
            	ids		: cs
            },
            listeners: {
            	'success': {
            		fn		: function() {
            			this.getSelectionModel().clearSelections(true);
            			this.refresh();
            		},
            		scope	: this
            	}
            }
    	});
    },
    resetReport404: function(btn, e) {
    	MODx.msg.confirm({
        	title 	: _('googleanalytics.report404_reset'),
        	text	: _('googleanalytics.report404_reset_confirm'),
        	url		: this.config.url,
        	params	: {
            	action	: 'mgr/reset',
            	id		: 'all'
            },
            listeners: {
            	'success': {
            		fn		: this.refresh,
            		scope	: this
            	}
            }
    	});
    },
	renderUrl: function(d, c) {
    	if ('' != d && '(direct)' != d && /\./.test(d)) {
	    	if (!/^(http)/.test(d)) {
		    	d = 'http://' + d;
	    	}
	    	
    		return '<a href="' + d + '" target="_blank">' + d + '</a>';
    	}
    	
    	return d;
	}
});

Ext.reg('googleanalytics-grid-report404', GoogleAnalytics.grid.Report404);