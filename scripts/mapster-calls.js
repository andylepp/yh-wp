jQuery(document).ready(function($){
	$(function() {
		// a cross reference of area names to text to be shown for each area
		var xref = {
			Barnsley: '<p>We let most of our homes in the <b>Barnsley Metropolitan Borough Council<\/b> area via the <a href="#Homeseeker">Homeseeker<\/a> Choice Based Lettings scheme.<\/p><p>We also retain a <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> for a small number of more readily available homes.<\/p>',
			Bradford: '<p>We let half of our homes in the <b>Bradford City Council<\/b> area via Bradford City Council\'s <a href="#OpenMoves">Open Moves<\/a> Value Based Lettings scheme.<\/p><p>We also retain a <a href="#YHWaitingList">Yorkshire Housing Waiting List<\/a> for a small number of more readily available homes.<\/p>',
			Calderdale: '<p>We let most of our homes in the <b>Calderdale Council<\/b> area via the <a href="#KeyChoice">KeyChoice<\/a> Choice Based Lettings scheme.<\/p><p>We also retain a <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> for a small number of more readily available homes.<\/p>',
			Craven: '<p>All our homes in the <b>Craven District Council<\/b> area are let via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>',		
			Doncaster: '<p>We have our own <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> in the <b>Doncaster Metropolitan Borough Council<\/b> area.<\/p><p>We also let half our vacant homes through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			EastRiding: '<p>All our homes in the <b>East Riding of Yorkshire<\/b> are let through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			Hambleton: '<p>We have no homes in the <b>Hambleton District Council<\/b> area.<\/p><p>You can still apply for a home via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>',		
			Harrogate: '<p>All our homes in the <b>Harrogate Borough Council<\/b> area are let through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p><p>All applications in Harrogate should be made via Harrogate Borough Council.<\/p>',
			Hull: '<p>All our homes in the <b>Hull City Council<\/b> area are let through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			Kirklees: '<p>We have our own <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> in the <b>Kirklees Council<\/b> area.<\/p><p>We also let half our vacant homes through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			Leeds: '<p>All our homes in the <b>Leeds City Council<\/b> area are let through <a href="#LeedsHomesRegister">Leeds Homes Register<\/a>, managed by the Local Authority.<\/p>',
			Richmondshire: '<p>We have no homes in the <b>Richmondshire District Council<\/b> area.<\/p><p>You can still apply for a home via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>',
			Rotherham: '<p>We have our own <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> in the <b>Rotherham Metropolitan Borough Council<\/b> area.<\/p><p>We also let half our vacant homes through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			Ryedale: '<p>All our homes in the <b>Ryedale District Council<\/b> area are let via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>',		
			Scarborough: '<p>We have no homes in the <b>Scarborough Borough Council<\/b> area.<\/p><p>You can still apply for a home via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>',		
			Selby: '<p>All our homes in the <b>Selby District Council<\/b> area are let via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>',		
			Sheffield: '<p>We have our own <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> in the <b>Sheffield City Council<\/b> area.<\/p><p>We also let half our vacant homes through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			Wakefield: '<p>We have our own <a href="#YHWaitingList">Yorkshire Housing waiting list<\/a> in the <b>Wakefield Council<\/b> area.<\/p><p>We also let half our vacant homes through <a href="#Nominations">Nomination<\/a> from the Local Authority.<\/p>',
			York: '<p>All our homes in the <b>City of York Council<\/b> area are let via the <a href="#NorthYorkshireHomechoice">Homechoice<\/a> Choice Based Lettings scheme.<\/p>'	
		};	
		$('#RegionMap').mapster({
			render_highlight: {
				fillColor: '9D9FA1',
				fillOpacity: 0.3
				},
			render_select: {
				fillColor: '9D9FA1',
				fillOpacity: 0.6
				},
			singleSelect: true,
			stroke: true,
			strokeColor: 'ffffff',
			strokeOpacity: 1,
			strokeWidth: 2,
			mapKey: 'alt',
			onClick: function (e) {
					$('#infoText').html(xref[e.key]);
					$('#textPane').effect('highlight', 'fast');
			},
			showToolTip: true,
			toolTipClose: ["tooltip-click", "area-mouseout"],
			listKey: 'alt' ,
			areas: [
     		{
     			key: "Barnsley",
     			toolTip: "Barnsley Metroplitan Borough Council"
     		},
     		{
     			key: "Bradford",
     			toolTip: "Bradford City Council"
     		},
     		{
     			key: "Richmondshire",
     			toolTip: "Richmondshire District Council"
     		},
     		{
     			key: "Craven",
     			toolTip: "Craven District Council"
     		},
     		{
     			key: "Hambleton",
     			toolTip: "Hambleton District Council "
     		},
     		{
     			key: "Harrogate",
     			toolTip: "Harrogate Borough Council "
     		},
     		{
     			key: "EastRiding",
     			toolTip: "East Riding of Yorkshire Council"
     		},
     		{
     			key: "Calderdale",
     			toolTip: "Calderdale Council"
     		},
     		{
     			key: "Hull",
     			toolTip: "Hull City Council"
     		},
     		{
     			key: "Kirklees",
     			toolTip: "Kirklees Council"
     		},
     		{
     			key: "Leeds",
     			toolTip: "Leeds City Council"
     		},
     		{
     			key: "Rotherham",
     			toolTip: "Rotherham Metropolitan Borough Council"
     		},
     		{
     			key: "Ryedale",
     			toolTip: "Ryedale District Council"
     		},
     		{
     			key: "Scarborough",
     			toolTip: "Scarborough Borough Council"
     		},
     		{
     			key: "Selby",
     			toolTip: "Selby District Council"
     		},
     		{
     			key: "Sheffield",
     			toolTip: "Sheffield City Council"
     		},
     		{
     			key: "Doncaster",
     			toolTip: "Doncaster Metropolitan Borough Council"
     		},
     		{
     			key: "Wakefield",
     			toolTip: "Wakefield Council"
     		},
     		{
     			key: "York",
     			toolTip: "City of York Council"
     		}
     		]
		});
	});
});
	
