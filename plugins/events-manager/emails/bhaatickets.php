<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title>BHAA Online Ticket : #_BOOKINGNAME</title></head>

<body><div style="">
<table cellspacing="0" cellpadding="1" border="0" summary="" style="width: 100%; font-family: Arial, Sans-serif; 
	border: 1px Solid #ccc; border-width: 1px 2px 2px 1px; background-color: #fff;">
<tr>
<td>
<div style="padding: 2px">

<?php 
// http://wp-events-plugin.com/documentation/placeholders/
foreach($EM_Booking->get_tickets_bookings() as $EM_Ticket_Booking):

// TODO - add note section for each ticket
if($EM_Ticket_Booking->get_ticket()->name=='Annual Membership')
{
	$header = '#_EVENTNAME : #_BOOKINGTICKETNAME';
	$eventDetails = false;
	$membershipDetails = true;
}
elseif($EM_Ticket_Booking->get_ticket()->name=='BHAA Member Ticket')
{
	$header = '#_EVENTNAME : #_BOOKINGTICKETNAME';
	$eventDetails = true;
	$membershipDetails = false;
}
else
{
	$header = '#_EVENTNAME : #_BOOKINGTICKETNAME';
	$eventDetails = true;
	$membershipDetails = false;
}

echo '<table cellpadding="1" cellspacing="1" border="1" summary="details">';

echo '<tr><td style="padding: 0 1em 1px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">';
echo '<img class="bhaa-logo" src="http://bhaa.ie/wp-content/uploads/2012/11/headerlogo.jpg" width="97" height="100" alt="BHAA Logo" style="float: left; padding: 20px 20px" />';
echo '<td style="padding: 0 1em 1px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">';
echo '<h3 style="padding:0 0 6px 0;margin:0;font-family:Arial,Sans-serif;font-size:16px;font-weight:bold;color:#222">'.$header.'</h3></td>';
echo '</tr>';
?>

<!-- Who -->
<tr>
<td	style="padding: 0 1em 1px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">
<div><i style="font-style: normal">Name</i></div></td>
<td	style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_BOOKINGNAME</td>
</tr>

<?php
echo '<tr><td style="padding: 0 1em 1px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">';
echo '<div><i style="font-style: normal">BHAA ID</i></div></td>';
echo '<td style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_BHAAID</td>';
echo '</tr>';
?>

<!-- Date Of Birth -->
<tr>
<td	style="padding: 0 1em 1px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">
<div><i style="font-style: normal">Date Of Birth</i></div></td>
<td	style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_BOOKINGFORMCUSTOM{bhaa_runner_dateofbirth}</td>
</tr>

<!-- Gender -->
<tr>
<td	style="padding: 0 1em 1px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">
<div><i style="font-style: normal">Gender</i></div></td>
<td	style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_BOOKINGFORMCUSTOM{bhaa_runner_gender}</td>
</tr>

<!-- Company -->
<tr>
<td	style="padding: 0 1em 10px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">
<div><i style="font-style: normal">Company</i></div></td>
<td	style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_BOOKINGFORMCUSTOM{bhaa_runner_companyname} - ID:#_BOOKINGFORMCUSTOM{bhaa_runner_company}</td>
</tr>


<?php if($eventDetails) {
// <!-- Thank you for registering for the BHAA #_EVENTLINK event.  -->
	
//<!-- When -->
echo '<tr><td style="padding: 0 1em 10px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">';
echo '<div><i style="font-style: normal">When</i></div></td>';
echo '<td style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_EVENTDATES @ #_EVENTTIMES</td>';
echo '</tr>';

//<!-- Where -->
echo '<tr><td style="padding: 0 1em 10px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap" valign="top">';
echo '<div><i style="font-style: normal">Where</i></div></td>';
echo '<td style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_LOCATIONNAME - #_LOCATIONFULLLINE</td>';
echo '</tr>';
}	
?>

<!-- Price -->
<tr>
<td	style="padding: 0 1em 10px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap"									valign="top">
<div><i style="font-style: normal">Paid Online</i></div></td>
<td	style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">#_BOOKINGPRICE</td>
</tr>

<!-- Booking ID -->
<tr>
<td	style="padding: 0 1em 10px 0; font-family: Arial, Sans-serif; font-size: 13px; color: #888; white-space: nowrap"									valign="top">
<div><i style="font-style: normal">BOOKING ID</i></div></td>
<td	style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222"	valign="top">#_BOOKINGID | #_BOOKINGTXNID</td>
</tr>

<?php if($membershipDetails) {
//<!-- Notes -->
echo '<tr><td colspan="2" style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">
<p>
Thank you for renewing your membership online.
</p>
<ul>
<li>Your entitled to run all BHAA events for an entry of 10e.</li>
<li>Your race results will be counted towards the BHAA league.</li>
<li>You can run with your company or sector team.</li>
</ul>
</td></tr>';
}
?>

<?php if($eventDetails) {
echo '<tr><td colspan="2" style="padding-bottom: 10px; font-family: Arial, Sans-serif; font-size: 13px; color: #222" valign="top">
<p>
Thank you for using the BHAA Day Membership form.
</p>
<ul>
<li>Please aim to arrive at the venue one hour before the first race to collect your race number.</li>
<li>Your race number contains the RFID chip which allows our chip timing system to record your time and position, and you will be asked to return it at the end of the race.</li>
<li>The use of Headphones to strictly forbidden at BHAA races on safety grounds.</li>
<li>The BHAA is totally voluntary organisation.</li>
<li><b style="color: red">You MUST PRINT and bring this email to the event registration.</b><li>
</ul>
</td></tr>';
}
?>

</table>
</div>
</td>
</tr>

<!-- Footer -->
<tr>
<td	style="background-color: #f6f6f6; color: #888; border-top: 1px Solid #ccc; font-family: Arial, Sans-serif; font-size: 11px">
<p>Reminder from <a href="https://www.bhaa.ie/" target="_blank" style="">Business Houses Athletic Association</a></p>
<p>You are receiving this email at the account '#_BOOKINGEMAIL' because you just used the BHAA payments system.</p>
<p>Please email #_CONTACTEMAIL with any booking queries</p>
</td>
<td	style="background-color: #f6f6f6; color: #888; border-top: 1px Solid #ccc; font-family: Arial, Sans-serif; font-size: 11px">
</td>
</tr>
</table>
</div>
</body>
</html>
<?php endforeach; ?>