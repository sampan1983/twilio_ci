<?php include_once('header.php') ?>
 <!-- Main content -->

 <script type="text/javascript"

      src="//static.twilio.com/libs/twiliojs/1.2/twilio.min.js"></script>

   

   <!--  <link href="http://static0.twilio.com/bundles/quickstart/client.css"

      type="text/css" rel="stylesheet" /> -->

  <!--   <script type="text/javascript">

 //Twilio.Device.setup('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzY29wZSI6InNjb3BlOmNsaWVudDpvdXRnb2luZz9hcHBTaWQ9JmFwcFBhcmFtcz0mY2xpZW50TmFtZT10d2lsaW9fY2FsbCBzY29wZTpjbGllbnQ6aW5jb21pbmc_Y2xpZW50TmFtZT10d2lsaW9fY2FsbCIsImlzcyI6InNpZCIsImV4cCI6MTU3NTYzNjU0MX0.mcoR7gIQJ_uLMmMgCoXo5ut8TiMRBO4LnFAvpNlEEEU', {'debug':true});



      Twilio.Device.setup("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzY29wZSI6InNjb3BlOmNsaWVudDpvdXRnb2luZz9hcHBTaWQ9JmFwcFBhcmFtcz0mY2xpZW50TmFtZT10d2lsaW9fY2FsbCBzY29wZTpjbGllbnQ6aW5jb21pbmc_Y2xpZW50TmFtZT10d2lsaW9fY2FsbCIsImlzcyI6InNpZCIsImV4cCI6MTU3NTYzNjU0MX0.mcoR7gIQJ_uLMmMgCoXo5ut8TiMRBO4LnFAvpNlEEEU");



      Twilio.Device.ready(function (device) {

        $("#log").text("Ready");

      });



      Twilio.Device.error(function (error) {

        $("#log").text("Error: " + error.message);

      });

alert(error.message);

      Twilio.Device.connect(function (conn) {

        $("#log").text("Successfully established call");

      });



      Twilio.Device.disconnect(function (conn) {

        $("#log").text("Call ended");

      });



      Twilio.Device.incoming(function (conn) {

        $("#log").text("Incoming connection from " + conn.parameters.From);

        // accept the incoming connection and start two-way audio

        conn.accept();

      });



      function call(param) {

 var phone_number = $("#number"+param).val();

 

        var caller_id = $("#caller_id"+param).val();

    

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



      function hangup() {

        Twilio.Device.disconnectAll();

      }

    </script> -->

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



  .datatable{ border-collapse: collapse !important}

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- <script>

      $( document ).ready(function() {





var table = $('#dataTable').DataTable();



// Sort by columns 1 and 2 and redraw

table

    .order( [ 7, 'desc' ] )

    .draw();

 });

</script> -->

<script>

      $( document ).ready(function() {





var table = $('#dataTable').DataTable();



// Sort by columns 1 and 2 and redraw

table

    .order( [ 4, 'desc' ] )

    .draw();

 });

</script>

        <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Email Center</a></li>
        <li class="breadcrumb-item active">Single Mail</li>
        <!-- Breadcrumb Menu-->
        
      </ol>
       <div class="container-fluid">
        <div class="animated fadeIn"> 
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-edit"></i>Compose Mail
                  
                </div>
                <div class="card-body col-lg-7">
                  <form class="form-horizontal" id="formValidate2" data-validate="parsley" method="post" action="Single_mail/send" name="client_record" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-form-label" for="prependedInput">Email</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope-open"></i></span>
                          <input id="prependedInput" class="form-control" name="email" size="16" type="email" placeholder="Write Email Here!" list="listid" required>

                         
                      </div>
                       
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="prependedInput">Subject</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <span class="input-group-addon"><i class="fa fa-envira"></i></span>
                          <input id="prependedInput" class="form-control" name="subject" size="16" type="text" placeholder="Write Subject Here!" list="listid" required>
                          <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">

                         
                      </div>
                       
                      </div>
                    </div>
<!--                     <div class="form-group emoji-contant-align">
                      <label class="col-form-label" for="appendedPrependedInput">Message</label>
                      <div class="controls"> 
                        <div class="input-prepend input-group">
                         <select class="form-control" name="message_type" id="change_message_type"  >
             <option value="custom">Custome message</option>
             <option value="template">Template message</option>
             </select>
                        </div>
                      </div>
                    </div> -->

                     <div class="form-group emoji-contant-align">

                      <label class="col-form-label" for="appendedPrependedInput">Message</label>

                      <div class="controls"> 

                        <div class="input-prepend input-group">

                         <select class="form-control" name="message_type" id="change_message_type" >

             <option value="custom">Custom message</option>

             <option value="template">Template message</option>

             </select>

                        </div>

                      </div>

                    </div>
<div class="form-group emoji-contant-align" id="custome_messgae">

                      <label class="col-form-label" for="appendedPrependedInput">Message</label>

                      <div class="controls">

                        <div class="input-prepend input-group">

                         <textarea id="messagebox" name="message" data-control="exname-control" rows="9" class="form-control" placeholder="Write your Message Here!"   maxlength="160"></textarea></textarea><br>

            

                        </div> <span id="counter-holder"><span>

                      </div>

                    </div>





          <div id="template_message" style="display:none">

          

          <div class="form-group emoji-contant-align" id="">

                      <label class="col-form-label" for="appendedPrependedInput">Select Template</label>

                      <div class="controls">

                       <select class="form-control" name="select_template" id="temp" >

             <option value="custom">Select</option>

             <?php 

             if ($tapp_template_msg=="") {

               echo "";

             }

             else{

             for($i=0;$i<sizeof($tapp_template_msg);$i++)

             {

              echo '<option value = '.$tapp_template_msg[$i]['id'].'>'.$tapp_template_msg[$i]['title'].'</option>';

             } 

           }

             ?>

                         </select>

                      </div>

                    </div>

          

           <div class="form-group emoji-contant-align" id="showtemplate">

                      <label class="col-form-label" for="appendedPrependedInput">Message</label>

                      <div class="controls">

                        <div class="input-prepend input-group">

                         <textarea id="temptext" name="message1" maxlength="160" rows="9" class="form-control" placeholder="Write your Message Here!"  ></textarea>

             <br>

            

                        </div> <span id="counter-holder1"><span>

                      </div>

                    </div>

                    </div>

                    <div class="form-actions">

                      <button type="submit" id="send_btn"  name="type" class="btn btn-primary">Send Now</button>

                      <button type="reset" class="btn btn-secondary">Cancel</button>

                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--/.col-->
          </div>
          
          <!--/.row-->
        </div>

      </div>
      <!-- /.conainer-fluid -->
    </main>

  </div>
<?php include_once('footer.php') ?>




<!-- Plugins and scripts required by this views -->



  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>







  <!-- Custom scripts required by this view -->



  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>



<script type="text/javascript">
   ////////change msg type function

  function change_message_type(elem)

{

  

  if(elem == 'custom')

  {

    

    document.getElementById('custome_messgae').style.display='block';

    document.getElementById('template_message').style.display='none';

  }

  if(elem == 'template')

  {

    

    document.getElementById('custome_messgae').style.display='none';

    document.getElementById('template_message').style.display='block';

  }

}
</script>
<script type="text/javascript">

  $('#change_message_type').change(function(){

    var type = $(this).val();

    if (type == 'template') {

      $('#template_message').show();

      $('#custome_messgae').hide();



    }

    else{

            $('#custome_messgae').show();

      $('#template_message').hide();



    }

  });

</script>

<script type="text/javascript">

  $('#temp').change(function(){

    var id = $(this).val();



   $.ajax({

              type : 'ajax',

              method : 'post',

              dataType : 'json',

              url : '<?php echo base_url(); ?>Bulk_sms/getdatamsg/'+id,

              success:function(r){

                // console.log(r);

                if (r==null) {

                  html = r;

                }

                else{

                html = r[0].message;

              }



                $('#temptext').val(html);



              },

              error:function(xhr,status,error){

                // console.log(xhr.responseText);

                

              }

   });

  });

</script>
<script type="text/javascript">
  <?php if (isset($_SESSION['flash_message'])) {?>
    toastr.success('<?php echo $_SESSION['flash_message']; ?>');
    <?php unset($_SESSION['flash_message']);} if (isset($_SESSION['failure_message'])){?>
      toastr.error('<?php echo $_SESSION['failure_message']; ?>');
      <?php unset($_SESSION['failure_message']);}?>
</script>