<?php include_once('header.php')?>
<style>
  td.sorting_1
{
  text-align: left;
}
  th.sorting_asc {
    padding-right: 19px!important;
}
}
  tr.newclasstr th.sorting {
    padding-right: 20px!important;
}
.main .container-fluid
{
  padding: 0px!important;
}
.noti_bubble11{display:none}



.table-font{font-size:0.875rem !important;}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

		  $( document ).ready(function() {

var table = $('#dataTable').DataTable();



// Sort by columns 1 and 2 and redraw

table

    .order( [ 7, 'desc' ] )

    // .draw();

 });

</script>

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <!--li class="breadcrumb-item"><a href="#">Admin</a></li-->

        <li class="breadcrumb-item active"> Received Messages</li>

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

              <i class="icon-envelope-open"></i> Received Messages

              <div class="card-actions">

                <a href="https://datatables.net/">

                  <small class="text-muted">docs</small>

                </a>

              </div>

            </div>



            <div class="card-body">

         <div class="container">

          <div class="row">

             <!-- <form class="form-horizontal col-md-6" id="f1">              

                 <div class="form-group row">

                  <label class="col-md-2 col-form-label " for="text-input"><strong>Month :</strong></label>

                    <div class="col-md-3">

                   <select style="" class="form-control input-sm inline-block month_label" id="month" name="month" value="">

                    <option value ="">Select Month</option> 



                    <option value="01">January</option>



                    <option value="02">February</option>



                    <option value="03">March</option>



                    <option value="04">April</option>



                    <option value="05">May</option>



                    <option value="06">June</option>



                    <option value="07">July</option>



                    <option value="08">August</option>



                    <option value="09">September</option>



                    <option value="10">October</option>



                    <option value="11">November</option>



                    <option value="12">December</option>



                  </select>
                    
                    </div>

                    <label class="col-md-2 col-form-label" for="text-input"><strong>Year : </strong></label>

                    <div class="col-md-3">

                    <input class="form-control input-sm inline-block month_label_year" id="year" type="number" name="year" size="4" value="<?php echo date('Y'); ?>">

                    </div>

                    <div class="col-md-2">

                   <input class="btn btn-primary btninp" type="submit" value="Submit">

                    </div>

                  </div>

              </form>

              <form id="f2" class="form-horizontal col-md-4">                 

                 <div class="form-group row">

                    <div class="col-md-9">

                    <input class="form-control input-sm inline-block" type="text"  name="msg_num" id="msg_num" size="14" placeholder="Search by number/message">
                     
                    </div>

                   <div class="col-md-3">

                    <input class="btn btn-primary btninp month_label" name="number_search" type="submit" value="Search">

                  </div>

                  </div>  

                </form> -->

                <div class="form-group exportbtnsty">

                   <div class="col-md-3">

                    <a href="#"><button type="button" id="export"

                      value="Export Data" class="btn btn-primary btninp btn-md"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Data</button>

                    </a>

                  </div>

                  </div>  
                  <div class="col-md-7">
<a href="#" class="btn btn-danger btn-md btn-sty" id="delete_select"><i class="fa fa-trash-o" aria-hidden="true"></i> Selected</a>
</div>

</div>
<div class="row">
  <!-- <div class="col-md-5">
<span  class="mark_read"> <input  style="opacity:1;"  type="checkbox"  class="case1" onClick="count(this.value)" value="" ><span style="margin-left: 2%;"> Mark all as read</span></span>
</div> -->

</div>



</div>

            
              <div id="tb">
              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">
                <thead>
                  <tr class="newclasstr">
                    <!-- Select &nbsp;  removed--> 
                    <th> &nbsp;<input type="checkbox" name="contact[]" value="select_all_contact " id="select_all_contact" onclick="selector1234()" ></th>
                    <th>S.No</th>
                    <th>Mobile Number</th>
                    <th>Twilio Number</th>
                    <th style="width: 290px!important">Message</th>
                    <th>Media</th>
                    <th>Date</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody id="Received">
                  <?php
                  if ($new_recieve=='No') {
                    echo '<tr><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>';
                  }
                  else{
                    for ($i=0; $i <sizeof($new_recieve); $i++) { 
                      if (empty($new_recieve[$i]['mediaUrl'])) {
                        $img = 'No Media';
                      }
                      else{
                        $img = "<a href= ".$new_recieve[$i]['mediaUrl']." target='_blank'>View MMS</a>";
                      }
                      $d = $i+1;

                      echo '<tr class="tr'.$new_recieve[$i]['id'].'"style="font-size:14px">
                                <td><input type="checkbox" name="contact[]"" id="con" class="checkboxes" onclick="select_single_contact(this)"" value="'.$new_recieve[$i]['id'].'" ></td>
                                <td>'.$d.'</td>

              <td><a href="#" class = "num_chat" data-id = '.$new_recieve[$i]['id'].' >'.$new_recieve[$i]['sender'].'</a></td>

                                <td >'.$new_recieve[$i]['twilio_num'].'</td>

                                <td>'.$new_recieve[$i]['body'].'</td>

                                <td>'.$img.'</td>

                                <td>'.$new_recieve[$i]['date_time'].'</td>

                                <td><a href = "#" class="btn btn-danger delete" data-id = '.$new_recieve[$i]['id'].' onClick ="det('.$new_recieve[$i]['id'].')"><i class="fa fa-trash-o" ></i></a></td>

                                  </tr>';
                    }
                  }
                  ?>
                                 </tbody>
                                </table>
                              </div>
            </div>

            <form class="no-margin"  method="post" onSubmit="return myFunction()"  action="get_lists.php" name="client_record" enctype="multipart/form-data" >







           <div style="display:none;">  





        </div>















    <!--Modal-->







  <div class="modal fade" id="form">







    <div class="modal-dialog">







        







      <div class="modal-content">







        <div class="modal-header">







          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>







          <h4 align="center">Make a List</h4>







        </div>















        <div class="modal-body">







            <div class="form-group">







             <label class="control-label">List Name</label>







                <input type="text" placeholder="List name" onBlur="checkkeyword(this.value)" required class="form-control input-sm parsley-validated "  name="list">







                <span style="color:#FF0000;" id="show"></span> 







            </div>







             <div class="form-group">







             <label class="control-label">Description</label>







                <input type="text" placeholder="Description"  required class="form-control input-sm parsley-validated "  name="description">







                <span style="color:#FF0000;" id="show"></span> 







            </div>



        <div class="modal-footer">



                  <button type="submit" class="btn btn-danger btn-sm check">Submit</button> 



          <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>

         </div>



      </div>



    </div>



  </div> </div>

               </form>

          </div>

        </div>



      </div>

      <!-- /.conainer-fluid -->

    </main>

  </div>

<?php include_once('footer.php')?>
              <div class="modal fade" id="delete_select_btnModal">

    <div class="modal-dialog">
      <form class="no-margin" action="Received_messages_new/delete_s" data-validate="parsley" method="post" name="client_record" enctype="multipart/form-data" > 

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

  <script src="<?php echo base_url(); ?>js/views/tables.js"></script>

  <script type='text/javascript'>//<![CDATA[


$(function(){
 var checkboxes = $("input[type='checkbox']"),
    submitButt = $("button[type='submit']");
checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});
});//]]> 

function count()
{
var checkboxes = document.getElementsByName('delete_num[]');
var vals = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
//alert("df");
    if (checkboxes[i].checked) 
    {
        vals += ","+checkboxes[i].value;
    }
}
if (vals) vals = vals.substring(1);
//alert(vals);
//document.getElementById("checkboxvalue").value = vals;
window.location.href="Update_read_msg";
}

</script>

<script type="text/javascript">

  function det(ids){

    var id = ids;

    var msg = confirm('Are you sure??');

    if (msg==true) {
// alert(id);
      $.ajax({

                type : 'ajax',

                method : 'post',

                dataType : 'json',

                url : '<?php echo base_url();?>Received_messages_new/delete/'+id,

                success:function(r){

                  console.log(r);

                  if (r=='deleted') {



                    location.reload();

                  }

                  else{

                    toastr.error('Message Not deleted','failed');

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

  $('#f1').submit(function(evt){

      evt.preventDefault();

      var form = $('#f1').serialize();

      $.ajax({

          type : 'ajax',

          method : 'post',

          data : form,

          dataType : 'json',

          url : '<?php echo base_url();?>Received_messages_new/search',

          success:function(r){

            console.log(r);

           var html = '<table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTables" style="border-collapse: collapse !important"><thead><tr><th>Select All&nbsp;<input type="checkbox" name="contact[]" value="select_all_contact " id="select_all_contact" onclick="selector1234()" ></th><th>S.No</th><th>Mobile Number</th><th>Twilio Number</th><th>Message</th><th>Media</th><th>Date</th><th>Delete</th></tr></thead><tbody id="Received">';

           if (r=='No') 
           {
            html = '<tr><td></td><td></td><td></td><td>No data avaliable</td><td></td><td></td><td></td><td></td></tr>';
           }

           else{
         
           for (var i = 0; i < r.length; i++) {

            if (r[i].mediaUrl=='') {
                        var img = 'No Media';
                      }
                      else{
                        var img = "<a href= "+r[i].mediaUrl+" target='_blank'>View MMS</a>";
                      }
           var  d = i + 1;
             html += '<tr '+r[i].id+'><td><input type="checkbox" name="contact[]" id="con" class="checkboxes" onclick="select_single_contact(this)" value="'+r[i].id+'" ></td><td>'+d+'</td>              <td><a href="chat.php?number='+r[i].sender+'">'+r[i].sender+'</a></td> <td>'+r[i].twilio_num+'</td><td>'+r[i].body+'</td> <td>'+img+'</td> <td>'+r[i].date_time+'</td><td><a href = "#" class="btn btn-danger delete" onClick ="det('+r[i].id+')"  data-id = '+r[i].id+'><i class="fa fa-trash-o" ></i></a></td></tr>';          

         }

       }
          var tb = html+'</tbody></table>';

             $('#tb').html(html);
            $('#dataTables').DataTable();
            // $('#searchmy').show();

            // $('#Received').hide();

            // $('#searchno').hide();

          },

          error:function(xhr,status,error){

            console.log(xhr.responseText);

          }

      });

  });







  $('#f2').submit(function(evt){

      evt.preventDefault();

      var form = $('#f2').serialize();

      

      $.ajax({

          type : 'ajax',

          method : 'post',

          data : form,

          dataType : 'json',

          url : '<?php echo base_url();?>Received_messages_new/searchnum',

          success:function(r){
            console.log(r);
           var html = '<table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTables" style="border-collapse: collapse !important"><thead><tr><th>Select All&nbsp;<input type="checkbox" name="contact[]" value="select_all_contact " id="select_all_contact" onclick="selector1234()" ></th><th>S.No</th><th>Mobile Number</th><th>Twilio Number</th><th>Message</th><th>Media</th><th>Date</th><th>Delete</th></tr></thead><tbody id="Received">';
           if (r=='No') {
            html = '<tr><td></td><td></td><td></td><td>No data avaliable</td><td></td><td></td><td></td><td></td></tr>';
           }
           else{
           for (var i = 0; i < r.length; i++) {
            if (r[i].mediaUrl=='') {
               var img = 'No Media';
               }
           else{
               var img = "<a href= "+r[i].mediaUrl+" target='_blank'>View MMS</a>";
                }
           var  d = i + 1;
           html += '<tr '+r[i].id+'><td><input type="checkbox" name="contact[]" id="con" class="checkboxes" onclick="select_single_contact(this)" value="'+r[i].id+'" ></td><td>'+d+'</td>              <td><a href="chat.php?number='+r[i].sender+'">'+r[i].sender+'</a></td> <td>'+r[i].twilio_num+'</td><td>'+r[i].body+'</td> <td>'+img+'</td> <td>'+r[i].date_time+'</td>   <td><a href = "#" class="btn btn-danger delete" onClick ="det('+r[i].id+')"  data-id = '+r[i].id+'><i class="fa fa-trash-o" ></i></a></td>    </tr>';
         }
       }
           var tb = html+'</tbody></table>';
            $('#tb').html(html);
        //     $('#searchmy').hide();
        // //  $('#Received').hide();
        // //    $('#searchno').show();
            $('#dataTables').DataTable();

          },

          error:function(xhr,status,error){

            console.log(xhr.responseText);

          }

      });

  });



defaulttab();

  function defaulttab(){

                $('#searchmy').hide();

            $('#Received').show();

            $('#searchno').hide();

  }





  // function funnum(){

  //   var id = $('.num_chat').attr('data-id');

  //   alert(id);

  //   $.ajax({

  //             type : 'ajax',

  //             method : 'post',

  //             dataType : 'json',

  //             url : '< ?php echo base_url(); ?>Received_messages_new/chat/'+id,

  //             success:function(r){

  //               console.log(r);

  //               // location.href = '< ?php echo base_url(); ?>Received_messages_new/chatnum/'+r;

  //             },

  //             error:function(xhr,status,error){

  //               console.log(xhr.responseText);

  //             }

  //   });

  // }







</script>



<script type="text/javascript">

  $('.num_chat').click(function(){



 var id = $(this).attr('data-id');

    

    $.ajax({

              type : 'ajax',

              method : 'post',

              dataType : 'json',

              url : '<?php echo base_url(); ?>Received_messages_new/chat/'+id,

              success:function(r){

                console.log(r);

                if (r=="Can't open this msg") {

                  toastr.error("Can't open this msg");

                }

                else{

                location.href = '<?php echo base_url(); ?>Chat';

              }

              },

              error:function(xhr,status,error){

                console.log(xhr.responseText);

              }

    });

  });

</script>

<script type="text/javascript">

  $('#export').click(function(){

 var month = $('#month').val();

   var year =  $('#year').val();

   var msg_num = $('#msg_num').val();

   location.href = '<?php echo base_url(); ?>Received_messages/export/'+month+'/'+year+'/'+msg_num;



  });



</script>

<script type="text/javascript">

  <?php if(isset($_SESSION['receive_new_delete'])){?>

    toastr.success('<?php echo $_SESSION['receive_new_delete']; ?>','Deleted!');

    <?php unset($_SESSION['receive_new_delete']);} 
    unset($_SESSION['number']); if (isset($_SESSION['client_del'])) {?>
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
    toastr.warning('Please select a message','Invalid Selection');
  }
  else{

$('#delete_select_btnModal').modal('show');

}
});
</script>