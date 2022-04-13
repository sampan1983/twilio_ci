<?php include_once('header.php') ?>
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
        <li class="breadcrumb-item active"> Sent Messages</li>
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

              <i class="icon-paper-plane"></i>  Sent Messages

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <!--small class="text-muted">docs</small-->

                </a>

              </div>

            </div>



            <div class="card-body">
          <form class="row sent-message-form" id="searchform" method=post >
 
          <div class="col-sm-5">
          <!-- <a href="#" class="btn btn-danger btn-md btn-sty" onclick="delete_all('sent')"  style="float:right; margin-right:5px;  ">Delete All</a>
            <a href="#" class="btn btn-danger btn-md btn-sty" id="delete_select"  style="float:right; margin-right:5px;  ">Delete Selected</a> -->
          </div>
          <div class="col-sm-4">
           <input type=hidden name=num_msg value=submit>
           <input class="form-control input-sm inline-block " value="" id="msg_num" type="hidden" name="msg_num" size="4" placeholder="Search by number/message"></div>  

          <div class="col-sm-1">

            <input class="btn btn-primary btninp" type="hidden" value="Search">

          </div> 

              <div class="col-sm-1 sent-message-form-column">
<!-- 
          <a href="#" id="export" class="float-right btnsty2"><button type="button" value="Export Data" class="btn btn-primary anbtnsty"> Export Data</button></a> -->

          </div>

          </form>
            <div id="tb">
                 <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">

                <thead>
                  <tr>
                    <!-- <th>Select All&nbsp;<input type="checkbox" name="contact[]" value="select_all_contact " id="select_all_contact" onclick="selector1234()" ></th> -->
                    <th>ID</th>
                    <th>Number</th>
                    <th>Sender ID</th>
                    <th>Message</th>
                    <!-- <th>Media</th> -->
                    <th>Date </th>
                    <!-- <th>Status</th> -->
                  </tr>

                </thead>
                <tbody id="sentdata">
                  <?php
                  $i=1;
                 if(count($sent_msg)==0)
                 {?>

                  <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>

                 <?php }
                  foreach($sent_msg as $key)
                  { 
                 ?>
                    
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $key['sms_number']; ?></td>
                    <td><?php echo $key['twilio_num']; ?></td>
                    <td><?php echo $key['message']; ?></td>
                    <td><?php echo  Date('Y-m-d H:i:s',strtotime($key['date_time'])); ?></td>
                    <!-- <td><?php echo $key['status']; ?></td> -->
                  </tr>
                  <?php 
                  
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



      </div>

      <!-- /.conainer-fluid -->

    </main>





  </div>

<?php include_once('footer.php') ?>
  <!--Delete contact table -->

<!-- delete btn -->

  <div class="modal fade" id="delete_select_btnModal">
    <div class="modal-dialog">
      <form class="no-margin" action="Sent_messages/delete_s" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 
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


</div>
<!--   -->




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
</form>
</div>
</div>
    <!-- /.Delete model -->



<!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.dataTables.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/dataTables.bootstrap4.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

<script type="text/javascript">

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

            url : '<?php echo base_url(); ?>Sent_messages/deletedata',

            success:function(r){

              console.log(r);

              if (r) {

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

  $('.sent-message-form').submit(function(evt){

        evt.preventDefault();

        var form = $(this).serialize();

        $.ajax({

                type : 'ajax',

                method : 'post',

                data : form,

                dataType : 'json',

                url : '<?php echo base_url(); ?>Sent_messages/search',

                success:function(r){

                  console.log(r);

                  if (r !='No') {

                 var html = '<table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTables" style="border-collapse: collapse !important"><thead><tr><th>Select All&nbsp;<input type="checkbox" name="contact[]" value="select_all_contact " id="select_all_contact" onclick="selector1234()" ></th><th>ID</th><th>Number</th><th>Twilio Number</th><th>Message</th><th>Media</th><th>Date</th><th>Delete</th>         </tr></thead><tbody id="sentdata">';
                 for (var i = 0; i < r.length; i++) {
                  if (r[i].images=='null') {
                    var img = 'NO Media';
                  }
                  else{
                    var img = '<a href = "'+r[i].images+'" >View MMS</a>';
                  }
                  var d = i+1;
                   html += '<tr><td><input type="checkbox" name="contact[]" id="con" class="checkboxes" onclick="select_single_contact(this)" value="'+r[i].id+'" ></td><td>'+d+'</td><td>'+r[i].sms_number+'</td><td>'+r[i].twilio_num+'</td><td>'+r[i].message+'</td><td>'+img+'</td><td>'+r[i].date_time+'</td><td><a href = "#" class = "btn btn-danger deletesearch"  onclick="func('+r[i].id+')">Delete</a></td></tr>';
                 }
               }
               else{
                html = '<tr><td></td><td></td><td></td><td>No data available in table</td><td></td><td></td><td></td></tr>';
               }
                var tb = html+'</tbody></table>';
                 $('#tb').html(tb);
                 $('#dataTables').DataTable();
                 // $('#searchdata').show();

                 // $('#sentdata').hide();

              },

              error:function(xhr,status,error){

                console.log(xhr.responseText);

              }

        });

  });

</script>

<script type="text/javascript">

  tablebody();

  function tablebody(){

  $('#searchdata').hide();

   $('#sentdata').show();

 }

</script>

<script type="text/javascript">



  // $('.deletesearch').click(function(){

   function func(param) { 



    var id = param;

   $('#deleteform_id').val(id);

   $('#delete_table_btnModal').modal('show');

   $('#deletetable_form').submit(function(evt){

      evt.preventDefault();

      var form = $("#deletetable_form").serialize();

   

   

   $.ajax({

            type : 'ajax',

            method : 'post',

            data : form,

            dataType : 'json',

            url : '<?php echo base_url(); ?>Sent_messages/deletedata',

            success:function(r){

              console.log(r);

              

              location.reload();

            },

            error:function(xhr,status,error){

              console.log(xhr.responseText);

            }

   });

  });

 }

   // });



  // func();

</script>


<script type="text/javascript">

  $('#export').click(function(){

    var msg_num = $('#msg_num').val();

    location.href = '<?php echo base_url(); ?>Sent_messages/export/'+msg_num;

  });

</script>

<script type="text/javascript">

  <?php if (isset($_SESSION['sent_msg_delete'])) {?>

    toastr.success('<?php echo $_SESSION['sent_msg_delete']; ?>');

    <?php unset($_SESSION['sent_msg_delete']);} if (isset($_SESSION['sent_msg_delete_fail'])) {?>

      toastr.error('<?php echo $_SESSION['sent_msg_delete_fail']; ?>');

      <?php unset($_SESSION['sent_msg_delete_fail']);} if (isset($_SESSION['client_del'])) {?>

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
  else{
       document.getElementById("select_all_contact").checked = false;
       var uncheck = arr.indexOf(elem.value);
       if (uncheck>-1) {
       arr.splice( arr.indexOf(elem.value), 1 );
       }
      }
       $('#deleteselect_id').val(arr);
       }
 function selector1234(){
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