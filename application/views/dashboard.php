<?php include('header.php'); ?>
<!DOCTYPE html>
<html>

    <main class="main">









      <!-- Breadcrumb -->



      <ol class="breadcrumb">



        <li class="breadcrumb-item">Home</li>



        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->



        <li class="breadcrumb-item active">Dashboard</li>



        <!-- Breadcrumb Menu-->



        



      </ol>







      <div class="container-fluid">







        <div class="animated fadeIn">



          <div class="row">



            <!--div class="col-sm-6 col-lg-3">



              <div class="card postion-for-contant">



                <div class="card-body p-0 clearfix">



                  <i class="fa fa-user bg-primary p-4 px-5 font-2xl mr-3 float-left"></i>



                  <div class="h2 mb-0 pt-3 text-center">0</div>



                  <div class="text-muted text-uppercase font-weight-bold font-xs text-center leads">Total Leads </div>



                </div>



              </div>



            </div--> 



            <!--/.col-->







           <div class="col-sm-6 col-lg-4">

<a href="<?php echo base_url();?>Clients">

              <div class="card postion-for-contant">



                <div class="card-body p-0 clearfix">



                  <i class="fa fa-mobile bg-danger moblie-padding-dash px-5 font-2xl float-left"></i>



                  <div class="h2 mb-0 pt-3 text-center"><?php if ($data=='No') {

                    echo '0';

                  }

                  else{ echo sizeof($data);} ?></div>



                  <div class="text-muted text-uppercase font-weight-bold font-xs text-center leads2">Total Contacts</div>



                </div>



              </div>

</a>

            </div>



            <!--/.col-->







            <div class="col-sm-6 col-lg-4">

<a href="<?php echo base_url(); ?>Received_messages_new">

              <div class="card postion-for-contant">



                <div class="card-body p-0 clearfix">



                  <i class="icon-envelope bg-success p-4 envelopsty px-5 font-2xl float-left"></i>



                  <div class="h2 mb-0 pt-3 text-center"><?php echo $Received_messages_new; ?><br></div><div class="text-center current">Current Day</div>



                  <div class="text-muted text-uppercase font-weight-bold font-xs text-center leads3">Received SMS</div>



                </div>



              </div>

</a>

            </div>



            <!--/.col-->



<?php

$total_message_report = $sent_msg_log+$failed_numbers+$pending_numbers;



if ($total_message_report==0) {

    $total_message_report = 1;

}

    $total_message_delivered_percentage = ($sent_msg_log/$total_message_report)*100;

    $total_message_failed_percentage = ($failed_numbers/$total_message_report)*100;

    $total_message_pending_percentage = ($pending_numbers/$total_message_report)*100;



?>





            <div class="col-sm-6 col-lg-4">

<a href="<?php echo base_url(); ?>Sent_messages">

              <div class="card postion-for-contant">



                <div class="card-body p-0 clearfix">



                  <i class="fa fa-bell bg-info envelopsty p-4 px-5 font-2xl float-left"></i>



                  <div class="h2 mb-0 pt-3 text-center"><?php echo ($sent_msg_log); ?></div><div class="text-center current">Current Day</div>



                  <div class="text-muted text-uppercase font-weight-bold font-xs text-center leads4">Sent SMS</div>



                </div>



              </div>

</a>

            </div>



            <!--/.col-->



          </div>



          <!--/.row-->



          <div class="row">



            <div class="col-lg-12">



              <div class="card">



                <div class="card-body">



                  <div class="row">



                    <!--div class="col-sm-8">



                      <h4 class="card-title">Traffic</h4>



                      <p class="text-muted">Graph representation of Message </p>



                      <br>



                      <div class="chart-wrapper" style="height:250px;margin-top:20px;">



                        <canvas id="main-chart" height="250"></canvas>



                      </div>



                    </div-->



                    <div class="col-sm-12">



                      <h4 class="card-title">SMS Status</h4>



                      <p class="text-muted">Status Of Current Day</p>



                     <hr>



                      <br>

<a href="<?php echo base_url(); ?>Sent_messages" style="color:black">

                      <div>Delivered(<?php echo ($sent_msg_log);?>)</div>



                      <div class="">



                       <?php echo round($total_message_delivered_percentage,2);?>%



                      </div>

</a>

                      <div class="progress progress-sm mt-2 mb-3">



                        <div class="progress-bar bg-success" style="width: <?php echo $total_message_delivered_percentage;?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>



                      </div>

</a>

<a href="<?php echo base_url(); ?>Failed_numbers"style="color:black">

                      <div>Failed Messages(<?php echo ($failed_numbers); ?>)</div>



                      <div class="">



                        <?php echo round($total_message_failed_percentage,2);?>%



                      </div>



                      <div class="progress progress-sm mt-2 mb-3">



                        <div class="progress-bar bg-info" style="width: <?php echo round($total_message_failed_percentage,2);?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>



                      </div>

</a>



<a href="<?php echo base_url(); ?>Pending_numbers"style="color:black">

                      <div>Pending Messages(<?php echo($pending_numbers);?>)</div>



                      <div class="">



                        <?php echo round($total_message_pending_percentage,2);?>%



                      </div>



                    <div class="progress progress-sm mt-2 mb-3">



                        <div class="progress-bar bg-warning" style="width: <?php echo round($total_message_pending_percentage,2);?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>



                      </div> 

</a>

                      



                    </div>



                  </div>



                </div>



              </div>



              <!--/.card-->



            </div>



            <!--/.col-->



          



            <!--/.col-->



          </div>



          <!--/.row-->



         







         



          <!--/.row-->



        </div>







      </div>



      <!-- /.conainer-fluid -->



    </main>







    



  </div>



<?php include('footer.php'); ?>

<script type="text/javascript">

<?php if (isset($_SESSION['welcm']) && $_SESSION['welcm']=='1') {?>

  toastr.success('Welcome <?php echo $_SESSION['user']; ?>');

  <?php unset($_SESSION['welcm']);} ?>

</script>