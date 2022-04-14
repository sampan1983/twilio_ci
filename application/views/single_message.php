
<?php include_once('header.php') ?>
 <!-- Main content -->

 <script type="text/javascript"

      src="//static.twilio.com/libs/twiliojs/1.2/twilio.min.js"></script>

<!-- Main content -->

<head>

<style>
  form#formValidate2 .form-group input[type="radio"] {
    margin: 0px 5px 12px;}

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

    <main class="main">







      <!-- Breadcrumb -->



      <ol class="breadcrumb">



        <li class="breadcrumb-item">Home</li>



        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->



        <li class="breadcrumb-item active"> Single Message</li>



      </ol>

             <div class="container-fluid">

        <div class="animated fadeIn"> 

          <div class="row">

            <div class="col-lg-12">

              <div class="card">

                <div class="card-header">

                  <i class="fa fa-edit"></i>Send SMS
                  

                </div>

                <div class="card-body col-lg-7">

                  <!---form -->

<form id="formValidate2">

 

 <div class="form-group" id="number_holder">

                      <label class="col-form-label" for="prependedInput">Number</label>

                      <div class="controls">

                        <div class="input-prepend input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input id="prependedInput" class="form-control t3" name="number" size="16" type="text" placeholder="Write Number Here!" list="listid" required>



                         

                      </div>

                       

                      </div>

                    </div>

                    <input type="hidden" name="service_type" value="twilio">          

                    <div class="form-group">

                      <label class="col-form-label" for="appendedInput">Choose Sender Type:</label>
                      <br>

                      Copilot
                      <input type="radio" name="sender_type" value="cp" onclick="twilionum('cp')" checked>
                     From Twilio Number
                      <input type="radio" name="sender_type" value="num" onclick="twilionum('num')">

                      <div class="controls">

                        <div class="input-group">

          <select id="sl2" class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="twilio_number" required>

                         
                </select>

                         

                     </div>

                       

                      </div>

                    </div>

                    <div class="form-group">



<label class="col-form-label">Upload Image



     <span class="required">  </span>



    </label>



<div class="controls">



<input type="file" class="form-control" id="img" name="file[]" accept="image/*"  />



<span class="help-block"> You can send an image also.</span>



       </div>



     </div>





     <!-- select msg type -->

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

                         <textarea id="messagebox" name="message" data-control="exname-control" rows="9" class="form-control" placeholder="Write your Message Here!" maxlength="160" onkeyup="get_counts(this.value)"></textarea></textarea><br>

            

                        </div> <span class="counter-holder"><span>

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

                    <div class="form-group" id="tmp_img"><input type="hidden" name=tmp_img ></div>
          

           <div class="form-group emoji-contant-align" id="showtemplate">

                      <label class="col-form-label" for="appendedPrependedInput">Message</label>

                      <div class="controls">

                        <div class="input-prepend input-group">

                         <textarea id="temptext" name="message1" rows="9" class="form-control" placeholder="Write your Message Here!" maxlength="160" onkeyup="get_counts(this.value)"></textarea>

             <br>

            

                        </div> <span class="counter-holder1"><span>

                      </div>

                    </div>

                    </div>

                    <div class="form-actions">

                      <button type="submit" id="send_btn"  name="type" class="btn btn-primary"><i class="fa fa-send-o"></i> Send Now</button>

                      <button type="reset" class="btn btn-secondary">Cancel</button>

                    </div>

          

      

<!--   <input type="submit" name="submit"> -->

</form>

</div>

</div>

</div>

</div>

</div>

</div>









    <!-- /.modal-dialog -->







  </div>

  

  

  

  

  

  <div class="modal fade" id="add_bulk">







    <div class="modal-dialog">







                 <form class="no-margin" id="formValidate2" data-validate="parsley" method="post"  name="client_record" enctype="multipart/form-data" > 



      

      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Imports Contact</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>



        <div class="modal-body">







            <div class="form-group">







             <label class="control-label">Select File</label>







            <input type="file" name="file" class="form-control " required>


            </div>


           </div>







        <div class="modal-footer">







                  <button type="submit" class="btn btn-danger btn-sm ">Submit</button>















          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>







          </div>



      </div>







      <!-- /.modal-content -->







                </form>















    </div> 





      <!-- /.conainer-fluid -->



    </main>







    <!--  -->







  </div>





<?php include_once('footer.php') ?>
<!-- Plugins and scripts required by this views -->



  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>







  <!-- Custom scripts required by this view -->



  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>



<script type="text/javascript">

//   /////////////chnage msg type

//   function change_message_type(elem)

// {

  

//   if(elem == 'custom')

//   {

    

//     document.getElementById('custome_messgae').style.display='block';

//     document.getElementById('template_message').style.display='none';

//   }

//   if(elem == 'template')

//   {

    

//     document.getElementById('custome_messgae').style.display='none';

//     document.getElementById('template_message').style.display='block';

//   }

// }

  ///////get count fun

  function get_counts(val)

{

  var lengthhh = val.length;

  var left_length = 160 - lengthhh;

  $('.counter-holder').html("You've <b>"+ left_length +"</b> charater(s) left");

  $('.counter-holder1').html("You've <b>"+ left_length +"</b> charater(s) left");

}



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

  //////////send msg submit

  $('#formValidate2').submit(function(evt){

      evt.preventDefault();

      var form = new FormData(this);

      $('#send_btn').attr('disabled',true);

      $.ajax({

                type : 'ajax',

                method : 'post',

                data : form,

                dataType : 'json',

                url : '<?php echo base_url() ?>Single_message/getmsg',

                      enctype : 'multiple/form-data',

                     cache : false,

                     contentType : false,

                        processData : false,

                success:function(r)
                {
                  console.log(r);
                  if (r=='message sent') 
                  {
                    // location.reload();
                  }
                  else if (r=='blacklist')
                  {
                  // location.reload();
                  }
                  else
                  {
                    console.log(r);
                    toastr.error('message not send','failed');                  
                  }
                },
                error:function(xhr,status,error)
                {
                  console.log(xhr.responseText);
                  location.reload();
                  
                }

      });

  });

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

                console.log(r);

                if (r==null) {

                  html = r;

                }

                else{

                html = r[0].message;
                if (r[0].media!=null) {
                  console.log(r[0].media);
                  MMS = 'MMS<br><a href='+r[0].media+' target=_blank><i class="fa fa-file-image-o" aria-hidden="true"> </i></a><input type="hidden" name=tmp_img value='+r[0].media+' >';
                  $('#tmp_img').html(MMS);
                }
                else{
                  console.log('no');
                  MMS = '<input type="hidden" name=tmp_img value="">';
                  $('#tmp_img').html(MMS);
                }

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

  twilionum('cp');

  function twilionum(val){
    if(val=='cp')
    {

console.log('else')
    $.ajax({

          type : 'ajax',

          method : 'post',

          dataType : 'json',
          data:val,

          url : '<?php echo base_url(); ?>Single_message/gettwilionum',

          success:function(r)
          {
            console.log(r);
            var html = "";
            if (r)
            {
              for (var i = 0; i < r.length; i++) 
              {
                if (r[i].is_default == 'yes') 
                {
                 html += '<option value = '+r[i].number+'  selected>'+r[i].number+'</option>';
              }
              else
              {
                console.log(r);
                html += '<option value = '+r[i].number+'>'+r[i].number+'</option>';
              }
              var copilot = '<option value = "'+r[i].copilet_msg_service_id+'"  selected>Copilot</option>';
              }
          }
          else
          {
            html += '<option value = ""  selected>Twilio Number Not found</option>';
            var copilot = '<option value = ""  selected>Twilio Number Not found</option>';
          }

            $('#sl2').html(copilot);

          },

          error:function(xhr,status,error){

                // console.log(xhr.responseText);

                

              }

    });

}
else if(val=='num')
{
console.log('else')
    $.ajax({

          type : 'ajax',

          method : 'post',

          dataType : 'json',
          data:val,


          url : '<?php echo base_url(); ?>Single_message/gettwilionum',

          success:function(r)
          {
            console.log(r);
            var html = "";
            if (r)
            {

                html1='<option value =""  selected>Select Number</option>';
              for (var i = 0; i < r.length; i++) 
              {
                // if (r[i].is_default == 'yes') 
                // {
                 // html += '<option value = '+r[i].number+'  selected>'+r[i].number+'</option>';
              // }
              // else
              // {
                html += '<option value = '+r[i].number+'>'+r[i].number+'</option>';
              // }
              // var copilot = '<option value = "'+r[i].number+'"  selected>Copilot</option>';
              }
          }
          else
          {
            html += '<option value = ""  selected>Twilio Number Not found</option>';
            var html = '<option value = ""  selected>Twilio Number Not found</option>';
          }

            $('#sl2').html(html1+html);

          },

          error:function(xhr,status,error){

                // console.log(xhr.responseText);

                

              }

    });
}


  }

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['single_send'])) { ?>

    toastr.success('<?php echo $_SESSION['single_send']; ?>');

    <?php unset($_SESSION['single_send']);} if (isset($_SESSION['single_blacklist'])) { ?>

    toastr.error('<?php echo $_SESSION['single_blacklist']; ?>');

    <?php unset($_SESSION['single_blacklist']);} if (isset($_SESSION['failed'])) { ?>

    toastr.error('<?php echo $_SESSION['failed']; ?>');

    <?php unset($_SESSION['failed']);} ?>

</script>