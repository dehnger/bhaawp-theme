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
//error_log("start");
//error_log(print_r($_GET));
//error_log(print_r($_POST));
//echo "<pre>GET "; print_r($_GET); echo "</pre>";
//echo "<pre>POST "; print_r($_POST); echo "</pre>";

if(isset($_POST['editracetime'])) {
	$id = trim($_POST['id']);
	$racetime = trim($_POST['racetime']);
	//error_log('edit race time '.$id.' '.$racetime);	
	//global $BHAA;
	//BHAA::get_instance()->getRaceResult()->editRaceTime($id,$racetime);
}

get_header();

global $BHAA;

echo '<section id="primary">';

if( $EM_Event->end >= time() )
{
	echo $EM_Event->output(
		'[tabs tabdetails="Details" tabregister="Register" tabstandards="Standards"]
			[tab id=details]
				[one_half last="no"]<p>#_EVENTEXCERPT</p>[/one_half]
				[one_half last="yes"]<strong>Date/Time</strong><br/>Date - #_EVENTDATES<br/><i>#_EVENTTIMES</i>[/one_half]
				<h3>Details</h3>
				<div>#_EVENTNOTES</div>
			 	<h3>Location</h3>
				{has_location}
					[one_third last="no"]
						<strong>Address</strong><br/>
						#_LOCATIONADDRESS<br/>
						#_LOCATIONTOWN<br/>
						#_LOCATIONCOUNTRY<br/>
					[/one_third]
					[two_third last="yes"]
			<div id="map" style="float:right; margin:0px 0px 15px 15px;">#_MAP</div>
					[/two_third]
				{/has_location}
			[/tab]
			[tab id=register]
				<div>{has_bookings}#_BOOKINGFORM{/has_bookings}</div>
				{no_bookings}Online registion is unavailable for this event at the moment.{/no_bookings}
			[/tab]
			[tab id=standards]
				<h3>BHAA Standard Table</h3>
				<p>Like a golf handicap the BHAA standard table gives a runner a target time for the race distance</p>
				<p>#_BHAASTANDARDS</p>
			[/tab]
		[/tabs]');
} // [map address="https://maps.google.com/?q=#_LOCATIONLATITUDE,#_LOCATIONLONGITUDE" type="hybrid" width="100%" height="300px" zoom="4" scrollwheel="no" scale="no" zoom_pancontrol="yes"][/map]
else
{
/* 	$races = new WP_Query( array(
			'connected_type' => 'event_to_race',
			'connected_items' => get_queried_object(),
			'nopaging' => true
	));
	
	$results = '';
	$teams = '';
	if ( $races->have_posts() ) :
		while ( $races->have_posts() ) : 
			$races->the_post();
			$raceId = get_the_ID();
			$bhaa_race_type = get_post_meta( $raceId, 'bhaa_race_type', true );
			$results .= '<h3>'.get_the_title().'</h3>';
			if($bhaa_race_type!='S') {
				//$results .= BHAA::get_instance()->getIndividualResultTable()->renderTable($raceId);
				//$teams .= BHAA::get_instance()->getRaceTeamResultTable($raceId);
			}
		endwhile;
		// Prevent weirdness
		wp_reset_postdata();
	else :
		$results = "No races have been linked to this event yet.";
	endif; */
		
	// past event
	echo $EM_Event->output(
		'[tabs tabresults="Results" tabteams="Teams" tabdetails="Details" tabstandards="Standards"]
			[tab id=results]#_BHAARACERESULTS[/tab]
			[tab id=teams]#_BHAATEAMRESULTS[/tab]
			[tab id=details]
				[one_half last="no"]<p>#_EVENTEXCERPT</p>[/one_half]
				[one_half last="yes"]<strong>Date/Time</strong><br/>Date - #_EVENTDATES<br/><i>#_EVENTTIMES</i>[/one_half]
				<h3>Details</h3>
				<div>#_EVENTNOTES</div>
			 	<h3>Location</h3>
				{has_location}
					[one_third last="no"]
						<strong>Address</strong><br/>
						#_LOCATIONADDRESS<br/>
						#_LOCATIONTOWN<br/>
						#_LOCATIONCOUNTRY<br/>
					[/one_third]
					[two_third last="yes"]
						<div id="map" style="float:right; margin:0px 0px 15px 15px;">#_MAP</div>
					[/two_third]
				{/has_location}
			[/tab]
			[tab id=standards]
				<h3>BHAA Standard Table</h3>
				<p>Like a golf handicap the BHAA standard table gives a runner a target time for the race distance</p>
				<p>#_BHAASTANDARDS</p>
			[/tab]
		[/tabs]');
	//);
	
// 	// teams
// 	echo '<div id="teams">';
// 	echo '<h3>Teams</h3>';
// 	echo BHAA::get_instance()->getTeamResultTable()->renderTable(get_the_ID());
// 	echo '</div>';
	
	// photo / media links
// 	$photoset = get_post_meta(get_the_ID(),'flickr_photoset',true);
// 	echo '<div id="photos"><h3>Photos</h3>';
// 	if($photoset!="")
// 		echo '<iframe align="center" src="http://www.flickr.com/slideShow/index.gne?user_id=34896940@N06&set_id='.$photoset.'" frameBorder="0" width="90%" height="600" scrolling="no"></iframe>';
// 	else
// 		echo 'No photos have been linked to this event yet';
// 	echo '</div><div class="clearboth"></div>';
}
echo '</section>';
//error_log("end");
?>
