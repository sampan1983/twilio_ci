<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class View_group_numberModel extends CI_Model {

	function getid($id)
	{
	  $_SESSION['group_id'] = $id;
	  $sql = "select * from tapp_groups where fk_group_data = '$id'";
	  $result = $this->db->query($sql);
	  if ($result->num_rows()>0) 
	  {
       return	$groupdata = $result->result_array();
	   }
		else{
  			return 'No';
			}
	}


function get_fk_group()
{
	 $id = $_SESSION['group_id'];
	 $sql = "select * from tapp_groups where fk_group_data = '$id'";
	 $result = $this->db->query($sql);
		 if ($result->num_rows()>0) 
		 {
		   return	$groupdata = $result->result_array();
		 }
		else
		{
			return 'No';
		}
}



			function delete($id){

				$getnum = $this->db->query("select * from tapp_groups where id ='$id'");

				$num = $getnum->result_array();

				$num1 = $num[0]['number'];

				$delete = $this->db->query("delete from tapp_groups where id='$id'");

				if ($delete) {

					$_SESSION['groupdatadelete'] = $num1.'  removed successfully';

					return 'Deleted';

				}

				else{

					$_SESSION['groupdatadelete_fail'] = "Sorry this number can't delete from this group";

					return false;



				}

			}

}

?>

