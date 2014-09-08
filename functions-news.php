<?php
///////////////////////////////////////////////////////
//

//
// Modify Thematic indexloop
function remove_index_loop() {
  remove_action('thematic_indexloop', 'thematic_index_loop');
  remove_action('thematic_categoryloop', 'thematic_category_loop');
  remove_action('thematic_authorloop', 'thematic_author_loop');
  remove_action('thematic_archiveloop', 'thematic_archive_loop');
  remove_action('thematic_tagloop', 'thematic_tag_loop');
}
add_action('init', 'remove_index_loop');

function yh_indexloop() {
	while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID();
				echo '" ';
				if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
					post_class();
					echo '>';
				} else {
					echo 'class="';
					thematic_post_class();
					echo '">';
				}
					thematic_postheader(); ?>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post -->
		<?php 
	endwhile;
}
add_action('thematic_indexloop', 'yh_indexloop');
add_action('thematic_categoryloop', 'yh_indexloop');
add_action('thematic_authorloop', 'yh_indexloop');
add_action('thematic_archiveloop', 'yh_indexloop');
add_action('thematic_tagloop', 'yh_indexloop');


//
// Add thumbnails to post lists
function my_postheader($postheader) {
	if ( is_home() || is_archive() ) {
		if ( has_post_thumbnail() ) {
		   $postmeta .= the_post_thumbnail('thumbnail');
		} else {
			$postmeta .= 'Andy rules!';
		}
	}
	return $postheader;
	}
add_filter('thematic_postheader', 'my_postheader');


//
// Make thumbnails clickable on post list pages
function my_post_image_html( $html, $post_id, $post_image_id ) {
	if ( is_home() || is_archive() ) {
  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	}
  return $html;
	}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );


//
// Add news stories to the bottom of pages based on page name/category
function add_yh_posts() {	
	$cat_idObj = get_category_by_slug(the_slug());
	$cat_id = $cat_idObj->term_id;	
	
	if (is_page() && ($cat_id != '')) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts('cat='.$cat_id.'&showposts=5&paged='.$paged.'&orderby=date&order=DESC');
		?><div id="section-posts">
		<h2 class="section-title">Articles in this section</h2><?php
		yh_indexloop();
		thematic_navigation_below();
		?></div><?php
		wp_reset_query();
		return;
	} else {
		return;
	}
}	
// add_action('thematic_belowcontent', 'add_yh_posts');

//
//	Add press contact details below posts in the Press Releases category
function add_press_footer() {
	if (is_single() && in_category( 'press-releases' )) {
	?>
		<div id="press-contact-details">
			<p>For more details about this story please contact our <a href="mailto:media@yorkshirehousing.co.uk">Communications Team</a></p>
			<p>Yorkshire Housing is one of the largest social housing providers dedicated to Yorkshire, managing over 15,000 affordable homes and providing a wide range of care and support services across the region. </p>
		</div>
	<?php return;
	}
}
add_action('thematic_belowpost', 'add_press_footer');

//
// Modify Category Page titles
add_filter('thematic_page_title','childtheme_page_title');
function childtheme_page_title($content){
	if (is_category()) {
		$content = '<h1 class="entry-title">';
		$content .= '<span class="lighter">';
		$content .= __('Browsing category:', 'thematic');
		$content .= '</span> ';
		$content .= single_cat_title('', FALSE);
		$content .= '</h1>' . "\n";
		$content .= '<div class="archive-meta">';
		if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
		$content .= '</div>';
	}
	
	$content .= "\n";
	
	/*when filter you must always end your function w RETURN $variable or else nothing gets sent back to the parent function */
	
	return $content;
}

?>