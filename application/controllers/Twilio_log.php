<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;

class Twilio_log extends CI_Controller {

    // function __contruct(){
    //     parent::__contruct();
    // }

    public function log()
    {
        $sid = "AC9002e0f6a11c8a35a62f13057b913f09";
        $token = "7915224130e986ed7f619e1bdd53a0c7";
        
        $twilio = new Client($sid, $token);

        $messages = $twilio->messages
                           ->read([], 1);
      //  print_r($messages);
        foreach ($messages as $record) {
          //  print($record->from);
            echo "&nbsp&nbsp&nbsp&nbsp'.$record->body.'&nbsp&nbsp&nbsp&nbsp'.$record->to.'&nbsp&nbsp&nbsp&nbsp'.$record->uri.'<br>";
        }
        print_r($record->media);
        echo"<br><br><br><br>";
    }
}
