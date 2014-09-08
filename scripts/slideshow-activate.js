jQuery(document).ready(function($){
	// Featured on News Page slider
	$('#query-posts-7')
		.after('<li id="featured-stories-nav">Featured stories: ')
		.cycle({
			fx: 'scrollLeft', 
			pager: '#featured-stories-nav',
			delay: 500,
			easing: 'easeOutExpo',
			speed: 900
		});
	// Development Contacts slider
	$('.page-id-1005 #userslist1 .tbody')
		.after('<a style="float:right;margin-right:15px;" href="?p=7768#page-bottom">See all</a>')
		.cycle({
			fx: 'fade', 
			delay: 1000,
			easing: 'easeOutExpo',
			speed: 500,
			pause:1
		});
	// Development(43), Neighbourhoods (63), Get Involved (64), About (65), Money (44), Sheltered Housing Schemes (69) and Extra Care (71) Featured Posts slider
	$('#query-posts-43, #query-posts-63, #query-posts-64, #query-posts-65, #query-posts-44, #query-posts-69, #query-posts-71')
		.append('<div id="featured-pages-nav" class="slideshow-nav">')
		.cycle({
			fx: 'fade', 
			pager: '#featured-pages-nav',
			delay: 2500,
			easing: 'easeOutExpo',
			speed: 1000,
			slideExpr: 'div.post, div.page, div.scheme'
		});
	// Care and Support (73) featured_in_category Posts slider
	$('#query-posts-73')
		.cycle({
			fx: 'fade', 
			delay: 2500,
			easing: 'easeOutExpo',
			speed: 1000,
			slideExpr: 'div.post'
		});
	// Homepage Feature Posts slider
	$('#query-posts-60')
		.prepend('<div id="minimal-posts-nav" class="slideshow-nav">')
		.cycle({
			fx: 'fade', 
			pager: '#minimal-posts-nav',
			delay: 5000,
			easing: 'easeOutExpo',
			speed: 1000,
			slideExpr: 'div.post'
		});
});