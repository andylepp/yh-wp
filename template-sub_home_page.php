<?php
/**
 * Template Name: Sub Homepage
 * By Andy Leppard
 * No sidebar and 3/2/1 column layout.
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
	        
	            // calling the widget area 'page-top'
	            get_sidebar('page-top');
	
	            the_post();
	            
	            thematic_abovepost();
	        
	            ?>
	            
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
	                
	                thematic_postheader();
	                
	                ?>
	                
					<div class="entry-content">
	
	                    <?php
	                    
	                    the_content();
	                    
	                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');
	                    
	                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>
	
					</div><!-- .entry-content -->
					
					<!-- ACF Columns -->
					<?php 
					if(get_field('number_of_columns')=='1') { $colnum = '1'; }
					if(get_field('number_of_columns')=='2') { $colnum = '2'; }
					if(get_field('number_of_columns')=='3') { $colnum = '3'; }
					
					echo '<div class="columngroup entry-content">';
					if((get_field('column_1')!='') && ($colnum=='1' || $colnum=='2' || $colnum=='3')){
						echo '<div id="column_1" class="column span_1_of_'.$colnum.'">';
						the_field('column_1');
						echo '</div>';
					}
					if((get_field('column_2')!='') && ($colnum=='2' || $colnum=='3')){
						echo '<div id="column_2" class="column span_1_of_'.$colnum.'">';
						the_field('column_2');
						echo '</div>';
					}
					if((get_field('column_3')!='') && ($colnum=='3')){
						echo '<div id="column_3" class="column span_1_of_'.$colnum.'">';
						the_field('column_3');
						echo '</div>';
					}
					echo '</div>';
					?>
					
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