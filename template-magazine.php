<?php
/**
 * Template Name Posts: Magazine Layout
 *
 * Layout for a Your Home Issue NN post.
 *
 */
?>
<?php
 
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

		<div id="container">
			
			<?php thematic_abovecontent(); ?>
			
			<div id="content">

    	        <?php 
    	        
    	        the_post();
    	        		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
		
    	        // action hook creating the single post
    	        thematic_singlepost();
				
    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');

///////////////////////////////////////////////////////////////
//
//
// Get the custom field value
global $wp_query;
$postid = $wp_query->post->ID;
$issue = get_post_meta($postid, 'your-home-issue-number', true);
$issue = str_pad($issue, 2, '0', STR_PAD_LEFT);
if($issue==''){ $issue = 'issue-00'; } else { $issue = 'issue-'.$issue; }

function mag_posts_loop() {
	// Write the post info
		$pfx_date = get_the_date( $d );
						echo '<li>';
						echo $pfx_date;
						echo ': <a href="';
							the_permalink();
						echo '">';
							the_title();
						echo '</a></li>';
	return;
}

//
// Get posts that are in this issue and "Featured" 
query_posts(array(
	'post__not_in'=>$do_not_duplicate,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array($issue,'featured'),
			'operator' => 'AND'
		)
	)
));
if ( have_posts() ) {
	echo '<h3>Featured Stories</h3>';
	echo '<ul>';
	while ( have_posts() ) : the_post();
		$do_not_duplicate[] = $post->ID;
		mag_posts_loop();
	endwhile; 
	echo '</ul>';
}

//
// Now get posts that are in this issue and 
query_posts(array(
	'post__not_in'=>$do_not_duplicate,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array($issue,'your-home-extra'),
			'operator' => 'AND'
		)
	)
));
if ( have_posts() ) {
	echo '<h3>Your Home Extra Stories</h3>';
	echo '<ul>';
	while ( have_posts() ) : the_post();
		$do_not_duplicate[] = $post->ID;
		mag_posts_loop();
	endwhile; 
	echo '</ul>';
}

//
// Now get posts that are labelled In Brief
query_posts(array(
	'post__not_in'=>$do_not_duplicate,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array($issue,'in-brief'),
			'operator' => 'AND'
		)
	)
));
if ( have_posts() ) {
	echo '<h3>In Brief</h3>';
	echo '<ul>';
	while ( have_posts() ) : the_post();
		$do_not_duplicate[] = $post->ID;
		mag_posts_loop();
	endwhile; 
	echo '</ul>';
}

//
// Now get posts that are labelled Your Money
query_posts(array(
	'post__not_in'=>$do_not_duplicate,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array($issue,'your-money'),
			'operator' => 'AND'
		)
	)
));
if ( have_posts() ) {
	echo '<h3>Your Money</h3>';
	echo '<ul>';
	while ( have_posts() ) : the_post();
		$do_not_duplicate[] = $post->ID;
		mag_posts_loop();
	endwhile; 
	echo '</ul>';
}

//
// Now get posts that are labelled Youth
query_posts(array(
	'post__not_in'=>$do_not_duplicate,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array($issue,'youth'),
			'operator' => 'AND'
		)
	)
));
if ( have_posts() ) {
	echo '<h3>Youth!</h3>';
	echo '<ul>';
	while ( have_posts() ) : the_post();
		$do_not_duplicate[] = $post->ID;
		mag_posts_loop();
	endwhile; 
	echo '</ul>';
}







//
// Now display all the remaining articles from this issue 
query_posts(array(
	'post__not_in'=>$do_not_duplicate,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => $issue
		)
	)
));
if ( have_posts() ) {
	echo '<h3>Everything Else</h3>';
	echo '<ul>';
	while ( have_posts() ) : the_post();
		$do_not_duplicate[] = $post->ID;
		mag_posts_loop();
	endwhile; 
	echo '</ul>';
}


wp_reset_query();	
 
/////////////////////////////////////////////////////////////// 
 
    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
    	        
    	        ?>
		
			</div><!-- #content -->
			
			<?php thematic_belowcontent(); ?> 
			
		</div><!-- #container -->
		
<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>