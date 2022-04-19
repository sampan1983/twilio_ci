<?php include_once('header.php'); ?>
    
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Pending Emails</li>
        <!-- Breadcrumb Menu-->
        <!-- <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <a class="btn" href="#"><i class="icon-speech"></i></a>
            <a class="btn" href="index-2.html"><i class="icon-graph"></i> &nbsp;Pending Numbers</a>
            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
          </div>
        </li> -->
      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="card">
<!--             < ?php
            $query = mysqli_query($con,"select count(*) from tapp_sent_emails") ;
            $i = 1;
      while($row = mysqli_fetch_array($query) )
      {
      $count=$row[0];
      }
            ?> -->
            <div class="card-header">
              <i class="icon-people"></i> Pending Mails<span>(<?php if ($queued_data=='No') {
                echo 0;
              }
              else{
                echo sizeof($queued_data);
              } ?>)</span>
              <div class="card-actions">
              
              </div>
            </div>

            <div class="card-body">
              
              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date time</th>
                    <th>Delete</th>
                    
                   
                  </tr>
                </thead>
                <tbody><!-- < ?php print_r($queued_data); ?> -->
              <?php 
              if ($queued_data=='No') {
       	echo '<tr><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';
               } 
               else{
               	for ($i=0; $i <sizeof($queued_data) ; $i++) { 
               		
               	$d = $i+1;
               	echo '<tr id="tr" class="tr'.$queued_data[$i]['id'].'">
                          <td>'.$d.'</td>
                          <td>'.$queued_data[$i]['email'].'</td>
<td><a href="javascript:void(0)" onclick="get_email('.$queued_data[$i]['message'].')" >View Email</a></td>
                          <td>'.$queued_data[$i]['date_time'].'</td>
                        <td><a href = "Queued_mails/delete/'.$queued_data[$i]['id'].'" class = "btn btn-danger delete" data-id = "'.$queued_data[$i]['id'].'" onclick="return confirm("Are you sure you want to delete?")">Delete</a></td></tr>';
              }
               }
               ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <div class="modal" id="viewemail">
                    <div class="modal-dialog" style="max-width: 1500px;">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Email</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" id="setemail">
    
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
      <!-- /.conainer-fluid -->
    </main>
  </div>

<?php include('footer.php'); ?>
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
$( document ).ready(function() {
  $('#dataTable').DataTable(); 
  $('.dataTable').attr('style', 'border-collapse: collapse !important');
});
</script>
<script type="text/javascript">
	 function get_email(argument) {
      var id = argument;
      $.ajax({
          type : 'ajax',
          method : 'post',
          dataType : 'json',
          url : '<?php echo base_url(); ?>Queued_mails/getid/'+id,
          success:function(r){
           
                      $("#setemail").html(r);
          $("#viewemail").modal('show');

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