<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class View_group_number extends CI_Controller {
  function __construct(){
      parent::__construct();
      if (!isset($_SESSION['logged_in'])) {
        header('Location: '.base_url().'Login');
      }
      else if (!isset($_SESSION['group_id'])) {
         header('Location: '.base_url().'Add_group_numbers');
      }

    $this->load->model('View_group_numberModel');

    $this->load->model('Received_messages_newModel');

    $this->load->model('User_listModel');

    }

    public function index()

  {


    $this->load->model('User_listModel');

    $result['data_user'] = $this->User_listModel->get();

    $this->load->model('ClientModel');

    $result['data'] = $this->ClientModel->get();

    $this->load->model('Single_messageModel');

    $result['sent_msg_log'] = $this->Single_messageModel->sentmsglog();

    $this->load->model('Failed_numbersModel');

    $result['failed_numbers'] = $this->Failed_numbersModel->failedmsglog();

    $this->load->model('Pending_numbersModel');

    $result['pending_numbers'] = $this->Pending_numbersModel->pendingmsglog();

    $this->load->model('Received_messages_newModel');

    $result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();
    
    $result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();

      

    $result['data_user'] = $this->User_listModel->get();

    $result['group_data'] = $this->View_group_numberModel->get_fk_group(); 

    $this->load->view('view_group_numbers',$result);

  }

  public function getgroup()
  {
    $fk_group_data = $_POST['fk_group_data']; 
    $sql = $this->db->query("select * from tapp_create_groups where id = '$fk_group_data'");
    if ($sql->num_rows()==1) {
      $group_data = $sql->result_array();
      $group_name = $group_data[0]['name'];
    }
$allowedExts = array("xlsx","txt","csv");
$extension = explode(".", $_FILES["file"]["name"]);
if ($extension!=".xlsx" || $extension!=".txt" && ($_FILES["file"]["size"] < 90000000) && in_array($extension, $allowedExts))
{
 if ($_FILES["file"]["error"] > 0)
 {
  echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  $_SESSION['group']  = '3';
 }
 else
 {
    // $file=$_FILES["file"]["name"];
    // $temp[0] = rand(0, 3000); //Set to random number
      if (file_exists("../xls/imageDirectory/" . $_FILES["file"]["name"]))
      {
       echo $_FILES["file"]["name"] . " already exists. ";
       $_SESSION['group_exists'] = 'This number is already exists';
      }
      else
      {
        $temp = explode(".",$_FILES["file"]["name"]);
        $newfilename = rand(1,89768) . '.' .end($temp);
        move_uploaded_file($_FILES["file"]["tmp_name"],"upload1/".$newfilename);
        //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
        "upload1/".$newfilename;
        // echo "upload1/".$newfilename;
      }
  }
}
else
{
  echo "Invalid file";
  $_SESSION['group_invalid']  = '2';
}
  $inputFileName ="upload1/".$newfilename;
  $extension1 = explode(".", $inputFileName);
if ($extension1==".xlsx" || $extension!=".csv" || $extension1==".txt")
{
 set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
 include 'Classes/PHPExcel/IOFactory.php';
 // This is the file path to be uploaded.
try {
 $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
}
 catch(Exception $e) {
 $_SESSION['group_invalid']  = '2';
 // die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet); 
$already = 0;
$counter = 0; // Here get total count of row in that Excel sheet
for($i=2;$i<=$arrayCount;$i++){
$fname= '';//trim($allDataInSheet[$i]["A"]);
$lname = '';//trim($allDataInSheet[$i]["B"]);
$email = '';//trim($allDataInSheet[$i]["C"]);
$sm = trim($allDataInSheet[$i]["D"]);
$country = '';//trim($allDataInSheet[$i]["E"]);
$sm1=str_replace("(", "", $sm);
$sm2=str_replace(")", "", $sm1);
$sm3=str_replace("-", "", $sm2);
$sm4=str_replace(" ", "", $sm3);
$sm5=str_replace(",", "", $sm4);
$sm6=str_replace("+", "", $sm5);
$sm7=str_replace(".", "", $sm6);
$sm8=str_replace("/", "", $sm7);
$sm9=str_replace(";", "", $sm8);
$sm10=str_replace(":", "", $sm9);
$sm11=str_replace("!", "", $sm10);
$sm12=str_replace("@", "", $sm11);
$sm13=str_replace("*", "", $sm12);
$sm14=str_replace("$", "", $sm13);
$sm15=str_replace("%", "", $sm14);
$sm16=str_replace("^", "", $sm15);
$sm17=str_replace("&", "", $sm16);
$sm19=str_replace("<", "", $sm17);
$sm20=str_replace(">", "", $sm19);
$sm21=str_replace("<", "", $sm20);
$sm22=str_replace("?", "", $sm21);
$sm23=str_replace("_", "", $sm22);
$sms_number=str_replace("#", "", $sm23);
if(strlen($sms_number) == 10)
{
$sms_number = '1'.$sms_number;
}
// "select * from tapp_groups where number='$sms_number' and fk_group_data='$fk_group_data'";
// $query1 = $this->db->get_where('tapp_groups',array('number' => $sms_number, 'fk_group_data' => $fk_group_data ));
$query11 = $this->db->get_where('tapp_groups', array('number' => $sms_number, 'fk_group_data' => $fk_group_data ));
    if ($query11->num_rows()>0) {
      $already= $already+1;
    }
    // $row = $query11->result_array();
    // $d = $i-1;
    // $number = $row[$d]['number'];
    // if($number==$sms_number)
    // {
    //  $check = false;
    //  $_SESSION['group_data_already'] = 'This number is already in a group';
    // }
    else
    {
      $data['group_name'] = $group_name;
      $data['fk_group_data'] = $fk_group_data;
      $data['number'] = $sms_number;
      $data['first_name'] = $fname;
      $data['last_name'] = $lname;
      $data['email'] = $email;
      $data['country'] = $country;
      $data['date_time'] = date('Y-m-d H:i:s');                    
      $check = $this->db->insert('tapp_groups', $data);
      // $check = $this->db->query($query);
      if ($check) {
        $counter = $counter+1;
      }
     else{
      $already= $already+1;
      echo "23";
      }
    }  
// while($row=mysqli_fetch_array($query11))
// {
// $number =  $row['number'] ;
// }
}
}
  if ($counter==0) {
  $_SESSION['group_data_already'] = 'This number is already exists';
  echo '0';
  }
  else if ($counter<$already) {
  $_SESSION['group'] = '1';
  echo "1";
  }
  else{
   $_SESSION['group'] = '0';
   echo "2";
  }
  redirect(base_url().'Group_Numbers');
  }
public function export($group_name = ""){
  $filename = date('Y-m-d')."-group.csv";
  header( 'Content-Type: text/csv' );
  header( 'Content-Disposition: attachment;filename='.$filename);
  $file = fopen('php://output', 'w');
  //set the column names
    $cells[] = array('S.No.', 'Group','Number','Date' );
    $result=$this->db->query("select * from tapp_groups where fk_group_data='$group_name'");
    $row =$result->result_array();
    for ($i=0; $i <sizeof($row) ; $i++) { 
      $d = $i+1;
      //pass all the form values
$cells[] = array( $d, $row[$i]['group_name'],$row[$i]['number'],$row[$i]['date_time']);
}
foreach($cells as $cell)
{ 
  fputcsv($file,$cell);
}
fclose($file);
    }
 public function delete($id)
 {
  $result = $this->View_group_numberModel->delete($id);
  echo json_encode($result);
 }
}

?>