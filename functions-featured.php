<?php


//
// Get post thumbnail meta information
//
function the_post_thumbnail_meta($meta='title') {
	global $post;
	$thumb_id = get_post_thumbnail_id($post->id);
	$args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
	); 
	$thumbnail_image = get_posts($args);
	if ($thumbnail_image) {
		if($meta == 'title') {
			$text = get_post(get_post_thumbnail_id())->post_title; 
		}
		if($meta == 'caption') {
			$text = get_post(get_post_thumbnail_id())->post_excerpt; 
		}			
		if($meta == 'description') {
			$text = get_post(get_post_thumbnail_id())->post_content; 
		}
		if($meta == 'alt') {
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if(count($alt)) {
				$text = $alt; 
			}
		}
		return $text;
	}
}
//
// - - - - - - - - - - 
//



//
// Add Featured Content to the top of posts and pages
//
add_action('thematic_abovecontent', 'add_featuredcontent');
function add_featuredcontent() {	
	if(is_single() || is_page()) {
		if(is_page_template( 'template-level2.php' ) || is_page_template( 'template-quickqa.php' )) {
			return;
		} else {	
			// Get content ID and check for featured content
			global $wp_query;
			$postid = $wp_query->post->ID;
			$pullquote =  get_post_meta($postid, 'pull-quote', true);
			$hidefeaturedimg =  get_post_meta($postid, 'hide_featured_image', true);			
			$thumbnailtitle = the_post_thumbnail_meta('title');
			$thumbnailcaption = the_post_thumbnail_meta('caption');
			if((has_post_thumbnail() && ($hidefeaturedimg!="yes")) || !empty($pullquote)) {
				echo '<div class="featured">';				
				echo '<div id="featured-content">';
				// Find and draw the featured image
				if(has_post_thumbnail() && ($hidefeaturedimg!="yes")) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					echo '<div id="featured-image">';
					echo '<a rel="gallery" class="fancybox" href="' . $large_image_url[0] . '" title="'.$thumbnailtitle.'" >';	
					if(is_singular('development')) {
						echo get_the_post_thumbnail($postid, 'homepage-feature');
					} else {
						echo get_the_post_thumbnail($postid, 'post-featured');
					}
					echo '</a>';
					if(!empty($thumbnailcaption)){
						echo '<span class="thumb-caption">'.$thumbnailcaption.'</span>';
					}
					echo '</div>';
				} // End of featured image code
				echo '</div><!-- /featured-content --></div><!-- /.featured -->';
			}
		}
	}
}
//
// - - - - - - - - - - 
//



//
// Add Gallery Images to the top of property pages
//
add_action('thematic_before', 'add_gallery_images');
function add_gallery_images() {	
	if(is_singular('property')) {
		// check if the repeater field has rows of data
		if( have_rows('gallery_images') ):

			// loop through the rows of data
			while ( have_rows('gallery_images') ) : the_row();

				// display a sub field value
				the_sub_field('gallery_image');

			endwhile;

		else :

			// no rows found

		endif;
	}
}
//
// - - - - - - - - - - 
//



//	
// Draw the pull quote					
//
function add_pullquote() {	
	global $wp_query;
	$postid = $wp_query->post->ID;
	$pullquote =  get_post_meta($postid, 'pull-quote', true);
	if(!empty($pullquote)) {
		echo '<div id="pull-quote">';
		echo '<blockquote><span class="quote">';
		echo $pullquote;
		echo '</span></blockquote>';
		$pullquotesource = get_post_meta($postid, 'pull-quote-source', true);
		if(!empty($pullquotesource)) {
			echo '<p>';
			echo $pullquotesource;
			echo '</p>';
		}
		echo '</div>';
	} // End of pull quote code
}
add_action('thematic_betweenmainasides', 'add_pullquote');
//
// - - - - - - - - - - 
//



//
// Display Flickr Slideshow on "Press and Media Enquiries" page
add_action('thematic_belowcontent', 'add_flickrpics');
function add_flickrpics() { 
	if(is_page('press-and-media-enquiries')) { ?>
<div style="margin-bottom:50px;"><object width="600" height="450"> <param name="flashvars" value="offsite=true&lang=en-us&page_show_url=%2Fphotos%2Fyorkshirehousing%2Fsets%2F72157626711365174%2Fshow%2F&page_show_back_url=%2Fphotos%2Fyorkshirehousing%2Fsets%2F72157626711365174%2F&set_id=72157626711365174&jump_to="></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=109615"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=109615" allowFullScreen="true" flashvars="offsite=true&lang=en-us&page_show_url=%2Fphotos%2Fyorkshirehousing%2Fsets%2F72157626711365174%2Fshow%2F&page_show_back_url=%2Fphotos%2Fyorkshirehousing%2Fsets%2F72157626711365174%2F&set_id=72157626711365174&jump_to=" width="600" height="450"></embed></object></div>
<?php
	}
}



//
//
// Display Current Vacancies on "Careers", and "Job Vacancies" pages
// Made using wordpress RSS function fetch_feed() and SimplePie 
// http://simplepie.org/wiki/reference/start#simplepie_item
//
//
function current_vacancies($args) {
   extract($args);
   echo $before_widget;
   echo $before_title . 'Current Vacancies' . $after_title;
   echo $after_widget;
   // print some HTML for the widget to display here
   add_networxrss();
}

wp_register_sidebar_widget(
    'networx_vacancies', // your unique widget id
    'Networx Vacancies', // widget name
    'current_vacancies', // callback function
    array(               // options
        'description' => 'Adds Current Vacancies from Networx'
    )
);
function add_networxrss() { 

		// Get RSS Feed(s)
		include_once( ABSPATH . WPINC . '/feed.php' );

		// change the default feed cache recreation period to 2 hours
		function return_7200( $seconds ) {
		  return 7200;
		}
		add_filter( 'wp_feed_cache_transient_lifetime' , 'return_7200' );

		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://www.latestvacancies.com/yorkshirehousinggroup/rssfeedexternal.asp' );
		
		// reset feed cache
		remove_filter( 'wp_feed_cache_transient_lifetime' , 'return_7200' );

		if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly

			// Figure out how many total items there are, but limit it to 5. 
			$maxitems = $rss->get_item_quantity( 100 ); 

			// Build an array of all the items, starting with element 0 (first element).
			$rss_items = $rss->get_items( 0, $maxitems );

		endif;
		?>

				<ul>
					<?php if ( $maxitems == 0 ) : ?>
						<li><?php // _e( 'Sorry, we have no vacancies', 'my-text-domain' ); ?></li>
					<?php else : ?>
						<?php // Loop through each feed item and display each item as a hyperlink. ?>
						<?php foreach ( $rss_items as $item ) : ?>
							<li>
								<h4><a href="<?php echo esc_url( $item->get_permalink() ); ?>">
									<?php echo esc_html( $item->get_title() ); ?>
								</a></h4> 
								<p>
									<?php 
										$var = $item->get_item_tags('', 'location');
										print_r($var[0]['data'], false);
									?>, 
									<?php 
										$var = $item->get_item_tags('', 'salary');
										print_r($var[0]['data'], false);
									?>
								<br/>Closing date: 
									<?php 
										$var = $item->get_item_tags('', 'ClosingDate');
										$closinginfo = preg_split("/[\s]+/", $var[0]['data']);
										print_r($closinginfo[0], false);
									?></p>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
		<?php
}
//
// - - - - - - - - - - -
//


//
// Admin stuff


//
// Add a new column to the "Posts" page
add_filter('manage_posts_columns', 'featured_slideshows_column');
function featured_slideshows_column($columns) {
    $columns['featured'] = 'Featured';
    return $columns;
}


//
// Return a value to the "Posts" page
add_action('manage_posts_custom_column',  'show_featured_slideshows_column');
function show_featured_slideshows_column($name) {
    global $post;
    switch ($name) {
        case 'featured':
            if( get_post_meta($post->ID, 'feature_in_category', true) == yes ) { echo 'In Category<br/>'; }            
           	if ( get_post_meta($post->ID, 'feature_on_news_page', true) == yes ) { echo 'On News Page<br/>'; }
           	if ( get_post_meta($post->ID, 'feature_on_homepage', true) == yes ) { echo 'On Home Page<br/>'; }
            if( get_post_meta($post->ID, 'feature_in_category', true) == 1 ) { echo 'In Category (OLD)<br/>'; }            
           	if ( get_post_meta($post->ID, 'feature_on_news_page', true) == 1 ) { echo 'On News Page (OLD)<br/>'; }
           	if ( get_post_meta($post->ID, 'feature_on_homepage', true) == 1 ) { echo 'On Home Page (OLD)<br/>'; }
           	if ( get_post_meta($post->ID, 'hide_featured_image', true) == 1 ) { echo 'Hide Featured Image (OLD)<br/>'; }
    }
}
?>