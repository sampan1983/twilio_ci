 <?php include_once('header.php') ?>
    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Call Logs</li>

      </ol>



      <div class="container-fluid">



        <div class="animated fadeIn">

          <div class="card">

                        <div class="card-header">

              <i class="icon-call-out"></i> Call Logs<span>(<?php
                if ($data == 'No') {

                  echo '0';

                 } 

                 else{

                  echo sizeof($data);

                 } ?>)</span>

              <div class="card-actions">

              

              </div>

            </div>



            <div class="card-body">

			<div class="row"  align="right">

            <div class="col-sm-12">

			<a href="Outgoing_call_logs/export" style="color: #fff !important;margin-right: 30px;margin-bottom: 17px;" class="btn btn-primary btninp"  >

                  <small class="">Export data</small>

                </a>

				</div>

						</div>

              <table class="table table-striped table-bordered datatable table-responsive-sm " id="dataTable" style="width: 100%;">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>To</th>

                    <th>From</th>

			           		<th>Voice</th>

			           		<th>Recording</th>

                     <th>Date time</th>

                     <th>Delete</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                  if ($data=='No') {

                     echo '<tr><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr>';

                   } 

                   else{



                    for ($i=0; $i <sizeof($data) ; $i++) { 



                      if($data[$i]['voice_file'] != ''){

                        $voice = '<audio controls>  

   <source src="'.$data[$i]['voice_file'].'" type="audio/mp3">

 

</audio><a href="'.$data[$i]['voice_file'].'" download> <i class="fa fa-download icon-dwn"></a>';

} else {

           $voice =  "-"; }



             if($data[$i]['recording_url'] != '') {

             $recording = '<audio controls>  

   <source src="'.$data[$i]['recording_url'].'.wav" type="audio/wav">

 

</audio><a href="'.$data[$i]['recording_url'].'" download> <i class="fa fa-download icon-dwn"></a>';

} else { 



        $recording =  "-"; }

                      $d = $i+1;

                      echo '<tr>

                            <td>'.$d.'</td>

                            <td>'.$data[$i]['user_number'].'</td>

                            <td>'.$data[$i]['twilio_number'].'</td>

                            <td>'.$voice.'</td>

                            <td>'.$recording.'</td>

                            <td>'.$data[$i]['date_time'].'</td>

                            <td><a class="btn btn-danger delete" data-id='.$data[$i]['id'].' href="#delete" data-toggle="modal">

              <i class="fa fa-trash-o "></i>



            </a></td>



                              </tr>';

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


 <?php include_once('footer.php') ?>

<div class="modal fade" id="delete">



    <div class="modal-dialog">



                      <form action="Outgoing_call_logs/delete" method="post">

      <div class="modal-content">

<input type="hidden" name="page_name" value="Outgoing_call_logs">

<input type="hidden" name="table_name" value="tapp_voice_broadcast_logs">

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

  <script src="<?php echo base_url();?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url();?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <!-- <script src="<?php echo base_url();?>js/views/tables.js"></script> -->
  <script type="text/javascript">
    $(function(){
  $('#dataTable').DataTable({
    "scrollX":true
  });
  // $('.datatable').css({'border-collapse':'collapse !important'});
  $('.datatable').attr('style', 'border-collapse: collapse !important');
});
  </script>

<script type="text/javascript">

  $('.delete').click(function(){

    var id = $(this).attr('data-id');

    $('#id').val(id);

  });

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['vdelete']) && $_SESSION['vdelete']=='1') {?>

    toastr.success('Congrats! data deleted successfully');

    <?php unset($_SESSION['vdelete']);} if (isset($_SESSION['vdelete']) && $_SESSION['vdelete'] == '0') {?>

      toastr.error('Sorry! there was an error to delete');

      <?php unset($_SESSION['vdelete']);} ?>

</script>