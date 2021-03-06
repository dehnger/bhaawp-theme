<?php get_header(); ?>
	<?php
	if($data['blog_full_width']) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
	} elseif($data['blog_sidebar_position'] == 'Left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif($data['blog_sidebar_position'] == 'Right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	}
	
	$leagueSummary = new LeagueSummary(get_the_ID());
	$division = strtoupper( get_query_var('division'));
	$table = $leagueSummary->getDivisionSummary($division);
	if(strpos($division, 'L'))
		$events = $leagueSummary->getLeagueRaces('W');
	else
		$events = $leagueSummary->getLeagueRaces('M');
	?>
	<div id="content" style="width:100%">
	
	<div class="portfolio-content">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<h4><?php echo get_the_term_list($post->ID, 'division', '', ', ', ''); ?></h4>
		<div class="buttons"></div>
	</div>

<?php //echo var_dump($events); ?>

<?php 
echo '<table>';
echo '<tr>
	<th>Position</th>
    <th>Name</th>
    <th>Company</th>
    <th>Standard</th>';
	foreach ( $events as $event )
	{
		//  [lid] => 2492 [post_title] => Winter League 2012/2013 [eid] => 2121 [etitle] => South Dublin County Council 2013 [rid] => 2359 [rtitle] => sdcc2013_4M_M [rtype] => M
		echo '<th>'.substr($event->etitle,0,8).'</th>';
	}
echo '<th>Races</th>
  	<th>Points</th>
	</tr>';
$i=1;
foreach($table as $row) 
{
//[ID] => 1600 [user_login] => martin.prunty 
// [user_pass] => $.8/ 
// [user_nicename] => martin-prunty 
// [user_email] =>[user_url] => [user_registered] => 2012-12-01 15:03:58 
// [user_activation_key] => [user_status] => 0 [display_name] => Martin Prunty ) 
// [2] => stdClass Object ( [league] => 2492 [leaguetype] => I 
// [leagueparticipant] => 1628 [leaguestandard] => 7 [leaguedivision] => A 
// [leagueposition] => 37 [leaguescorecount] => 1 [leaguepoints] => 10 
// [leaguesummary] => {"eid":"2121","race":"2359","leaguepoints":"10"},{"eid":"2123","race":"2362","leaguepoints":"10"}
if($row->leaguedivision!=$division)
{
	$i++;
}
else
{
	// specific row
	echo '<tr>
	<td>'.($i++).'</td>
    <td>'.sprintf('<a href="/runner/?id=%d"><b>%s</b></a>',$row->leagueparticipant,$row->display_name).'</td>
	<td>'.sprintf('<a href="/?post_type=house&p=%d"><b>%s</b></a>',$row->ID,$row->post_title).'</td>
    <td>'.$row->leaguestandard.'</td>';
	$points = json_decode(html_entity_decode($row->leaguesummary));
	// for each event id - look for a matching json row
	foreach ( $events as $event )
	{
		// 9925 {"0":{"eid":"2123","race":"2362","leaguepoints":"10"}}
		// nasty - loops the points
		$match = false;
		if(!empty($points))
		{
			$r = 0;
			foreach ( $points as $point )
		  	{
				if($event->eid==$point->eid)
				{
					$r = $point->leaguepoints;
					if($r!=0)
					{
						echo '<td>'.$r.'</td>';
						$match=true;
						break;
					}
					//break;
				}
		  	}
		  	//if($r!=0)
		  	//	echo '<td>'.$r.'</td>';
		  	//else
		  		//echo '<td>-</td>';
		}
		//else
		if(!$match)
		{
			echo '<td>-</td>';
			$match=false;
		}
		//else
		//{
			//echo '<td>e</td>';
		//}
	}
	echo '<td>'.$row->leaguescorecount.'</td>
    <td>'.$row->leaguepoints.'</td>
  	</tr>';
}

}//endforeach;
echo '</table>';
?>
</div>
<?php get_footer(); ?>