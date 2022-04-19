<?php include_once('header.php') ?>

    <main class="main">







      <!-- Breadcrumb -->



      <ol class="breadcrumb">



        <li class="breadcrumb-item">Home</li>



        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->



        <li class="breadcrumb-item active">Update Account Details</li>



        <!-- Breadcrumb Menu-->



        <!-- <li class="breadcrumb-menu d-md-down-none">



          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">



            <a class="btn" href="#"><i class="icon-speech"></i></a>



            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Update Twilio Details</a>



            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>



          </div>



        </li> -->



      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-people"></i> Update Account Details

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <small class="text-muted">docs</small>

                </a>

              </div>

            </div>

            <div class="card-body">

              <div class="row" <?php if (!$_SESSION['type'] =='super admin') {

                echo 'style="display : none"';

              } ?>>

<!--                <a data-toggle="modal" href="#add_form" class="btn btn-info">Add account</a> -->

              <div class="col-lg-12"> 

              <div class="add-btn-group-padding">

              <!-- <button type="button" class="btn btn-primary btninp" data-toggle="modal" data-target="#add_form" onclick="getuser()"><i class="fa fa-plus fa-sm"></i> Add Account</button> -->



              </div>



            </div>

            </div>



            </div>

<!--               <div class="table acc" style="overflow: scroll;"> -->

              <table class="table table-striped table-bordered datatable table-responsive-sm">



                <thead>



                  <tr>



                    <th>ID</th>



                    <th>Account Type</th>



                    <th>Account ID</th>



                    <th>Account Token</th>

                    <th>App SID</th>

                    <th>Service Id</th>



                    <th>Action</th>



                  </tr>



                </thead>



                <tbody>



                  <?php if ($data=='No') {

                    echo '<tr><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>';

                  } 

                  else{

                    for ($i=0; $i <sizeof($data) ; $i++) { 

                      $d = $i+1;

                      echo '<tr>

                               <td>'.$d.'</td>

                                <td>'.$data[$i]['service_type'].'</td>

                                <td>'.$data[$i]['twilio_sid'].'</td>

                                <td>'.$data[$i]['twilio_token'].'</td>

                                <td>'.$data[$i]['app_sid'].'</td>

                                 <td>'.$data[$i]['copilet_msg_service_id'].'</td>                                

          
                                 <td>   <a class="btn btn-info action-btn edit" data-type="'.$data[$i]['service_type'].'" data-sid="'.$data[$i]['twilio_sid'].'" data-token="'.$data[$i]['twilio_token'].'" data-id="'.$data[$i]['id'].'" data-app ="'.$data[$i]['app_sid'].'"  data-service_id="'.$data[$i]['copilet_msg_service_id'].'" data-toggle="modal" href="#edit_form">



              <i class="fa fa-edit "></i>



            </a>

</td>


                                </tr>';
                           



                    }



                  }



                  ?>



         <!--              <td>   <a class="btn btn-info action-btn edit" data-type="'.$data[$i]['service_type'].'" data-sid="'.$data[$i]['twilio_sid'].'" data-token="'.$data[$i]['twilio_token'].'" data-id="'.$data[$i]['id'].'" data-app ="'.$data[$i]['app_sid'].'"  data-service_id="'.$data[$i]['copilet_msg_service_id'].'" data-toggle="modal" href="#edit_form">



              <i class="fa fa-edit "></i>



            </a>



                      <a class="btn btn-danger action-btn delete" data-id='.$data[$i]['id'].' data-toggle="modal" href="#delete">



              <i class="fa fa-trash-o "></i>







            </a></td> -->

<!-- add new account -->

<div class="modal fade" id="add_form">

 <div class="modal-dialog">

  <form class="no-margin"  method="post" action="Add_twilio_account/add" name="client_record" id="example" enctype="multipart/form-data" >

  <div class="modal-content">

      <!-- Modal Header -->

    <div class="modal-header">

    <h4 class="modal-title text-center">Add Twilio Details</h4>

     <button type="button" class="close" data-dismiss="modal">&times;</button>

    </div>

       <!-- Modal body -->

    <div class="modal-body">

     <div class="row">

      <div class="col-sm-12">

        <div class="form-group">

         <label  class="control-label">User </label>

         <select class="form-control" name="user_id" id="user">

          <option value="">Select User</option>

         </select>

        </div>

      </div>

    </div>

     <div class="row">

      <div class="col-sm-12">

        <div class="form-group">

         <label  class="control-label">Account Type</label>

         <select class="form-control" name="service_type">

          <option value="">Select Type</option>

          <option value="twilio">Twilio</option>

         </select>

        </div>

      </div>

    </div>

    <div class="row">

    <div class="col-sm-12">

      <div class="form-group">

       <label  class="control-label">Account Sid</label>

       <input type="text" placeholder="Enter Sid" required class="form-control"  name="sid" >

      </div>

    </div>

  </div>

   <div class="row">

     <div class="col-sm-12">

        <div class="form-group">

         <label for="accntoken">Account Token</label>

         <br>

         <input type="text"  placeholder="Enter Token" required class="form-control input-sm parsley-validated "  name="token" >

        </div>

      </div>

    </div>

   <div class="row">

     <div class="col-sm-12">

        <div class="form-group">

         <label for="accntoken">App SID</label>

         <br>

         <input type="text"  placeholder="Enter Token"  class="form-control input-sm parsley-validated "  name="app_sid" >

        </div>

      </div>

    </div>    

     <div class="row">

     <div class="col-sm-12">

        <div class="form-group">

         <label for="copilet_msg_service_id">Sservice id</label>

         <br>

         <input type="text"  placeholder="Enter service id"  class="form-control input-sm parsley-validated "  name="copilet_msg_service_id" >

        </div>

      </div>

    </div> 

  </div>

<!-- Modal footer -->

   <div class="modal-footer">

     <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>

     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

   </div>

  </div>

</form>

</div>

</div>

<!--end model add new account -->

                       







                  <div class="modal fade" id="edit_form">



    <div class="modal-dialog">



      <form class="no-margin"  method="post"   action="Add_twilio_account/edit" name="client_record" id="example" enctype="multipart/form-data" >



      <div class="modal-content">



      <input type="hidden" id="editid" name="id">



        <!-- Modal Header -->



        <div class="modal-header">



          <h4 class="modal-title text-center">Update Twilio Details</h4>



          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>       

        <!-- Modal body -->

        <div class="modal-body">

    		<div class="row">

  		  <div class="col-sm-12">

        <div class="form-group">

          <label  class="control-label">Account Type</label>

          <select class="form-control" id="edittype" name="service_type">

					</select>

        </div>

        </div>

        </div>

        <div class="row">

                    <div class="col-sm-12">

                      <div class="form-group">

                        <label  class="control-label">Account Sid</label>

                        <input type="text" id="editsid" placeholder="Enter Sid" required class="form-control"  name="sid" >

                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-sm-12">

                      <div class="form-group">

                        <label for="accntoken">Account Token</label>

                        <br>

                          <input type="text" id="edittoken"  placeholder="Enter Token" required class="form-control input-sm parsley-validated "  name="token" >

                         </div>

                      </div>

                    </div>

                  <div class="row">

                    <div class="col-sm-12">

                      <div class="form-group">

                        <label for="accntoken">App SID</label>

                        <br>

                          <input type="text" id="editapp_sid"  placeholder="Enter Token"  class="form-control input-sm parsley-validated "  name="app_sid">

                         </div>

                      </div>

                    </div>

                     <div class="row">

                    <div class="col-sm-12">

                      <div class="form-group">

                        <label for="accntoken">Service id</label>

                        <br>

                          <input type="text" id="edit_msg_service_id"  placeholder="Enter Service id"  class="form-control input-sm parsley-validated "  name="copilet_msg_service_id">

                         </div>

                      </div>

                    </div>

                  </div>



        



        <!-- Modal footer -->



        <div class="modal-footer">



          <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>



          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



        </div>



        



      </div>



</form>



    </div>



  </div>















<div class="modal fade" id="delete">



    <div class="modal-dialog">



      <form class="no-margin"  method="post"   action="Add_twilio_account/delete" name="client_record" id="example" enctype="multipart/form-data" >



      <div class="modal-content">



      



        <!-- Modal Header -->



		<input type="hidden" name="id" id="delid">



        <div class="modal-header">



          <h4 class="modal-title text-center">Delete Twilio Details</h4>



          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>



        



        <!-- Modal body -->



        <div class="modal-body">



         <div class="row">







                    



                    <div class="col-sm-12">















                    <label>Are you sure you want to clear database? This action can't be undone.</label>















                    </div>



                  </div>







                  



        </div>



        



        <!-- Modal footer -->



        <div class="modal-footer">



          <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>



          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



        </div>



        



      </div>



</form>



    </div>



  </div>







                          </tbody>



              </table>

           <!--  </div> -->



            </div>



          </div>



        </div>







      </div>



      <!-- /.conainer-fluid -->



    </main>







 







  </div>







  <div class="modal fade" id="myModal">



    <div class="modal-dialog">



      <form class="no-margin"  method="post"   action="add_twilio_account1.php" name="client_record" id="example" enctype="multipart/form-data" >



      <div class="modal-content">



      



        <!-- Modal Header -->



        <div class="modal-header"> 



          <h4 class="modal-title text-center">Add Twilio Details</h4>



          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>



        



        <!-- Modal body -->



        <div class="modal-body">



		



		    <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">







                        <label  class="control-label">Account Type</label>



                        <select class="form-control" name="service_type">



						<option value="">Select Account Type</option>



						<option value="twilio">Twilio</option>



				



						</select>



                      </div>







                    </div>







                  </div>



				  



		



         <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">







                        <label  class="control-label">Account Sid</label>



                        <input type="text" id="" placeholder="Enter Sid" required class="form-control"  name="sid">



                      </div>







                    </div>







                  </div>







                  <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">



                        <label for="accntoken">Account Token</label>



                        <br>



                          <input type="text" id="twilio_num1" value="" placeholder="Enter Token" onKeyUp="checkkeyword(this.value)" required class="form-control input-sm parsley-validated "  name="token">



                         </div>







                    </div>







                  </div>



        </div>



        



        <!-- Modal footer -->



        <div class="modal-footer">



          <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>



          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



        </div>



        



      </div>



</form>



    </div>



  </div>







  <?php include_once('footer.php') ?>







<!-- Plugins and scripts required by this views -->



  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>







  <!-- Custom scripts required by this view -->



 <!--  <script src="<?php echo base_url(); ?>js/views/tables.js"></script> -->









<script type="text/javascript">

$(document).ready( function () {



    $('.datatable').DataTable({



      "scrollX": true

    });

      $('.datatable').attr('style', 'border-collapse: collapse !important');

} );

</script>

<script type="text/javascript">



  $('.edit').click(function(){



    var id = $(this).attr('data-id');



    var type = $(this).attr('data-type');



    var token = $(this).attr('data-token');



    var sid = $(this).attr('data-sid');

    var app = $(this).attr('data-app')



  var copilet_msg_service_id = $(this).attr('data-service_id');





    $('#editid').val(id);



    $('#edittoken').val(token);



    $('#editsid').val(sid);

    $('#editapp_sid').val(app);



    $('#edit_msg_service_id').val(copilet_msg_service_id);



    types(token);



   });



</script>



<script type="text/javascript">



  



  function types(token){



    $.ajax({



              type : 'ajax',



              method : 'post',



              dataType : 'json',



              url : '<?php echo base_url(); ?>Add_twilio_account/gettype',



              success:function(r){



                console.log(r);



                var html = "";



                for (var i = 0; i < r.length; i++) {



                  if (r[i].service_type==token) {



                  html += '<option value = "'+r[i].service_type+'" selected>'+r[i].service_type+'</option>';



                }



                else{



                  html += '<option value = "'+r[i].service_type+'" >'+r[i].service_type+'</option>';



                }



              }



                $('#edittype').html(html);





              },



              error:function(xhr,status,error){



                console.log(xhr.responseText);



              }



    });



  }



</script>







<script type="text/javascript">



  <?php if (isset($_SESSION['update']) && $_SESSION['update']=='1') { ?>



    toastr.success('Account updated successfully');



    <?php unset($_SESSION['update']); } if (isset($_SESSION['update']) && $_SESSION['update']=='0'){?>



    toastr.error('Account not updated','Failed');



    <?php unset($_SESSION['update']);    } ?>



</script>



<script type="text/javascript">



  $('.delete').click(function(){



    var id = $(this).attr('data-id');



    $('#delid').val(id);



  });



</script>



<script type="text/javascript">



  <?php if (isset($_SESSION['delete']) && $_SESSION['delete']=='1') { ?>



    toastr.success('Account deleted successfully');



    <?php unset($_SESSION['delete']); } if (isset($_SESSION['delete']) && $_SESSION['delete']=='0'){?>



    toastr.error('Account not deleted','Failed');



    <?php unset($_SESSION['delete']);    } ?>



</script>

<script type="text/javascript">

  function getuser()

  {

    $.ajax({

              type : 'ajax',

              method : 'post',

              dataType : 'json',

              url : '<?php echo base_url(); ?>Add_twilio_account/getuser',

              success:function(r)

              {

                  console.log(r);

                  var html = "";

                 for (var i = 0; i < r.length; i++) 

                 {

                      if (i==0) {

                      html += '<option value = " " selected>Select user</option><option value = "'+r[i].id+'" >'+r[i].user_name+'</option>';

                    }

                    else

                    {

                      html += '<option value = "'+r[i].id+'" >'+r[i].user_name+'</option>';

                    }

                }

                $('#user').html(html);

              },

          });

      }

</script>

