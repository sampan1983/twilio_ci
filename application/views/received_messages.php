<style>

.noti_bubble11{display:none}



.table-font{font-size:0.875rem !important;}

</style>

<?php include_once('header.php')?>
    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item"><a href="#">Admin</a></li>

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

             <form action="" method="post" id="f1" name=f1 enctype="multipart/form-data" class="form-horizontal col-md-6">

              <input type=hidden name=todo value="submit">

                 <div class="form-group row">

                  <label class="col-md-2 col-form-label " for="text-input"><strong>Month :</strong></label>

                    <div class="col-md-3">

                   <select style="" class="form-control input-sm inline-block month_label" id="month" name="month" value="">

                    <option value = "">Select Month</option>



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

                   <input class="btn btn-primary" type="submit" value="Submit">

                    </div>

                  </div>

              </form>

              <form id="f2" class="form-horizontal col-md-4">                 

                 <div class="form-group row">

                  

                    <div class="col-md-9">

                                  <input class="form-control input-sm inline-block" type="text"  name="msg_num" size="14" id="msg_num" placeholder="Search by number/message">

                       

                    </div>

                   <div class="col-md-3">

                    <input class="btn btn-primary month_label" name="number_search" type="submit" value="Search">

                  </div>

                  </div>  

                </form>

                <div class="form-group">

                  

                   

                   <div class="col-md-3">

                    <a href="#"><button type="button" value="Export Data" class="btn btn-primary btn-md" id="export"> Export Data</button>

                    </a>

                  </div>

                  </div>  

</div>



<div class="row">

<!--   < ?php

    if (isset($_POST['todo']) && $_POST['todo']=='submit') {

    $month = $_POST['month'];

    $year = $_POST['year'];

 

  }?> -->

 <!-- <div class="col-sm-1 sent-message-form-column">

                    <a href="export_received_msg.php?year=&month="><button type="button" value="Export Data" class="btn btn-primary"> Export Data</button></a>

                  </div>

                  <br><br> -->



                   <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">

                <span class="mark_read"> <input  style="opacity:1;"  type="checkbox"  class="case1" onClick="count(this.value)" value="" ><span style="margin-left: 2%;"> Mark all as read</span></span>

                <thead>

                  <tr>

                    <th class="table-font">ID</th>

                    <th class="table-font">Mobile Number</th>

                    <th class="table-font">Twilio Number</th>

                    <th class="table-font">Message</th>

                    <th class="table-font">Date</th>

                  </tr>

                </thead>

                <tbody id="alldata">

                  <?php

                    if ($tabledata=='No') {

                      echo '<tr><td></td><td></td><td>No data avaliable</td><td></td><td></td></tr>';

                    }

                    else{

                          for ($i=0; $i <sizeof($tabledata); $i++) { 

                            $d = $i+1;

                            echo '<tr class="tr'.$tabledata[$i]['id'].'"style="font-size:14px">

                                        <td>'.$d.'</td>

<td><a href="#" class = "num_chat" data-id = '.$tabledata[$i]['id'].' >'.$tabledata[$i]['sender'].'</a></td>

                                        <td>'.$tabledata[$i]['twilio_num'].'</td>

                                        <td>'.$tabledata[$i]['body'].'</td>

                                        <td>'.$tabledata[$i]['date_time'].'</td>

                            </tr>';

                          }

                    }

                  ?>              

    

                    </tbody>

                                                     <tbody id="searchmy"></tbody>

                                 <tbody id="searchno"></tbody>

              </table>



               



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

  $('#f1').submit(function(evt){

      evt.preventDefault();

      var form = $('#f1').serialize();

      $.ajax({

          type : 'ajax',

          method : 'post',

          data : form,

          dataType : 'json',

          url : '<?php echo base_url();?>Received_messages/search',

          success:function(r){

            console.log(r);

           var html = "";

           if (r=='No') {

            html = '<tr><td></td><td></td><td>No data avaliable</td><td></td><td></td></tr>';

           }

           else{

              

                      

           for (var i = 0; i < r.length; i++) {

            

           var  d = i + 1;

             html += '<tr '+r[i].id+' style="font-size:14px"><td>'+d+'</td>              <td><a href="#" class = "num_chat" data-id = "'+r[i].id+'">'+r[i].sender+'</a></td> <td>'+r[i].twilio_num+'</td><td>'+r[i].body+'</td> <td>'+r[i].date_time+'</td></tr>';

           

         }

       }



            $('#searchmy').html(html);

            $('#searchmy').show();

            $('#alldata').hide();

           $('#searchno').hide();
           // $('#dataTable').DataTables();

          },

          error:function(xhr,status,error){

            console.log(xhr.responseText);

          }

      });

  });







  $('#f2').submit(function(evt){
      evt.preventDefault();
      var form = $('#f2').serialize();
      $.ajax(
      {
          type : 'ajax',
          method : 'post',
          data : form,
          dataType : 'json',
          url : '<?php echo base_url();?>Received_messages/searchnum',
          success:function(r)
          {
            console.log(r);
           var html = "";
           if (r=='No') 
           {
            html = '<tr><td></td><td></td><td>No data avaliable</td><td></td><td></td></tr>';
           }
           else
           {
           for (var i = 0; i < r.length; i++) 
           {
           var  d = i + 1;
           html += '<tr '+r[i].id+' style="font-size:14px"><td>'+d+'</td>              <td><a href="#" class = "num_chat" data-id = "'+r[i].id+'">'+r[i].sender+'</a></td> <td>'+r[i].twilio_num+'</td><td>'+r[i].body+'</td> <td>'+r[i].date_time+'</td></tr>';
         }
       }

            $('#searchno').html(html);

            $('#searchmy').hide();

            $('#alldata').hide();

            $('#searchno').show();

          },

          error:function(xhr,status,error){

            console.log(xhr.responseText);

          }

      });

  });



defaulttab();

  function defaulttab(){

                $('#searchmy').hide();

            $('#alldata').show();

            $('#searchno').hide();

  }

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

    

    var year = $('#year').val();

    var msg_num = $('#msg_num').val();



    location.href = '<?php echo base_url(); ?>Received_messages/export/'+month+'/'+year+'/'+msg_num;

    

  })

</script>

<?php unset($_SESSION['number']); ?>