<?php include_once('header.php'); ?>

      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Add New Number</li>

        <!-- Breadcrumb Menu-->

        <!-- <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <a class="btn" href="#"><i class="icon-speech"></i></a>

            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Add New Number</a>

            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>

          </div>

        </li> -->

      </ol>



      <div class="container-fluid">



        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-people"></i> Add New Number

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <small class="text-muted">docs</small>

                </a>

              </div>

            </div>



            <div class="card-body">

              <div class="row">



            <div class="col-lg-12"> 

              <div class="add-btn-group-padding">

              <button type="button" class="btn btn-primary btninp" data-toggle="modal" data-target="#yModal"><i class="fa fa-plus fa-sm"></i> Add New Number</button>

              </div>

            </div>

            </div>

              <table class="table table-striped table-bordered datatable table-responsive-sm">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>Account Type</th>

                  
                    <th>Number</th>
                    <th>Call Forward Number</th>
                    <th>Message Forward Number</th>
                    <th>Action</th>

                   

                  </tr>

                </thead>

                <tbody>

                     <?php

                     if ($twilio_numbers=='No') {

                      echo '<tr><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>';

                     }

                     else{



                      for ($i=0; $i <sizeof($twilio_numbers) ; $i++) { 
                      	if ($twilio_numbers[$i]['call_forward']!=null) {
                      		$call = $twilio_numbers[$i]['call_forward'];
                      	}
                      	else{
                      		$call = '-';
                      	}

                      	if ($twilio_numbers[$i]['call_forward']!=null) {
                      		$msg = $twilio_numbers[$i]['msg_forward'];
                      	}
                      	else{
                      		$msg = '-';
                      	}
                      	
                          $d = $i+1;

                        echo ' <tr '.$twilio_numbers[$i]['id'].'>

                    <td>'.$d.'</td>

                    <td>'.$twilio_numbers[$i]['service_type'].'</td>

                   

                    <td>'.$twilio_numbers[$i]['number'].'</td>
                    <td>'.$call.'</td>
                    <td>'.$msg.'</td>

                    <td>                    

                      <a class="btn btn-info action-btn edit" data-id = '.$twilio_numbers[$i]['id'].'

                      data-msg = '.$msg.' data-call = '.$call.'  data-toggle="modal" href="#edit_form"  >

                <i class="fa fa-edit "></i>

              </a>

                      <a class="btn btn-danger action-btn delete" data-toggle="modal" data-id = '.$twilio_numbers[$i]['id'].' href="#">

                <i class="fa fa-trash-o "></i>

              </a>

                    </td>';

                      }

                     }

                     ?>               

                 

                    <!-- ss -->

                    <!-- <td>

                      <a class="btn btn-success" href="#">

              <i class="fa fa-search-plus "></i>

            </a>

                      <a class="btn btn-info" href="#">

              <i class="fa fa-edit "></i>

            </a>

                      <a class="btn btn-danger" href="#">

              <i class="fa fa-trash-o "></i>



            </a>

                    </td> -->

                  

                  <div class="modal fade" id="edit_form">



 <div class="modal-dialog">



                  <form action="Forward/edit" method="post" class="no-margin"  id="edit"  >





      <div class="modal-content">



        <div class="modal-header">

          <h4 class="modal-title text-center">Edit Number?</h4>

          <button type="button" class="close" data-dismiss="modal">×</button>

        </div>



        <div class="modal-body">

		
				  

          



            <div class="form-group">



             <label class="control-label">Call Number</label>


             <input type="hidden" name="id" id="editid">
            <input type="number" id="twilio_num" placeholder="Enter Number e.g 61********" value=""  required class="form-control input-sm parsley-validated "  name="call">









            </div>
                        <div class="form-group">



             <label class="control-label">Message Number</label>



            <input type="number" id="twilio_msg" placeholder="Enter Number e.g 61********" value=""  required class="form-control input-sm parsley-validated "  name="msg">









            </div>



           </div>



        <div class="modal-footer">



                  <button type="submit" class="btn btn-danger btn-sm check2">Submit</button>



          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>

          </div>



      </div>

                </form>

   </div>

 </div>



<!--delete data-->

 <div class="modal fade" id="delete2">



   <div class="modal-dialog">



                      <form id="deleteform" method="post">



      <div class="modal-content">



        

        <div class="modal-header">

          <h4 class="modal-title text-center">Remove this Number?</h4>

          <button type="button" class="close" data-dismiss="modal">×</button>

        </div>



        <div class="modal-body">



           <div class="form-group" style="text-align: center;">

              <input type="hidden" name="id" id="deleteid">

              <label for="folderName">Are you sure you want to remove this Number? This action can't be undone.</label>



            </div>



        </div>





        <div style="text-align:center;" class="modal-footer">



                 <button type="submit" class="btn btn-danger btn-sm">Confirm</button>





          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>

        </div>



     </div>



                        </form>



    </div>



    </div>



                </tbody>



                

              </table>

            </div>

          </div>

        </div>



      </div>

      <!-- /.conainer-fluid -->

    </main>

  </div>



  <div class="modal fade" id="myModal">

    <div class="modal-dialog">

      <form  id="addform">

      <div class="modal-content">

              <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title text-center">New Number</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

         <div class="row">

 <div class="col-sm-12">              

 <div class="form-group">        

 <label for="name">Account</label>    

 <select name="sid" class="form-control" >			

 <option value="">Select  Account</option>	

 					

 <option value="sid">

 Twilio</option>	

 					

 

 </select>                   

 </div>                   

 </div>										

                   



                  </div>



                  <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="accnumber">Number</label>

                        <br>

                      <input type="text" class="form-control" id="twilio_num1" name="num" placeholder="15417543XXX" required >

                       <span style="color:#FF0000;" id="show"></span>

                      </div>



                    </div>



                  </div>

				  

				  

				  

				  <div class="form-group">



             <label class="control-label">Make This Number As Default:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>



            <input type="radio" name="is_default" value="yes" > Yes&nbsp;&nbsp;&nbsp;

			 <input type="radio" name="is_default" value="no"> No



           <input type="hidden" placeholder="Keyword name" value=""  required class="form-control input-sm parsley-validated "  name="id">



           <span style="color:#FF0000;" id="show"></span>

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




</div><?php include_once('footer.php'); ?>
<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

  $('#addform').submit(function(evt){

    evt.preventDefault();

    var form = $(this).serialize();

    $.ajax({

            type : 'ajax',

            method : 'post',

            data : form,

            dataType : 'json',

            url : '<?php echo base_url(); ?>Forward/addnum',

            success:function(r){

              console.log(r);

              if (r=='inserted') {



                location.reload();

              }

              else if (r=='already') {

                toastr.warning('This number is already added');

              }

              else{

                toastr.error('Failed');

              }

            },

            error:function(xhr,status,error){

              console.log(xhr.responseText);

            }

    });

  });

</script>

<script type="text/javascript">

  $('.delete').click(function(){

    var id = $(this).attr('data-id');

    $('#delete2').modal('show');

    $('#deleteid').val(id);

    $('#deleteform').submit(function(evt){

      evt.preventDefault();

      var form = $(this).serialize();

      $.ajax({

                type : 'ajax',

                method : 'post',

                data : form,

                dataType : 'json',

                url : '<?php echo base_url();?>Forward/delete',

                success:function(r){

                  console.log(r);

                  if (r=='deleted') {



                    location.reload();

                  }

                  else{

                    toastr.error("Sorry This number can't deleted", 'Failed');

                  }

                },

      });

    });



  });

  

</script>

<script type="text/javascript">

  $('.edit').click(function(){

    var id = $(this).attr('data-id');

    var num = $(this).attr('data-call');

    var msg = $(this).attr('data-msg');

    $('#twilio_num').val(num);
    $('#twilio_msg').val(msg);
    $('#editid').val(id);




//     $('#edit').submit(function(e){

//       e.preventDefault();

//       var form = $("#edit").serialize();
// alert(form);
      

//     $.ajax({

//               type : 'ajax',

//               method : 'post',

//               data : form,

//               dataType : 'json',

//               url : '< ?php echo base_url(); ?>Forward/edit',

//               success:function(r){

//                 console.log(r);

//                 if (r==true) {



//                   location.reload();

//                 }

//                 else{

//                   toastr.error("This number is already added",'Already');

//                 }

//               },

//               error:function(xhr,status,error){

//                 console.log(xhr.responseText);

//               }

//     });

        });

  



  function funs(param) {

    var is = param;

    console.log(param); 

    if(is=="yes"){

      $(".issss").val("yes");

    }else {

      $(".issss").val("no");

    }



  }

</script>

<script type="text/javascript">

  function gettype(twilio_sids){



    console.log(twilio_sids);

    $.ajax({

                type : 'ajax',

                method : 'post',

                dataType : 'json',

                url : '<?php echo base_url();?>Add_twilio_number/gettype',

                success:function(r){

                  console.log(r);

                  var sid = "";

                  for (var i = 0; i < r.length; i++) {

                    if (twilio_sids==r[i].twilio_sid) {

                   sid += '<option value="">Select Account</option><option value="'+r[i].twilio_sid+'" selected>'+r[i].service_type+'</option>';

                  }

                  else{

                    sid += '<option value="'+r[i].twilio_sid+'" >'+r[i].service_type+'</option>'

                  }

                }

                  $('#sid').html(sid);

                },

                error:function(xhr,status,error){

                  console.log(xhr.responseText);

                }

    });

  }

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['num_added'])) {?>

    toastr.success('<?php echo $_SESSION['num_added']; ?>');

    <?php unset($_SESSION['num_added']);} 



    if (isset($_SESSION['num_deleted'])) {?>

    toastr.success('<?php echo $_SESSION['num_deleted']; ?>');

    <?php unset($_SESSION['num_deleted']);}



    if (isset($_SESSION['number_edit'])) {?>

    toastr.success('<?php echo $_SESSION['number_edit']; ?>');

    <?php unset($_SESSION['number_edit']);} ?>

</script>