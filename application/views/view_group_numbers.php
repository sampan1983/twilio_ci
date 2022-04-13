<?php include_once('header.php') ?>    
<main class="main">
      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->
        <li class="breadcrumb-item active">Group Numbers</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
              <i class="icon-people"></i> Group Numbers
              <div class="card-actions">
                <a href="https://datatables.net/">
                  <small class="text-muted"></small>
                </a>
              </div>
            </div>
            <div class="card-body">

              <div class="row">



            <div class="col-md-8"> 

               <div class="add-btn-group-padding">

              <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#form"><i class="fa fa-plus fa-sm"></i> Add Number</button>

        <a href="<?php echo base_url(); ?>sample.xlsx" download class="btn btn-primary btn-md"  ><i class="fa fa-plus fa-sm"></i> Download Sample</a>

              </div>

            </div>
             <div class="col-md-4" >



<a href="View_group_number/export/<?php if($group_data=='No'){ echo""; }else{  echo $group_data[0]['fk_group_data']; }?>"><button type="button" value="Export Data" class="btn btn-primary btn-md btn-sty" style="float:right"> Export Data</button></a>
  




                  </div>

            </div>

              <table class="table table-striped table-bordered datatable table-responsive-add" id="dataTable">

                <thead>

                  <tr>

                    <th>S.No.</th>

                    <th>Group</th>

                    <th>Number</th>
                    <th>Date</th>

                    <th>Remove</th> 

                  </tr>

                </thead>

                <tbody>





                  <?php

                  if ($group_data=='No') {

                  echo  '<tr><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';

                  }

                  else{



                    for ($i=0; $i <sizeof($group_data) ; $i++) { 

                      $d=$i+1;

                      echo "<tr ".$group_data[$i]['id'].">

                            <td>".$d."</td>

                          <td>".$group_data[$i]['group_name']."</td>

                            <td>".$group_data[$i]['number']."</td>

                            <td>".$group_data[$i]['date_time']."</td>

                            <td><a href = '#' class='btn btn-danger delete'  data-id='".$group_data[$i]['id']."'><i class='fa fa-trash-o ''></i></a></td>

                      </tr>";

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



<?php include_once('footer.php') ?>
<!--Add group data Model-->

  <div class="modal fade" id="form">

    <div class="modal-dialog">

      <!--in form "onSubmit="return validation1()""  -->

<form  method="post"  action="View_group_number/getgroup/" name="client_record" id="example" enctype="multipart/form-data">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title text-center">Add Group Number</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

<!--          <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="name">Group Name</label>

                        <input type="text" class="form-control" id="name" name="group_name" placeholder="Enter Group Name" required>

                      </div>



                    </div>



                  </div> -->



                  <div class="row">



                    <div class="col-sm-12">

                      <input type="hidden" name="fk_group_data" value="<?php echo $_SESSION['group_id']; ?>">

                      <div class="form-group">

<!--                         <label for="ccnumber">Number</label> -->

                        <br>

                       <input type="file" id="upload-demo" name="file" required accept=".xlsx,.csv" >

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

  <!--close -->



<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

  <?php if (isset($_SESSION['group'])&& $_SESSION['group']=='0') {?>

    toastr.success('Number added successfully');

    <?php unset($_SESSION['group']);} if (isset($_SESSION['group'])&& $_SESSION['group']=='1') {?>

      toastr.error('Sorry there is an error in file data');

      <?php unset($_SESSION['group']); }



       if (isset($_SESSION['group_data_already'])) {?>

        toastr.error('This number is already added in this group');

        <?php unset($_SESSION['group_data_already']); } ?>





</script>

<script type="text/javascript">

  $('.delete').click(function(){

      var id = $(this).attr('data-id');

      $msg = confirm('Are you sure???');

      if ($msg==true) {

        $.ajax({

                type : 'ajax',

                method : 'post',

                dataType : 'json',

                url : '<?php echo base_url(); ?>View_group_number/delete/'+id,

                success:function(r){



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

  <?php if (isset($_SESSION['groupdatadelete'])) {?>

    toastr.success('<?php echo $_SESSION['groupdatadelete'];?>','Removed');

    <?php unset($_SESSION['groupdatadelete']);} if (isset($_SESSION['groupdatadelete_fail'])) {?>

      toastr.error("<?php echo $_SESSION['groupdatadelete_fail'];?>",'Failed');

      <?php unset($_SESSION['groupdatadelete_fail']); } ?>

</script>