<?php include_once('header.php') ?>
<style>

table.table-bordered.dataTable th:last-child{
  width: 135.8438px;
  
}


.switch {
  position: relative;
  display: inline-block;
  width: 49px;
  height: 25px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 17px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #fabb3d;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
    <main class="main">
      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->
        <li class="breadcrumb-item active"> Reccuring SMS</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
              <i class="icon-envelope-open"></i> Reccuring SMS
              <div class="card-actions">      
              </div>
              <div class="modal fade" id="add_form">
                <div class="modal-dialog">
                  <form class="no-margin" action="add_recurring_data" method="POST" enctype="multipart/form-data" > 
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title text-center">Add Reccuring SMS</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">

            <label class="control-label"><b>Upload Recurring File </b> (<span> Date format should be in YYYY-MM-DD</span> )</label>
            <div>
            <!-- upload recurring   -->
            <div class="upload-file">
              <input style="cursor:pointer;" type="file" id="upload-demo" name="file" class="upload-demo" required accept=".xlsx,.csv,.txt">
              <a href="http://voicedrop.net/upload/sample_recurring.xlsx" download>
              <input type="button" class="btn btn-success" value="Download Sample"></a>
              <label data-title="Select file" for="upload-demo">
              <span data-title="No file selected..."></span>
              </label>
            </div>
            
            <!-- <input type="file" id="upload-demo" name="file" required accept=".xlsx,.csv" >             -->


            </div>
           </div>

           <div class="form-group">

            <label class="control-label"><b> Choose Numbers </b></label>

            <div class="controls">

              <div class="input-prepend input-group">
            <select name="msg_type" class="form-control" onChange="show(this.value);" required>
              <option  value="" style="display:none">Select</option>
              <option value="group">Group Number</option>
              <option value="file">Upload File</option>
              <option value="clients">Contacts</option>
            </select>
            <datalist id='listid'>
            </datalist>
            </div>
           </div>
           <div id="leads_wrap" style="display:none">
           <br>
          <label class="col-form-label" for="prependedInput">Select Leads</label><div class="form-control" style=" padding: 7px 7px 7px 17px;" onclick="showCheckboxes()">Select<img src="<?php echo base_url(); ?>dropdown.png" style="float:right;float: right;    height: 15px;    width: 6px;    margin-top: 4px;    "></div>

<div class="form-group" style="display:none;max-height:250px;overflow:auto" id="leads_holder">

<input type="checkbox" name="leads_name[]" value="select_all" id="select_all" onclick="selector123()">&nbsp;Select All<br>

</div></div>











<div id="clients_wrap" style="display:none">
<br>
<label class="col-form-label" for="prependedInput">Select Contacts</label><div class="form-control" style=" padding: 7px 7px 7px 17px;" onclick="showCheckboxes_clients()">Select<img src="<?php echo base_url(); ?>dropdown.png" style="float:right;float: right;    height: 15px;    width: 6px;    margin-top: 4px;    "></div>

<div class="form-group" style="display:none;max-height:250px;overflow:auto" id="clients_holder">

<input type="checkbox" name="clients_name[]" value="select_all_clients" id="select_all_clients" onclick="selector1234()" >&nbsp;Select All<br>

<?php

if ($clientdata =='No') {

  echo "";

}

else{

for($i = 0; $i<sizeof($clientdata); $i++){

 echo '<input type="checkbox" name="clients_name[]" class="checkboxes" onclick="single_select_clients(this)" value="'.$clientdata[$i]['sender'].'">&nbsp;'.$clientdata[$i]['first_name'].'  '.$clientdata[$i]['last_name'].' - '.$clientdata[$i]['sender'].'<br>';

 

}

}

?>

</div></div>



           <div class="row" id="first_box" style=" display:none;">



  <div class="col-md-12">

<br>

<div class="form-group">



<label class="control-label">Select a Group</label>



<select name="group_name"  class="form-control ">



<option value="" style="display:none">Select</option>

<?php

if ($getgroup=='No') {

echo "";

}

else{

for($i=0;$i<sizeof($getgroup);$i++){

echo '<option value="'.$getgroup[$i]['id'].'">'.$getgroup[$i]['name'].'</option>';

}

}

?>





</select>



</div>



</div>







</div>











<div class="row" id="second_box" style=" display:none;">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">Upload File</label>
        <div class="upload-file">
          <input style="cursor:pointer;" type="file" id="upload-demo" name="filex" class="upload-demo" accept=".xlsx,.csv,.txt">
          <a href="<?php echo base_url(); ?>upload/sample_bulk.xlsx"><input type="button" class="btn btn-success" value="Download Sample"/></a>
          <label data-title="Select file" for="upload-demo">
            <span data-title="No file selected..."></span>
          </label>
        </div>
        <input type="hidden" id="dtp_input1" value="" /><br/>
      </div>
    </div>
</div>

  <div >
    <!-- Template Message -->
    
<div class="form-group emoji-contant-align">
<label class="col-form-label" for="appendedPrependedInput">Message</label>
<div class="controls">
  <div class="input-prepend input-group">
   <select class="form-control" name="message_type" onchange="change_message_type(this.value)" >
    <option value="custom">Custom message</option>
    <option value="template">Template message</option>
  </select>
  </div>
</div>
</div>
<div class="form-group emoji-contant-align" id="custome_messgae">
<label class="col-form-label" for="appendedPrependedInput">Message</label>
<div class="controls">
  <div class="input-prepend input-group">
   <textarea id="examplename" name="mymessage" data-control="exname-control" rows="9" class="form-control" placeholder="Write your Message Here!"></textarea>
  </div>
</div>
</div>
<div id="template_message" style="display:none">
<div class="form-group emoji-contant-align" id="template_message">
<label class="col-form-label" for="appendedPrependedInput">Select Template</label>
<div class="controls">
 <select class="form-control" name="select_template" id="temp1"  >
  <option value="custom">Select</option>
<?php 

if ($tapp_template_msg=="") {

echo "";

}

else{

for($i=0;$i<sizeof($tapp_template_msg);$i++)

{

echo '<option value = '.$tapp_template_msg[$i]['id'].'>'.$tapp_template_msg[$i]['title'].'</option>';

} 

}

?>
   </select>
</div>
</div>
<div class="form-group" id="tmp_img"><input type="hidden" name=tmp_img ></div>
<div class="form-group emoji-contant-align" id="showtemplate">
<label class="col-form-label" for="appendedPrependedInput">Message</label>
<div class="controls">
  <div class="input-prepend input-group">
   <textarea name="message" id="temptext" data-control="exname-control" rows="9" class="form-control" placeholder="Write your Message Here!" value = ""  ></textarea>
  </div>
</div>
</div>
</div>
    <!-- Template message end -->
      Note :  Add <b>{{KEYWORD}}</b> in the place where you want your keyword in message. <br>
      Add <b>{{DATE}}</b> in the place where you want date in message. <br>
      Add <b>{{DAY OF WEEK}}</b> in the place where you want day of week message.
    </div>

  <!-- model body close -->
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
            <button type="button" class="btn btn-primary btninp"  data-toggle="modal" data-target="#add_form ">Add Reccuring SMS
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
                    <th>Message</th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
               </thead>
                <tbody>
                  <?php
                  $d = 1;
                  if ($recurr_data->num_rows()>0) {

                    $fields = $this->db->field_data('recurring_msg');
                    foreach($recurr_data->result() as $row){   ?>
                    <tr>
                      <td><?php echo $d++; ?></td>
                      <td><?php echo $row->message ?></td>
                      <td><?php echo $row->number ?></td>
                      <td><?php echo Date('d/m/Y',strtotime($row->sended_on)) ?></td>
                      <td><?php echo $row->status ?></td>
                      <td>
                        <label class="switch">
                          <input type="checkbox" class="stop" <?php if ($row->status=='Active') {
                            echo 'checked';
                          } ?> data-id = "<?php echo $row->id ?>">
                          <span class="slider round"></span>
                        </label>
                      <!-- <a href = "#" class="btn btn-warning stop" data-id = "<?php echo $row->id ?>" ><i class="fa fa-times"></i></a> -->
                        <a href = "#" class="btn btn-info edit" data-id = "<?php echo $row->id ?>" data-number = "<?php echo $row->number ?>" data-sended_on= "<?php echo Date('Y-m-d',strtotime($row->sended_on)); ?>" data-message = "<?php echo $row->message ?>"><i class="fa fa-edit"></i></a>
                        <a href = "#" class="btn btn-danger delete" data-id = "<?php echo $row->id ?>"><i class="fa fa-trash-o "></i></a>
                      </td>
                    </tr>
                    <?php } } ?>
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







                 <form class="no-margin" id="editform" > 



      

      <div class="modal-content">







        <div class="modal-header">







          







          <h4 class="modal-title text-center">Edit Reccuring SMS</h4>



          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







        </div>















        <div class="modal-body">





<div class="form-group">

            <label class="control-label">Date</label>

          <input type="date" placeholder="Enter Date" value="" id="editdate" required class="form-control "  name="date">
          <input type="hidden" name="id" id="edit_id">
           </div>

     <div class="form-group">

            <label class="control-label">Message</label>

          <input type="text"  required class="form-control " id="editmsg"  name="msg">

           </div>  

       

       <div class="form-group">

            <label class="control-label">Numbers</label>

          <textarea  placeholder="Numbers" rows="5" id="editnum" required class="form-control"  name="numbers"></textarea>
                    <span>Use comma (,) as delimeter for saperate numbers</span>
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
function change_message_type(elem){
  if(elem == 'custom'){
    document.getElementById('custome_messgae').style.display='block';
    document.getElementById('template_message').style.display='none';
  }
  if(elem == 'template'){
    document.getElementById('custome_messgae').style.display='none';
    document.getElementById('template_message').style.display='block';
  }
}

$('#temp1').change(function(){
   var id = $(this).val();
   $.ajax({
            type : 'ajax',
            method : 'post',
            dataType : 'json',
            url : '<?php echo base_url(); ?>Bulk_sms/getdatamsg/'+id,
            success:function(r){
              console.log(r);
              console.log(r[0].media+'in');
              if (r==null) {
                html = r;
              }
              else{
              html = r[0].message;
              if (r[0].media) {
                console.log(r[0].media);
                MMS = 'MMS<br><a href='+r[0].media+' target=_blank><i class="fa fa-file-image-o" aria-hidden="true"></i></a><input type="hidden" name=tmp_img value='+r[0].media+'>';              
              }
              else{
                console.log('null');
                  MMS = '<input type="hidden" name=tmp_img >';
              }
              $('#tmp_img').html(MMS);
                }

              $('#temptext').val(html);
            },
            error:function(xhr,status,error){
              console.log(xhr.responseText);
            }
   });
  });


$('.stop').click(function(){
  if ($(this).prop('checked')) {
      var status = 'Active';
    }
    else{
      var status = 'stop';
    }
  var ask = confirm("Are you sure you want to "+status+" ?");
  var id = $(this).data('id');
  if(ask){
      $.ajax({
        type : "ajax",
      method : "post",
        data : {'id':id,'status':status},
         url : 'stop_recurr',
      success:function(res){
        console.log(res);
        location.reload();
      }
      })
  }
  else{
    if ($(this).prop('checked')) {
        $(this).prop('checked',false);
    }
    else{
      $(this).prop('checked',true);
    }
  }
})

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
    var title = $(this).attr('data-sended_on');

    $('#editdate').val(title);

    var temp_type = $(this).attr('data-message');

    $('#editmsg').val(temp_type);

    var msg = $(this).attr('data-number');

    $('#editnum').val(msg);

$('#edit_form').modal('show');

     $('#editform').submit(function(evt){
     document.getElementById('editsub').disabled = true;
      evt.preventDefault();

      var form = $(this).serialize();

      $.ajax({
            type : 'ajax',
            method : 'post',
            data : form,
            url : '<?php echo base_url(); ?>recurr_edit',
            success:function(r){
              if (r) {
                location.reload();
              }
              else if (r =='already') {
                toastr.warning('This Data is already exits','Not Changed');
                location.reload();
              }
              location.reload();
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

              data : {'id':id},

              url : '<?php echo base_url(); ?>recurr_delete',

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

  <?php if(isset($_SESSION['recurr_add'])){?>

    toastr.success('<?php echo $_SESSION['recurr_add']; ?>');

    <?php unset($_SESSION['recurr_add']);} 



    if(isset($_SESSION['recurr_add_fail'])){?>

    toastr.error('<?php echo $_SESSION['recurr_add_fail']; ?>');

    <?php unset($_SESSION['recurr_add_fail']);} 



    if(isset($_SESSION['edit_recurr'])){?>

    toastr.success('<?php echo $_SESSION['edit_recurr']; ?>');

    <?php unset($_SESSION['edit_recurr']);} 



    if(isset($_SESSION['delete_recurr'])){?>

    toastr.error('<?php echo $_SESSION['delete_recurr']; ?>');

    <?php unset($_SESSION['delete_recurr']);} ?>

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
<script>
  function show(str)



{







if(str=='file')



{



$("#second_box").show();



$("#scheduled_btn").hide();



$("#send_btn").show();



$("#first_box").hide();

$("#clients_wrap").hide();

$("#leads_wrap").hide();



}

else if(str=='leads')

{

$("#second_box").hide();



$("#scheduled_btn").hide();



$("#send_btn").show();



$("#first_box").hide();

$("#clients_wrap").hide();

$("#leads_wrap").show();

}

else if(str=='clients')

{

$("#second_box").hide();



$("#scheduled_btn").hide();



$("#send_btn").show();



$("#first_box").hide();

$("#clients_wrap").show();

$("#leads_wrap").hide();

}

else



{



$("#second_box").hide();



$("#scheduled_btn").hide();



$("#send_btn").show();



$("#first_box").show();

$("#clients_wrap").hide();

$("#leads_wrap").hide();

}

}


function showCheckboxes_clients()

       {



       var expanded = false;

       var checkboxes = document.getElementById("clients_holder");

       if (!expanded) {

       checkboxes.style.display = "block";

       expanded = true;

       }

       else

         {

       checkboxes.style.display = "none";

       expanded = false;

       }

       /* if(checkboxes.style.display === 'none' )  {   checkboxes.style.display = "block";  }  else{    checkboxes.style.display = "none";  } */

       }











        function showCheckboxes()

       {

       var expanded1 = false;

       var checkboxes = document.getElementById("leads_holder");

       if (!expanded1) {

       checkboxes.style.display = "block";

       expanded1 = true;

       }

       else

         {

       checkboxes.style.display = "none";

       expanded1 = false;

       }

       /* if(checkboxes.style.display === 'none' )  {   checkboxes.style.display = "block";  }  else{    checkboxes.style.display = "none";  } */

       }











         function single_select(elem)

   {

   if(elem.checked == true) {

     }

     else {

       document.getElementById("select_all").checked = false;

       }

       }





         function single_select_clients(elem)

   {

   if(elem.checked == true) {

     }

     else {

       document.getElementById("select_all_clients").checked = false;

       }

       }
       function selector1234()

{

  var total_freelancer = $('input:checkbox.checkboxes').length;



var total_freelancer1 = $('input:checkbox.checkboxes');

// console.log(total_freelancer1[i]);

var i = 0;for(i=0; i<total_freelancer;i++)

{ if(document.getElementById("select_all_clients").checked == true){

  

total_freelancer1[i].checked = true;



}

else

{

total_freelancer1[i].checked = false;

}

   }

   }







   function selector123()

{

  var total_freelancer = $('input:checkbox.checkboxes').length;

  alert(total_freelancer);

var total_freelancer1 = $('input:checkbox.checkboxes');

var i = 0;for(i=0; i<=total_freelancer;i++)

{ if(document.getElementById("select_all").checked == true)

{

total_freelancer1[i].checked = true;

}

else

{

total_freelancer1[i].checked = false;

}

   }

   }

</script>



<script type="text/javascript">



   $(document).ready(function() {



              /*  $('#datetimepicker1').datetimepicker();*/



      $("#demo1").emojioneArea({



       container: "#container",



       hideSource: false,



       useSprite: false



      });



    });





</script>



 <script>







    $(function() {



      // Initializes and creates emoji set from sprite sheet



      window.emojiPicker = new EmojiPicker({



        emojiable_selector: '[data-emojiable=true]',



        assetsPath: 'lib/img/',



        popupButtonClasses: 'fa fa-smile-o'



      });

      window.emojiPicker.discover();

    });

  </script>



<script type="text/javascript">
   $('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });

</script>