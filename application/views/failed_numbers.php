 <?php include_once('header.php') ?>
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



 <!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Failed Message</li>

        <!-- Breadcrumb Menu-->

        <!-- <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <a class="btn" href="#"><i class="icon-speech"></i></a>

            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Failed Numbers</a>

            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>

          </div>

        </li> -->

      </ol>



      <div class="container-fluid">



        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-people"></i> Failed Message

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <small class="text-muted">docs</small>

                </a>

              </div>

            </div>



            <div class="card-body">

                <form method=post name=f1 action=''>

                   <input type=hidden name=num_msg value=submit>

   



              <div class="row">



            <div class="col-lg-12"> 

              <div class="add-btn-group-padding">

              <!--a href="export_failed.php" ><button type="button" value="Export Data" class="btn btn-primary"> Export CSV</button></a-->

              </div>

            </div>

            </div>

          </form>

              

              <table class="table table-striped table-bordered datatable table-responsive-sm"  id="dataTable">

                <thead>

                  <tr>

                    <th>ID</th>

                                     <th>User Number</th>

                    <th>Message</th>

                    <th>Media</th>

                    <th>Twilio Number</th>

                     <th>Date time</th>

<th>Delete</th>

                      

                   

                  </tr>

                </thead>

                <tbody>

                  <?php

                  if ($failed_data=='No') {

                  echo '<tr class="odd" ><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr>';

                  }

                  else{



                    for ($i=0; $i <sizeof($failed_data) ; $i++) { 

                      $d = $i+1;

                      if ($failed_data[$i]['images']==null) {

                        $img = 'NO Media';

                        

                      }

                      else{

                        $img = '<a href="'.$failed_data[$i]['images'].'" target="_blank">View MMS</a>';

                      }



                      echo '<tr '.$failed_data[$i]['id'].'>

                              <td>'.$d.'</td>

                              <td>'.$failed_data[$i]['sms_number'].'</td>



                              <td>'.$failed_data[$i]['message'].'</td>

                              <td>'.$img.'</td>

                                 <td>'.$failed_data[$i]['twilio_num'].'</td>

                              <td>'.$failed_data[$i]['date_time'].'</td>   

                             <td><a href="#" class="btn btn-danger delete" data-id = "'.$failed_data[$i]['id'].'">Delete</a></td>                           

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

                url : '<?php echo base_url(); ?>Failed_numbers/delete/'+id,

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

  <?php if(isset($_SESSION['delete'])){?>

    toastr.success('<?php echo $_SESSION['delete']; ?>','Deleted!!');

    <?php unset($_SESSION['delete']);} if(isset($_SESSION['delete_fail'])){?>

    toastr.error('<?php echo $_SESSION['delete_fail']; ?>','Failed');

    <?php unset($_SESSION['delete_fail']);} ?>

</script>