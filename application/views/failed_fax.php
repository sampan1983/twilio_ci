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
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active"> Failed Fax</li>
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
              <i class="icon-paper-plane"></i> Failed Fax
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
                    <th>Fax</th>
                    <th>Date</th>
				<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                	if ($fail_data=='No') {
                		echo '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>';
                	}
                	else{
                		for ($i=0; $i <sizeof($fail_data) ; $i++) { 
                			if ($fail_data[$i]['fax_url']=='') {
                				$pdf = 'No Fax';
                			}
                			else{
                				$pdf = '<a href='.$fail_data[$i]['fax_url'].' target="_blank">View Fax</a>';
                			}
                				$d = $i+1;
                			echo '<tr '.$fail_data[$i]['id'].'>
                					<td>'.$d.'</td>
                					<td>'.$fail_data[$i]['fax_number'].'</td>
                					<td>'.$fail_data[$i]['twilio_num'].'</td>
                					<td>'.$pdf.'</td>
                					<td>'.$fail_data[$i]['created_at'].'</td>
                					<td><a href="#" class="btn-danger btn-sm delete" data-id='.$fail_data[$i]['id'].' >Delete
               </a></td>



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
<?php include_once('footer.php') ?>
<!-- Plugins and scripts required by this views -->
  <script src="vendors/js/jquery.dataTables.min.js"></script>
  <script src="vendors/js/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts required by this view -->
  <script src="js/views/tables.js"></script>
<script type="text/javascript">
  $('.delete').click(function(){
    var id = $(this).attr('data-id');
    
   $msg =  confirm("Are you sure??");
    if ($msg) {
      location.href = '<?php echo base_url(); ?>Failed_fax/delete/'+id;
    }
  });
</script>
<script type="text/javascript">
  <?php if(isset($_SESSION['delete_fax_fail'])&& $_SESSION['delete_fax_fail']=='1'){?>
  toastr.success("Data deleted successfully","Deleted");
  <?php unset($_SESSION['delete_fax_fail']);} if(isset($_SESSION['delete_fax_fail'])&& $_SESSION['delete_fax_fail']=='0'){?>
  toastr.success("Sorry there is an error","Failed");
  <?php unset($_SESSION['delete_fax_fail']);}  ?>
</script>