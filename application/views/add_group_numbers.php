<?php include_once('header.php') ?>
    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Groups</li>

      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-people"></i> Groups

              <div class="card-actions">

                

              </div>

            </div>



            <div class="card-body">

              <div class="row">



            <div class="col-lg-12"> 

              <div class="add-btn-group-padding">

              <button type="button" class="btn btn-primary btninp btn-md"  data-toggle="modal" data-target="#form"><i class="fa fa-plus fa-sm"></i> Add Group</button>

			  

              </div>

            </div>

            </div>

              <table class="table table-striped table-bordered datatable table-responsive-add" id="dataTable">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>Group Name</th>

                    <th>Action</th>

                   

                  </tr>

                </thead>

                <tbody>

                  <?php

                  if ($getgroup=='No') {

                    echo '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">No data available in table</td></tr>';

                  }

                  else{



                    for ($i=0; $i <sizeof($getgroup) ; $i++) { 

                      $d = $i+1;

                      echo '<tr '.$getgroup[$i]['id'].'>

                              <td>'.$d.'</td>

                              <td><b><a href="#" class="name" data-id = "'.$getgroup[$i]['id'].'">'.$getgroup[$i]['name'].'</a></b></td>

                              <td><a href="#" class="btn btn-info edit" onclick="editfun(`'.$getgroup[$i]['id'].'`,`'.$getgroup[$i]['name'].'`)"><i class="fa fa-edit"> </i></a><a href="#" class=" btn  btn-danger delete" data-id="'.$getgroup[$i]['id'].'"><i class="fa fa-trash-o "></i></a></td>





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

      <!-- .container-fluid -->

    </main>



    



  </div>


<!-- edit model -->
  <div class="modal fade" id="editform">
    <div class="modal-dialog">
    <form  method="post" onSubmit="return validation1()"  action="Add_group_numbers/edit_group" name="client_record" id="example" enctype="multipart/form-data">
     <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center">Edit Group Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
         <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="name">Group Name</label>
              <input type="hidden" name="id" id="edit_id">
              <input type="text" class="form-control" id="edit_name" name="group_name" placeholder="Enter Group Name" required>
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
<!-- edit model -->

  <div class="modal fade" id="form">

    <div class="modal-dialog">

<form  method="post" onSubmit="return validation1()"  action="Add_group_numbers/getgroup" name="client_record" id="example" enctype="multipart/form-data">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title text-center">New Group</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

         <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="name">Group Name</label>

                        <input type="text" class="form-control" id="name" name="group_name" placeholder="Enter Group Name" required>

                      </div>



                    </div>



                  </div>



<!--                   <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="ccnumber">Number</label>

                        <br>

                       <input type="file" id="upload-demo" name="file" required >

                      </div>



                    </div>



                  </div> -->

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



  <script type="text/javascript">

    

    function validation1() {



    var a = document.getElementById("twilio_num1").value;



//alert(a);



    if (a.length > 11 || a.length < 11) {



        alert("Number length must be 11");



        return false;



    }



}



  </script>


<?php include_once('footer.php') ?>



<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

  $('.name').click(function(){

      var id = $(this).attr('data-id');

      

      $.ajax({

                type : 'ajax',

                method : 'post',

                dataType : 'json',

                url : '<?php echo base_url(); ?>Add_group_numbers/getid/'+id,

                success:function(r){

                  console.log(r);

                  location.href = '<?php echo base_url();?>Group_Numbers';

                },

                error:function(xhr,status,error){

                  console.log(xhr.responseText);

                }

      });

  });

</script>



<script type="text/javascript">

  $(".delete").click(function(){

    var id = $(this).attr('data-id');

    $msg = confirm('Are you sure??');

    if ($msg==true) {

      $.ajax({

        type : 'ajax',

        method : 'post',

        dataType : 'json',

        url : '<?php echo base_url(); ?>Add_group_numbers/delete_group/'+id,

        success:function(r){

          console.log(r);

          if (r=='deleted') {



            location.reload();

          }

          else{

            toastr.error('Not deleted','failed');

          }

        },

        error:function(xhr,status,error){

          console.log(xhr.responseText);

        }



      });

    }

  });

</script>

<script type="text/javascript">

 <?php if (isset($_SESSION['add_group'])&& $_SESSION['add_group']=='1') {?>

  toastr.success('New group added successfully');

  <?php unset($_SESSION['add_group']);}if (isset($_SESSION['add_group'])&& $_SESSION['add_group']=='0') {?>

  toastr.warning('This name is already added');

  <?php unset($_SESSION['add_group']);}if (isset($_SESSION['add_group'])&& $_SESSION['add_group']=='2') {?>

  toastr.error("Sorry this group can't added");

  <?php unset($_SESSION['add_group']);}

  if (isset($_SESSION['group_del'])&& $_SESSION['group_del']=='1') {?>
      toastr.success('Group deleted successfully','Deleted');
  <?php unset($_SESSION['group_del']);} unset($_SESSION['group_id']);
      if (isset($_SESSION['already'])) {?>
      toastr.warning('<?php echo $_SESSION['already']; ?>');
  <?php unset($_SESSION['already']); } if (isset($_SESSION['edit'])) { ?>
      toastr.success('<?php echo $_SESSION['edit']; ?>');
  <?php unset($_SESSION['edit']); } ?>

</script>
<script type="text/javascript">
  function editfun(id,name){
    $('#edit_name').val(name);
    $('#edit_id').val(id);
    $('#editform').modal('show');

  }
</script>