<?php include_once('header.php')?>
<script type="text/javascript"

      src="//static.twilio.com/libs/twiliojs/1.2/twilio.min.js"></script>

   

    <link href="https://static0.twilio.com/bundles/quickstart/client.css"

      type="text/css" rel="stylesheet" />
      <?php
    include 'twilio/Services/Twilio/Capability.php';
    $query = $this->db->query("Select * from tapp_twilio_account where user_id = '".$_SESSION['id']."' and service_type = 'twilio'");
    if ($query->num_rows()>0) {
      $getData = $query->result_array();
      $AccountSid = $getData[0]['twilio_sid'];
      $AuthToken = $getData[0]['twilio_token'];
    }
    if (!empty($getData[0]['app_sid'])) {
    $appSid = $getData[0]['app_sid'];      
    }
    else{
          $appSid = '';
    }
    if (!empty($getData[0]['twilio_sid'])) {
    $AccountSid = $getData[0]['twilio_sid'];      
    }
    else{
          $AccountSid = '';
    }
    if (!empty($getData[0]['twilio_token'])) {
    $AuthToken = $getData[0]['twilio_token'];      
    }
    else{
          $AuthToken = '';
    }
    $capability = new Services_Twilio_Capability($AccountSid,$AuthToken);
    $capability->allowClientOutgoing($appSid);
    $capability->allowClientIncoming('Twilio');
    $token = $capability->generateToken();
      ?>

    <script type="text/javascript">

 //Twilio.Device.setup('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzY29wZSI6InNjb3BlOmNsaWVudDpvdXRnb2luZz9hcHBTaWQ9QVBhN2Y2N2QzZTUxNTU0OWQ2YmM1MGRjOTIyMWM2OWU3OSZhcHBQYXJhbXM9JmNsaWVudE5hbWU9dHdpbGlvX2NhbGwgc2NvcGU6Y2xpZW50OmluY29taW5nP2NsaWVudE5hbWU9dHdpbGlvX2NhbGwiLCJpc3MiOiJzaWQiLCJleHAiOjE1NzU2OTc3MTN9.Ry68u3YbkkISxjRMjcRahgvZ2E_ti15u_aaWuyJ01jg', {'debug':true});



      Twilio.Device.setup("<?php echo trim($token); ?>",{'debug':true});
      Twilio.Device.ready(function (device)
      {
        $("#log").text("Ready");
      });
      Twilio.Device.error(function (error) 
      {
        $("#log").text("Error: " + error.message);
        alert(error.message);
      });
      Twilio.Device.connect(function (conn) 
      {
        $("#log").text("Successfully established call");
      });
      Twilio.Device.disconnect(function (conn) 
      {
        $("#log").text("Call ended");
      });
      Twilio.Device.incoming(function (conn) 
      {
        $("#log").text("Incoming connection from " + conn.parameters.From);
        // accept the incoming connection and start two-way audio
        conn.accept();
      });

      function call() 
      {
       var phone_number = $("#number").val();
       var caller_id = $("#caller_id").val();
       var myparam = phone_number + "#"+ caller_id;
       if(caller_id == '')
       {
        alert('Please Select Caller ID');    
       }
       else
       {
        params = {"PhoneNumber": myparam};
        Twilio.Device.connect(params);
       }
      }

      function hangup() 
      {
        Twilio.Device.disconnectAll();
      }
    </script>

<!-- Main content -->

<head>

<style>

    #call_button { background-color: #0c8d43!important;

    border-color: #0c8d43!important;

    color: #fff!important;

    background: green!important;

    padding: 6px!important;

    margin-top: 0!important;

        font-size: 28px;

font-weight: 500;

    }


	 #hangup_button {   background-color: #0c8d43 !important;

    border-color: #e41010!important;

    color: #fff!important;

    background: #e41010!important;

    padding: 6px!important;

    margin-top: 0!important;

    font-size: 28px;

font-weight: 500;



}

button.call::before {

    background-position: 0 -48px;

    display: none;

}

button.hangup::before {

    background-position: 0 -131px;

    display: none;

}

body {

    text-align: left;

    background:none;

}

</style>

</head>

<main class="main">



  <!-- Breadcrumb -->



  <ol class="breadcrumb">



    <li class="breadcrumb-item">Home</li>



    <!--li class="breadcrumb-item">



      <a href="#">Admin</a>



    </li-->



    <li class="breadcrumb-item active">Outgoing Calls</li>



    <!-- Breadcrumb Menu-->



  



  </ol>



  <div class="container-fluid">



    <div class="animated fadeIn">



      <div class="card">



        <div class="card-header">



          <i class="icon-people"></i> Outgoing Calls



             



            



        </div>



        <div class="card-body">



          <br>



          <div class="row justify-content-center">



            <div class="col-sm-5">



              <button  class="call btn btn-lg col-sm-5 " id="call_button" onclick="call();">



                <i class="fa fa-phone"></i>



      Call



    



              </button>



              <button class="hangup btn btn-lg col-sm-6" id="hangup_button" onclick="hangup();">



                <i class="fa fa-headphones"></i>



      Hangup



    



              </button>



            </div>



          </div>



            <br>

 <div class="row justify-content-center">
  <div class=" col-sm-5">
  <select name="caller_id" class="form-control" id="caller_id">
  <?php if ($data=='No') 
  {
    echo '<option value="">Select Caller ID</option>';
  } 
  else
  {
   for ($i=0; $i <sizeof($data) ; $i++)
   { 
    if ($i==0) 
    {
     echo '<option value="">Select Caller ID</option><option value="'.$data[$i]['number'].'">'.$data[$i]['number'].'</option>';
     }
    else
    {
     echo '<option value="'.$data[$i]['number'].'">'.$data[$i]['number'].'</option>';
    }
   }
  }
    ?>
	</select>
  </div>
 </div>
  <br>
 <div class="row justify-content-center">
  <div class=" col-sm-5">
  <select name="tonumber" class="form-control" id="tonumber" onchange="get_tonum()">
  <option value="">Select Contact</option>
<?php 
foreach ($contact_data as $key) { ?>
 <option value="<?php echo $key->sender; ?>"><?php echo $key->first_name; ?> - <?php echo $key->sender; ?></option> 
<?php } ?>

</select>

              

              </div>



            </div>


			<br>

          <div class="row justify-content-center">



            <div class=" col-sm-5">



              <input class="form-control enter_call" type="text" id="number" onkeyup="check_blacklist(this.value)" name="number" placeholder="Enter a phone number to call">

<span>Enter phone number with country code</span>

              </div>



            </div>



            <div class="row">



              <div id="log" class="col-sm-3 btn btn-primary text-center" style="background: #20a8d8;">Ready </div>
              <div>
                <!-- <?php echo $AccountSid; echo "<br>"; echo $AuthToken; ?> -->
              </div>


            </div>



          </div>



        </div>



      </div>



    </div>



    <!-- /.conainer-fluid -->



  </main>



</div>
<?php include_once('footer.php')?>

<script>

function check_blacklist(elem) {



  var xhttp = new XMLHttpRequest();



  xhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("log").innerHTML =

      this.responseText;

	  	if(this.responseText == 'Ready')

		{

			$('#call_button').prop('disabled', false);

			$('#log').css('background-color','green');

			//document.getElementById('call_button').disabled='false';

		}

		else{

			$('#call_button').prop('disabled', true);

			$('#log').css('background-color','red');

			//document.getElementById('call_button').disabled='true';

		}

    }

  };

  if (elem=='') {

      $('#call_button').prop('disabled', true);

      $('#log').css('background-color','#20a8d8'); 

      document.getElementById("log").innerHTML = 'Ready';  

  //     xhttp.open("GET", 'Outgoing_calls/blackList/'+elem, true);

  // xhttp.send();

  }

  else{



  xhttp.open("GET", 'Outgoing_calls/blackList/'+elem, true);

  xhttp.send();

}

}
function get_tonum() {
  var to_number = $("#tonumber").val();
  $("#number").val(to_number);
}
</script>







<!-- Plugins and scripts required by this views -->



<script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>



<script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



<!-- Custom scripts required by this view -->



<script src="<?php echo base_url(); ?>js/views/tables.js"></script>







