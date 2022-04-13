<?php
header('Content-type: text/xml');
	$media_file = str_replace(' ','',$_REQUEST['voice_file']);
	
?>
<Response>
  <Play loop="1"><?php echo $media_file ?></Play>
</Response>
