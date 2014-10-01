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