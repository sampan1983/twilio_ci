<?php include_once('header.php') ?>
 <!-- Main content --> 

 <main class="main">   

 <!-- Breadcrumb -->   

 <ol class="breadcrumb">  

 <li class="breadcrumb-item">Home</li> 

 <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->    

 <li class="breadcrumb-item active">Chat</li>  


 </ol>     

 <div class="container-fluid">   

   <input type="hidden" name="number1" value="<?php if ($_SESSION['number'] == null) {

      echo "";

    } 

    else{echo $_SESSION['number']; } ?>">

           

   <div class="animated fadeIn">

   <div class="card">           

   <div class="card-header">    

   <i class="icon-people"></i>You're Chatting With: <?php 

   if ($_SESSION['number'] == null) {

      echo " ";

    } 

    else{echo $_SESSION['number']; }?>           

    <div class="card-actions">       

   <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus fa-sm"></i> Delete Conversation</button>    

   </div>          

   </div>

             

  <div class="card-body">   

  <div class="row">           

  <div class="col-lg-12">    

  <div class="add-btn-group-padding text-center">  

  <div class="page-content-inner align-items-center"> 

  <div class="row"> 

  <div class="col-md-8 center-block">

  <div class="panel panel-info twillo-chat-panel">

  <form id="sendmsg">

  <div class="input-group">

                   <input type="hidden" name="number1" value="<?php echo $gettwilio[0]['sender']; ?>">

           <input type="hidden" name="twilio_num" value="<?php echo $gettwilio[0]['twilio_num']; ?>">

                                    <input type="text" name="msg" required="true" class="form-control" placeholder="Enter Message" oninvalid="this.setCustomValidity('Please Write Your Message First')" oninput="setCustomValidity('')"/>

                                    <span class="input-group-btn">

                                        <button class="btn btn-primary chat-right-btn" type="submit">SEND</button>

                                    </span>

                                </div>

                </form>

  <div class="panel-body scrollbar" id="style-3">   

  

  <div class="force-overflow">

  <ul class="media-list">          



  <?php

  if ($chatdata=='No') {

    echo "";

  }

  else{

for ($i=0; $i <sizeof($chatdata) ; $i++) 

{

  // echo $data1['sending_status'];

  

  if($chatdata[$i]['sending_status']=='S') { ?>

                                   <li class="media">  

                   <div class="offset-md-2 col-md-12">

                   <div class="media">

                   <div class="media-body panel-chat-message" >

                   <?php echo $chatdata[$i]['body'];?>

                   <br />               

                   <small class="text-muted"> <?php echo $chatdata[$i]['date_time'];?></small>        

                   </div>           

                   </div>        

                   </div>       

                   </li>

                   <?php } 

                   else { ?>

                   

     <li class="media">



                                        <div class="col-md-12">



                                            <div class="media">

                                               

                                                <div class="media-body panel-chat-message2" >

                                                    <?php echo $chatdata[$i]['body'];?>                                                    <br />                                                   <small class="text-muted"> <?php echo $chatdata[$i]['date_time'];?></small>

                                                   

                                                </div>

                                            </div>



                                        </div>

                                    </li><?php } }

                                  }?>



              

     

                                </ul>

                </div>

            </div>

            <div class="panel-footer twillo-chat-footer">

                

            </div>

        </div>

    </div></div>

                                    </div>

              </div>

            </div>

            </div>

            </div>

          </div>

        </div>



      </div>

      <!-- /.conainer-fluid -->

    </main>

</div>



  <div class="modal fade" id="myModal">

    <div class="modal-dialog">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title text-center">Delete Conversation?</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

         <div class="row">



                    <div class="col-sm-12">



                    <label>Are you sure you want to Delete Conversation? This action can't be undone.</label>



                    </div>



                  </div>



                 

        </div>

        

        <!-- Modal footer -->

        <div class="modal-footer">

          <form id="delete" action="Chat/delete" method="POST">

            





<input type="hidden" name="number1" value="<?php echo $_SESSION['number']; ?>">





          <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </form>

        </div>

        

      </div>

    </div>

  </div>


<?php include_once('footer.php') ?>


<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

  $('#sendmsg').submit(function(evt){

    evt.preventDefault();

    var form = $(this).serialize();
console.log(form);
    $.ajax({

            type : 'ajax',

            method : 'post',

            data : form,

            dataType : 'json',

            url : '<?php echo base_url();?>Chat/sendmsg',

            success:function(r){

              console.log(r);

             location.reload();

            },

            error:function(xhr,status,error){

              console.log(xhr.responseText);

            }

    });

  });

</script>



<script type="text/javascript">

<?php if(isset($_SESSION['true']) && $_SESSION['true']=="200"){ ?>

 

  toastr.success('Message deleted successfully');

 <?php unset($_SESSION['true']); } if(isset($_SESSION['true']) && $_SESSION['true']=="201") { ?>

   

    toastr.error('Message not deleted','Failed');

 <?php unset($_SESSION['true']); } ?>



 <?php if(isset($_SESSION['fail_chat'])) {?>



  toastr.error("<?php echo $_SESSION['fail_chat']; ?>");



  <?php unset($_SESSION['fail_chat']); } ?>

</script>