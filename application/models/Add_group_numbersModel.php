<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Add_group_numbersModel extends CI_Model {

	function getgroup()
	{
		$sql = "select * from tapp_create_groups where user_id = '".$_SESSION['id']."'";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) 
		{
     		$getgroup = $result->result_array();
			return $getgroup;
		}
		else
		{
			return $getgroup = 'No';
		}
	}



			function delete_group($id){

				$sql = "delete from tapp_create_groups where id = '$id'";

				$result = $this->db->query($sql);

				if ($result==true) {

					$delete_group_data = $this->db->query("delete from tapp_groups where fk_group_data = '$id'");

					if ($delete_group_data) {

											

						$_SESSION['group_del'] = '1';

					return 'deleted';

				}

				}

				else{

					$_SESSION['group_del'] = '0';

					return false;

				}

			}



		function addgroup()
		{
		 $name_g = $this->input->post('group_name');
		 $check = $this->db->get_where('tapp_create_groups', 
		 						array(
		 						  	 'name' => $name_g,
		 							 'user_id' => $_SESSION['id'] 
		 							)
		 					);
		 //"select * from tapp_create_groups where name = '".$name."' and user_id = '".$_SESSION['id']."'"
         if ($check->num_rows()>0) 
         {
          $_SESSION['add_group'] = '0';
    	  return 'already';
		 }
		else
		{
			$data  = array('name' => $name_g, 'user_id' => $_SESSION['id'] );
       	 $insert = $this->db->insert("tapp_create_groups", $data);
    	 if ($insert) 
    	 {
  		  $_SESSION['add_group'] = '1';
 		  return true;
    	 }
		else
		{
 		 $_SESSION['add_group'] = '2';
 		 return false;
		}
       }
		}

	function edit_group(){
	 $id = $this->input->post('id');
	 $name = $this->input->post('group_name');
	 $getgroup = $this->db->get_where('tapp_create_groups', array('id' => $id, 'user_id' => $_SESSION['id'] ));
	 $getgroup_data = $getgroup->result_array(); 
	 foreach ($getgroup_data as $key => $value) {
	 	$old_group = ($value['name']);
	 }
	 if ($old_group!=$name) {
	 	$check_group = $this->db->get_where('tapp_create_groups', array('name' => $name , 'user_id' => $_SESSION['id'] ));
	 	if ($check_group->num_rows()>0) {
	 	$_SESSION['already'] = 'This group name is already exists';
	 	return false;
	 	}
	 	else{
	 		$edit_name = array('name' => $name );
	 		$edit_name_num = array('group_name' => $name );
	 		$this->db->set($edit_name);
	 		$this->db->where('id',$id);
	 		$this->db->update('tapp_create_groups');
	 		$this->db->set($edit_name_num);
	 		$this->db->where('fk_group_data',$id);
	 		$this->db->update('tapp_groups');
	 	$_SESSION['edit'] = 'Group name have been changed successfully';
	 	}
	 }
	 $_SESSION['edit'] = 'Group name have been changed successfully';


	}	


}

?>