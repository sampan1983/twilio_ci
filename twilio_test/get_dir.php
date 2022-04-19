 <?php 
		  function get_dir()
		  {
			   $target_dir =  str_replace(basename($_SERVER['PHP_SELF']),'',$_SERVER['REQUEST_URI']);
  return $target_dir;  
		  }
		 
 ?>