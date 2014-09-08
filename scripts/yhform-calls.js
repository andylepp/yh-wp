jQuery(document).ready(function($){
	//
	// Make fields class="disabled" readonly
	jQuery('li.disabled input').attr("readonly", "readonly");
	//
	// Notice to quit form date wrangling
	//
	// Custom function to enable MONDAY only in jquery calender
	function enableMONDAYS(date) {
		var day = date.getDay();
		return [(day == 1), '']; 
	}
	jQuery("#input_37_44").attr("readonly", "readonly").datepicker({
		showOn: 'focus',
		dateFormat: "DD, dd MM yy",
		minDate: 0,
		beforeShowDay: enableMONDAYS,
		onSelect: function (date) {
			// The only field where a user can choose a date
			var date1 = jQuery('#input_37_44').datepicker('getDate');
			var date2 = jQuery('#input_37_44').datepicker('getDate');
			date1.setDate(date1.getDate());
			date2.setDate(date2.getDate() + 27);
			
			// Notice period ENDS (Shown in "Ending your tenancy" section)
			jQuery('#input_37_27').datepicker('setDate', date2);
			
			// Notice period BEGINS (Shown in "Confirmation of termination of tenancy" section)
			jQuery('#input_37_43').datepicker('setDate', date1);
			
			// Notice period BEGINS (Shown in "Confirmation of termination of tenancy" section)
			jQuery('#input_37_37').datepicker('setDate', date2);
			
		}
	});
	//
	// Diable all the datepicker
	jQuery('#input_37_27').attr("readonly", "readonly").datepicker({
		showOn: 'none',
		dateFormat: "DD, dd MM yy"
	});
	jQuery('#input_37_37').attr("readonly", "readonly").datepicker({
		showOn: 'none',
		dateFormat: "DD, dd MM yy"
	});
	jQuery('#input_37_43').attr("readonly", "readonly").datepicker({
		showOn: 'none',
		dateFormat: "DD, dd MM yy"
	});
});
