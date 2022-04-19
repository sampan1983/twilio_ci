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
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active"> Sent Fax</li>
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
              <i class="icon-paper-plane"></i>  Sent Fax
              <div class="card-actions">
                <a href="https://datatables.net/">
                  <small class="text-muted">docs</small>
                </a>
              </div>
            </div>

            <div class="card-body">
  
              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Number</th>
                    <th>Twilio Number</th>
                    <!-- <th>Message</th> -->
                    <th>Fax</th>
                    <th>Date</th>
<th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($data_get=='No') {
                  	
                  }
                  else{

                  	for ($i=0; $i < sizeof($data_get); $i++) { 
                                          if($data_get[$i]['fax_url'] != '') {
                                            $pdf = '<a href='.$data_get[$i]['fax_url'].' target="_blank">View Fax</a>';
                                          }
                                          else{
                                            $pdf = 'No Fax';
                                          }
                  		$d = $i+1;
                  		echo '<tr '.$data_get[$i]['id'].'>
                  		<td>'.$d.'</td>
                  					<td>'.$data_get[$i]['fax_number'].'</td>
                  					<td>'.$data_get[$i]['twilio_num'].'</td>
                  					<td>'.$pdf.'</td>
                  					<td>'.$data_get[$i]['created_at'].'</td>
                  					<td><a class="btn-danger btn-sm delete" href="#" data-id = '.$data_get[$i]['id'].' >Delete</a></td>

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
      <!-- /.conainer-fluid -->
    </main>
</div>


<?php include_once('footer.php')?>

<!-- Plugins and scripts required by this views -->
  <script src="vendors/js/jquery.dataTables.min.js"></script>
  <script src="vendors/js/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts required by this view -->
  <script src="js/views/tables.js"></script>
<script type="text/javascript">
  $('.delete').click(function(){
    var id = $(this).attr('data-id');
    
   $msg =  confirm("are you sure??");
    if ($msg) {
      location.href = '<?php echo base_url(); ?>Sent_fax/delete/'+id;
    }
  });
</script>
<script type="text/javascript">
  <?php if(isset($_SESSION['delete_fax_sent_log'])&& $_SESSION['delete_fax_sent_log']=='1'){?>
  toastr.success("Data deleted successfully","Deleted");
  <?php unset($_SESSION['delete_fax_sent_log']);} if(isset($_SESSION['delete_fax_sent_log'])&& $_SESSION['delete_fax_sent_log']=='0'){?>
  toastr.success("Sorry there is an error","Failed");
  <?php unset($_SESSION['delete_fax_sent_log']);}  ?>
</script>