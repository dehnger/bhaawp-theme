<?php
/*
 * Remember that this file is only used if you have chosen to override event pages with formats in your event settings!
* You can also override the single event page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files
* Your file would be named single-event.php
*/
/*
 * This page displays a single event, called during the em_content() if this is an event page.
* You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
* You can display events however you wish, there are a few variables made available to you:
*
* $args - the args passed onto EM_Events::output()

http://wordpress.org/support/topic/plugin-events-manager-how-to-customise-events-list-page
http://wp-events-plugin.com/documentation/advanced-usage/
http://docs.jquery.com/UI/API/1.9/Menu

*/
global $EM_Event;
/* @var $EM_Event EM_Event */

get_header();

echo '<section id="primary">';

if( $EM_Event->end >= time() )
{
	echo $EM_Event->output(
				
		'[one_third last="no"]<p>#_EVENTEXCERPT</p>[/one_third]'.
		'[one_third last="no"]<strong>Date/Time</strong><br/>Date - #_EVENTDATES<br/><i>#_EVENTTIMES</i>[/one_third]'.
		'[one_third last="yes"]
		<a href="#details">Details</a>
		<a href="#register">Register</a>
		<a href="#location">Location</a>
		[/one_third]'.

		// details
		'<div id="details">'.
		'<h3>Details</h3>'.
		'#_EVENTNOTES'.
		'</div>'.
		'</br>'.

		// register
		'<div id="register">'.
		'<h3>Register</h3>'.
		'{has_bookings}#_BOOKINGFORM{/has_bookings}'.
		'{no_bookings}Online registion will be available closer to the event date and can be done on the day of event at the registration location.{/no_bookings}'.
		'</div>'.
		'</br>'.
			
		// location
		'<div id="location">'.
		'<h3>Location</h3>'.
		'{has_location}'.
		'[one_third last="no"]<p>'.
		'<strong>Address</strong><br/>'.
		'#_LOCATIONADDRESS<br/>'.
		'#_LOCATIONTOWN<br/>'.
		'#_LOCATIONCOUNTRY<br/>'.
		'</p>[/one_third]'.
		'[two_third last="yes"]<div id="details" style="float:right; margin:0px 0px 15px 15px;">#_MAP</div>[/two_third]'.
		'{/has_location}'.
		'</div>'.
		'</br>'
		);
}
else
{
	// past event
	echo $EM_Event->output(
		'[one_third last="no"]<p>#_EVENTEXCERPT</p>[/one_third]'.
		'[one_third last="no"]<strong>Date/Time</strong><br/>Date - #_EVENTDATES<br/><i>#_EVENTTIMES</i>[/one_third]'.
		'[one_third last="yes"]
		<a href="#results">Results</a>
		<a href="#photos">Photos</a>
		<a href="#details">Details</a>
		[/one_third]');

	// Find connected pages
	$connected = new WP_Query( array(
		'connected_type' => 'event_to_race',
		'connected_items' => get_queried_object(),
		'nopaging' => true,
	));

	global $loader;
	// results
	echo '<div id="results">';
	echo '<h3>Results</h3>';
	if ( $connected->have_posts() ) :

	//echo '<h2 id="results">Full Race Results</h2>';
	while ( $connected->have_posts() ) :
	$connected->the_post();
	//echo 'race id'.get_the_ID();
	//echo '<h4>'.the_title().'</h4>';
	echo $loader->raceresult->getTable()->renderTable(get_the_ID());
	endwhile;

	// Prevent weirdness
	wp_reset_postdata();
	
	else :
	echo "No races have been linked to this event yet.";
	endif;
	echo '</div>';
	
	// teams
	//echo '<div id="teams">';
	//echo '<h3>Teams</h3>';
	//echo $loader->teamresult->getTable()->renderTable(get_the_ID());
	//echo '</div>';
	
	// photo / media links
	$photoset = get_post_meta(get_the_ID(),'flickr',true);
	echo '<div id="photos"><h3>Photos</h3>';
	if($photoset!="")
		echo '<iframe align="center" src="http://www.flickr.com/slideShow/index.gne?user_id=34896940@N06&set_id='.$photoset.'" frameBorder="0" width="90%" height="600" scrolling="no"></iframe>';
	else
		echo 'No photos have been linked to this event yet';
	echo '</div></br>';
	
	// details
	echo $EM_Event->output(
		'<div id="details">'.
		'<h3>Details</h3>'.
		'#_EVENTNOTES'.
		'</div></br>');
}
echo '</section>';
?>
