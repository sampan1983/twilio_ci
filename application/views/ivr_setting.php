<?php include_once('header.php') ?>
    <main class="main">

      <!-- Breadcrumb -->

      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->
        <li class="breadcrumb-item active"> IVR Setting</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
              <i class="icon-settings"></i> IVR Setting
              <div class="card-actions">      
              </div>

              <div class="modal fade" id="add_form">

    <div class="modal-dialog">

         <form class="no-margin" id="formValidate2" action="add_ivr" method="POST" enctype= "multipart/form-data"> 

      <div class="modal-content">


        <div class="modal-header">


          <h4 class="modal-title text-center">Add IVR Data</h4>

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>


        <div class="modal-body">

        <div class="form-group">

            <label class="control-label">User Input</label>

          <input type="text" placeholder="User Input" value="" required class="form-control "  name="title">

           </div>

		 <div class="form-group">

          <!-- <label class="control-label">Response Type</label>
          <select  required class="form-control" id="temp_type"  name="temp_type">
          <option value="" style="display:none">Select Response type</option>
          <option value="text">Text</option>
          <option value="voice">Audio</option>
          </select> -->

           </div>  

         
		   <div class="form-group" id="res_text" >

          <label class="control-label">Forward To</label>

          <!-- <textarea  placeholder="Enter Response of User Input " rows="5"  class="form-control"  name="message"></textarea> -->
         <input type="number" name="forward" class="form-control" required id="" >
      </div>
      <div class="form-group" style="display:none" id="res_file">

        <label class="control-label">Response File</label>

        <input type="file"  placeholder="Enter Response of User Input " class="form-control"  name="message_file" accept=".mp3"></textarea>

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
            </div>

            <div class="card-body">



         <div class="container">
<div class="form-group">
                   <div class="col-md-5">
                    <button type="button" class="btn btn-primary btninp"  data-toggle="modal" data-target="#add_form ">Add IVR DATA
                   </button>
                  </div>



                  </div>  
                    </div>
           <div style="overflow:auto">
           <table class="table table-striped table-bordered datatable table-responsive-sm">

            <thead>

              <tr>

                <th>ID</th>

                <th>User Input</th>

                <th>Forward To</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>
                  <?php
                  $d = 1;
                  if ($ivr_data=='No') {
                    echo '<tr><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>';
                  }
                  else{
                    for($i=0;$i<sizeof($ivr_data);$i++){
                      echo '<tr '.$ivr_data[$i]['id'].'>
                                <td>'.$d++.'</td>
                                <td>'.$ivr_data[$i]['user_input'].'</td>
                                <td>'.$ivr_data[$i]['response'].'</td>
                                <td><a href = "#" class="btn btn-info edit" data-id = '.$ivr_data[$i]['id'].' data-user_input = "'.$ivr_data[$i]['user_input'].'" data-response= "'.$ivr_data[$i]['response'].'" data-date_time = "'.$ivr_data[$i]['date_time'].'"><i class="fa fa-edit"></i></a><a href = "#" class="btn btn-danger delete" data-id = '.$ivr_data[$i]['id'].'><i class="fa fa-trash-o "></i></a></td>
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







    <!--  -->







  </div>

<?php include_once('footer.php') ?>



  <!-- Edit Modal -->



              <div class="modal fade" id="edit_form">







    <div class="modal-dialog">







                 <form class="no-margin" id="editform" enctype="multipart/form-data"> 



      

      <div class="modal-content">







        <div class="modal-header">


          <h4 class="modal-title text-center">Edit IVR DATA</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">





<div class="form-group">

            <label class="control-label">User Input</label>

          <input type="text" placeholder="Title" value="" id="edittitle" required class="form-control "  name="title">
          <input type="hidden" name="id" id="edit_id">
           </div>

           <!-- <div class="form-group">

<label class="control-label">Response Type</label>

<select  required class="form-control" id="temp_type1"  name="temp_type">

<option value="" style="display:none">Select Response type</option>
<option value="text">Text</option>
<option value="voice">Audio</option>

</select>

</div>   -->

<!-- 
<div class="form-group" id="res_text1" style="display:none">

<label class="control-label">Response</label>

<textarea  placeholder="Enter Response of User Input "  rows="5"  class="form-control"  name="message"></textarea>

</div>
<div class="form-group" style="display:none" id="res_file1">

<label class="control-label">Response File</label>

<input type="file"  placeholder="Enter Response of User Input " class="form-control"  name="message_file" accept=".mp3"></textarea>

</div> -->

       <!-- <div class="form-group">

            <label class="control-label">Response</label>

          <textarea  placeholder="Template Message" rows="5" id="editmsg" required class="form-control"  name="message"></textarea>

           </div> -->


           <div class="form-group" id="res_text" >

<label class="control-label">Forward To</label>

<!-- <textarea  placeholder="Enter Response of User Input " rows="5"  class="form-control"  name="message"></textarea> -->
<input type="number" name="response" class="form-control" required id="editmsg" >
</div>
           </div>


        <div class="modal-footer">


                  <button type="submit" id="editsub" class="btn btn-danger btn-sm check">Submit</button>



          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>



          </div>



      </div>







      <!-- /.modal-content -->







                </form>

    </div>

    <!-- /.modal-dialog -->

  </div>

            </div>





  <?php include_once('footer.php') ?>




<!-- Plugins and scripts required by this views -->



  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>







  <!-- Custom scripts required by this view -->



  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>


<script type="text/javascript">

  <?php if(isset($_SESSION['template_add'])){?>

    toastr.success('<?php echo $_SESSION['template_add']; ?>');

    <?php unset($_SESSION['template_add']);} 



    if(isset($_SESSION['template_add_fail'])){?>

    toastr.error('<?php echo $_SESSION['template_add_fail']; ?>');

    <?php unset($_SESSION['template_add_fail']);} 



    if(isset($_SESSION['edit_template'])){?>

    toastr.success('<?php echo $_SESSION['edit_template']; ?>');

    <?php unset($_SESSION['edit_template']);} 



    if(isset($_SESSION['delete_template'])){?>

    toastr.error('<?php echo $_SESSION['delete_template']; ?>');

    <?php unset($_SESSION['delete_template']);} ?>

</script>

<script type="text/javascript">

  $('.edit').click(function(){
    var id = $(this).attr('data-id');
    $('#edit_id').val(id);
    var title = $(this).attr('data-user_input');
    $('#edittitle').val(title);
    var msg = $(this).attr('data-response');
    $('#editmsg').val(msg);
    $('#edit_form').modal('show');
  });
    $('#editform').submit(function(evt){
    document.getElementById('editsub').disabled = true;
    evt.preventDefault();
    // var form = $(this).serialize();
    var form = new FormData(this);
    $.ajax({
            type : 'ajax',
          method : 'post',
            data : form,
        // dataType : 'json',
        contentType: false,
              processData: false,
             url : '<?php echo base_url(); ?>ivr_edit',
          success:function(r){
            console.log(r);
              if (r) {
                location.reload();
              }
              else if (r =='already') {
                toastr.warning('This Input is already added','Not Changed');
                location.reload();
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
    $ask = confirm('Arey you sure??');
    if ($ask) {
      $.ajax({
              data : {'id':id},
              type : 'ajax',
            method : 'post',
               url : '<?php echo base_url(); ?>ivr_delete',
            success:function(r){
              location.reload();
            },
            error:function(xhr,status,error){
              console.log(xhr.responseText);
            }
      });

    }



  });

$('#temp_type').change(function(){
  const type = $(this).val();
  if (type=='text') {
   $('#res_text').show();
   $('#res_file').hide(); 
  }
  else{
    $('#res_text').hide();
   $('#res_file').show(); 
  }
});

$('#temp_type1').change(function(){
  const type = $(this).val();
  if (type=='text') {
   $('#res_text1').show();
   $('#res_file1').hide(); 
  }
  else{
    $('#res_text1').hide();
   $('#res_file1').show(); 
  }
});

</script>
