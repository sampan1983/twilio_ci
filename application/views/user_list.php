<?php include_once('header.php') ?>   
 <main class="main">
   <!-- Breadcrumb -->
   <ol class="breadcrumb">
     <li class="breadcrumb-item">Home</li>
     <li class="breadcrumb-item active">Profile</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
              <i class="icon-people"></i> Profile
            </div>
            <div class="card-body">
              <div class="row">
            <div class="col-lg-12"> 
              <div class="add-btn-group-padding">
                 <?php if ($_SESSION['type']=='super admin') {?>
<!--                    <a data-toggle="modal" href="#add_form" class="btn btn-info">Add account</a> -->

<!--             <div class="col-lg-12">  -->
              <!-- <div class="add-btn-group-padding"> -->
              <!-- <button type="button" class="btn btn-primary btninp" data-toggle="modal" data-target="#add_form"><i class="fa fa-plus fa-sm"></i> Add New User</button> -->
              <!-- </div> -->
<!--             </div>    -->           <?php  } ?>
              </div>
            </div>
            </div>
              <table class="table table-striped table-bordered datatable table-responsive-sm">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Profile Image</th>
                   <th>Action</th>
                  </tr>
               </thead>
                <tbody>
                 <?php
                   if ($data=='No') {
                     echo '<tr><td></td><td></td><td>No Data avaliable</td><td></td><td></td></tr>';
                   }
                   else{
                    for ($i=0; $i <sizeof($data); $i++) { 
                      if (empty($data[$i]['profile_image'])) {
                        $img = '';
                      }
                      else
                      {
                        $img = '<a class="tabel-data-profile-img" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="'.base_url().'/img/avatars/'.$data[$i]['profile_image'].'" class="img-avatar" alt="admin@bootstrapmaster.com">
                                  </a>';
                      }
                      $d = $i+1;
                      echo ' <tr id="tr" class="tr'.$data[$i]['id'].'">
                              <td>'.$d.'</td>
                              <td>'.$data[$i]['user_name'].'</td>
                              <td>'.$data[$i]['email'].'</td>
                              <td>'.$img.'</td>
                              <td style="text-align:right;"> <a class="btn btn-info action-btn edit" data-id='.$data[$i]['id'].' data-user='.$data[$i]['user_name'].' data-email='.$data[$i]['email'].' data-pass='.$data[$i]['password'].' data-pic='.$data[$i]['profile_image'].' data href="#edit_form"  data-toggle="modal" >
                              <i class="fa fa-edit "></i>
                               </a>
                              <a class="btn btn-danger action-btn delete" href="#delete" data-id='.$data[$i]['id'].' data-toggle="modal" >
                            <i class="fa fa-trash-o "></i>
                           </a>
                          </td>
                        </tr>';

                    }

                   }

                  ?>

                 





<!-- Add user -->
               <!--Modal-->
  <div class="modal fade" id="add_form">
    <div class="modal-dialog">
     <form class="no-margin" action="<?php echo base_url(); ?>User_list/add" method="post" enctype="multipart/form-data">
      <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title text-center">Add New User</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
           <label class="control-label">User Name</label>
            <input type="text" placeholder="User name"  required class="form-control" name="username">
          </div>
          <div class="form-group">
           <label class="control-label">Email</label>
           <input type="email" placeholder="Email" required class="form-control input-sm parsley-validated "  name="email">
          </div>
         <div class="form-group">
          <label class="control-label">Password</label>
          <input type="password" placeholder="password" value="" required class="form-control input-sm parsley-validated "  name="password">
         </div>
         <div class="form-group">
         <label for="ccnumber">Profile Image</label>
          <br>
           <input type="file" class="form-control" name="profileimage[]"  placeholder="Profile Image" accept="Image/*">
         </div>
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-danger btn-sm check">Submit</button>
         <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
         </div>
        </div>
      <!-- /.modal-content -->
       </form>
      </div>
   <!-- /.modal-dialog -->
    </div>

<!--end add user -->

               <!--Modal-->
  <div class="modal fade" id="edit_form">
    <div class="modal-dialog">
     <form class="no-margin" id="editform">
      <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title text-center">Edit User</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
           <label class="control-label">User Name</label>
            <input type="text" placeholder="User name" id="edituser"  required class="form-control" name="user_name">
           <input type="hidden" placeholder="Keyword name" id="editid" required class="form-control input-sm parsley-validated "  name="id">
           <input type="hidden" placeholder="Keyword name" id="editemail"  required class="form-control input-sm parsley-validated editemail"  name="email_old">
          </div>
          <div class="form-group">
           <label class="control-label">email</label>
           <input type="email" placeholder="Email" value="" required class="form-control input-sm parsley-validated  editemail"  name="email">
          </div>
         <div class="form-group">
          <label class="control-label">Password</label>
          <input type="password" value="**************************" id="editpass" onclick="clear()" class="form-control input-sm parsley-validated " name="password">
         </div>
         <div class="form-group">
         <label for="ccnumber">Profile Image</label>
          <br>
           <input type="file" class="form-control" id="editimg"  name="profileimage[]"  placeholder="Profile Image" accept="Image/*">
         </div>
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-danger btn-sm check">Submit</button>
         <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
         </div>
        </div>
      <!-- /.modal-content -->
       </form>
      </div>
   <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->
   <!--Modal-->
 <!--Modal-->







  <div class="modal fade" id="delete">







    <div class="modal-dialog">







                      <form action="User_list/delete" method="post">



<input type="hidden" name="id" id="deleteid">











      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Remove this User?</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">







            <div class="form-group" style="text-align: center;">







              <label for="folderName">Are you sure you want to remove this User? This action can't be undone.</label>







            </div>







        </div>















        <div style="text-align:center;" class="modal-footer">







                  <button type="submit" class="btn btn-danger btn-sm">Confirm</button>















          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>







          </div>







      </div>







      <!-- /.modal-content -->







                        </form>







    </div>







    <!-- /.modal-dialog -->







  </div>







  <!-- /.modal -->







          













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



      <form class="no-margin"  method="post" onSubmit="return Validate()" id="example"  action="get_user1.php" name="client_record" enctype="multipart/form-data" >







      <div class="modal-content">



      



        <!-- Modal Header -->



        <div class="modal-header">



          <h4 class="modal-title text-center">New User</h4>



          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>



        



        <!-- Modal body -->



        <div class="modal-body">



         <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">



                        <label for="name">User Name</label>



                        <input type="text" class="form-control" placeholder="User Name" name="user_name">



                      </div>







                    </div>







                  </div>







                  <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">



                        <label for="ccnumber">Email</label>



                        <br>



                       <input type="email" class="form-control" name="email" placeholder="example@email.com">



                      </div>







                    </div>







                  </div>



                  <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">



                        <label for="ccnumber">Password</label>



                        <br>



                       <input type="password" class="form-control"   name="password" id="pass1" placeholder="password">



                      </div>







                    </div>







                  </div>



                  <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">



                       <label for="ccnumber">Confirm Password</label>



                        <br>



                       <input type="password" class="form-control"   name="password" id="pass2"  placeholder="confirm password">



                      </div>







                    </div>







                  </div>



                  <div class="row">







                    <div class="col-sm-12">







                      <div class="form-group">



                         <label for="ccnumber">Profile Image</label>



                        <br>



                       <input type="file" class="form-control" id="profile_image" name="profileimage" placeholder="Profile Image">



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



  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>



<script type="text/javascript">

    function Validate() {

        var password = document.getElementById("pass1").value;

        var confirmPassword = document.getElementById("pass2").value;

        if (password != confirmPassword) {

            alert("Passwords do not match.");

            return false;

        }

        return true;

    }

</script>

<script type="text/javascript">

  $('.edit').click(function(){

    var id = $(this).attr('data-id');

    $('#editid').val(id);

    var user = $(this).attr('data-user');

    $('#edituser').val(user);

    var email = $(this).attr('data-email');

    $('.editemail').val(email);



    var img = $(this).attr('data-pic');

    $('#editimg').val(img);





  });

</script>

<script type="text/javascript">

  $('#editform').submit(function(evt){

    evt.preventDefault();

    var form = new FormData(this);

      

      $.ajax({
                type : 'ajax',
                method : 'post',
                data : form,
                dataType : 'json',
                url : '<?php echo base_url() ?>User_list/edit',
                enctype : 'multiple/form-data',
                cache : false,
                contentType : false,
                processData : false,
                success:function(r){
                console.log(r);
                if (r=='updated') {
                location.reload();
                 }
                else if (r=='already') {
                toastr.warning('This email is already in added','Already');
                  }
                else{
                 toastr.error('not updated','Failed');
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

      $('#deleteid').val(id);

  });

</script>



<script type="text/javascript">

  <?php if (isset($_SESSION['true'])&&$_SESSION['true']=="200") {?>
    toastr.success('Account deleted');
  <?php unset($_SESSION['true']); } if (isset($_SESSION['true'])&&$_SESSION['true']=="199" ) {?>

    toastr.error('Account could not delete','Failed');

    <?php unset($_SESSION['true']);} if(isset($_SESSION['user_updated'])){?>

      toastr.success('<?php echo $_SESSION['user_updated']; ?>');

      <?php unset($_SESSION['user_updated']);} if(isset($_SESSION['added'])){?>

      toastr.success('<?php echo $_SESSION['added']; ?>');

      <?php unset($_SESSION['added']);} if(isset($_SESSION['already'])){?>

      toastr.success('<?php echo $_SESSION['already']; ?>');

      <?php unset($_SESSION['already']);} ?>
</script>





