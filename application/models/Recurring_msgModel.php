<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;
class Recurring_msgModel extends CI_Model { 
    public function get_data(){
     return   $get = $this->db->select('*')->from('recurring_msg')->get();
    }

    public function send_recurring(){
        $query = $this->db->select('*')
                        ->from('recurring_msg')
                        ->where('DATE(sended_on) = DATE(NOW())')
                        ->where('status','active')
                        ->limit('70')
                        ->get();
        if ($query->num_rows()) {
            $date = Date('Y-m-d');
            $dayofweek = date('l', strtotime($date));
            $monthfromdate = date('M', strtotime($date));
            $dayfromdate = date('d', strtotime($date));
            if ($dayofweek!='Saturday') {
                $check_twilio_number = $this->db->get("tapp_twilio_number");
                if ($check_twilio_number->num_rows()>0) {
                    foreach($check_twilio_number->result() as $twilio_data){   
                        $sid = $twilio_data->twilio_sid;
                        $twilio_token = $twilio_data->twilio_token;
                        $service_type = $twilio_data->service_type;
                        $twilio_num = $twilio_data->number;
                    }
                    foreach($query->result() as $row){
                        $msg = $row->message;
                        $number = explode(",",$row->number);
                        foreach($number as $sms_num){
                            try{
                                $client = new Client($sid, $twilio_token);
                                $response = $client->messages->create(
                                                    $sms_num,
                                                    array(
                                                        // 'from' => $twilio_num,
                                                        'messagingServiceSid'=>'MG0ceda53ed68da4f3795dc4e504fe3119',
                                                        'body' => $msg  
                                                    )
                                            );
                                print_r($response);
                                $this->db->update('recurring_msg',array('status'=>'sent'),array('id'=>$row->id));
                            }
                            catch(Exception $e){
                                echo $e->getMessage();
                            }

                        }
                    }
                }
            }
        }
	}
}
?>
