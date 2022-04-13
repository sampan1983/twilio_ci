<?php include_once('header.php')?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

		  $( document ).ready(function() {





var table = $('#dataTable').DataTable();



// Sort by columns 1 and 2 and redraw

table

    .order( [ 5, 'desc' ] )

    .draw();

 });

</script>

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Queued Message</li>

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

              <i class="icon-people"></i> Queued Message<!-- <span>(< ?php echo sizeof($pmsg) ?>)</span> -->

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <small class="text-muted">docs</small>

                </a>

              </div>

            </div>



            <div class="card-body">

              <div style="overflow:auto">

              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">

                <thead>

                  <tr>

                    <th>ID</th>

                  <th>User Number</th>

                    <th>Message</th>

                    <th>Media</th>

                    <th>Twilio Number</th>

                     <th>Added on</th>

                     <th>Status</th>
                   

                  </tr>

                </thead>

                <tbody>

                  <?php

                  if ($pmsg=='No') {

                    echo '<tr><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>';

                  }

                  else{



                     for ($i=0; $i <sizeof($pmsg) ; $i++) { 
                      $t = $i+1;
                                      if ($pmsg[$i]['images']=='') {

                        $img = 'NO Media';

                        

                      }

                      else{

                        $img = '<a href="'.$pmsg[$i]['images'].'" target="_blank">View MMS</a>';

                      }

                    echo '<tr>

                              <td>'.$t.'</td>

                              <td>'.$pmsg[$i]['sms_number'].'</td>

                              <td>'.$pmsg[$i]['message'].'</td>

                               <td>'.$img.'</td>

                              <td>'.$pmsg[$i]['twilio_num'].'</td>

                              



                              <td>'.$pmsg[$i]['date_time'].'</td>

                              <td>'.$pmsg[$i]['scheduled_time'].'</td>                              

                              <td><a href = "#" class = "btn btn-danger delete" data-id = "'.$pmsg[$i]['id'].'">Delete</a></td>

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



      </div>

      <!-- /.conainer-fluid -->

    </main>

  </div>



  <?php include_once('footer.php')?>


<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

  <script type="text/javascript">

    $('.delete').click(function(){

      var id = $(this).attr('data-id');

      $msg = confirm('Are you sure??');

      if ($msg==true) {

        $.ajax({

          type : 'ajax',

          method : 'post',

          dataType : 'json',

          url : '<?php echo base_url(); ?>Pending_numbers/delete/'+id,

          success:function(r){

            console.log(r);

              location.reload();

                     },

          error:function(xhr,status,error){

            console.log(xhr.responseText);

          }



        });

      }



    });

  </script>

<script type="text/javascript">

  <?php if (isset($_SESSION['delete'])) {?>

    toastr.success('<?php echo $_SESSION['delete'];?>');

    <?php unset($_SESSION['delete']);} if (isset($_SESSION['delete_fail'])) {?>

    toastr.error('<?php echo $_SESSION['delete_fail'];?>');

    <?php unset($_SESSION['delete_fail']);} ?>

</script>