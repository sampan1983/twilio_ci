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

        <li class="breadcrumb-item active"> Sent Mail</li>

        <!-- Breadcrumb Menu-->

     <!--    <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <a class="btn" href="#"><i class="icon-speech"></i></a>

            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Groups</a>

            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>

          </div>

        </li> -->

      </ol>



      <div class="container-fluid">



        <div class="animated fadeIn">

          <div class="card">

            <div class="card-header">

              <i class="icon-paper-plane"></i>  Sent Mail

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <!--small class="text-muted">docs</small-->

                </a>

              </div>

            </div>



            <div class="card-body">

                 

                 <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>Email</th>



                    <th>Message</th>



                    <th>Date</th>

                    <th>Delete</th>

                  </tr>

                </thead>

                <tbody id="sentdata">

                  <?php
                  // print_r($sent_mail);
                  if ($sent_mail=="No") {

                    echo '<td valign="top" colspan="5" class="dataTables_empty">No data available in table</td>';

                  }

                  else{



                  for ($i=0; $i <sizeof($sent_mail) ; $i++) { 



                      $d = $i+1;

                    echo '<tr '.$sent_mail[$i]['id'].'>

                              <td>'.$d.'</td>

                              <td>'.$sent_mail[$i]['email'].'</td>



                              <td><a href="javascript:void(0)" onclick="get_email('.$sent_mail[$i]['message'].')" >View Email</a></td>



                              <td>'.$sent_mail[$i]['date_time'].'</td>

                              <td><a href = "#" class = "btn btn-danger delete" data-id = "'.$sent_mail[$i]['id'].'" >Delete</a></td>

                    </tr>';

                  }

                }

                  ?>



                        </tbody>

                        <tbody id="searchdata">

                          

                        </tbody>

              </table>

                

            </div>

          </div>

        </div>



      </div>

      <!-- /.conainer-fluid -->

    </main>





  </div>

<?php include_once('footer.php')?>

  <!--show msg  -->



              <div class="modal fade" id="view_msgModal">
    <div class="modal-dialog" style="max-width: 1500px;">
<!-- 
                 <form class="no-margin" id="deletetable_form" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" >  -->

            <div class="modal-content">

        <div class="modal-header">

         <h4 class="modal-title text-center">Email</h4>

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>

                        <!-- Modal body -->
                        <div class="modal-body" id="setemail">
    
                        </div>


                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
      </div>
      <!-- /.modal-content -->
    </div>



  </div>

    <!-- /.show mail model -->

  <!--Delete contact table -->



              <div class="modal fade" id="delete_table_btnModal">







    <div class="modal-dialog">







                 <form class="no-margin" id="deletetable_form" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 



      

      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Remove Msg</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">



          <input type="hidden" name="id" id="deleteform_id">

<label class="text-center">Are you sure???</label>







        <div class="modal-footer">







                  <button type="submit" class="btn btn-danger btn-sm check">Yes</button>















          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">No</button>







          </div>



      </div>







      <!-- /.modal-content -->







                </form>















    </div>



  </div>

    <!-- /.show msg model -->




<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>
  <script type="text/javascript">
    function get_email(argument) {
      var id = argument;
      $.ajax({
          type : 'ajax',
          method : 'post',
          dataType : 'json',
          url : '<?php echo base_url(); ?>Sent_mail/get_email/'+id,
          success:function(r){
            
                      $("#setemail").html(r);
          $("#view_msgModal").modal('show');

          },
          error:function(xhr,status,error){
            console.log(xhr.responseText);
          }
      })
    }
    
  </script>
<script type="text/javascript">
  <?php if(isset($_SESSION['delete_mail']) && $_SESSION['delete_mail']=='1' ){?>
  toastr.success('Mail deleted successfully');
  <?php unset($_SESSION['delete_mail']);} if (isset($_SESSION['delete_mail']) && $_SESSION['delete_mail']=='0') {?>
    toastr.error('Sorry there is an error ','Failed');
    <? unset($_SESSION['delete_mail']);} ?>
</script>
<script type="text/javascript">
  $('.delete').click(function(){
    var id = $(this).attr('data-id');
    var msg = confirm('Are you sure??');
    if (msg) {
      location.href = 'sent_mail/delete/'+id;
    }
  });
</script>