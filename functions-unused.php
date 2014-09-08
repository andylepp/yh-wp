<?php
//
// Add featured posts to Level 1 Homepages
// 
add_action('thematic_abovecontent', 'L1_homepage');
function L1_homepage() {
	if(is_page_template( 'template-level1.php' )){
		$mypages = new WP_Query( array (
			'post_type' => 'any',
			'meta_key' => 'feature_on_homepage',
			'meta_value' => '1',
			'orderby' => 'post_modified',
			'order' => 'DESC',
			'limit' => '5'
			)
		);
		echo '<div id="featured-homepage">';
			foreach($mypages as $mypage) { ?>
					<h2><?php echo get_the_title($mypage->ID); ?></h2> <?php					
					$excerpt = $mypage->post_excerpt;
					if($excerpt != ''){
						echo '<p>'.$excerpt.'</p>';
					} ?>
			<?php
			}
			echo '</div><!-- #featured-homepage -->';
	wp_reset_query();
	}
}



//
// Add Featured Posts to the top of Level 3 homepages
//
function add_featuredposts() {	
	$cat_idObj = get_category_by_slug(the_slug());
	$cat_id = $cat_idObj->term_id;	
	$postid = $wp_query->post->ID;
	global $featured;
	$featured =  get_post_meta($postid, 'feature_in_category', true);
	// include featured news if available, ie. a category slug matches the current page slug
	if (is_page() && ($cat_id != '')) {		query_posts('cat='.$cat_id.'&meta_key=feature_in_category&meta_value=yes&showposts=-1&orderby=date&order=DESC');
		featured_posts_loop();
		wp_reset_query();
	} 
		return;
	
	
}	



//
// The Featured Posts Loop for add_featuredposts() on Level 3 homepages
//
function featured_posts_loop() {
	?><div class="featured"><div id="featured-posts"><?php
	while ( have_posts() ) : the_post();	
	$post_image_id = get_post_thumbnail_id($post_to_use->ID);
		if ($post_image_id) {
			$thumbnail = wp_get_attachment_image_src( $post_image_id, array( 300,450 ), false);
			if ($thumbnail) { 
				(string)$thumbnail = $thumbnail[0];
			} 
		} ?>
		<div class="featured-post">
			<h2><a href="<?php the_permalink(); ?>" title="<?php echo get_the_excerpt(); ?>" style="background: no-repeat 50% 50% url('<?php echo $thumbnail; ?>');"><span><?php the_title(); ?></span></a></h2>
		</div><!-- .post --> <?php 
	endwhile;
	echo '</div><!-- /#featured_posts --></div><!-- /.featured -->';
}



//
// Add big slideshow to top of Level 2 Homepages
//
add_action('thematic_abovecontent', 'L2_homepage');
function L2_homepage() {
	if(is_page_template( 'template-level2.php' )){
		global $wp_query;
		$postid = $wp_query->post->ID;
		/* $pages = get_posts(array(
					'child_of' => $postid,
					'numberposts' => -1,
					'post_type' => 'page',
					'meta_key' => 'feature_options',
					'meta_value' => 'feature_in_category',
					'sort_column' => 'post_modified',
					'sort_order' => 'DESC',
					'hierarchical' => 0
				)); */
		$pages = get_pages('child_of=' . get_the_ID() .'&hierarchical=0&meta_key=feature_in_category&meta_value=yes&sort_column=post_modified&sort_order=DESC');
//		$pages = get_pages('child_of=' . get_the_ID() .'&hierarchical=0&meta_key=feature_options&meta_value=feature_in_category&sort_column=post_modified&sort_order=DESC');
		if($pages) {
			echo '<div id="featured-pages">';
			foreach($pages as $page) { 
			$thumbnail = get_the_post_thumbnail($page->ID, 'homepage-feature');
			?>
			<div class="featured-page">
				<a href="<?php echo get_page_link($page->ID); ?>">
					<?php echo $thumbnail; ?>
					<div class="text">
					<h2><?php echo get_the_title($page->ID); ?></h2> <?php					
					$excerpt = $page->post_excerpt;
					if($excerpt != ''){
						echo '<p>'.$excerpt.'</p>';
					} ?>
					</div>
				</a>
			</div><!-- .post --> 
			<?php
			}
			echo '</div><!-- #featured-pages -->';
		}
	}
}



//
// Add big slideshow to top of template-2013 pages
// 
add_action('thematic_abovecontent', 'L2013_template');
function L2013_template() {
	if(is_page_template( 'template-2013.php' )){
		
		$pages = get_pages('child_of=' . get_the_ID() .'&hierarchical=0&meta_key=feature_in_category&meta_value=yes&sort_column=post_modified&sort_order=DESC');
		if($pages) {
			echo '<div id="featured-pages">';
			foreach($pages as $page) { 
			$thumbnail = get_the_post_thumbnail($page->ID, 'homepage-feature');
			?>
			<div class="featured-page">
				<a href="<?php echo get_page_link($page->ID); ?>">
					<?php echo $thumbnail; ?>
					<div class="text">
					<h2><?php echo get_the_title($page->ID); ?></h2> <?php					
					$excerpt = $page->post_excerpt;
					if($excerpt != ''){
						echo '<p>'.$excerpt.'</p>';
					} ?>
					</div>
				</a>
			</div><!-- .post --> 
			<?php
			}
			echo '</div><!-- #featured-pages -->';
		}
	}
}


?>