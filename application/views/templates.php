<?php include_once('header.php') ?>
    <main class="main">

      <!-- Breadcrumb -->

      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->
        <li class="breadcrumb-item active"> Template</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
              <i class="icon-envelope-open"></i> Template
              <div class="card-actions">      
              </div>

              <div class="modal fade" id="add_form">

    <div class="modal-dialog">

         <form class="no-margin" id="formValidate2" > 

      <div class="modal-content">


        <div class="modal-header">


          <h4 class="modal-title text-center">Add Template</h4>

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>


        <div class="modal-body">





<div class="form-group">

            <label class="control-label">Title</label>

          <input type="text" placeholder="Title" value="" required class="form-control "  name="title">

           </div>

		 <div class="form-group">

            <label class="control-label">Type</label>

          <select  required class="form-control" id="temp_type"  name="temp_type">

          
<!--           <option value="">Select Template type</option> -->
          <option value="SMS">SMS</option>
          <!-- <option value="MMS">MMS</option> -->

          </select>

           </div>  

           <div class="form-group" id="addMMS"><input type="file" class="form-control" name="file[]" accept="image/*"  /></div>
		   

		   <div class="form-group">

            <label class="control-label">Message</label>

          <textarea  placeholder="Template Message" rows="5" required class="form-control"  name="message"></textarea>

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



                    <button type="button" class="btn btn-primary btninp"  data-toggle="modal" data-target="#add_form">Add New Template

               </button>
                  </div>



                  </div>  


</div>
<!-- <div class="row">



           



                <div class="col-sm-1 sent-message-form-column">



                    <a href="export_leads.php?year=&month="><button type="button" value="Export Data" class="btn btn-primary btn-md"> Export Data</button></a>



                  </div>



                  <br><br>



            



           </div>  --> 



           <div style="overflow:auto">



              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">



                <thead>



                  <tr>



                     <th>S.No.</th>



                    <th>Title</th>



                    



                    <th>Message</th>
                    <!-- <th>Image</th> -->

                    <th>Action</th>



                  </tr>



                </thead>



                <tbody>

                  <?php

                  

                   if ($template_data=='') {
                      $template_data = [];
                  }

             
                  if ($template_data=='No') {

                  echo '<tr><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>';


                  }

                  else{
                    
                    for($i=0;$i<sizeof($template_data);$i++){
                      $d = $i+1;
                      if ($template_data[$i]['media']!=null) {
                        $img = '<a href= '.$template_data[$i]['media'].' target=_blank>MMS</a>';
                      }
                      else{
                        $img = 'No MMS';
                      }
                      echo '<tr '.$template_data[$i]['id'].'>

                                <td>'.$d.'</td>

                                <td>'.$template_data[$i]['title'].'</td>

                                <td>'.$template_data[$i]['message'].'</td>
                           
                                <td><a href = "#" class="btn btn-info edit" data-id = '.$template_data[$i]['id'].' data-title = "'.$template_data[$i]['title'].'" data-temp= "'.$template_data[$i]['temp_type'].'" data-msg = "'.$template_data[$i]['message'].'"><i class="fa fa-edit"></i></a><a href = "#" class="btn btn-danger delete" data-id = '.$template_data[$i]['id'].'><i class="fa fa-trash-o "></i></a></td>

                              </tr>';

                    }

                  }



                  ?>



                   

                </tbody>



              </table>

</div>
     <!-- <td>'.$img.'</td> -->
           











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







                 <form class="no-margin" id="editform" > 



      

      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Edit Template</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">





<div class="form-group">

            <label class="control-label">Title</label>

          <input type="text" placeholder="Title" value="" id="edittitle" required class="form-control "  name="title">
          <input type="hidden" name="id" id="edit_id">
           </div>

     <div class="form-group">

            <label class="control-label">Type</label>

          <select  required class="form-control " id="edittemp_type"  name="temp_type">

          

          <option value="SMS">SMS</option>

          </select>

           </div>  

       

       <div class="form-group">

            <label class="control-label">Message</label>

          <textarea  placeholder="Template Message" rows="5" id="editmsg" required class="form-control"  name="message"></textarea>

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

  $('#formValidate2').submit(function(evt){

    evt.preventDefault();

    var form = new FormData(this);

    $.ajax({

              type : 'ajax',

              method : 'post',

              data : form,

              dataType : 'json',

              url : '<?php echo base_url(); ?>Templates/addtemplates',
              enctype : 'multiple/form-data',
              cache : false,
              contentType : false,
              processData : false,

              success:function(r){

                console.log(r);

                if (r==true) {

                  location.reload();

                }

                else{

                  toastr.error('This template is already added ','Already added');

                }

              },

              error:function(xhr,status,error){

                console.log(xhr.responseText);

              }

    });

  });

</script>

<script type="text/javascript">

  $('.edit').click(function(){

    var id = $(this).attr('data-id');
    $('#edit_id').val(id);
    var title = $(this).attr('data-title');

    $('#edittitle').val(title);

    var temp_type = $(this).attr('data-temp');

    $('#edittemp_type').val(temp_type);

    var msg = $(this).attr('data-msg');

    $('#editmsg').val(msg);

$('#edit_form').modal('show');

     $('#editform').submit(function(evt){
     document.getElementById('editsub').disabled = true;
      evt.preventDefault();

      var form = $(this).serialize();

      $.ajax({

            type : 'ajax',

            method : 'post',

            data : form,

            dataType : 'json',

            url : '<?php echo base_url(); ?>Templates/edittemplate',

            success:function(r){

              console.log(r);
              console.log('already');

              if (r==true) {
                location.reload();
              }
              else if (r =='already') {
                toastr.warning('This Template is already added','Not Changed');
                location.reload();
              }

            },

            error:function(xhr,status,error){

              console.log(xhr.responseText);

            }

      });



     });



  });

</script>

<script type="text/javascript">

  $('.delete').click(function(){

    var id = $(this).attr('data-id');

    $ask = confirm('Arey you sure??');

    if ($ask) {

      $.ajax({

              type : 'ajax',

              method : 'post',

              dataType : 'json',

              url : '<?php echo base_url(); ?>Templates/deletetemplate/'+id,

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
  type();
  function type(){
    $('#addMMS').hide();
  }
  $('#temp_type').change(function(){
    type = $(this).val();
    img = "";
    if (type == 'MMS') {
      img = '';
       $('#addMMS').show();
    }
    else{
       $('#addMMS').hide();
    }

  });
</script>
<!-- <script type="text/javascript">
  $('#').click(function(){

  }
</script> -->