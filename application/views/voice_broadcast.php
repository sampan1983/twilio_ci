<?php include_once('header.php') ?>    <!-- Main content -->
    <main class="main">
  <!-- Breadcrumb -->
     <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
       <!--li class="breadcrumb-item"><a href="#">Voice Center</a></li-->
        <li class="breadcrumb-item active">Voice Broadcast</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-phone"></i>Voice Broadcasting
                  <!-- <div class="card-actions">



                    <a href="#" class="btn-setting"><i class="icon-settings"></i></a>



                    <a href="#" class="btn-minimize"><i class="icon-arrow-up"></i></a>



                    <a href="#" class="btn-close"><i class="icon-close"></i></a>



                  </div> -->
                </div>
                <div class="card-body col-lg-7">
                 <form class="form-horizontal" id="formValidate2" data-validate="parsley" method="post" action="Voice_broadcast/get_voice_broadcast" name="client_record" enctype="multipart/form-data" novalidate>
                  <div class="form-group">
                   <label class="col-form-label" for="prependedInput">upload Type</label>
                    <div class="controls">
                     <div class="input-prepend input-group">
                    <select name="call_type" class="form-control" onChange="show(this.value);" required>
                      <option  value="">Select</option>
                      <option value="group">Groups</option>
                      <option value="file">Upload File</option>
                      <option value="clients">Contacts</option>
                    </select>
                    <datalist id='listid'>
                    </datalist>
                   </div>
                  </div>
                </div>
                <div class="form-group">
                 <label class="col-form-label" for="appendedInput">Twilio Number</label>
                  <div class="controls">
                  <div class="input-group">
                   <select id="sl" class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true"  name="twilio_number" required>
            <?php

              if ($data=='No') {

                echo '<option value="">Twilio Number Not added</option>';

              }

              else{

                for ($i=0; $i <sizeof($data) ; $i++) { 

                  echo '<option value="'.$data[$i]['number'].'">'.$data[$i]['number'].'</option>';

                }

              }

           ?>

        



       

         </select>



                         



                     </div>



                       



                      </div>



                    </div>




<!--edit-->
<div id="clients_wrap" style="display:none">

          <label class="col-form-label" for="prependedInput">Select Contacts</label><div class="form-control" style=" padding: 7px 7px 7px 17px;" onclick="showCheckboxes_clients()">Select<img src="<?php echo base_url(); ?>dropdown.png" style="float:right;float: right;    height: 15px;    width: 6px;    margin-top: 4px;    "></div>

          <div class="form-group" style="display:none;max-height:250px;overflow:auto" id="clients_holder">

          <input type="checkbox" name="clients_name[]" value="select_all_clients" id="select_all_clients" onclick="selector1234()" >&nbsp;Select All<br>

          <?php

          if ($clientdata =='No') {

            echo "";

          }

          else{

          for($i = 0; $i<sizeof($clientdata); $i++){
              // echo $clientdata[$i]['sender'];
           echo '<input type="checkbox" name="clients_name[]" class="checkboxes" onclick="single_select_clients(this)" value="'.$clientdata[$i]['sender'].'">&nbsp;'.$clientdata[$i]['first_name'].'  '.$clientdata[$i]['last_name'].'<br>';

           

          }

        }

          ?>

</div></div>

                     <div class="row" id="first_box" style=" display:none;">



            <div class="col-md-12">



<div class="form-group">



<label class="control-label">Select a Group</label>



 <select name="group_name"  class="form-control ">



<option value="">Select</option>

<?php

if ($getgroup=='No') {

  echo "";

}

else{

  for($i=0;$i<sizeof($getgroup);$i++){

      echo '<option value="'.$getgroup[$i]['name'].'">'.$getgroup[$i]['name'].'</option>';

  }

}

?>





 </select>



</div>



</div>







</div>

<div class="row" id="second_box" style="display: none;" >



           <div class="col-md-12">

       

<div class="form-group">



            <label class="control-label">Upload Numbers File</label>



            <div class="upload-file">



                    <input style="cursor:pointer;" type="file" id="upload-demo" name="file" class="upload-demo" accept=".xlsx,.csv,.txt" required>

<a href="<?php echo base_url(); ?>upload/sample_bulk.xlsx"><input type="button" class="btn successbtnsty btn-success" value="Download Sample"/ ></a>

                    <label data-title="Select file" for="upload-demo">



                     <span data-title="No file selected..."></span>



                    </label>



                  </div>



            <input type="hidden" id="dtp_input1" value="" /><br/>



           </div>



</div>



</div>

<!--end-->



	   <div class="row" >



           <div class="col-md-12">

		   

<div class="form-group">



            <label class="control-label">Upload Audio File</label>



            <div class="upload-file">



                    <input style="cursor:pointer;" type="file" id="upload-demo" name="file1" class="upload-demo" accept=".mp3" required >

					

<a href="<?php echo base_url(); ?>voice_upload/sample_voice.mp3" download><input type="button" class="btn btn-success successbtnsty" value="Download Sample"/></a>

                    <label data-title="Select file" for="upload-demo">



                     <span data-title="No file selected..."></span>



                    </label>



                  </div>



            <input type="hidden" id="dtp_input1" value="" /><br/>



           </div>



</div>



</div>           

		 <div class="form-group emoji-contant-align">



                      <label class="col-form-label" for="appendedPrependedInput"></label>



                      <div class="controls">



                        <div class="input-prepend input-group">



                         <input type="hidden" value="9000000000" name="agent_number"  class="form-control" placeholder="Agent Number"  required>



                        </div>



                      </div>



                    </div>

					

					

                    <div class="form-actions">



                      <button type="submit" id="send_btn" class="btn btn-primary">Send Now</button>



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




<script type="text/javascript" src="<?php echo base_url(); ?>emoji/js2.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>emoji/js1.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>emoji/emojionearea.js"></script>











  <!-- Begin emoji-picker JavaScript -->



  <script src="<?php echo base_url(); ?>lib/js/nanoscroller.min.js"></script>



 <script src="<?php echo base_url(); ?>lib/js/tether.min.js"></script>



  <script src="<?php echo base_url(); ?>lib/js/config.js"></script>



  <script src="<?php echo base_url(); ?>lib/js/util.js"></script>



  <script src="<?php echo base_url(); ?>lib/js/jquery.emojiarea.js"></script>



  <script src="<?php echo base_url(); ?>lib/js/emoji-picker.js"></script>



  <!-- End emoji-picker JavaScript -->
<!-- 
<script>



  function show(str)



    {



  



    if(str=='file')



    {



    $("#second_box").show();



    $("#scheduled_btn").hide();



    $("#send_btn").show();



    $("#first_box").hide();



    }



    else



    {



    $("#second_box").hide();



    $("#scheduled_btn").hide();



    $("#send_btn").show();



    $("#first_box").show();



    }



  }







</script> -->

<script type="text/javascript">



   $(document).ready(function() {



      $("#demo1").emojioneArea({



       container: "#container",



       hideSource: false,



       useSprite: false



      });



    });



</script>



 <script>







    $(function() {



      // Initializes and creates emoji set from sprite sheet



      window.emojiPicker = new EmojiPicker({



        emojiable_selector: '[data-emojiable=true]',



        assetsPath: 'lib/img/',



        popupButtonClasses: 'fa fa-smile-o'



      });































      // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields































      // You may want to delay this step if you have dynamically created input fields that appear later in the loading process































      // It can be called as many times as necessary; previously converted input fields will not be converted again































      window.emojiPicker.discover();































    });































  </script>















<script>

function select_n(str) {

	

    if (str.length == 0) { 

        document.getElementById("sl").innerHTML = "";

        return;

    } else {

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("sl").innerHTML = this.responseText;

            }

        };

        xmlhttp.open("GET", "getn.php?q=" + str, true);

        xmlhttp.send();

    }

}

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['failure_message'])) { ?>



    toastr.error('<?php echo $_SESSION['failure_message']; ?>');



    <?php unset($_SESSION['failure_message']); } if (isset($_SESSION['xlsx_error'])) {?>



      toastr.error('<?php echo $_SESSION['xlsx_error'];?>');



      <?php unset($_SESSION['xlsx_error']);} if (isset($_SESSION['file_exists'])){?>



        toastr.error('<?php echo $_SESSION['file_exists']; ?>');



        <?php unset($_SESSION['file_exists']);}if (isset($_SESSION['invalid_xlsx'])) { ?>



          toastr.error('<?php echo $_SESSION['invalid_xlsx']; ?>');



          <?php unset($_SESSION['invalid_xlsx']);} if (isset($_SESSION['error_loading'])) {?>



            toastr.error('<?php echo $_SESSION['error_loading']; ?>');

    <?php unset($_SESSION['error_loading']);} if (isset($_SESSION['failure_message_invalid'])) { ?>

      toastr.error('<?php echo $_SESSION['failure_message_invalid']; ?>');

      <?php unset($_SESSION['failure_message_invalid']);} if (isset($_SESSION['flash_message'])) {?>

        toastr.success('<?php echo $_SESSION['flash_message']; ?>');

        <?php unset($_SESSION['flash_message']); } ?>

</script>
<script type="text/javascript">

  function showCheckboxes_clients()

       {



       var expanded = false;

       var checkboxes = document.getElementById("clients_holder");

       if (!expanded) {

       checkboxes.style.display = "block";

       expanded = true;

       }

       else

         {

       checkboxes.style.display = "none";

       expanded = false;

       }

       /* if(checkboxes.style.display === 'none' )  {   checkboxes.style.display = "block";  }  else{    checkboxes.style.display = "none";  } */

       }

         function single_select_clients(elem)

   {

   if(elem.checked == true) {

     }

     else {

       document.getElementById("select_all_clients").checked = false;

       }

       }









       function selector1234()

{

  var total_freelancer = $('input:checkbox.checkboxes').length;



var total_freelancer1 = $('input:checkbox.checkboxes');

// console.log(total_freelancer1[i]);

var i = 0;for(i=0; i<total_freelancer;i++)

{ if(document.getElementById("select_all_clients").checked == true){

  

total_freelancer1[i].checked = true;



}

else

{

total_freelancer1[i].checked = false;

}

   }

   }


  
  function show(str)



    {







    if(str=='file')



    {



    $("#second_box").show();



    $("#scheduled_btn").hide();



    $("#send_btn").show();



    $("#first_box").hide();

    $("#clients_wrap").hide();

    $("#leads_wrap").hide();



    }

  else if(str=='leads')

  {

    $("#second_box").hide();



    $("#scheduled_btn").hide();



    $("#send_btn").show();



    $("#first_box").hide();

    $("#clients_wrap").hide();

    $("#leads_wrap").show();

  }

  else if(str=='clients')

  {

    $("#second_box").hide();



    $("#scheduled_btn").hide();



    $("#send_btn").show();



    $("#first_box").hide();

    $("#clients_wrap").show();

    $("#leads_wrap").hide();

  }

    else



    {



    $("#second_box").hide();



    $("#scheduled_btn").hide();



    $("#send_btn").show();



    $("#first_box").show();

$("#clients_wrap").hide();

    $("#leads_wrap").hide();

    }



  }
</script>