<?php include_once('header.php')?>    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Queued calls</li>

        <!-- Breadcrumb Menu-->

        <!-- <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <a class="btn" href="#"><i class="icon-speech"></i></a>

            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Pending Numbers</a>

            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>

          </div>

        </li> -->

      </ol>



      <div class="container-fluid">



        <div class="animated fadeIn">

          <div class="card">

                        <div class="card-header">

              <i class="icon-call-out"></i> Queued Calls<span>(<?php if ($data=='No') {

                echo '0';}

                else{

                  echo sizeof($data);

                } ?>)</span>

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <small class="text-muted">docs</small>

				  </a>

				  

                

              </div>

	

            </div>



            <div class="card-body">

              		  <a href="Pending_calls/start?status=ready" style=""class="btn btn-success btninp">Start Calls</a>&nbsp;

              <a href="Pending_calls/start?status=pause"  style=""class="btn btn-danger btninp2">Stop Calls</a><br></br>

              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable" style="border-collapse: collapse !important">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>To</th>

                    

                   

                    <th>From</th>

				

					<th>Voice</th>

					<th>status</th>

                     <th>Date time</th>

                    

                     <th>Delete</th>

                      

                   

                  </tr>

                </thead>

                <tbody>

                  <?php 

                      if ($data=='No') {

                        echo '<td valign="top" colspan="7" class="dataTables_empty">No data available in table</td>';

                      }

                      else{

                        for ($i=0; $i <sizeof($data) ; $i++) { 

                           if($data[$i]['voice_file'] != '') {

                           $play = '<a href="'.$data[$i]['voice_file'].'" target="_blank">Play</a>';} 

                           else {

                            $play =  "-"; 

                          }

                          $d = $i+1;

                        echo '<tr>

                                <td>'.$d.'</td>

                                <td>'.$data[$i]['user_number'].'</td>

                                <td>'.$data[$i]['twilio_number'].'</td>

                                <td>'.$play.'</td>

                                <td>'.$data[$i]['readyToCall'].'</td>

                                <td>'.$data[$i]['date_time'].'</td>

                                <td><a class="btn btn-danger delete" data-id='.$data[$i]['id'].' href="#delete" data-toggle="modal">

              <i class="fa fa-trash-o "></i>



            </a></td></tr>';

                        }

                      }

                  ?>

                                  </tbody>

              </table>

            </div>

          </div>

        </div>



      </div>

      <!-- /.conainer-fluid -->

    </main>

  </div>


<?php include_once('footer.php')?>


<div class="modal fade" id="delete">



    <div class="modal-dialog">



                      <form action="Pending_calls/delete" method="post">

      <div class="modal-content">

<input type="hidden" name="page_name" value="pending_calls.php">

<input type="hidden" name="table_name" value="tapp_voice_broadcast">

<input type="hidden" name="id" id="id">

<input type="hidden" name="flash_message" value="Congrats! data deleted successfully">

<input type="hidden" name="failure_message" value="Sorry! there was an error to delete">

        <div class="modal-header">

          <h4 class="modal-title text-center">Remove This Call Log</h4>

          <button type="button" class="close" data-dismiss="modal">×</button>

        </div>



        <div class="modal-body">



            <div class="form-group" style="text-align: center;">



              <label for="folderName">Are you sure you want to remove this Log? This action can't be undone.</label>



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



<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

  $('.delete').click(function(){

    var id = $(this).attr('data-id');

    $('#id').val(id);

  });

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['delcall']) && $_SESSION['delcall']=='1') { ?>

    toastr.success('Congrats! data deleted successfully');

    <?php unset($_SESSION['delcall']);  } if (isset($_SESSION['delcall']) && $_SESSION['delcall']=='0') {?> toastr.error('Sorry! there was an error to delete');

    <?php unset($_SESSION['delcall']); } ?>

</script>



<script type="text/javascript">

  <?php if (isset($_SESSION['status']) && $_SESSION['status']=='1') { ?>

    toastr.success('All call status has been changed');

    <?php unset($_SESSION['status']);  } if (isset($_SESSION['status']) && $_SESSION['status']=='0') {?> toastr.error('Sorry! call status not changed');

    <?php unset($_SESSION['status']); } ?>

</script>