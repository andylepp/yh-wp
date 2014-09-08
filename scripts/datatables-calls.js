var oCache = {
    iCacheLower: -1
};
 
function fnSetKey( aoData, sKey, mValue )
{
    for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
    {
        if ( aoData[i].name == sKey )
        {
            aoData[i].value = mValue;
        }
    }
}
 
function fnGetKey( aoData, sKey )
{
    for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
    {
        if ( aoData[i].name == sKey )
        {
            return aoData[i].value;
        }
    }
    return null;
}
 
function fnDataTablesPipeline ( sSource, aoData, fnCallback ) {
    var iPipe = 5; /* Ajust the pipe size */
     
    var bNeedServer = false;
    var sEcho = fnGetKey(aoData, "sEcho");
    var iRequestStart = fnGetKey(aoData, "iDisplayStart");
    var iRequestLength = fnGetKey(aoData, "iDisplayLength");
    var iRequestEnd = iRequestStart + iRequestLength;
    oCache.iDisplayStart = iRequestStart;
     
    /* outside pipeline? */
    if ( oCache.iCacheLower < 0 || iRequestStart < oCache.iCacheLower || iRequestEnd > oCache.iCacheUpper )
    {
        bNeedServer = true;
    }
     
    /* sorting etc changed? */
    if ( oCache.lastRequest && !bNeedServer )
    {
        for( var i=0, iLen=aoData.length ; i<iLen ; i++ )
        {
            if ( aoData[i].name != "iDisplayStart" && aoData[i].name != "iDisplayLength" && aoData[i].name != "sEcho" )
            {
                if ( aoData[i].value != oCache.lastRequest[i].value )
                {
                    bNeedServer = true;
                    break;
                }
            }
        }
    }
     
    /* Store the request for checking next time around */
    oCache.lastRequest = aoData.slice();
     
    if ( bNeedServer )
    {
        if ( iRequestStart < oCache.iCacheLower )
        {
            iRequestStart = iRequestStart - (iRequestLength*(iPipe-1));
            if ( iRequestStart < 0 )
            {
                iRequestStart = 0;
            }
        }
         
        oCache.iCacheLower = iRequestStart;
        oCache.iCacheUpper = iRequestStart + (iRequestLength * iPipe);
        oCache.iDisplayLength = fnGetKey( aoData, "iDisplayLength" );
        fnSetKey( aoData, "iDisplayStart", iRequestStart );
        fnSetKey( aoData, "iDisplayLength", iRequestLength*iPipe );
         
        $.getJSON( sSource, aoData, function (json) { 
            /* Callback processing */
            oCache.lastJson = jQuery.extend(true, {}, json);
             
            if ( oCache.iCacheLower != oCache.iDisplayStart )
            {
                json.aaData.splice( 0, oCache.iDisplayStart-oCache.iCacheLower );
            }
            json.aaData.splice( oCache.iDisplayLength, json.aaData.length );
             
            fnCallback(json)
        } );
    }
    else
    {
        json = jQuery.extend(true, {}, oCache.lastJson);
        json.sEcho = sEcho; /* Update the echo for each response */
        json.aaData.splice( 0, iRequestStart-oCache.iCacheLower );
        json.aaData.splice( iRequestLength, json.aaData.length );
        fnCallback(json);
        return;
    }
}
jQuery(document).ready(function(jQuery){
	jQuery('#staff').dataTable({
		'aaSorting': [[ 0, 'desc' ]],
		'aoColumns': [ { 'bVisible': false }, null, null, null, { 'bVisible': false } ],
		'bPaginate': false,
		'bInfo': false,
		'bFilter': true,
		'bAutoWidth': false,
		'oLanguage': {
			'sZeroRecords': '<p><b>Sorry, no results match your query.<\/b><\/p><p>If you think this is an error, please report it though our contact form.<\/p>',
			'sSearch': '<b>Search contacts:</b>&nbsp; '
		}
	});		
	jQuery('#envserv').dataTable({
		'iDisplayLength': 1,
		'bInfo': false,
		'bFilter': true,
		'bPaginate': true,
		'bProcessing': false,
		'sDom': 'ft',
		'oLanguage': {
			'sZeroRecords': '<p><b>Sorry, no results match your query.<\/b><\/p><p>If you think this is an error, please report it though our contact form.<\/p>',
			'sSearch': '<b>Type your full postcode:</b>&nbsp; '
		}
	});		
	jQuery('#investment').dataTable( {
		'iDisplayLength': 1,
		'bServerSide': true,
		'bProcessing': true,
		'sAjaxSource': '/wp-content/themes/yh/scripts/datatables-investment.php',
		'bAutoWidth' : false, 
		'bPaginate': true,
		'sPaginationType': 'full_numbers',
		'bLengthChange': false,
		'aoColumns' : [
			{ 'sTitle': 'Address', 'sClass': 'address', 'bSortable': false  },
			{ 'sTitle': 'Roofing', 'sClass': 'odd', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Windows', 'sClass': 'even', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Doors', 'sClass': 'odd', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Bathroom', 'sClass': 'even', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Kitchen', 'sClass': 'odd', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Heating', 'sClass': 'even', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Electrics', 'sClass': 'odd', 'bSearchable': false, 'bSortable': false  },
			{ 'sTitle': 'Painting', 'sClass': 'even', 'bSearchable': false, 'bSortable': false  }
		],
		'oLanguage': {
			'sZeroRecords': '<p><b>Sorry, no results match your query.<\/b><\/p><p>If you think this is an error, please report it though our contact form.<\/p>',
			'sSearch': '<b>Search by address or postcode:</b>&nbsp; '
		}
	});
	jQuery('#investmentStaff').dataTable( {
		'iDisplayLength': 10,
		'bServerSide': true,
		'bProcessing': true,
		'bLengthChange': true,
		'sAjaxSource': '/wp-content/themes/yh/scripts/datatables-investment.php',
		'bAutoWidth' : false, 
		'bPaginate': true,
		'aLengthMenu': [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		'sPaginationType': 'full_numbers',
		'aoColumns' : [
			{ 'sTitle': 'Address', 'sClass': 'address', 'bSortable': true  },
			{ 'sTitle': 'Roofing', 'sClass': 'odd', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Windows', 'sClass': 'even', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Doors', 'sClass': 'odd', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Bathroom', 'sClass': 'even', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Kitchen', 'sClass': 'odd', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Heating', 'sClass': 'even', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Electrics', 'sClass': 'odd', 'bSearchable': false, 'bSortable': true  },
			{ 'sTitle': 'Painting', 'sClass': 'even', 'bSearchable': false, 'bSortable': true  }
		],
		// 'sDom': 'T<"clear">flirtp', // this does not work - I don't know why!!
		'oTableTools': {
			'sSwfPath': 'http://www.yorkshirehousing.co.uk/wp-content/themes/yh/scripts/copy_csv_xls_pdf.swf',
			'aButtons': [ 
				{ 'sExtends': 'xls', 'sButtonText': 'Save for Excel' },
				{ 'sExtends': 'pdf', 'sButtonText': 'Save as PDF' }
			]
		},
		'oLanguage': {
			'sZeroRecords': '<p><b>Sorry, no results match your query.<\/b><\/p><p>If you think this is an error, please report it though our contact form.<\/p>',
			'sSearch': '<b>Filter addresses:</b>&nbsp; '
		}

	});
	jQuery('#userslist2 #usertable').dataTable({
		'aaSorting': [[ 0, 'desc' ]],
		'aoColumns': [ null, null, { 'bVisible': false } ],
		'bPaginate': false,
		'bInfo': false,
		'bFilter': true,
		'bAutoWidth': true,
		'oLanguage': {
			'sZeroRecords': '<p><b>Sorry, no results match your query.<\/b><\/p><p>If you think this is an error, please report it though our contact form.<\/p>',
			'sSearch': 'Search by postcode:'
		}
	});
	jQuery('#properties').dataTable( {
		'sDom': '<"clear">lrtp',
		'iDisplayLength': -1,
		'bServerSide': true,
		'bProcessing': true,
		'sAjaxSource': '/wp-content/themes/yh/scripts/datatables-property.php',
		'bAutoWidth' : false, 
		'bPaginate': false,
		'aoColumns' : [
			{
			 	'sTitle': 'uuid', 
				'sClass': 'properties hidden',
				'bSearchable': false, 
				'bVisible': false
			},
			{ 
				'sTitle': 'URN', 
				'sClass': 'URN hidden', 
				'bSearchable': false, 
				'bVisible': false
			},
			{ 
				'sTitle': 'Weekly Rent', 
				'sClass': 'total_rent', 
				'bSearchable': false, 
				'bSortable': true  
			},
			{ 
				'sTitle': 'Type', 
				'sClass': 'property_type', 
				'bSearchable': true, 
				'bSortable': true  
			},
			{ 
				'sTitle': '', 
				'sClass': 'flat_floor_level', 
				'bSearchable': true, 
				'bSortable': false  
			},
			{ 
				'sTitle': 'Beds', 
				'sClass': 'bedrooms', 
				'bSearchable': true, 
				'bSortable': true  
			},
			{ 
				'sTitle': 'Address', 
				'sClass': 'address', 
				'bSearchable': true, 
				'bSortable': true  
			},
			{
				'sTitle': 'Postcode', 
				'sClass': 'postcode', 
				'bSearchable': true, 
				'bSortable': true  
			},
			{ 
				'sTitle': 'Age Criteria', 
				'sClass': 'criteria_age', 
				'bSearchable': true, 
				'bSortable': true  
			},
			{ 
				'sTitle': 'Adaptations', 
				'sClass': 'is_adapted', 
				'bSearchable': true, 
				'bSortable': true  
			}
		],
		'oLanguage': {
			'sZeroRecords': '<p><b>Sorry, no results match your query.<\/b><\/p><p>If you think this is an error, please report it though our contact form.<\/p>',
			'sSearch': 'Type to filter properties:&nbsp; '
		},
		"aoColumnDefs": [ {
    		"aTargets": [9],
   			"fnCreatedCell": function (nTd, sData, oData, i) {
        		if ( sData == "no" ) {
          			jQuery(nTd).removeClass('is_adapted').addClass('not_adapted');
        		} 
      		}
    	} ]
	});
});
