<?php include_once('header.php') ?>
 <!-- Main content -->

 <script type="text/javascript"

      src="//static.twilio.com/libs/twiliojs/1.2/twilio.min.js"></script>


<head>

<style>
  .container {
    max-width: 100%;
    padding: 0px;
}

    #call_button { background-color: #0c8d43!important;

    border-color: #0c8d43!important;

    color: #fff!important;

    background: green!important;

    padding: 6px!important;

    margin-top: 0!important;

        font-size: 28px;

font-weight: 500;

    }



	.datatable{ border-collapse: collapse !important}

	 #hangup_button {   background-color: #0c8d43 !important;

    border-color: #e41010!important;

    color: #fff!important;

    background: #e41010!important;

    padding: 6px!important;

    margin-top: 0!important;

    font-size: 28px;

font-weight: 500;



}

button.call::before {

    background-position: 0 -48px;

    display: none;

}

button.hangup::before {

    background-position: 0 -131px;

    display: none;

}

body {

    text-align: left;

    background:none;

}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- <script>

		  $( document ).ready(function() {





var table = $('#dataTable').DataTable();



// Sort by columns 1 and 2 and redraw

table

    .order( [ 7, 'desc' ] )

    .draw();

 });

</script> -->

<!-- <script>

      $( document ).ready(function() {

var table = $('#dataTable').DataTable();

// Sort by columns 1 and 2 and redraw

table

    // .order( [ 7, 'desc' ] )

    .draw();

 });

</script> -->

<script type="text/javascript">
    $(function(){
  $('#dataTable').DataTable({
    // "scrollX":true
  });
  // $('.datatable').css({'border-collapse':'collapse !important'});
  $('.datatable').attr('style', 'border-collapse: collapse !important');
});
  </script>
    <main class="main">







      <!-- Breadcrumb -->



      <ol class="breadcrumb">



        <li class="breadcrumb-item">Home</li>



        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->



        <li class="breadcrumb-item active"> Contact</li>



      </ol>







      <div class="container-fluid">







        <div class="animated fadeIn">



          <div class="card">



            <div class="card-header">



              <i class="icon-envelope-open"></i> Contact



              <div class="card-actions">



             



              </div>





              <div class="modal fade" id="add_form">







    <div class="modal-dialog">







                 <form class="no-margin" id="formValidate2" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 



      

      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Add Contact</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">





<div class="form-group">

            <label class="control-label">Name</label>

          <input type="text" placeholder="Name" value="" required class="form-control "  name="first_name">

           </div>

		   

		   

		   <div class="form-group">

            <label class="control-label">Email</label>

          <input type="email" placeholder="Email" value=""  class="form-control  "  name="email">

           </div>

		   

		   

            <div class="form-group">







             <label class="control-label">Mobile Number</label>

           <input type="number" name="mobile" placeholder="Enter Mobile Number" value ="" class="form-control input-sm parsley-validated" required>

            </div>







            







        



           



            



            <div class="form-group">

            <label class="control-label">Address</label>

          <input type="text" placeholder="Address" value=""  class="form-control  "  name="address">

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

  

  

  

  

  

  <div class="modal fade" id="add_bulk">







    <div class="modal-dialog">







                 <form class="no-margin" id="formValidate" data-validate="parsley" method="post" action="Clients/import" name="client_record" enctype="multipart/form-data" >  



      

      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Imports Contact</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">







            <div class="form-group">







             <label class="control-label">Select File</label>







            <input type="file" name="file" class="form-control " accept=".xlsx,.txt,.csv" required>







            </div>







          







           



         



          



             



           











           </div>







        <div class="modal-footer">







                  <button type="submit" class="btn btn-danger btn-sm ">Submit</button>















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



         







<div class="row">



                  



                   



                   <div class="col-md-8">



                    <button type="button" class="btn btn-primary btn-sty"  data-toggle="modal" data-target="#add_form "><i class="fa fa-plus"></i> New Contact

               </button>

              <button type="button" class="btn btn-primary btn-sty"  data-toggle="modal" data-target="#add_bulk "><i class="fa fa-file-excel-o" aria-hidden="true"></i> Import excel

               </button>

			    <a href="<?php echo base_url(); ?>upload/sample_contact.xlsx" download type="button" class="btn btn-primary anbtnsty"  data-toggle="" data-target=""><i class="fa fa-file-excel-o" aria-hidden="true"></i>  Sample file

               </a>



                  </div>

 <div class="col-md-4" >



<a href="Clients/export"><button type="button" value="Export Data" class="btn btn-primary btn-md btn-sty" style="float:right"><i class="fa fa-file-excel-o" aria-hidden="true"></i>  Export Data</button></a>
  
<a href="#" class="btn btn-danger btn-md btn-sty" id="delete_select"  style="float:right; margin-right:5px;  "><i class="fa fa-trash-o"></i> Selected</a>



                  </div>

                  </div>  <br>

</div>



           <div style="overflow:auto">



<table class="table table-striped table-bordered datatable table-responsive-sm dataTable no-footer" id="dataTable" style="border-collapse: collapse !important">
                <thead>
                  <tr>
                   <th>Select All&nbsp;<input type="checkbox" name="contact[]" value="select_all_contact " id="select_all_contact" onclick="selector1234()" ></th>
                    <th>Type</th>
                    <th>Phone Number</th>
                    <th>Name</th>
                    <th>Date</th> 
                    <th>Time</th>
                    <th>Action</th>
                    <th>Action Result</th>
                    <th>Result Description</th>
                    <th>Duration</th>
                 </tr>
                </thead>
                <tbody>
                <?php 
                if ($data=='No') {
                  echo '<td valign="top" colspan="7" class="dataTables_empty">No data available in table</td>';
                }
                 else{
                   for ($i=0; $i < sizeof($data); $i++) { 
                    $data[$i]['name'] = str_replace("_", "'", $data[$i]['first_name']);
                            $add=str_replace("<", "(", $data[$i]['address']);
                            $add=str_replace(">", ")", $add);
                            $add=str_replace("_", "'", $add);
                            $address=str_replace('^', '"', $add); ?>

                     <tr>
                     <td><input type='checkbox' name='contact[]' id='con' class='checkboxes' onclick='select_single_contact(this)' value="<?php echo $data[$i]['id'] ?>" > </td>

                     <td><?php echo $data[$i]['type'] ?></td>

                     <td><?php echo $data[$i]['phone_number'] ?></td>

                     <td><?php echo $data[$i]['	name'] ?></td>

                     <td><?php echo $data[$i]['	date'] ?></td>
                     <td><?php echo $data[$i]['	time'] ?></td>
                     <td><?php echo $data[$i]['		action'] ?></td>

                     

                    <td><?php echo $data[$i]['action_result'] ?></td>
                    <td><?php echo $data[$i]['result description'] ?></td>
                    <td><?php echo $data[$i]['duration'] ?></td>

                    <td><a href = '#' class='btn btn-info edit' data-id = '<?php echo $data[$i]['id'] ?>' data-sender = '<?php echo $data[$i]['sender'] ?>' data-name = '<?php echo $data[$i]['first_name'] ?>' data-email = '<?php echo $data[$i]['email'] ?>' data-address = '<?php echo $data[$i]['address'] ?>'><i class = 'fa fa-edit'> </i></a><a href = '#' class='btn btn-danger delete' data-id = '<?php echo $data[$i]['id'] ?>' > <i class = 'fa fa-trash-o' > </i></a></td>
                     </tr>

<?php                   }

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



    <!--Delete select contact table -->



              <div class="modal fade" id="edit_contactModal">

    <div class="modal-dialog">


                 <form class="no-margin" id="editcontact_form" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 


      <div class="modal-content">

        <div class="modal-header">

          <h4 class="modal-title text-center">Edit Contact</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>



        <div class="modal-body">



          <input type="hidden" name="id" id="id">

<div class="form-group">

            <label class="control-label">Name</label>

          <input type="text" placeholder="Name" id="name" value="" required class="form-control "  name="first_name">

           </div>

       

       

       <div class="form-group">

            <label class="control-label">Email</label>

          <input type="email" placeholder="Email" id="email" value=""  class="form-control  "  name="email">

           </div>

       

       

            <div class="form-group">







             <label class="control-label">Mobile Number</label>

           <input type="number" name="mobile" id="mobile" placeholder="Enter Mobile Number" value ="" class="form-control input-sm parsley-validated" required>

            </div>





            <div class="form-group">

            <label class="control-label">Address</label>

          <input type="text" placeholder="Address" id="address" value=""  class="form-control  "  name="address">

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

  <!-- /.Edit model -->

  

   <!--Delete contact table -->

              <div class="modal fade" id="delete_table_btnModal">



    <div class="modal-dialog">



                 <form class="no-margin" id="deletetable_form" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 

      
      <div class="modal-content">



        <div class="modal-header">



          



          <h4 class="modal-title text-center">Remove this Contact</h4>

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>



        </div>







        <div class="modal-body">

          <input type="hidden" name="id" id="deleteform_id">
<label class="text-center">Are you sure you want to remove this Contact? This action can't be undone.</label>



        <div class="modal-footer">



                  <button type="submit" class="btn btn-danger btn-sm check">Yes</button>







          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">No</button>



          </div>

      </div>



      <!-- /.modal-content -->



                </form>







    </div>

  </div>
    <!-- /.Delete model -->


</form>
</div>
</div>
              <div class="modal fade" id="delete_select_btnModal">

    <div class="modal-dialog">
      <form class="no-margin" action="Clients/delete_s" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 

      <div class="modal-content">

        <div class="modal-header">

          <h4 class="modal-title text-center">Delete Selected Contact</h4>

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>

        <div class="modal-body">
<input type="hidden" name="select" id="deleteselect_id">

<label class="text-center">Are you sure you want to remove this Contact? This action can't be undone.</label>
          
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


            
    <!-- /.Delete model -->



<!-- Plugins and scripts required by this views -->



  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>



  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>







  <!-- Custom scripts required by this view -->



<!--   <script src="< ?php echo base_url(); ?>js/views/tables.js"></script> -->



<!--jQuery for add contact -->

<script type="text/javascript">

  $('#formValidate2').submit(function(evt){

    evt.preventDefault();

    var form = $(this).serialize();

    $.ajax({

            type : 'ajax',

            method : 'post',

            data : form,

            dataType : 'json',

            url : '<?php echo base_url(); ?>Clients/add',

            success:function(r){

                if (r=='already') {

              toastr.error('Sorry !!this email or mobile number is already added','Failed!!');

              console.log(r);

            }

            else if(r=='added'){

              location.reload();



            }

            else{

              console.log(r);

            }

            

            },

            error:function(xhr,status,error){

              console.log(xhr.responseText);

            }

    });

  });

</script>

<script type="text/javascript">

  //////edit btn of table

  $('.edit').click(function(){

    var id = $(this).attr('data-id');

    $('#id').val(id);

    var name = $(this).attr('data-name');
    name = name.replace("_","'");

    $('#name').val(name);



    var email = $(this).attr('data-email');

    $('#email').val(email);

    var mobile = $(this).attr('data-sender');

    $('#mobile').val(mobile);

    var address = $(this).attr('data-address');



add = address.replace("<","(");
add = add.replace(">",")");
add = add.replace("_","'");
address = add.replace('^','"');

    $('#address').val(address);



    $('#edit_contactModal').modal('show');//////edit model of contact

    $('#editcontact_form').submit(function(evt){

      evt.preventDefault();

      var form = $(this).serialize();

      $.ajax({

            type : 'ajax',

            method : 'post',

            data : form,

            dataType : 'json',

            url : '<?php echo base_url(); ?>Clients/edit',

            success:function(r){

              console.log(r);

              if (r=='already') {

                toastr.error('Sorry!! this data is already added','Failed!!');

                              

              }

              else if (r=='edited') {

                // toastr.success('Contact edited','Success');

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

  ///////////delete table data btn 

  $('.delete').click(function(){

    var id = $(this).attr('data-id');

    $('#deleteform_id').val(id);

    $('#delete_table_btnModal').modal('show');

    $('#deletetable_form').submit(function(evt){

        evt.preventDefault();

        var form = $(this).serialize();

        $.ajax({

          type : 'ajax',

          method : 'post',

          data : form,

          dataType : 'json',

          url : '<?php echo base_url(); ?>Clients/delete',

          success:function(r){

            

            if (r==true) {

              location.reload();

            }

            else{

              console.log(r);

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

  <?php if (isset($_SESSION['flash_message']) && $_SESSION['flash_message']=='0') { ?>

    toastr.success('Congrats! Clients imported successfully.');

    

 <?php unset($_SESSION['flash_message']); }  if (isset($_SESSION['fail_message']) && $_SESSION['fail_message']=='2') {?>

    toastr.warning('Invalid file format. Please select excel or csv file.'); 

    <?php unset($_SESSION['fail_message']); }?>



    <?php if (isset($_SESSION['add_client'])) {?>

        toastr.success('New contact added successfully','Added!!');

        <?php unset($_SESSION['add_client']);} if (isset($_SESSION['edit_client'])) {?>

          toastr.success('<?php echo $_SESSION['edit_client']; ?>','Updated!!');

          <?php unset($_SESSION['edit_client']); } if (isset($_SESSION['client_del'])) {?>

            toastr.success('<?php echo $_SESSION['client_del']; ?>','Deleted!!');

            <?php unset($_SESSION['client_del']);} if (isset($_SESSION['client_del_not'])) {?>

            toastr.error('<?php echo $_SESSION['client_del_not']; ?>','Failed!!');

            <?php unset($_SESSION['client_del_not']);} ?>





</script>
<script type="text/javascript">
  var arr = [];

   function select_single_contact(elem)
  
   {

   if(elem.checked == true) {
      arr.push(elem.value);      
     }

     else {

       document.getElementById("select_all_contact").checked = false;
       var uncheck = arr.indexOf(elem.value);
       if (uncheck>-1) {
arr.splice( arr.indexOf(elem.value), 1 );
       }
       }
       $('#deleteselect_id').val(arr);

       }



 function selector1234()

{

  var total_freelancer = $('input:checkbox.checkboxes').length;



var total_freelancer1 = $('input:checkbox.checkboxes');
console.log(total_freelancer1);
// console.log(total_freelancer1[i]);
var arry = [];
var i = 0;
for(i=0; i<total_freelancer;i++) { 
  if(document.getElementById("select_all_contact").checked == true) {
    total_freelancer1[i].checked = true;
    arry.push(total_freelancer1[i].value);
  }
  else {
     total_freelancer1[i].checked = false;
  }
}
console.log(arry);
       $('#deleteselect_id').val(arry);

   }
</script>
<script type="text/javascript">
$('#delete_select').click(function(){
  
  var select_val = $('#deleteselect_id').val();
  if (select_val.length==0) {
    toastr.warning('Please select a contact','Invalid Selection');
  }
  else{

$('#delete_select_btnModal').modal('show');

}
});
</script>








