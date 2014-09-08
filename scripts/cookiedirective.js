jQuery(document).ready(function() {
	jQuery.cookiesDirective({
		privacyPolicyUri: '/about/website/cookie-usage-guide',
		explicitConsent: false, // false allows implied consent
		position: 'top', // top or bottom of viewport
		duration: 10, // display time in seconds
		message: 'We use cookies on this website to make it work well, and to monitor which pages are popular.', // customise the disclosure message              
		fontSize: '14px', // font size for disclosure panel
		linkColor: '#cccccc' // link color in disclosure panel
	});
});
