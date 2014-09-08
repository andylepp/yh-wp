<?php

/**

 * Template Name: Video Homepage

 *

 * Layout for Video Homepage.

 *

 */

?>

<?php



    // calling the header.php

    get_header();



    // action hook for placing content above #container

    thematic_abovecontainer();



?>



	<style type="text/css">

		#header, #breadcrumb, #footer {display:none}

		body { background-image: none /* url(<?php get_bloginfo('stylesheet_directory') ?>/images/filename.png) */; }
		
		</style>

		<div id="container" style="width:640px;margin:150px">


			<?php thematic_abovecontent(); ?>

		

			<div id="content" style="width:100%;">

	

	            <?php

	        

	            // calling the widget area 'page-top'

	            get_sidebar('page-top');

	

	            the_post();

	            

	            thematic_abovepost();

	        

	            ?>

	            

				<div style="width:100%;" id="post-<?php the_ID();

					echo '" ';

					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {

						post_class();

						echo '>';

					} else {

						echo 'class="';

						thematic_post_class();

						echo '">';

					}

	        	{
			echo '<body style="background-color:grey">';
			}        

	                // creating the post header

	                thematic_postheader();

	                

	                ?>

	                

					<div class="entry-content">

	

	                    <?php

	                    

	                    the_content();

	                    

	                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');

	                    

	                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>

	

					</div><!-- .entry-content -->

				</div><!-- #post -->

	

	        <?php

	        

	        thematic_belowpost();

	        

	        // calling the comments template

       		if (THEMATIC_COMPATIBLE_COMMENT_HANDLING) {

				if ( get_post_custom_values('comments') ) {

					// Add a key/value of "comments" to enable comments on pages!

					thematic_comments_template();

				}

			} else {

				thematic_comments_template();

			}

	        

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