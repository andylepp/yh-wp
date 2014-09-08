<?php 


//
// Add promo links based on post/page tags
add_action('yh_above_post_footer', 'post_footer_promo_links');
function post_footer_promo_links() {
	if(is_single()) {
		// Make Welfare Reform Links
		if(is_single() && (has_tag('welfare-reform'))) { ?>
				<div id="welfare-reform" class="post-footer-promo"> <a href="<?php echo site_url('neighbourhoods/neighbourhood-contacts/benefits-and-money-advisors'); ?>" title="Find your Benefit and Money Advisor">Benefit &amp; Money Advisor</a>.</div>
		<?php } 
		// Make Apprenticeships Links
		if(is_single() && (has_tag('apprenticeships'))) { ?>
				<div id="apprenticeships" class="post-footer-promo"><a href="<?php echo site_url('careers/apprenticeships'); ?>" title="Find out about apprenticeships at Yorkshire Housing">More about apprenticeships at Yorkshire Housing</a></div>
		<?php } 
		// Make Magazine Promo Link
		if(is_single() && has_category('your-home-magazine')) {
				if(has_tag('issue-04')) { $linkURL = '5120/your-home-winter-2011'; $class = 'issue-04'; $linktext = 'Your Home, Winter 2011';  } 
				elseif(has_tag('issue-05')) { $linkURL = '4973/your-home-spring-2012'; $class = 'issue-05'; $linktext = 'Your Home, Spring 2012';  } 
				elseif(has_tag('issue-06')) { $linkURL = '3879/your-home-summer-2012'; $class = 'issue-06'; $linktext = 'Your Home, Summer 2012';  } 
				else { return; }
				 ?>
				<div id="your-home-magazine" class="post-footer-promo<?php echo ' '.$class; ?>">
					<a href="<?php echo site_url($linkURL); ?>" title="<?php echo $linktext; ?>">Read more of <?php echo $linktext; ?></a>				
				</div>
		<?php } 
		// Make Apply for a Home Links
		if(is_single() && (has_tag('apply'))) { ?>
				<div id="apply-for-a-home" class="post-footer-promo">Find out <a href="<?php echo site_url('homes/rent/apply'); ?>" title="Applying for a home">how to apply for a home</a> with Yorkshire Housing</div>
		<?php } 
		// Make Get Involved Links
		if(is_single() && (has_tag('get-involved'))) { ?>
				<div id="get-involved" class="post-footer-promo"><a href="<?php echo site_url('get-involved'); ?>" title="Find out how to get involved in your community">Find out how to get involved in your community</a></div>
		<?php } 
		// Make Customer Service Standards Link
		if(has_tag('customer-service-standards')) { 
			if(has_tag(array('access-to-services-and-customer-care','new-homes','allocations-and-lettings','responsive-repairs','planned-works','adaptations','environmental-services','tenancy-and-estate-management','anti-social-behaviour','community-engagement','income-management'))) {
				if(has_tag('access-to-services-and-customer-care')) { $anchor = 'access-to-services-and-customer-care'; $linktext = 'Access to Services and Customer Care';  } 
				elseif(has_tag('new-homes')) { $anchor = 'new-homes'; $linktext = 'New Homes';  } 
				elseif(has_tag('allocations-and-lettings')) { $anchor = 'allocations-and-lettings'; $linktext = 'Allocations and Lettings';  } 
				elseif(has_tag('responsive-repairs')) { $anchor = 'responsive-repairs'; $linktext = 'Responsive Repairs';  } 
				elseif(has_tag('planned-works')) { $anchor = 'planned-works'; $linktext = 'Planned Works';  } 
				elseif(has_tag('adaptations')) { $anchor = 'adaptations'; $linktext = 'Adaptations';  } 
				elseif(has_tag('environmental-services')) { $anchor = 'environmental-services'; $linktext = 'Environmental Services';  } 
				elseif(has_tag('tenancy-and-estate-management')) { $anchor = 'tenancy-and-estate-management'; $linktext = 'Tenancy and Estate Management';  } 
				elseif(has_tag('anti-social-behaviour')) { $anchor = 'anti-social-behaviour'; $linktext = 'Anti-social Behaviour';  } 
				elseif(has_tag('community-engagement')) { $anchor = 'community-engagement'; $linktext = 'Community Engagement';  } 
				elseif(has_tag('income-management')) { $anchor = 'income-management'; $linktext = 'Income Management'; } ?>
				<div class="post-footer-promo" id="customer-service-standards">Find out more about our Customer Service Standard for <a href="<?php echo site_url('about/how-we-are-governed/customer-service-standards#'.$anchor); ?>"><?php echo $linktext ?></a></div>
				<?php
			}
			else {  ?>
				<div id="customer-service-standards" class="post-footer-promo">Read more about our <a href="<?php echo site_url('about/how-we-are-governed/customer-service-standards'); ?>">Customer Service Standards</a></div>
		<?php } 
		}
		// Make Rent Account Link
		if(is_single() && (has_tag('myhome') || has_tag('rent-account'))) { ?>
				<div id="rent-account" class="post-footer-promo">Access your rent account online using <a href="<?php echo site_url('services/myhome'); ?>">MyHome</a></div>
		<?php } 
		// Make my4walls Link
		if(is_single() && has_tag('my4walls')) { ?>
				<div id="my4walls" class="post-footer-promo"><a class="graphic" href="http://www.my4walls.co.uk" title="Local HomeBuy Agent for West Yorkshire, North Yorkshire and Humberside">My4Walls</a> helps make home ownership affordable. <a href="http://www.my4walls.co.uk" title="Local HomeBuy Agent for West Yorkshire, North Yorkshire and Humberside">Visit My4Walls</a>.</div>
		<?php } 
		// Make Space Property Link
		if(is_single() && has_tag('space-property')) { ?>
				<div id="space-property" class="post-footer-promo"><a href="http://www.spaceproperty.co.uk" title="Market rent properties in Yorkshire">Space Property</a> offer high quality homes for rent at market prices or discounted rates throughout Yorkshire.</div>
		<?php } 
		//
		//
		// TODO MAKE LIFE/FOOD/GARDENWORKS PROMO LINKS
		//
		//
		// Make LifeWorks Link
		//if(is_single() && has_tag('lifeworks')) { ?>
				<!-- <div id="lifeworks" class="post-footer-promo"><a href="http://www.yhlifeworks.co.uk" title="">LifeWorks</a></div> -->
		<?php // } 
		// Make FoodWorks Link
		// if(is_single() && has_tag('foodworks')) { ?>
				<!-- <div id="foodworks" class="post-footer-promo"><a href="http://www.yhfoodworks.co.uk" title="">FoodWorks</a></div> -->
		<?php // } 
		// Make GardenWorks Link
		// if(is_single() && has_tag('foodworks')) { ?>
				<!-- <div id="gardenworks" class="post-footer-promo"><a href="http://www.yhgardenworks.co.uk" title="">GardenWorks</a></div> -->
		<?php // } 
		//
		//
		//
		//
		//
		return;
	}
}

// Modify post footer
function yh_thematic_postfooter() {
    global $id, $post;
    do_action('yh_above_post_footer');
    if ($post->post_type == 'page' && current_user_can('edit_posts')) { /* For logged-in "page" search results */
        $postfooter = '<div class="entry-utility">' . '<span class="edit">' . thematic_postfooter_posteditlink() . '</span>';
        $postfooter .= "</div><!-- .entry-utility -->
        ";
    } elseif ($post->post_type == 'page') { /* For logged-out "page" search results */
        $postfooter = '<div class="entry-utility"></div><!-- .entry-utility -->
        ';
    } else {
        if (is_single()) {
            $postfooter = '<div class="entry-utility">'.thematic_postfooter_postcategory().thematic_postfooter_posttags();
        } else {
            $postfooter = '<div class="entry-utility">'.thematic_postfooter_postcategory().thematic_postfooter_posttags().thematic_postfooter_postcomments();
        }
        $postfooter .= '</div><!-- .entry-utility -->
        ';
    }
    // Put it on the screen
    echo apply_filters( 'yh_thematic_postfooter', $postfooter ); // Filter to override default post footer
} // end thematic_postfooter
add_filter('thematic_postfooter','yh_thematic_postfooter');
?>
