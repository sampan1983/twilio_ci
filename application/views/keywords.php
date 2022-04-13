 <?php include_once('header.php') ?>
    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item"><a href="#">Admin</a></li>

        <li class="breadcrumb-item active">Autoresponder Keywords</li>

        <!-- Breadcrumb Menu-->

        <!-- <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <a class="btn" href="#"><i class="icon-speech"></i></a>

            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Unsubscription Keywords</a>

            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>

          </div>

        </li> -->

      </ol>



      <div class="container-fluid">



        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-people"></i> Autoresponder Keywords

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

              <button type="button" class="btn btn-primary btninp" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-sm"></i>&nbsp;New Keywords</button>

              </div>

            </div>

            </div>



  <table class="table table-striped table-bordered datatable table-responsive-sm dataTable no-footer" id="dataTable" style="border-collapse: collapse !important">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>Keywords</th>

                    <th>Message</th>

                    <th>Action</th>

                    

                   

                  </tr>

                </thead>

                <tbody>

                  <?php

                  if ($data=='No') {

                    echo '<tr><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>';

                  }

                  else{

                    for ($i=0; $i <sizeof($data) ; $i++) { 

                      $d = $i+1;

                      echo '<tr>

                              <td>'.$d.'</td>

                              <td>'.$data[$i]['keyword'].'</td>

                              <td>'.$data[$i]['message'].'</td>

                              <td><a href="#" class = "btn btn-info edit" data-id='.$data[$i]['id'].' data-key = "'.$data[$i]['keyword'].'" data-msg = "'.$data[$i]['message'].'"><i class="fa fa-edit"></i></a>  <a href="#" data-id='.$data[$i]['id'].' class = "btn btn-danger delete" ><i class="fa fa-trash-o"></i></a></td>

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

  <!-- Edit model -->

                <div class="modal fade" id="edit_form">



    <div class="modal-dialog">



                  <form class="no-margin"  method="post" onSubmit="return myFunction()"  action="Keywords/edit" name="client_record" enctype="multipart/form-data" >

      <div class="modal-content">



        <div class="modal-header">

          <h4 class="modal-title text-center">Edit Keyword</h4>

          <button type="button" class="close" data-dismiss="modal">×</button>

        </div>



        <div class="modal-body">



            <div class="form-group">



             <label class="control-label">Keyword</label>



            <input type="text" placeholder="Keyword name" id="key" onBlur="keyword1(this.value)" required class="form-control input-sm parsley-validated "  name="keyword">



            <input type="hidden" placeholder="Keyword name" id="id" required class="form-control input-sm parsley-validated "  name="id">



            <span style="color:#FF0000;" id="show1"></span>



            </div>



            <div class="form-group">



            <label class="control-label">Message</label>



            <textarea class="form-control" rows="3" name="message" data-control="exname-control" maxlength="160" placeholder="Write your Message Here!" required id="msg"></textarea>



            You have <span class="add-on" id="exname-control"></span> characters left.



            </div>



           </div>



        <div class="modal-footer">



                  <button type="submit" class="btn btn-danger btn-sm check1">Submit</button>



          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>



          </div>



      </div>

                </form>



    </div>



  </div>

  <!--close -->



  <div class="modal fade" id="myModal">

    <div class="modal-dialog">

      <form class="no-margin"  method="post" onSubmit="return myFunction()" id="example"  action="Keywords/add" name="client_record" enctype="multipart/form-data" >

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title text-center">Keyword Information</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

         <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="name">Keyword</label>

                        <input type="text" class="form-control"  name="keyword" placeholder="Keyword Name">

                      </div>



                    </div>



                  </div>



                  <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="ccnumber">Message</label>

                        <br>

                      <textarea class="form-control" rows="3" name="message" id="examplename" data-control="exname-control" maxlength="160" placeholder="Write your Message Here!" required=""></textarea>

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

  $('.edit').click(function(){

    $('#edit_form').modal('show');

    var id = $(this).attr('data-id');

    $('#id').val(id);

    var key = $(this).attr('data-key');

    $('#key').val(key);

    var msg = $(this).attr('data-msg');

    $('#msg').val(msg);

  });

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['key']) && $_SESSION['key'] == '0') {?>



    toastr.success('Keyword updated');

<?php unset($_SESSION['key']);} if (isset($_SESSION['key']) && $_SESSION['key'] == '1') { ?>

   toastr.error('Keyword not updated');

<?php unset($_SESSION['key']);} ?>

</script>

<script type="text/javascript">

  $('.delete').click(function(){

    var id = $(this).attr('data-id');

    $msg = confirm('Are you sure??');

    if ($msg) {

      $.ajax({

              type : 'ajax',

              method : 'post',

              dataType : 'json',

              url : '<?php echo base_url(); ?>Keywords/delete/'+id,

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

    <?php if (isset($_SESSION['new_key']) && $_SESSION['new_key'] == '0') {?>



    toastr.success('New Keyword Added');

<?php unset($_SESSION['new_key']);} if (isset($_SESSION['new_key']) && $_SESSION['new_key'] == '1') { ?>

   toastr.error('This keyword is already exists','Failed');

<?php unset($_SESSION['new_key']);} ?>

</script>



<script type="text/javascript">

    <?php if (isset($_SESSION['keydel']) && $_SESSION['keydel'] == '0') {?>



    toastr.success('Keyword Deleted successfully');

<?php unset($_SESSION['keydel']);} if (isset($_SESSION['keydel']) && $_SESSION['keydel'] == '1') { ?>

   toastr.error('Keyword not delete','Failed');

<?php unset($_SESSION['keydel']);} ?>

</script>



