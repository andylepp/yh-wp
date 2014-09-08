<?php
/**
 * Template Name: News Homepage
 *
 * Layout for News Homepage.
 *
 */
?>
<?php
    // calling the header.php
    get_header();
    // action hook for placing content above #container
    thematic_abovecontainer();
?>
<div id="container" style="width:940px;margin:10px;">
	<?php thematic_abovecontent(); ?>
	<div id="content" style="width:100%;">
	<?php
	// calling the widget area 'page-top'
	get_sidebar('page-top');
	thematic_abovepost();


	$cat_idObj = 'news';
	$cat_id = $cat_idObj->term_id;	
	$postid = $wp_query->post->ID;
	global $featured;
	$featured =  get_post_meta($postid, 'featured_slideshow', true);
	// include featured news if available, ie. a category slug matches the current page slug
query_posts('cat='.$cat_id.'&meta_key=featured_slideshow&meta_value=1&showposts=-1&orderby=date&order=DESC');
	
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
		wp_reset_query();


	
	thematic_belowpost();
	// calling the widget area 'page-bottom'
	get_sidebar('page-bottom');	
	?>
	</div><!-- #content -->
	<?php thematic_belowcontent(); ?> 	
</div><!-- #container -->
<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();    
    // calling footer.php
    get_footer();
?>