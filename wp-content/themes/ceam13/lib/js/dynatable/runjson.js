$(document).ready( function() {

$.dynatableSetup({
  // your global default options here
    features: {
    paginate: true,
    sort: true,
    pushState: true,
    search: true,
    recordCount: true,
    perPageSelect: true
  }
});

	$('#my-ajax-table').dynatable({
	
	  dataset: {
	    ajax: true,
	    ajaxUrl: '/wp-content/themes/ceam13/lib/js/msip5/msip5_2013.json',
	    ajaxOnLoad: true,
	    perPageDefault: 10,
		perPageOptions: [10,20,50,100],
	    records: []
	  }
	  });
	  
});

/*
		  dataset: {
		    ajax: true,
		    //ajaxUrl: null,
		    ajaxUrl: '/wp-content/themes/ceam13/lib/js/msip5/msip5_2013.json',
		    ajaxCache: null,
		    ajaxOnLoad: true,
		    ajaxMethod: 'GET',
		    ajaxDataType: 'json',
		    totalRecordCount: null,
		    queries: null,
		    queryRecordCount: null,
		    page: null,
		    perPageDefault: 10,
		    perPageOptions: [10,20,50,100],
		    sorts: null,
		    sortsKeys: null,
		    sortTypes: {},
		    records: []
		  }
*/