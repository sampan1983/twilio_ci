<?php include_once('header.php') ?>
    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active">Blacklist</li>

      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-people"></i> Blacklist

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <!--small class="text-muted">docs</small-->

                </a>

              </div>

            </div>



            <div class="card-body">

              <div class="row">



            <div class="col-lg-12"> 

              <div class="add-btn-group-padding">

              <button type="button" class="btn btn-primary btninp btn-md"  data-toggle="modal" data-target="#form"><i class="fa fa-plus fa-sm"></i> Add Number</button>

			 

              </div>

            </div>

            </div>

              <table class="table table-striped table-bordered datatable table-responsive-add" id="dataTable">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>Number</th>

                    <th>Action</th>

                   

                  </tr>

                </thead>

                <tbody>

                  <?php

                  if ($BlackListData=='No') {

                    echo '<tr><td valign="top" colspan="3" class="dataTables_empty">No data available in table</td></tr>';

                  }

                  else{

                  for ($i=0; $i <sizeof($BlackListData) ; $i++) { 

                    $d = $i+1;

                    echo '<tr '.$BlackListData[$i]['id'].'>



                          <td>'.$d.'</td>

                          <td><b>'.$BlackListData[$i]['number'].'</b></td>

                          <td><a href="#" class = "btn btn-danger delete" onclick = "myfun('.$BlackListData[$i]['id'].')">Delete </a></td>





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











  





  <div class="modal fade" id="form">

    <div class="modal-dialog">

<form  method="post" name="" id="blacklist_form" enctype="multipart/form-data">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title text-center">Add Number</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

         <div class="row">



                    <div class="col-sm-12">



                      <div class="form-group">

                        <label for="name">Number</label>

                        <input type="text" class="form-control" id="name" name="number" placeholder="Enter Number">

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



<?php include_once('footer.php') ?>  <!-- Plugins and scripts required by this views -->





<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

  $('#blacklist_form').submit(function(evt){

    evt.preventDefault();

    var form = $(this).serialize();

    $.ajax({

              type : 'ajax',

              method : 'post',

              data : form,

              dataType : 'json',

              url : '<?php echo base_url(); ?>Blacklist_numbers/addnum',

              success:function(r){

                  

                  location.reload();

                

              },

              error:function(xhr,status,error){

                console.log(xhr.responseText);

              }

    });

  });

</script>



<script type="text/javascript">

  function myfun(p){

  var msg = confirm('Are you sure??');

  var i = p;



  if (msg==true) {

    $.ajax({

              type : 'ajax',

              method : 'post',

              dataType : 'json',

              url : '<?php echo base_url(); ?>Blacklist_numbers/delete_blacklist/'+i,

              success:function(r){

                console.log(r);

                if (r=='delete') {



                  location.reload();

                }

                else{

                  toastr.error('Failed');

                }

              },

              error:function(xhr,status,error){

                console.log(xhr.responseText);

              }

    });

  }



  }

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['blacklist_added'])){?>

    toastr.success('<?php echo $_SESSION['blacklist_added']; ?>');

    <?php unset($_SESSION['blacklist_added']);} if (isset($_SESSION['delete_blacklist'])){?>

    toastr.success('<?php echo $_SESSION['delete_blacklist']; ?>');

    <?php unset($_SESSION['delete_blacklist']);} if (isset($_SESSION['blacklist_already'])){?>

    toastr.warning('<?php echo $_SESSION['blacklist_already']; ?>');

    <?php unset($_SESSION['blacklist_already']);}?>

</script>