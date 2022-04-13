<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="SMS Application">

  <meta name="author" content="Łukasz Holeczek">

  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard,Vue,Vue.js,React,React.js">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.png">

  <title> SMS APP</title>

  <!-- Icons -->

  <link href="<?php echo base_url(); ?>vendors/css/font-awesome.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>vendors/css/simple-line-icons.min.css" rel="stylesheet">

  <!-- Main styles for this application -->

  <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

  <!-- Styles required by this views -->

  <link href="<?php echo base_url(); ?>vendors/css/daterangepicker.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>vendors/css/gauge.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>vendors/css/toastr.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>vendors/css/dataTables.bootstrap4.min.css" rel="stylesheet">

 <!-- custom stylesheet for all -->

  <link href="<?php echo base_url(); ?>css/custom-style.css" rel="stylesheet">

  <!-- Begin emoji-picker Stylesheets -->

  <link href="<?php echo base_url(); ?>lib/css/nanoscroller.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>lib/css/emoji.css" rel="stylesheet">

  <style type="text/css">

    .avatar-img-margin {

      margin-right: 80px !important;

  }

  .right a {

        margin-left: 676px;

  }

  </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

  $( document ).ready(function() {

    setTimeout(function() { $("#toast-container").hide(); }, 4000);

  });

</script>

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">







  <header class="app-header navbar">







    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">







      <span class="navbar-toggler-icon"></span>







    </button>







    <a class="navbar-brand" href="#"> <!--img src="img/" style=""--> </a>







    <button class="navbar-toggler sidebar-toggler d-md-down-none h-100 b-r-1 px-3" type="button">







      <span class="navbar-toggler-icon"></span>







    </button>







    <ul class="nav navbar-nav d-md-down-none mr-auto">















      <!--form class="form-inline px-4">







        <i class="fa fa-search"></i>







        <input class="form-control" type="text" placeholder="Search...">







      </form-->







    </ul>







    <ul class="nav navbar-nav ml-auto">







      







      







      <!-- <li class="nav-item dropdown d-md-down-none">







        <a class="nav-link nav-pill" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">







          <i class="icon-envelope-letter"></i><span class="badge badge-pill badge-info">7</span>







        </a>







       </li> -->







      <li class="nav-item dropdown ">







        <a class="nav-link nav-pill avatar avatar-img-margin" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">







          <img src="<?php echo base_url(); ?>img/avatars/<?php echo $data_user[0]['profile_image'];?>" class="img-avatar" alt="">







          <!-- <span class="badge badge-pill badge-danger">9</span> -->







          <span class="profile-name"><strong><?php echo $data_user[0]['user_name'];?></strong></span>







        </a>















        <div class="dropdown-menu dropdown-menu-right">







          <div class="dropdown-header text-center">







            <strong>Account</strong>







          </div>







         







          <a class="dropdown-item" href="<?php echo base_url(); ?>My_Profile"><i class="fa fa-user"></i> My Profile</a>



      



          <a class="dropdown-item" href="<?php echo base_url(); ?>Messages"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success"><?php echo $Received_messages_new; ?></span></a>







          <a class="dropdown-item" href="<?php echo base_url(); ?>Login/logout"><i class="fa fa-lock"></i> Logout</a>







        </div>







      </li>







      <li class="profile-name"> </li>







      <!-- <button class="navbar-toggler aside-menu-toggler" type="button">







        <span class="navbar-toggler-icon"></span>







      </button> -->















    </ul>







  </header>







  <div id="toast-container" class="toast-top-right">



 



</div>







    <div class="app-body">







    <div class="sidebar">







      <nav class="sidebar-nav">







        <ul class="nav">







          <!-- <li class="nav-title text-center">







            <span>Dashboard</span>







          </li> -->







          <li class="nav-item">







            <a class="nav-link" href="<?php echo base_url();?>Dashboard"><i class="icon-speedometer"></i> Dashboard </a>







          </li>







          </li>



       <li class="nav-item">







            <a class="nav-link" href="<?php echo base_url(); ?>Contacts"><i class="icon-people"></i> Contacts</a>







          </li>

          <?php if ($_SESSION['user']=='super admin') {            ?>

         <li class="nav-item">

          <a class="nav-link" href="<?php echo base_url(); ?>My_Profile"><i class="icon-user"></i> User Management</a>

        </li>

      <?php } ?>



          <li class="nav-item nav-dropdown">







            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-envelope"></i> Message</a>







            <ul class="nav-dropdown-items">

              <li class="nav-item">

                <a class="nav-link" href="<?php echo base_url(); ?>Single_Message"><i class="icon-envelope-open"></i> Single Message</a>

              </li>



                 <li class="nav-item">

                <a class="nav-link" href="<?php echo base_url(); ?>Bulk_Message"><i class="icon-envelope-letter"></i> Bulk Message</a>

              </li>

            

              <li class="nav-item">

                <a class="nav-link" href="<?php echo base_url(); ?>Inbox"><i class="icon-envelope-open"></i> Inbox</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" href="<?php echo base_url(); ?>Sent_Messages"><i class="icon-paper-plane"></i> Sent Messages</a>

              </li>

            </ul>

          </li>



  <li class="nav-item">

            <a class="nav-link" href="<?php echo base_url(); ?>Voice_Broadcast"><i class="icon-call-out"></i> Voice Call</a>

          </li> 

 

 

          <li class="nav-item">

            <a class="nav-link" href="<?php echo base_url(); ?>Bulk_Voice_Broadcast"><i class="icon-call-out"></i> Bulk Voice Broadcast</a>

          </li>

 



          <li class="nav-item">







            <a class="nav-link" href="<?php echo base_url(); ?>Groups"><i class="icon-people"></i> Groups</a>







          </li>



          



        <li class="nav-item">







            <a class="nav-link" href="<?php echo base_url(); ?>Template_Messages"><i class="icon-people"></i> Template Messages</a>







          </li>



          <li class="nav-item">







            <a class="nav-link" href="<?php echo base_url(); ?>Blacklist"><i class="icon-people"></i> BlackList</a>







          </li>







            <li class="nav-item">







            <a class="nav-link" href="<?php echo base_url(); ?>Autoresponder_Keywords"><i class="icon-people"></i> Autoresponder Keywords</a>







          </li>







           <li class="nav-item nav-dropdown">







            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-chart"></i> Reports</a>







            <ul class="nav-dropdown-items">



<li class="nav-item">


            <a class="nav-link" href="<?php echo base_url(); ?>Call_Logs"><i class="icon-call-out"></i> Call Logs</a>


          </li>



      



      



<li class="nav-item">

            <a class="nav-link" href="<?php echo base_url(); ?>Queued_Calls"><i class="icon-call-out"></i>Queued Calls</a>


</li>










          







              <li class="nav-item">







                <a class="nav-link" href="<?php echo base_url(); ?>Failed_Messages"><i class="fa fa-exclamation-triangle fa-lg"></i> Failed Messages</a>







              </li>







              <li class="nav-item">







                <a class="nav-link" href="<?php echo base_url(); ?>Pending_Messages"><i class="icon-clock"></i> Pending Messages</a>







              </li> 

              <!-- <li class="nav-item">







              <a class="nav-link" href="<?php echo base_url(); ?>Queued"><i class="icon-clock"></i> Queued Messages</a>







              </li>          -->







            </ul>







          </li>  







           <li class="nav-item nav-dropdown">







            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> Settings</a>







            <ul class="nav-dropdown-items">







               <li class="nav-item">







                  <a class="nav-link" href="<?php echo base_url(); ?>Add_Account"><i class="icon-link"></i> Add  Account</a>







                </li>







                  <li class="nav-item">







                  <a class="nav-link" href="<?php echo base_url(); ?>Add_Number"><i class="icon-call-end"></i> Add  Number</a>

                  <!-- <a class="nav-link" href="<?php echo base_url(); ?>Forward"><i class="icon-call-end"></i>Forward</a> -->









                </li>









            </ul>







          </li>







     







       </ul>







      </nav>







      <button class="sidebar-minimizer brand-minimizer" type="button"></button>







    </div>

