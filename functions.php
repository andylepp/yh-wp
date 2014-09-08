<?php

include('functions-featured.php');
include('functions-news.php');
include('functions-contacts.php');
include('functions-promotions.php');

//
// Register styles and scripts with Wordpress
//
add_action('init','yh_register_scripts');
function yh_register_scripts(){
	if(!is_admin()){
		// Register Gotham styles from typography.com
		wp_register_style('yhgotham', '//cloud.typography.com/721776/701384/css/fonts.css');
		// Register FS Me styles from fontdeck.com
		wp_register_style('yhfsme', '//f.fontdeck.com/s/css/FoLoWApGXZjIs3iiRyd/SoekOSM/yorkshirehousing.co.uk/15686.css');
		// Register test styles (for working on test page)
		wp_register_style('yhtest', get_bloginfo('stylesheet_directory').'/yhtest.css');
		// Register styles for form "Working out your budget"
		wp_register_style('yhform', get_bloginfo('stylesheet_directory').'/yhform.css');
		// Register styles for homepage
		wp_register_style('yh-homepage', get_bloginfo('stylesheet_directory').'/style-homepage.css');
		// Register styles for newspage
		wp_register_style('yh-newspage', get_bloginfo('stylesheet_directory').'/style-newspage.css');
		// add jquery UI effects, fade and highlight
		wp_register_script('eucookies', get_bloginfo('stylesheet_directory').'/scripts/jquery.cookiesdirective.js', array('jquery'), '2.0');
		wp_register_script('easing', get_bloginfo('stylesheet_directory').'/scripts/jquery.easing.1.3.js', array('jquery'), '1.0');
		// add jquery UI effects, fade and highlight
		wp_register_script('ui-effects', get_bloginfo('stylesheet_directory').'/scripts/jquery-ui-1.8.20.custom.min.js', array('jquery'), '1.0');
		// add jquery for "featured" slideshows
		wp_register_script('cycle', get_bloginfo('stylesheet_directory').'/scripts/jquery.cycle.all.min.js', array('jquery'), '1.0');
		// add jquery for imagemap browsing
		wp_register_script('mapster', get_bloginfo('stylesheet_directory').'/scripts/jquery.mapster.min.js', array('jquery'), '1.2.4.065');
		// add Datatables for contacts browisng and investment data
		wp_register_script('datatables', get_bloginfo('stylesheet_directory').'/scripts/jquery.dataTables.min.js', array('jquery'), '1.0');
		wp_register_script('tabletools', get_bloginfo('stylesheet_directory').'/scripts/TableTools.min.js', array('jquery','datatables'), '1.0');
		// Register exit survey script
		wp_register_script('xitsurvey', get_bloginfo('stylesheet_directory').'/jsexit/XitSurveyInit.js', array('jquery'), '1.0');
		// Register calls script for Working Out Your Budget Form, and Notice to Quit Form
		wp_register_script('yhform-calls',  get_bloginfo('stylesheet_directory')  . '/scripts/yhform-calls.js', array('jquery', 'jquery-ui-datepicker'), '1.0');
		// Add fontdeck fonts
		wp_register_script('fontdeck',  get_bloginfo('stylesheet_directory')  . '/scripts/fontdeck.js', '1.0');
	}
}
//
// - - - - - - - - - - 
//



//
// Conditionally load scripts dependent on page need
//
add_action('wp_enqueue_scripts', 'yh_load_scripts');
function yh_load_scripts(){
	if(is_page(584)) {
		wp_enqueue_script('mapster-calls',  get_bloginfo('stylesheet_directory')  . '/scripts/mapster-calls.js', array('mapster', 'ui-effects'), '1.0', true);
	}
	if(is_page(5529)) {
		wp_enqueue_script('tabletools',  get_bloginfo('stylesheet_directory')  . '/scripts/TableTools.min.js', array('jquery', 'datatables'), '1.0');
	}
	if(is_page(array(9080,619,5529,2607,2612,2400,2615,2617,2627,2619,'neighbourhood-officers','income-officers','benefits-and-money-advisors','investment-schedule','development-contacts','money','test'))) {
		wp_enqueue_script('datatables-calls',  get_bloginfo('stylesheet_directory')  . '/scripts/datatables-calls.js', array('jquery', 'datatables'), '1.0');
	}
	if(is_page_template('template-level1.php') || is_page_template('template-sub_home_page.php') || is_single(array('sheltered-housing-schemes','extra-care-schemes')) || is_page(array('about','development','neighbourhoods','get-involved'))) {
		wp_enqueue_script('slideshow-activate',  get_bloginfo('stylesheet_directory')  . '/scripts/slideshow-activate.js', array('jquery', 'cycle'), '1.0');
	}
	 if(!is_admin()) {
		// Load Gotham font
		wp_enqueue_style('yhgotham', '//cloud.typography.com/721776/701384/css/fonts.css');
		// Add fontdeck CSS to the head
		wp_enqueue_style('yhfsme', '//f.fontdeck.com/s/css/FoLoWApGXZjIs3iiRyd/SoekOSM/yorkshirehousing.co.uk/15686.css');		
		// currently blocked by IT for YH network users!
		// wp_enqueue_script('fontdeck', get_bloginfo('stylesheet_directory').'/scripts/fontdeck.js');
		// Add exit survey script to the footer
		wp_enqueue_script('xitsurvey', get_bloginfo('stylesheet_directory').'/jsexit/XitSurveyInit.js', array('jquery'), NULL, true);
		// Add eu cookie script	
		wp_enqueue_script('eucookies', get_bloginfo('stylesheet_directory').'/scripts/jquery.cookiesdirective.js', array('jquery'), '2.0');
		wp_enqueue_script('eucookies-call', get_bloginfo('stylesheet_directory').'/scripts/cookiedirective.js', array('jquery'), NULL, true);
	}
	if(is_page(array(7965,'terminate-tenancy','test'))) {
		wp_enqueue_style('yhform', get_bloginfo('stylesheet_directory').'/yhform.css');
		wp_enqueue_script('yhform-calls',  get_bloginfo('stylesheet_directory')  . '/scripts/yhform-calls.js', array('jquery-ui-datepicker','jquery'), NULL);
	}
	if(is_page(array('home','development', 'test'))) {
		wp_enqueue_style('yh-homepage', get_bloginfo('stylesheet_directory').'/style-homepage.css');
	}
	if(is_page('latest-news')) {
		wp_enqueue_style('yh-newspage', get_bloginfo('stylesheet_directory').'/style-newspage.css');
	}
	if(is_page('test') || is_single('5484')) {
		wp_enqueue_style('yhtest', get_bloginfo('stylesheet_directory').'/yhtest.css');
	}
}
//
// - - - - - - - - - - 
//



//
// Deregister all the bumpf for Very Plain Page Template
//
// Could this be expanded to optimise the site generally?
//
add_action( 'wp_print_styles', 'deregister_bumpf', 100 );

function deregister_bumpf() {
	if(is_page_template('template-plainvery.php')) {
		wp_deregister_style( array( 'avatars', 'eu-cookie-directive', 'theme-my-login' ));
	}
}
//
// - - - - - - - - - - 
//



//
// set the max width of images for inclusion in posts
//
if ( ! isset( $content_width ) ) $content_width = 600;
//
// - - - - - - - - - - 
//



//
// remove the max width declarations for mailchimp rss images
// Instead, set RSS image sizes in Dashboard > Settings > RSS Image Resize (plugin)
//
remove_filter( 'mb_rss_extend_item_media_image_dimension', 'mb_rss_image_fullwidth' );
//
// - - - - - - - - - - 
//



//
// Enable excerpts for pages 
//
add_post_type_support( 'page', 'excerpt' );
//
// - - - - - - - - - - 
//



//
// Exclude categories from the blog home page news feed
// I don't think we use this anymore lol :)
//
function excludeposts() {
	if (is_home()) {
		query_posts("cat=-114,-124,-66");
	}
}
add_filter ('thematic_above_indexloop','excludeposts');
//
// - - - - - - - - - - 
//



//
// Find the page slug for use elsewhere
//
function the_slug() {
	$post_data = get_post($post->ID, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}
//
// - - - - - - - - - - 
//



//
// Don't show comments if there are no comments, duh.
//
function remove_comments(){
  if (!comments_open()){
		remove_action('thematic_comments_template','thematic_include_comments',5);
	}
}
add_action('template_redirect','remove_comments');
//
// - - - - - - - - - - 
//



//
// Tweak Jetpack Sharing settings
//
function jptweak_remove_share() {
    remove_filter( 'the_excerpt', 'sharing_display',19 );
}
add_action( 'loop_start', 'jptweak_remove_share' );
// remove publicize by default
add_filter( 'publicize_checkbox_default', '__return_false' );
//
// - - - - - - - - - - 
//



//
// Add Yoast Breadcrumbs
//
function position_breadcrumb(){
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<div id="breadcrumb">','</div>');
	}
	echo '';
}
add_action('thematic_belowheader','position_breadcrumb');
//
// - - - - - - - - - - 
//



//
// Add a "Skip to Content" link
//
function skip_link() { ?>
	<a style="display:none" href="#content">Skip to content</a>
<?php }
add_action('thematic_before', 'skip_link');
//
// - - - - - - - - - - 
//



//
// Remove Thematic menu and default Thematic actions, then filter away the default scripts loaded with Thematic
//
function childtheme_head_scripts() {
    // Nothing in this fuction now lol
}
add_filter('thematic_head_scripts','childtheme_head_scripts');
//
// - - - - - - - - - - 
//



//
// Don't even write the thematic header content
//
function remove_access_and_branding() {
	remove_action('thematic_header','thematic_brandingopen',1);
	remove_action('thematic_header','thematic_blogtitle',3);
	remove_action('thematic_header','thematic_blogdescription',5);
	remove_action('thematic_header','thematic_brandingclose',7);
	remove_action('thematic_header','thematic_access',9);
}
add_action('init', 'remove_access_and_branding');
//
// - - - - - - - - - - 
//



//
// Add strapline at the very top of the header
//
function add_strapline() {
	echo '<div id="strapline"><a id="logolink" href="'.site_url().'" title="Yorkshire Housing homepage">Yorkshire Housing:</a></div>';
	return;
}
add_action('thematic_header','add_strapline', 0);
//
// - - - - - - - - - - 
//



//
// Register Custom Menu positions
//
function yh_menus() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'social_links_menu' => 'Social Links Menu',
				'top_menu' => 'Top Navigation',
				'main_navigation' => 'Main Navigation'
			)
		);
	}
}
add_action('init', 'yh_menus');
//
// - - - - - - - - - - 
//



//
// Place Top Menu
//
function position_top_menu(){
	wp_nav_menu(array('menu' => 'Top Navigation','theme_location' => 'top_menu'));
}
add_action('thematic_header','position_top_menu', 2);
//
// - - - - - - - - - - 
//



//
// Place Social Menu
//
function position_social_menu(){
	if (is_page('test')) {
		wp_nav_menu(array('menu' => 'Social Links Menu','theme_location' => 'social_links_menu'));
	}
}
add_action('thematic_header','position_social_menu', 1);
//
// - - - - - - - - - - 
//



//
// Place Main Menu
//
function position_main_navigation(){
	wp_nav_menu(array('menu' => 'Main Navigation','theme_location' => 'main_navigation'));
}
add_action('thematic_header','position_main_navigation', 9);
//
// - - - - - - - - - - 
//



//
// Add Soundcloud icon to Social Menu Icons plugin
//
add_filter( 'storm_social_icons_type', create_function( '', 'return "icon-sign";' ) );
add_filter( 'storm_social_icons_use_latest', '__return_true' ); // Updates plugin to use newer (4.0) icons
add_filter( 'storm_social_icons_networks', 'storm_social_icons_networks');
function storm_social_icons_networks( $networks ) {

    $extra_icons = array (
		'soundcloud.com' => array( 
			'name' => 'Soundcloud',
			'class' => 'soundcloud',
			'icon' => 'fa fa-soundcloud'
		)
    );

    $extra_icons = array_merge( $networks, $extra_icons );
    return $extra_icons;

}
//
// - - - - - - - - - - 
//



//
// Add thumbnail sizes for all uploaded images
//
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'homepage-thumb', 150, 100, true );
	add_image_size( 'newspage-thumb', 300, 200, true );
	add_image_size( 'mini-thumb', 50, 50, true );
	add_image_size( 'large-wide', 720, 300, true );
	add_image_size( 'featured-in-category', 600, 400, true );
	add_image_size( 'post-thumb', 300, 999, false );
	add_image_size( 'homepage-feature', 630, 315, true ); // used on sliders on the homepage
	add_image_size( 'post-featured', 626, 999, false ); // used at the top of posts and pages
}
//
// - - - - - - - - - - 
//



//
// Rearrange Author Dropdown
//
function remove_author_metabox() {
    remove_meta_box( 'authordiv', 'post', 'normal' );
}
function move_author_to_publish_metabox() {
    global $post_ID;
    $post = get_post( $post_ID );
    echo '<div id="author" class="misc-pub-section" style="border-top-style:solid; border-top-width:1px; border-top-color:#EEEEEE; border-bottom-width:0px;">Author: ';
    post_author_meta_box( $post );
    echo '</div>';
}
add_action( 'admin_menu', 'remove_author_metabox' );
add_action( 'post_submitbox_misc_actions', 'move_author_to_publish_metabox' );
//
// - - - - - - - - - - 
//



/**
 * Auto-subscribe or unsubscribe an Edit Flow user group when a post changes status
 *
 * @see http://editflow.org/extend/auto-subscribe-user-groups-for-notifications/
 *
 * @param string $new_status New post status
 * @param string $old_status Old post status (empty if the post was just created)
 * @param object $post The post being updated
 * @return bool $send_notif Return true to send the email notification, return false to not
 */
function efx_auto_subscribe_usergroup( $new_status, $old_status, $post ) {
    global $edit_flow;
  
    // You could also follow a specific user group based on post_status
    if ( 'draft' == $new_status ) {
        // You'll need to get term IDs for your user groups and place them as
        // comma-separated values
        $usergroup_ids_to_follow = array(
                // Web content management team
                83
            );
        $edit_flow->notifications->follow_post_usergroups( $post->ID, $usergroup_ids_to_follow, true );
    }
 
    // Return true to send the email notification
    return $new_status;
}
add_filter( 'ef_notification_status_change', 'efx_auto_subscribe_usergroup', 10, 3 );
//
// - - - - - - - - - - 
//



//
// hide unused widget areas inside the WordPress admin
//
function childtheme_hide_widgetized_areas($content) {
//    unset($content['Primary Aside']);
//    unset($content['Secondary Aside']);
//    unset($content['1st Subsidiary Aside']);
//    unset($content['2nd Subsidiary Aside']);
    unset($content['3rd Subsidiary Aside']);
    unset($content['Index Top']);
    unset($content['Index Insert']);
    unset($content['Index Bottom']);
//    unset($content['Single Top']);
//    unset($content['Single Insert']);
//    unset($content['Single Bottom']);
//    unset($content['Page Top']);
//    unset($content['Page Bottom']);
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_hide_widgetized_areas');
//
// - - - - - - - - - - 
//



//
// Add tags to pages - this seems like a good idea :)
//
function reg_cat() {
		register_taxonomy_for_object_type('post_tag','page');
}
add_action('init', 'reg_cat');
//
// - - - - - - - - - - 
//



//
// Add Post thumbnails to posts lists in admin
// This can be turned on and off in the "Screen Options" dropdown panel
//
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
    $defaults['post_thumbs'] = __('Thumb');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
        if($column_name === 'post_thumbs'){
        echo the_post_thumbnail('mini-thumb');
    }
}
//
// - - - - - - - - - - 
//



//
// Remove hard-coded image margins from post images
// 
class fixImageMargins{
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();
//
// - - - - - - - - - - 
//



//
// Remove Cannonical links as WP SEO plugin does a better job
//
function childtheme_canonical_url() {
		// nothing here now!
}
add_filter('thematic_canonical_url','childtheme_canonical_url');
//
// - - - - - - - - - - 
//



//
// Set favicons and touch icons
//
function childtheme_favicon() { 
	if(is_page('9122')) { ?>
		    <link rel="shortcut icon" href="/favicon.ico">	
			<link rel="apple-touch-icon" href="/apple-touch-survey.png" />
<?php 	
	} else { ?>
		    <link rel="shortcut icon" href="/favicon.ico">
			<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<?php 
	}
}
add_action('wp_head', 'childtheme_favicon');
//
// - - - - - - - - - - 
//



//
// Make Gravity Forms show addresses in the British format
//
add_filter("gform_address_types", "british_address", 10, 2);
function british_address($address_types, $form_id){
    $address_types["british"] = array(
                                    "label" => "British",
                                    "country" => "United Kingdom",
                                    "zip_label" => "Postcode",
                                    "state_label" => "County",
                                    "states" => array("", "Cheshire", "Cleveland", "Cumbria", "Durham", "East Riding of Yorkshire", "Greater Manchester", "Lancashire", "North Yorkshire", "South Yorkshire", "Stockton-on-Tees", "Tyne and Wear", "West Yorkshire")
    );
    return $address_types;
}
add_filter("gform_address_zip", "change_address_zip", 10, 2);
function change_address_zip($label, $form_id){
    return "Postcode";
}
//
// - - - - - - - - - - 
//



//
// Fix Gravity Form Tabindex Conflicts
// http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
//
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}
//
// - - - - - - - - - - 
//



/**
* Gravity Wiz // Calculate Number of Days Between Two Gravity Form Date Fields
*
* Allows you to calculated the number of days between two Gravity Form date fields and populate that number into a
* field on your Gravity Form.
*
* @version   1.0
* @author    David Smith <david@gravitywiz.com>
* @license   GPL-2.0+
* @link      http://gravitywiz.com/calculate-number-of-days-between-two-dates/
* @copyright 2013 Gravity Wiz
*/
class GWDayCount {
 
    private static $script_output;
 
    function __construct( $args ) {
 
        extract( wp_parse_args( $args, array(
            'form_id'          => false,
            'start_field_id'   => false,
            'end_field_id'     => false,
            'count_field_id'   => false,
            'include_end_date' => true,
            ) ) );
 
        $this->form_id        = $form_id;
        $this->start_field_id = $start_field_id;
        $this->end_field_id   = $end_field_id;
        $this->count_field_id = $count_field_id;
        $this->count_adjust   = $include_end_date ? 1 : 0;
 
        add_filter( "gform_pre_render_{$form_id}", array( &$this, 'load_form_script') );
        add_action( "gform_pre_submission_{$form_id}", array( &$this, 'override_submitted_value') );
 
    }
 
    function load_form_script( $form ) {
 
        // workaround to make this work for < 1.7
        $this->form = $form;
        add_filter( 'gform_init_scripts_footer', array( &$this, 'add_init_script' ) );
 
        if( self::$script_output )
            return $form;
 
        ?>
 
        <script type="text/javascript">
 
        (function($){
 
            window.gwdc = function( options ) {
 
                this.options = options;
                this.startDateInput = $( '#input_' + this.options.formId + '_' + this.options.startFieldId );
                this.endDateInput = $( '#input_' + this.options.formId + '_' + this.options.endFieldId );
                this.countInput = $( '#input_' + this.options.formId + '_' + this.options.countFieldId );
 
                this.init = function() {
 
                    var gwdc = this;
 
                    // add data for "format" for parsing date
                    gwdc.startDateInput.data( 'format', this.options.startDateFormat );
                    gwdc.endDateInput.data( 'format', this.options.endDateFormat );
 
                    gwdc.populateDayCount();
 
                    $(document).on( 'change', '#' + this.startDateInput.attr('id') + ', #' + this.endDateInput.attr('id'), function(){
                        gwdc.populateDayCount();
                    });
 
                }
 
                this.getDayCount = function() {
 
                    var startDate = this.parseDate( this.startDateInput.val(), this.startDateInput.data('format') )
                    var endDate = this.parseDate( this.endDateInput.val(), this.endDateInput.data('format') );
                    var dayCount = 0;
 
                    if( !this.isValidDate( startDate ) || !this.isValidDate( endDate ) )
                        return '';
 
                    if( startDate > endDate ) {
                        return 0;
                    } else {
 
                        var diff = endDate - startDate;
                        dayCount = diff / ( 60 * 60 * 24 * 1000 ); // secs * mins * hours * milliseconds
                        dayCount = Math.round( dayCount ) + this.options.countAdjust;
 
                        return dayCount;
                    }
 
                }
 
                this.parseDate = function( value, format ) {
 
                    if( !value )
                        return false;
 
                    format = format.split('_');
                    var dateFormat = format[0];
                    var separators = { slash: '/', dash: '-', dot: '.' };
                    var separator = format.length > 1 ? separators[format[1]] : separators.slash;
                    var dateArr = value.split(separator);
 
                    switch( dateFormat ) {
                    case 'mdy':
                        return new Date( dateArr[2], dateArr[0] - 1, dateArr[1] );
                    case 'dmy':
                        return new Date( dateArr[2], dateArr[1] - 1, dateArr[0] );
                    case 'ymd':
                        return new Date( dateArr[0], dateArr[1] - 1, dateArr[2] );
                    }
 
                    return false;
                }
 
                this.populateDayCount = function() {
                    this.countInput.val( this.getDayCount() ).change();
                }
 
                this.isValidDate = function( date ) {
                    return !isNaN( Date.parse( date ) );
                }
 
                this.init();
 
            }
 
        })(jQuery);
 
        </script>
 
        <?php
        self::$script_output = true;
        return $form;
    }
 
    function add_init_script( $return ) {
 
        $start_field_format = false;
        $end_field_format = false;
 
        foreach( $this->form['fields'] as &$field ) {
 
            if( $field['id'] == $this->start_field_id )
                $start_field_format = $field['dateFormat'] ? $field['dateFormat'] : 'mdy';
 
            if( $field['id'] == $this->end_field_id )
                $end_field_format = $field['dateFormat'] ? $field['dateFormat'] : 'mdy';
 
        }
 
        $script = "new gwdc({
                formId:             {$this->form['id']},
                startFieldId:       {$this->start_field_id},
                startDateFormat:    '$start_field_format',
                endFieldId:         {$this->end_field_id},
                endDateFormat:      '$end_field_format',
                countFieldId:       {$this->count_field_id},
                countAdjust:        {$this->count_adjust}
            });";
 
        $slug = implode( '_', array( 'gw_display_count', $this->start_field_id, $this->end_field_id, $this->count_field_id ) );
        GFFormDisplay::add_init_script( $this->form['id'], $slug, GFFormDisplay::ON_PAGE_RENDER, $script );
 
        // remove filter so init script is not output on subsequent forms
        remove_filter( 'gform_init_scripts_footer', array( &$this, 'add_init_script' ) );
 
        return $return;
    }
 
    function override_submitted_value( $form ) {
 
        $start_date = false;
        $end_date = false;
 
        foreach( $form['fields'] as &$field ) {
 
            if( $field['id'] == $this->start_field_id )
                $start_date = self::parse_field_date( $field );
 
            if( $field['id'] == $this->end_field_id )
                $end_date = self::parse_field_date( $field );
 
        }
 
        if( $start_date > $end_date ) {
 
            $day_count = 0;
 
        } else {
 
            $diff = $end_date - $start_date;
            $day_count = $diff / ( 60 * 60 * 24 ); // secs * mins * hours
            $day_count = round( $day_count ) + $this->count_adjust;
 
        }
 
        $_POST["input_{$this->count_field_id}"] = $day_count;
 
    }
 
    static function parse_field_date( $field ) {
 
        $date_value = rgpost("input_{$field['id']}");
        $date_format = empty( $field['dateFormat'] ) ? 'mdy' : esc_attr( $field['dateFormat'] );
        $date_info = GFCommon::parse_date( $date_value, $date_format );
        if( empty( $date_info ) )
            return false;
 
        return strtotime( "{$date_info['year']}-{$date_info['month']}-{$date_info['day']}" );
    }
}
/* set functionallity on Community Fund application form */ 
new GWDayCount( array(
    'form_id'        => 30,
    'start_field_id' => 2,
    'end_field_id'   => 3,
    'count_field_id' => 4
    ) );
//
// - - - - - - - - - - 
//



//
// Modifying TinyMCE editor to remove unused items.
//
add_filter('tiny_mce_before_init', 'customformatTinyMCE' );
function customformatTinyMCE($init) {
	// Add block format elements you want to show in dropdown
	$init['theme_advanced_blockformats'] = 'p,h2,h3,h4';
	$init['theme_advanced_disable'] = 'strikethrough,underline,forecolor,justifyleft,justifycenter,justifyfull,justifyright,outdent,indent';

	return $init;
}
//
// - - - - - - - - - - 
//



//
// Override 404
//
function childtheme_override_404_content() { ?>
	<?php thematic_postheader(); ?>
	<div class="entry-content not-found">
	<?php get_sidebar('page-top'); ?>
	</div><!-- .entry-content -->
<?php }
//
// - - - - - - - - - - 
//



//
// Customize the thematic search form for Relavanssi
//
function yh_searchform_text() {
	return 'Search terms';
}
add_filter('search_field_value', 'yh_searchform_text');
function yh_searchbutton_text() {
	return 'Go';
}
add_filter('search_submit_value', 'yh_searchbutton_text');
//
// - - - - - - - - - - 
//



//
// Enable "Stemming" for Relavanssi
// http://en.wikipedia.org/wiki/Stemming
//
add_filter('relevanssi_stemmer', 'relevanssi_simple_english_stemmer');
//
// - - - - - - - - - - 
//



//
// Function to show pdf documents in the posts - roommy 050413 
//
function pdfshow($attr, $content) {
	return '<iframe src="http://docs.google.com/gview?url='.$attr['href'] .'&embedded=true" style="width:848px; height:780px;" frameborder="0"></iframe>';
}
add_shortcode('pdfshow', 'pdfshow');
//
// - - - - - - - - - - 
//



//
// Determine post category to pass to gravity forms (relies on thematic)
// This is used to get categories to use as Mailchimp subscription groups
//
add_filter('gform_field_value_update_category', 'determine_update_categories');
function determine_update_categories($value){
	$value = '';
	if (is_single()) {
		$value .= get_the_category_list(', ');
	} 
	if (is_page()) {
		$id = get_the_ID();
		$value .= get_post_meta($id, 'update_category', true);
	} 
	return $value; 
}
//
// - - - - - - - - - - -
//



//
// Trying to do same as above but as a checkbox list - aaaaaarrrrrrrrrrrrrrggggggggghhhhh
//
// add_filter('gform_field_value_subscribe_category', 'determine_subscribe_categories');
function determine_subscribe_categories($cats){
    global $post; 

	$post_categories = wp_get_post_categories( $post->ID );
	$cats = array();
	
	foreach($post_categories as $c){
		$cat = get_category( $c );
		$cats = array( $cat->name, $cat->isSelected );

	}	
	
	return $cats;
}	
//
// - - - - - - - - - - -
//



//
// Create Unique IDs for safety reports
//
// http://www.gravityhelp.com/forums/topic/guid-entry-id#post-1491
// http://pastie.org/1401609
//
add_filter("gform_pre_render", "process_unique");
function process_unique($form) {
    global $uuid;
    
    $uuid['form_id'] = $form['id'];
    $uuid['field_id'] = 60;
    add_filter("gform_field_value_uuid", "get_unique");
    
    return $form;
}
function get_unique(){
    global $uuid;
    
    $prefix = "YH";
    $form_id = $uuid['form_id'];
    $field_id = $uuid['field_id'];
    
    do {
        $unique = mt_rand();
        $unique = substr($unique, 0, 8);
        $unique = $prefix . $unique;
    } while (!check_unique($unique, $form_id, $field_id));
    
    return $unique;
}
function check_unique($unique, $form_id, $field_id) {
    global $wpdb;
    
    $table = $wpdb->prefix . 'rg_lead_detail';
    $result = $wpdb->get_var("SELECT value FROM $table WHERE form_id = '$form_id' AND field_number = '$field_id' AND value = '$unique'");
    
    if(empty($result))
        return true;
    
    return false;
}
//
// - - - - - - - - - - -
//



//
// Route emails on the Notice to quit form (/forms/terminate-tennacy)
// And on "Staff only" version of the Notice to quit form (/forms/ntq)
//
add_filter('gform_notification_37', 'route_housing_email', 10, 3);
function route_housing_email( $notification, $form, $entry ) {

    // Target notifications based on notification name
    if($notification["name"] == "Admin Notification"){        

			$bradford = array("bradford","thorpe-edge","shipley","bierley","tong","thornton","queensbury","woodside","lidget-green","cottingley","great-horton","wibsey","saltaire","west-bowling","allerton","low-moor","clayton","tyersal","odsal","little-horton","bingley","idle","holemwood","ecclsehill","undercliffe","frizinghall","heaton","wrose","bowling","bradford-moor","manningham","gilstead","canterbury","thackley","oakenshaw","allerton","chellow-dere","keighley","fell-lane","oakworth","long-lee","haworth");
			$york = array("york","bridlington","keyington","roos","hornsea","withernsea","selby","wistow","burn","osgodby","malton","acklam","burythorpe","leavening","leppington","thixendale","york","ampleforth","bulmer","coulton","firby","gilling-east","hovingham","nunington","osbaldwick","scackleton","slingsby","terrington","welburn","westow","whitwell-on-the-hill","barton-le-willows","buttercrambe","claxton","clifton","copmanthorpe","foston","gate-helmsley","horton","haxby","heworth","huntington","lilling","sheriff-hutton","skelton","stockton-on-forest","strensall","thorton-le-clay","warthill","wigginton","wheldrake","harome","helmsley","nawton","old-byland","pockley","sproxton","wombleton","yearsley","newgate","shambles","rawcliffe","middlegate","skeldergate","dringhouses","market-weighton","driffield","swiss-cottage","nafferton","tadcaster","ulleskelt","beverley","long-risten","holderness","burstwick","patrington","goole","snaith");
			$malton = array("malton","amotherby","appleton-le-street-","barton-le-street","brawby","broughton","great-barugh","great-habton","little-barugh","castlegate","old-malton","ruton","swinton","birdsall","butterwick","duggleby","east-heslerton","kirbygrindalythe","north-grimston","norton","rillington","scagglethorpe","scampston","settrington","sherburn","weaverthorpe","west-heslerton","west-knapton","west-lutten","wharam","wintringham","yedringham","kirbymisperton","pickering","aislaby","allerston","lockton","murton","middleton","newton-upon-rawcliffe","thornton-le-dale","wilton","wrelton","keldhead","york","huttons-ambo","gillamoor","great-edstone","hutton-le-hole","kirbymoorside","normanby","sinnington","scarborough","ganton","potter-brompton","staxton","ebberston","driffield","foxholes");
			$leeds = array("pontefract","ferrybridge","normanton","south-kirkby","knottingley","leeds","bramley","beeston","wortley","woodhouse","headingly","briggate","armley","meanwood","seacroft","middleton","stanningly","pudsey","lower-wortley","farnley","belle-isle","stourton-grange","upper-wortley","west-park","cottingley","gledhow","garforth","morley","thorpe","allerton-bywater","west-ardsley","gildersome","rodley","otley","chapel-allerton","middlefield","horsforth","guisely","swarcliffe","whinmoor","great-preston","wakefield","wrenthorpe","east-ardsley","belle-vue","ackworth","lupset","westgate","crigglestone","horbury","ossett","horbury-junction","parkhill","south-elmsall","purston","methley","alverthorpe","chapelthorpe","kettlethorpe","havercroft","stanley","hemsworth","ryehill","outwood","new-sharlston","tingley","castleford","glasshougton","whitwood","ponterfract","featherstone","upton","south-elmsall","wetherby","thorp-arch");
			$skipton = array("knaresborough","barnoldswick","whixley","skipton","gargrave","carleton","elmsley","grassington","hellifield","long-preston","malha,","thomson-in-craven","kettlewell","threshold","harrogate","pannal","lancaster","austwick","bentham","lower-bentham","clapham","settle","giggleswick","horton-in-ribblesdale","stainforth","carnforth","ingleton","burton-in-lonsdale","keighley","bradley","cononley","glusburn","crosshills","sutton-in-craven","cowling","farnhill");
			$sheffield = array("sheffield","penistone","thurgoland","wortley","firvale","wadsley","woodhouse","darnall","pitsmoor","the-manor","burngreave","highfields","waterthorpe","barnsley","slikstone-common","shafton","athersley","higham","worsbrough-common","mapplewell","stairfoot","staincross","carlton","dodworth","grimethorpe","hoyland-common","monk-bretton","honeywell","wombwell","ardsley","old-town","darton","royston","smithies","cudworth","kingstone","billingley","new-lodge","redbrook","warsbrough","jump","brierley","birdwell","athersley","darfield","candy-cross","doncaster","bawtry","hexthorpe","wheatley","denaby","cantley","edlington","stainforth","thorne","balby","hatfield","scawsby","cusworth","town-moor","mexborough","bentley","tickhill","rossington","warmsworth","sprotborough","belle-vue","auckley","intake","adwick-le-street","bessacarr","moor-ends","armthorpe","kirk-sandall","broom-valley","kilnhurst","burghwallis","braithwaite","edenthorpe","carcroft","rotherham","thurnscoe","bolton-on-dearne","goldthorpe","highgate","eastwood","maltby","dalton","thurcroft","brinsworth","aston","wath-on-deane","treeton","rawmarsh","parkgate","west-melton","kimberworth","greasborough","munsborough","bramley","hunderwell","catcliffe","sunnyside");
			$huddersfield = array("mirfield","liversedge","todmorden","batley","heckmondwyke","huddersfield","marsh","lindley","dalton","edgerton","lockwood","birkby","waterloo","slaithwaite","fartown","golcar","moldgreen","marsden","crossland-moor","milnsbridge","kirkburton","cowersley","linthwaite","almondbury","scissett","halifax","abbey-walk-south","elland","greetland","holmfield","boothtown","ovenden","stumpcross","lee-mount","sowerby-bridge","illingworth","wheatley","king-cross","mytholmroyd","batley","carlinghow","soothill","birstall","dewsbury","thornhill","dewsbury-moor","ravensthorpe","scouthill","bradford","cleckheaton","moorend","gomersal","birkenshaw","oakenshaw","brighouse","rastrick");

		// search arrays and return true or not for any particular query
		function in_array_r($needle, $haystack, $strict = false) {
			foreach ($haystack as $item) {
				if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
					return true;
				}
			}
			return false;
		}

		//the actual query 
		$query = $entry[3]; // Address Line 2 Field
		$query = str_replace(' ', '-', strtolower($query));

		$email1 = in_array_r($query, $bradford) ? 'Notices_BradfordHub@Yorkshirehousing.co.uk' : null;
		$email2 = in_array_r($query, $york) ? 'Notices_YorkHub@Yorkshirehousing.co.uk' : null;
		$email3 = in_array_r($query, $malton) ? 'Notices_MaltonHub@Yorkshirehousing.co.uk' : null;
		$email4 = in_array_r($query, $leeds) ? 'Notices_LeedsHub@Yorkshirehousing.co.uk' : null;
		$email5 = in_array_r($query, $skipton) ? 'Notices_SkiptonHub@Yorkshirehousing.co.uk' : null;
		$email6 = in_array_r($query, $sheffield) ? 'Notices_SheffieldHub@Yorkshirehousing.co.uk' : null;
		$email7 = in_array_r($query, $huddersfield) ? 'Notices_HuddersfieldHub@Yorkshirehousing.co.uk' : null;

		$email = null;

		if($email1 != null){ $email = $email1; }
		if($email2 != null && $email != null) { $email .= ','; }
		if($email2 != null){ $email .= $email2; }
		if($email3 != null && $email != null) { $email .= ','; }
		if($email3 != null){ $email .= $email3; }
		if($email4 != null && $email != null) { $email .= ','; }
		if($email4 != null){ $email .= $email4; }
		if($email5 != null && $email != null) { $email .= ','; }
		if($email5 != null){ $email .= $email5; }
		if($email6 != null && $email != null) { $email .= ','; }
		if($email6 != null){ $email .= $email6; }
		if($email7 != null && $email != null) { $email .= ','; }
		if($email7 != null){ $email .= $email7; }

		if($email == null) { 
			$query = $entry[4]; // Town Field
			$query = str_replace(' ', '-', strtolower($query));
			$email1 = in_array_r($query, $bradford) ? 'Notices_BradfordHub@Yorkshirehousing.co.uk' : null;
			$email2 = in_array_r($query, $york) ? 'Notices_YorkHub@Yorkshirehousing.co.uk' : null;
			$email3 = in_array_r($query, $malton) ? 'Notices_MaltonHub@Yorkshirehousing.co.uk' : null;
			$email4 = in_array_r($query, $leeds) ? 'Notices_LeedsHub@Yorkshirehousing.co.uk' : null;
			$email5 = in_array_r($query, $skipton) ? 'Notices_SkiptonHub@Yorkshirehousing.co.uk' : null;
			$email6 = in_array_r($query, $sheffield) ? 'Notices_SheffieldHub@Yorkshirehousing.co.uk' : null;
			$email7 = in_array_r($query, $huddersfield) ? 'Notices_HuddersfieldHub@Yorkshirehousing.co.uk' : null;


			if($email1 != null){ $email = $email1; }
			if($email2 != null && $email != null) { $email .= ','; }
			if($email2 != null){ $email .= $email2; }
			if($email3 != null && $email != null) { $email .= ','; }
			if($email3 != null){ $email .= $email3; }
			if($email4 != null && $email != null) { $email .= ','; }
			if($email4 != null){ $email .= $email4; }
			if($email5 != null && $email != null) { $email .= ','; }
			if($email5 != null){ $email .= $email5; }
			if($email6 != null && $email != null) { $email .= ','; }
			if($email6 != null){ $email .= $email6; }
			if($email7 != null && $email != null) { $email .= ','; }
			if($email7 != null){ $email .= $email7; }
			if($email == null) { 
		
				$email = 'customerservices@yorkshirehousing.co.uk'; 
				$notification['message'] = "<p><b>IMPORTANT</b><br/>This information could not be auto-routed. Please forward it to the correct Neighbourhood Team.</p>".$notification['message'];
			}
        }
        // change the "to" email address
        $notification['to'] = $email;

    }

    return $notification;
}
//
// - - - - - - - - - - -
//



//
// Populate Property enquiry form (46) with current properties
//

// Adds a filter to form id 46. Replace 46 with your actual form id
add_filter("gform_pre_render_46", populate_checkbox);
add_filter("gform_admin_pre_render_46", populate_checkbox);

function populate_checkbox($form){
	global $wpdb;
	$sample_table = $wpdb->prefix."yh_properties"; // replace with your table name.
	$q = "SELECT * from $sample_table"; // whatever query you need to get your field info
	$results = $wpdb->get_results($q);
	$choices = array();
	$inputs = array();
	foreach ($results as $result) {
		$text = $result->address.", ".$result->postcode;
		$value = $result->address;
		$field_id = "6.".$result->uuid; // replace the 6 in "6." with your field ID.
		$choices[] = array("text" => $text, "value" => $value);
		$inputs[] = array("label" => $value, "id" => $field_id); 
	}
    //Adding items to field id 6. Replace 6 with your actual field id. You can get the field id by looking at the input name in the markup.
    foreach($form["fields"] as &$field){
        //replace 6 with your checkbox field id
        if($field["id"] == 6){
            $field["choices"] = $choices;
            $field["inputs"] = $inputs;
        }
    }

    return $form;
}
//
// - - - - - - - - - - -
//



//
// Add a tracking gif to print requests
//
add_action('wp_footer', 'add_print_tracking_code', 100);
function add_print_tracking_code(){ ?><script type="text/javascript">
 
var googleAccountID = "UA-6122293-1";
 
function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
}
 
function guid() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}
 
(function(){
 
  var GIF = "https://ssl.google-analytics.com/collect?v=1&t=event" +
      "&ec=print&tid=" + googleAccountID + "&cid=" + guid() +
      "&z=" + (Math.round((new Date()).getTime() / 1000)).toString() +
      "&ea=" + encodeURIComponent(document.title) +
      "&el=" + encodeURIComponent(document.location.pathname);
 
  var rule = "body:after{content:url(" + GIF + ")}";
  var head = document.head || document.getElementsByTagName('head')[0];
  var css  = document.createElement('style');
 
  if (css && head) {
 
      css.setAttribute("type",  "text/css");
      css.setAttribute("media", "print");
 
      if (css.styleSheet) { // For IE
          css.styleSheet.cssText = rule;
      } else {
          css.appendChild(document.createTextNode(rule));
      }
 
      head.appendChild(css);
      
      /* Written by Amit Agarwal - labnol.org */
  }
 
})();
 
</script>
<?php }

//
// Track form submissions in Google Analytics
// add_filter("gform_submit_button_1", "add_conversion_tracking_code", 10, 2);


///////////////////////////////////////
//
// UNUSED FUNCTIONS
//
// Add style declaration with custom colour
function custom_page_colour() {	

	$colours[0]	= '#162978';
	$colours[1]	= '#2165ab';
	$colours[2]	= '#25988c';
	$colours[3]	= '#00b5dd';
	$colours[4]	= '#44a02b';
	$colours[5]	= '#8fba1e';
	$colours[6]	= '#eb8b1b';
	$colours[7]	= '#dd4524';
	$colours[8]	= '#c8004a';
	$colours[9]	= '#930051';
	$colours[10]	= '#860074';
	$colours[11]	= '#581676';
	shuffle( $colours );
	// Get content ID and check for custom colour
	global $wp_query;
	$postid = $wp_query->post->ID;
	$customcolour =  get_post_meta($postid, 'custom-colour', true);
	// Write the custom styles into the head
	if(!empty($customcolour)) {
		$color = $customcolour;
	} else {
		$color = $colours[0];
	} ?><style type="text/css"> #featured-image, #pull-quote, #magazine-header,.aside .flexipages_widget .current_page_item > a, .aside .widget_nav_menu .current-menu-item > a, .aside .widget_nav_menu .current-post-ancestor > a, .aside .widget_nav_menu .current-post-parent > a, #page-bottom .flexipages_widget .page_item { background-color:<?php echo $color; ?> !important; } blockquote { border-color:<?php echo $color; ?> !important; }</style>
	<?php
	return;
}	
// add_action('wp_head', 'custom_page_colour'); 
function andylepp_sig () {
?>
<!--                                                                                
                                                                                
                                                                                
                                      7                                         
                                   .......77                                    
                                  ,,.....7777                                   
                                 ,,,,...777777                                  
                                ,,,,,,.IIIIIIII                                 
                               =:,,,,,IIIIIIIIII                                
                               :::,,,7IIIIIIIIIII                               
                             7:::::, IIIIIIIIIIII?                              
                             ::::::I??????????????7                             
                           7~~::::~????????::??????                             
                           ~~~~:::????????:::=??????                            
                          ~~~~~~:??????++:::::+++++++                           
                         ~~~~~~~++++++++:::::~~+++++++                          
                        ===~~~~++++++++ 7:::~~~~+++++++                         
                       =====~~++++++++   =:~~~~~~+++++++                        
                      =======+=======     :~~~~~~========                       
                     7+=============7      ~~~~~~=========                      
                     ++++==7=======         ~~~~===========                     
                    +++++=7=======7          ~~======~~~~~~+                    
                   ?+++++7~~~~~~~=            ======++~~~~~~7                   
                  ???+++?~~~~~~~~              =====+++~~~~~~7                  
                7?????++~~~~~~~~    andylepp    ==+++++~~~~~~~                  
                ???????~~~~~~~~                 7=++++++:::::::                 
               II?????::::::::7                   +++++??:::::::                
              IIII???::::::::                     I+++????:::::::               
             IIIIII?7 777   ++++=======~~~~~~~:::::?++?????,,,,,,:              
            77IIIIII???????+++++++======~~~~~~~:::::???????I,,,,,,,             
           777IIIIIII???????++++++=======~~~~~~~:::::?????III,,,,,,,            
           77777IIIIII???????+++++++======~~~~~~~:::::????IIII,,,,,,+           
          777777IIIIIII???????+++++++======~~~~~~~:::::??IIIIII......           
           .......,,,,,,:::::::~~~~~~======+++++++??????IIIIII77....            
            .....,,,,,,::::::~~~~~~~======+++++++??????IIIIIII77:..             
             ...,,,,,,,::::::~~~~~~=======++++++??????IIIIIII7777.7             
              7777777777777777IIIIIIIII?II???????????IIIIII7777777              
                                                                                
                                                                                
                                                                                -->

<?php
}
add_action('wp_footer', 'andylepp_sig');
?>