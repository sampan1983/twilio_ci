<?php
header('Content-type: text/xml');
include_once("../connection.php");
$query =  mysqli_query($con,"select * from tapp_voice_broadcast_logs where user_number like '%".$_REQUEST['user_number']."' and is_called = 'no' order by date_time desc limit 1");
$number_key = $_REQUEST['Digits'];
$caller_id = '+17024302770';
while($row = mysqli_fetch_array($query))
{
	$agent_number = str_replace('+','',$row['agent_number']);
	$id = str_replace('+','',$row['id']);
	$caller_id = str_replace('+','',$row['twilio_number']);

	
}
if($number_key == '1')
{
?>
<Response>
    <Dial callerId="<?php echo '+'.$caller_id;?>">
       <Number><?php echo '+'.$agent_number;?></Number>"
    </Dial>
</Response>
<?php } 
else
{
	?>
	<Response>
    <Hangup/>
</Response>
	
	<?php
} ?>
<?php
$update = mysqli_query($con,"update tapp_voice_broadcast_logs set is_called='yes' where id='".$id."'")
?>