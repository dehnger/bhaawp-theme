<?php 

// bhaa custom
remove_action('wp_head','wp_generator');
remove_action('wp_head','wp_shortlink_wp_head' );
remove_action('wp_head','adjacent_posts_rel_link_wp_head' );

// update logo on the login page
add_action("login_head", "bhaa_login_head");
function bhaa_login_head() {
	echo "
<style>
	body.login #login h1 a {
	background: url('http://bhaa.ie/wp-content/uploads/2012/11/headerlogo.jpg') no-repeat center top transparent;
	height: 120px;
	width: 400px;
}
</style>
";
}

// http://stackoverflow.com/questions/9326315/wordpress-change-default-display-name-publicy-as-for-all-existing-users
function bhaa_force_pretty_displaynames($user_login, $user) {
	$outcome = trim(get_user_meta($user->ID, 'first_name', true) . " " . get_user_meta($user->ID, 'last_name', true));
	if (!empty($outcome) && ($user->data->display_name!=$outcome)) {
		wp_update_user( array ('ID' => $user->ID, 'display_name' => $outcome));
	}
}
add_action('wp_login','bhaa_force_pretty_displaynames',10,2);

function bhaa_lost_password_message() {
	$action = $_REQUEST['action'];
	if( $action == 'lostpassword' ) {
		$message = '<p class="message"><b>Please enter your email address below</b><br/>- If there is an error it maybe the case that we do not have your email linked to your account, you should send an email to <a href="mailto:info@bhaa.ie?Subject=Email Reset">info@bhaa.ie</a> with your name and BHAA ID and we can fix this up.</p>';
		return $message;
	}
}
add_filter('login_message', 'bhaa_lost_password_message');

// [pdf href="xx"]
function pdf_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'href' => ''
			), $atts ) );
			// http://stackoverflow.com/questions/1244788/embed-vs-object
			return '<object data="'.$href.'" width="95%" height="675" type="application/pdf">
    			<embed src="'.$href.'" width="95%" height="675" type="application/pdf" />
			</object>';
}
add_shortcode( 'pdf', 'pdf_shortcode' );


function count_team_runners( $query ) {
	if ( isset( $query->query_vars['query_id'] ) && 'count_team_runners' == $query->query_vars['query_id'] ) {
		$query->query_from = $query->query_from . ' LEFT OUTER JOIN (
                SELECT COUNT(p2p_id) as runners
                FROM wp_p2p
            ) p2p ON (wp_users.ID = p2p.p2p_from)';
		//$query->query_where = $query->query_where . ' AND rr.races > 0 ';
	}
}
//add_action('pre_user_query', array(&$this,'count_team_runners'));


/**
 * http://wordpress.org/support/topic/image_size_names_choose-not-working
 * http://www.deluxeblogtips.com/2011/06/list-registered-image-sizes.html
 */
function ml_custom_image_choose( $args ) {
	$image_sizes = get_intermediate_image_sizes();
	error_log('ml_custom_image_choose');
//	var_dump(print_r($image_sizes));
	//global $_wp_additional_image_sizes;
	// make the names human friendly by removing dashes and capitalising
	foreach( $image_sizes as $key => $value ) {
		$custom[ $key ] = ucwords( str_replace( '-', ' ', $key ) );
	}
	return array_merge( $args, $custom );
}
add_filter('image_size_names_choose','ml_custom_image_choose');

?>