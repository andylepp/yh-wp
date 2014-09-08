<?php 

//

// Write Neighbourhood Team Lists

// add_action('thematic_belowcontent', 'yh_neighbourhood_team');

function yh_neighbourhood_team() {	if(is_page(array('skipton-and-harrogate','bradford','kirklees-and-calderdale','sheffield-barnsley-doncaster-and-rotherham','malton-norton-and-pickering','leeds-and-wakefield','york-selby-east-riding-and-west-ryedale'))){

		$post_data = get_post($post->ID, ARRAY_A);

		$team = $post_data['post_title'];

		echo '<div id="contacts">';

		yh_office_info(the_slug());

		echo '<h2>Meet the '.$team.' Neighbourhood Team</h2>';

		echo '<p>Search for the people who work in your Neighbourhood, by typing your postcode in the search box below. You can also search by name or role. Please call our Customer Service Centre on 0345 366 4404 to book an appointment.</p>

		<P>Opening Hours: Mon to Fri 8am until 6pm </P>';

			yh_staff_contacts('team');

		echo '</div>';

	} // End page conditional

	return;

}



//

// Write Service Team Lists

// add_action('thematic_belowcontent', 'yh_service_teams');

function yh_service_teams() {

	if(is_page(array('neighbourhood-officers','income-officers'))){

		$role = ucwords(str_replace('-', ' ', the_slug()));
		
		$contactmethod = 'book an appointment';
		

		echo '<div id="contacts"><h2>All Yorkshire Housing ' . $role . '</h2><p>Find the ' . $role . ' who work in your neighbourhood by typing your postcode in the box below.</p>
		<p>Please call our Customer Service Centre on <strong>0345 366 4404</strong> to ' . $contactmethod . '.</p>

		<P>Opening Hours: Mon to Fri 8am until 6pm </P>';

		yh_staff_contacts('jobtitle');

		echo '</div>';

	} // End page conditional

	return;

}

add_action('thematic_belowcontent', 'yh_community_team');

function yh_community_team() {

	if(is_page('community-team')){

		echo '<div id="contacts"><h2>The Yorkshire Housing Community Team</h2><p>If you need to speak to a member of the community team, please call our Customer Service Centre on 0345 366 4404.</p>

		<P>Opening Hours: Mon to Fri 8am until 6pm </P>';

		yh_staff_contacts('community');

		echo '</div>';

	} // End page conditional

	return;

}

add_action('thematic_belowcontent', 'yh_development_team');

function yh_development_team() {

	if(is_page('development-contacts')){

		echo '<div id="contacts"><h2>Yorkshire Housing Development Team</h2>';

		yh_staff_contacts('development');

		echo '</div>';

	} // End page conditional

	return;

}





//

// Write Office info onto neighbourhood pages

// function yh_show_office_info() {

// 	if(is_page('contact')) {

// 		echo '<div id="contacts">';

// 		yh_office_info('head');

// 		echo '</div>';

// 	}

// }

// add_action('thematic_belowcontent', 'yh_show_office_info');

//



// IN PROGRESS -- - - ----- - - -- - -  ---- - - --- - - --- 

//

// Build office info for inclusion elsewhere

function yh_office_info($method='') {

		// define offices array

   /* $yh_offices["bradford"] = array(

    	"address" => array(

				"building" => "",

				"street" => "",

				"town" => "",

				"city" => "Bradford",

				"county" => "",

				"postcode" => ""

			),

			"telephone" => "01274 826 000",

			"fax" => "01274 826 001",

			"email" => "customerservices@yorkshirehousing.co.uk",

			"times" => array(

			"Our Bradford office is not open to Customers."

			)

    );

    $yh_offices["kirklees-and-calderdale"] = array(

    	"address" => array(

				"building" => "",

				"street" => "",

				"town" => "",

				"city" => "Huddersfield",

				"county" => "",

				"postcode" => ""

			),

			"telephone" => "01484 431 666",

			"fax" => "01484 544 143",

			"email" => "customerservices@yorkshirehousing.co.uk",

			"times" => array(

			"Our Huddersfield office is not open to Customers."

			)

			

    );

    $yh_offices["leeds-and-wakefield"] = array(

    	"address" => array(

				"building" => "PO Box 822",

				"city" => "Leeds",

				"county" => "West Yorkshire",

				"postcode" => "LS1 9PF"

			),

			"telephone" => "0113 243 4621",

			"email" => "customerservices@yorkshirehousing.co.uk"

    );    

    $yh_offices["malton-norton-and-pickering"] = array(

    	"address" => array(

				"building" => "",

				"street" => "",

				"town" => "",

				"city" => "Malton",

				"county" => "",

				"postcode" => ""

			),

			"telephone" => "01653 600 300",

			"fax" => "01653 698 030",

			"email" => "customerservices@yorkshirehousing.co.uk",

			"times" => array(

			"Our Malton office is not open to Public."

				)

    );

    $yh_offices["sheffield-barnsley-doncaster-and-rotherham"] = array(

    	"address" => array(

				"building" => "",

				"street" => "",

				"town" => "",

				"city" => "Sheffield",

				"county" => "",

				"postcode" => ""

			),

			"telephone" => "0114 256 4200",

			"fax" => "0114 244 7544",

			"email" => "customerservices@yorkshirehousing.co.uk",

			"times" => array(

			"Our Sheffield office is not open to Customers."

			)

    );

    $yh_offices["skipton-and-harrogate"] = array(

    	"address" => array(

				"building" => "",

				"street" => "",

				"town" => "Skipton",

				"city" => "",

				"county" => "",

				"postcode" => ""

			),

			"telephone" => "01756 704 500",

			"fax" => "01756 796 972",

			"email" => "customerservices@yorkshirehousing.co.uk",

			"times" => array(

			"Our Skipton office is not open to Customers."

			)

    );

    $yh_offices["york-selby-east-riding-and-west-ryedale"] = array(

    	"address" => array(

				"building" => "",

				"street" => "",

				"town" => "",

				"city" => "York",

				"county" => "",

				"postcode" => ""

			),

			"telephone" => "01904 436 373",

			"fax" => "01904 413 159",

			"email" => "customerservices@yorkshirehousing.co.uk"

    ); */ 

    $yh_offices["head"] = array(

    	"address" => array(

				"building" => "Dysons Chambers",

				"street" => "12-14 Briggate",

				"town" => "",

				"city" => "Leeds",

				"county" => "West Yorkshire",

				"postcode" => "LS1 6ER"

			),

			"telephone" => "0113 825 6000",

			"fax" => "",

			"email" => "customerservices@yorkshirehousing.co.uk",

			"location" => "53.79533107018039,-1.5426993370056152",

			"times" => array(

				"Our Leeds office is not open to Customers."

			)

    );

    if($method!=='') { $this_page = $method; } else { $this_page = the_slug(); }

    if(array_key_exists($this_page, $yh_offices)) {

		$this_office = extract($yh_offices[$this_page]);

		$address_details = extract($address);

		if($times){ $times = extract($times); }

		// Write out the office information

		echo '<div class="office_info">';

		// write a title to precede the table (depending on which method has been passed to the yh_office_info function)

		echo '<h2>Yorkshire Housing ';

		if($method=='head') { echo 'head'; } else { if($city) { echo $city; } else { echo $town; } }

		echo ' office details and opening times</h2><table><tbody><tr><td><table>';

		// check if any vaules have been set for address, and if they have, write a table row

		if($address) {

			echo '<tr><th>Address</th><td>';

			echo 'Yorkshire Housing</br>';

			if($building) echo $building . '</br>'; 

			if($street) echo $street . '</br>';

			if($town) echo $town .' </br>';

			if($city) echo $city . '</br>';

			if($postcode) echo $postcode;

			echo '</td></tr>';

		} // end address

		// check if location is set and if it is, write a google map link

		if($location) { 

			echo '<tr><th>Map link</th><td><a href="https://maps.google.co.uk/maps?q=Yorkshire+Housing';

			if($building) echo ',+' . $building;

			if($street) echo ',+' . $street;

			if($town) echo ',+' . $town;

			if($city) echo ',+' . $city;

			if($postcode) echo ',+' . $postcode;

			echo '&ll=' . $location . '&spn=0.008057,0.017273&z=16&t=m">';

			if($this_page=='head') { 

				echo 'YH head'; 

			} else { 

				if($city) { 

					echo $city; 

				} else { 

					echo $town; 

				} 

			}

			echo ' office on Google Maps</a></td></tr>'; 

		} // end location

		// check if telephone is set and if it is, write a telephone row

		if($telephone) { 

			echo '<th>Telephone</th><td>' . $telephone.'</td></tr>'; 

		} // end telephone

		// check if fax is set and if it is, write a fax row

		if($fax) { 

			echo '<th>Fax</th><td>' . $fax.'</td></tr>'; 

		} // end fax

		// check if email is set and if it is, write an email link row

		if($email) { 

			echo '<th>Email</th><td><a href="mailto:' . antispambot($email) . '">' . antispambot($email) . '</a></td></tr>'; 

		} // end email

		echo '</table></td>';

		// check if times has values and if it does, write a table of opening times

		if($times) {

			echo '<td><table class="openingTimes">';

			echo '<tr><th>Monday</th><td>'.$mon.'</td></tr>';

			echo '<tr><th>Tuesday</th><td>'.$tue.'</td></tr>';

			echo '<tr><th>Wednesday</th><td>'.$wed.'</td></tr>';

			echo '<tr><th>Thursday</th><td>'.$thu.'</td></tr>';

			echo '<tr><th>Friday</th><td>'.$fri.'</td></tr>';

			echo '</table></td>';

		} else { 

			echo '<td><div class="note"><b>Our ';

			if($city) { echo $city; } else { echo $town; }

			echo ' office is not open to customers.</b></div></td>';

		}// end times

		// now close the main table

		echo '</tr></tbody></table>';

		echo '</div><!-- /.office_info -->';

	}

}

// IN PROGRESS -- - - ----- - - -- - -  ---- - - --- - - --- 





//

// Build contact tables for use on various pages

function yh_staff_contacts($method='all') {

	// define variables 

	// used to display YH staff on Neighbourhood pages function starts here 291-388

	if($method=='community'){

		$args = array(

			'meta_key' => 'yh_community_team',

			'meta_value' => 'yes'

		);

	} 

	if($method=='development'){

		$args = array(

			'meta_key' => 'yh_development_team',

			'meta_value' => 'yes'

		);

	} 

	if($method=='team'){

		$args = array(

			'meta_key' => 'yh_team',

			'meta_value' => the_slug()

		);

	} 

	if($method=='jobtitle'){

		$args = array(

			'meta_key' => 'yh_job_title',

			'meta_value' => rtrim (the_slug(), 's')

		);

	} 

	// If there's some data, draw the table

	if($args) {

		echo '<table id="staff" class="'.the_slug().'">

		<thead>

			<tr>

				<th class="role">Role</th>

				<th class="picture">Picture</th>

				<th>Details</th>

				<th class="contact">Contact</th>

				<th class="postcodes">Postcodes</th>

			</tr>

		</thead>

		<tbody>';

		// Get all staff that match variables

		$staff_list = get_users($args);

		foreach ($staff_list as $user) {

			$picture 	= get_avatar( $user->ID, 80 );

			$istrainee 	= get_user_meta($user->ID, 'yh_trainee', TRUE);

			$issenior 	= get_user_meta($user->ID, 'yh_manager', TRUE);

			$isparttime 	= get_user_meta($user->ID, 'yh_part_time', TRUE);

			$iscommunityteam 	= get_user_meta($user->ID, 'yh_community_team', TRUE);

			$isdevelopmentteam 	= get_user_meta($user->ID, 'yh_development_team', TRUE);

			$jobtitle 	= ucwords(str_replace('-', ' ', get_user_meta($user->ID, 'yh_job_title', TRUE)));

			$yhteam 	= get_user_meta($user->ID, 'yh_team', TRUE);

			$patch 		= get_user_meta($user->ID, 'yh_patch', TRUE);

			$telephone 	= get_user_meta($user->ID, 'yh_telephone', TRUE);

			$postcodes 	= get_user_meta($user->ID, 'yh_postcodes', TRUE);

			$realname =  get_user_meta($user->ID, 'first_name', TRUE).' '. get_user_meta($user->ID, 'last_name', TRUE);;

			if($issenior=='yes') {

				$senior	= 'Senior ';

				$forneighbourhood = ' for '.ucwords(str_replace('-', ' ', get_user_meta($user->ID, 'yh_team', TRUE)));

			} else {

				$senior	= '';

				$forneighbourhood = '';

			}

			if($istrainee=='yes') {

				$trainee	= 'Trainee ';

			} else {

				$trainee	= '';

			}

			if($isparttime=='yes') {

				$parttime	= ' (Part-time)';

			} else {

				$parttime	= '';

			}

			

			echo '<tr>';

			echo '<td class="role">' . $jobtitle . '</td>';

			echo '<td class="picture">' . $picture . '</td>';

			echo '<td><p><b>' . $realname . '</b><br/>' . $trainee . $senior . $jobtitle . $forneighbourhood . $parttime .'</p>';

			if($isdevelopmentteam) {

				echo '<p>' . $telephone . '</p>';

			}

			if(!$iscommunityteam && !$isdevelopmentteam && ($patch != '')) { 

				echo '<p><b>Patch:</b><br/>' . $patch . '</p>';

			}

			echo '</td>';

			// Check if this team member is in the Leeds team

			if($yhteam == 'leeds-and-wakefield') {

				// write an empty table cell - Datatable Jquery requires valid a table structure

				echo '<td class="contact"><p></p>';

				echo '<p></p>';

			}

			else {

			// Write in the contact details for this officer

				echo '<td class="contact"><p></p>';

				// Check if the user has a record entered for Telephone Number, and if they do, write the next line in

				if($telephone) { echo '<p></p>'; }

			} 

			echo '</td>';

			echo '<td class="postcodes">' . $postcodes . '</td>';

			echo '</tr>';

		}		

			

			echo '</tbody></table>';

	}

}





//

// Add extra users fields

add_action( 'show_user_profile', 'extra_user_profile_fields' );

add_action( 'edit_user_profile', 'extra_user_profile_fields' );

 

function extra_user_profile_fields( $user ) { ?>

<h3><?php _e("Yorkshire Housing Staff Information", "blank"); ?></h3>

 

<table class="form-table">

	<tr>

		<th><label for="yh_job_title"><?php _e("Job Title"); ?></label></th>

		<td>

		<select name="yh_job_title" id="yh_job_title">

			<?php $selected = get_the_author_meta( 'yh_job_title', $user->ID ); ?>

			<option>Please select...</option>

			<option value="neighbourhood-officer"<?php if($selected == 'neighbourhood-officer') { echo ' selected'; } ?>>Neighbourhood Officer</option>

			<option value="income-officer"<?php if($selected == 'income-officer') { echo ' selected'; } ?>>Income Officer</option>

			<option value="Benefits and Money Advisor"<?php if($selected == 'Benefits and Money Advisor') { echo ' selected'; } ?>>Benefits and Money Advisor</option>

			<option value="Community Engagement Advisor"<?php if($selected == 'Community Engagement Advisor') { echo ' selected'; } ?>>Community Engagement Advisor</option>

			<option value="Business Enterprise Coach"<?php if($selected == 'Business Enterprise Coach') { echo ' selected'; } ?>>Business Enterprise Coach</option>

			<option value="Community Investment Manager"<?php if($selected == 'Community Investment Manager') { echo ' selected'; } ?>>Community Investment Manager</option>
			
			<option value="Apprenticeship Co-ordinator"<?php if($selected == 'Apprenticeship Co-ordinator') { echo ' selected'; } ?>>Apprenticeship Co-ordinator</option>

			<option value="community-development-advisor"<?php if($selected == 'community-development-advisor') { echo ' selected'; } ?>>Community Development Advisor</option>

			<option value="employment-and-opportunities-coordinator"<?php if($selected == 'employment-and-opportunities-coordinator') { echo ' selected'; } ?>>Employment &amp; Opportunities Co-ordinator</option>

			<option value="customer-magazine-editor"<?php if($selected == 'customer-magazine-editor') { echo ' selected'; } ?>>Customer Magazine Editor</option>



			<option value="Business and Development Director"<?php if($selected == 'Business and Development Director') { echo ' selected'; } ?>>Business and Development Director</option>

			<option value="Head of Space Property and Development"<?php if($selected == 'Head of Space Property and Development') { echo ' selected'; } ?>>Head of Space Property and Development</option>

			<option value="Senior Development Manager"<?php if($selected == 'Senior Development Manager') { echo ' selected'; } ?>>Senior Development Manager</option>

			<option value="Development Project Manager"<?php if($selected == 'Development Project Manager') { echo ' selected'; } ?>>Development Project Manager</option>

			<option value="Clerk of Works"<?php if($selected == 'Clerk of Works') { echo ' selected'; } ?>>Clerk of Works</option>

			<option value="Business Programme Manager"<?php if($selected == 'Business Programme Manager') { echo ' selected'; } ?>>Business Programme Manager</option>

			<option value="Development Project Assistant"<?php if($selected == 'Development Project Assistant') { echo ' selected'; } ?>>Development Project Assistant</option>

			<option value="Development Project Assistant and BRE CfSH Assessor"<?php if($selected == 'Development Project Assistant and BRE CfSH Assessor') { echo ' selected'; } ?>>Development Project Assistant and BRE CfSH Assessor</option>

			<option value="Performance and Research Officer"<?php if($selected == 'Performance and Research Officer') { echo ' selected'; } ?>>Performance and Research Officer</option>





		</select>

		&nbsp;&nbsp; <input type="checkbox" name="yh_trainee" value="yes"<?php if(get_the_author_meta( 'yh_trainee', $user->ID ) == 'yes') { echo ' checked'; } ?> />&nbsp;<label for="yh_trainee">Trainee</label> &nbsp;&nbsp; <input type="checkbox" name="yh_manager" value="yes"<?php if(get_the_author_meta( 'yh_manager', $user->ID ) == 'yes') { echo ' checked'; } ?> />&nbsp;<label for="yh_manager">Senior&nbsp;/&nbsp;Manager</label> &nbsp;&nbsp; <input type="checkbox" name="yh_part_time" value="yes"<?php if(get_the_author_meta( 'yh_part_time', $user->ID ) == 'yes') { echo ' checked'; } ?> />&nbsp;<label for="yh_part_time">Part-time</label>

		</td>

	</tr>

	<tr>

		<th><label for="yh_telephone"><?php _e("Direct Dial Telephone"); ?></label></th>

		<td>

		<input type="text" name="yh_telephone" id="yh_telephone" value="<?php echo esc_attr( get_the_author_meta( 'yh_telephone', $user->ID ) ); ?>" class="regular-text" />

		</td>

	</tr>

	<tr>

		<th><label for="yh_team"><?php _e("Neighbourhood Team"); ?></label></th>

		<td>

		<select name="yh_team" id="yh_team">

			<?php $selected = get_the_author_meta( 'yh_team', $user->ID ); ?>

			<option value="null">Please select...</option>

			<option value="bradford"<?php if($selected == 'bradford') { echo ' selected'; } ?>>Bradford</option>

			<option value="kirklees-and-calderdale"<?php if($selected == 'kirklees-and-calderdale') { echo ' selected'; } ?>>Kirklees and Calderdale</option>

			<option value="leeds-and-wakefield"<?php if($selected == 'leeds-and-wakefield') { echo ' selected'; } ?>>Leeds and Wakefield</option>

			<option value="malton-norton-and-pickering"<?php if($selected == 'malton-norton-and-pickering') { echo ' selected'; } ?>>Malton, Norton and Pickering</option>

			<option value="sheffield-barnsley-doncaster-and-rotherham"<?php if($selected == 'sheffield-barnsley-doncaster-and-rotherham') { echo ' selected'; } ?>>Sheffield, Barnsley, Doncaster and Rotherham</option>

			<option value="skipton-and-harrogate"<?php if($selected == 'skipton-and-harrogate') { echo ' selected'; } ?>>Skipton and Harrogate</option>

			<option value="york-selby-east-riding-and-west-ryedale"<?php if($selected == 'york-selby-east-riding-and-west-ryedale') { echo ' selected'; } ?>>York, Selby, East Riding and West Ryedale</option>

		</select>

		&nbsp;&nbsp; <input type="checkbox" name="yh_community_team" value="yes"<?php if(get_the_author_meta( 'yh_community_team', $user->ID ) == 'yes') { echo ' checked'; } ?> />&nbsp;<label for="yh_community_team">Community Team Member</label>

		&nbsp;&nbsp; <input type="checkbox" name="yh_development_team" value="yes"<?php if(get_the_author_meta( 'yh_development_team', $user->ID ) == 'yes') { echo ' checked'; } ?> />&nbsp;<label for="yh_development_team">Development Team Member</label> 

	</tr>

	<tr>

		<th><label for="yh_patch"><?php _e("Patch Name"); ?></label></th>

		<td>

		<input type="text" name="yh_patch" id="yh_patch" value="<?php echo esc_attr( get_the_author_meta( 'yh_patch', $user->ID ) ); ?>" class="regular-text" />

		</td>

	</tr>

	<tr>

		<th><label for="yh_postcodes"><?php _e("Post Codes Served"); ?></label></th>

		<td>

		<textarea rows="8" cols="30" name="yh_postcodes" id="yh_postcodes"><?php echo esc_attr( get_the_author_meta( 'yh_postcodes', $user->ID ) ); ?></textarea>

		</td>

	</tr>

</table>

<?php }



//

// Register user meta fields

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );

add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }	 

	update_user_meta( $user_id, 'yh_job_title', $_POST['yh_job_title'] );

	update_user_meta( $user_id, 'yh_trainee', $_POST['yh_trainee'] );

	update_user_meta( $user_id, 'yh_manager', $_POST['yh_manager'] );

	update_user_meta( $user_id, 'yh_part_time', $_POST['yh_part_time'] );

	update_user_meta( $user_id, 'yh_telephone', $_POST['yh_telephone'] );

	update_user_meta( $user_id, 'yh_team', $_POST['yh_team'] );

	update_user_meta( $user_id, 'yh_community_team', $_POST['yh_community_team'] );

	update_user_meta( $user_id, 'yh_development_team', $_POST['yh_development_team'] );

	update_user_meta( $user_id, 'yh_patch', $_POST['yh_patch'] );

	update_user_meta( $user_id, 'yh_postcodes', $_POST['yh_postcodes'] );

}



//

// Hide silly User fields

function hide_profile_fields( $contactmethods ) {

	unset($contactmethods['aim']);

	unset($contactmethods['jabber']);

	unset($contactmethods['yim']);

	unset($contactmethods['googleplus']);

	unset($contactmethods['twitter']);

	unset($contactmethods['url']);

	return $contactmethods;

}

add_filter('user_contactmethods','hide_profile_fields',10,1);

?>