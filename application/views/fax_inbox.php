<?php include_once('header.php') ?>
<style>
.noti_bubble11{display:none}

.table-font{font-size:0.875rem !important;}
</style>
<?php 
include_once('header.php')
?>    <!-- Main content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
		  $( document ).ready(function() {


var table = $('#dataTable').DataTable();

// Sort by columns 1 and 2 and redraw
table
    .order( [ 4, 'desc' ] )
    .draw();
 });
</script>
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active"> Received Fax</li>
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
              <i class="icon-envelope-open"></i> Received Fax
              <div class="card-actions">
                <a href="https://datatables.net/">
                  <small class="text-muted">docs</small>
                </a>
              </div>
            </div>

            <div class="card-body">
         <div class="container">

<div class="row">         
               
           </div>

</div>
            
              <table class="table table-striped table-bordered datatable table-responsive-sm" id="dataTable">

                <thead>
                  <tr id>
                    <th>ID</th>

                    <th>Fax Number</th>
                    <th>Twilio Number</th>

                    <th>Media</th>
                    <th >Date</th>
                    <th >Delete</th>
                  </tr>
                </thead>
                <tbody>
                	<?php 
                	if ($get_inbox=='No') {
                		echo '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>';
                	}
                	else{
                		for ($i=0; $i <sizeof($get_inbox) ; $i++) { 
                		
                		                		$d = $i+1;
              			if ($get_inbox[$i]['fax_url']!='') {
                			$pdf = '<a href='.$get_inbox[$i]['fax_url'].' target="_blank" >View Fax</a>';
                			}
                			else{
                				$pdf = 'No Fax';
                			}
                	echo '<tr '.$get_inbox[$i]['id'].'>
                						<td>'.$d.'</td>
                						<td>'.$get_inbox[$i]['fax_number'].'</td>
                						<td>'.$get_inbox[$i]['twilio_num'].'</td>
                						<td>'.$pdf.'</td>
                						<td>'.$get_inbox[$i]['created_at'].'</td>
                						<td><a href="#" class="btn-danger btn-sm delete" data-id= '.$get_inbox[$i]['id'].' >Delete</a> </td>
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

</div><?php include_once('footer.php') ?>
<!-- Plugins and scripts required by this views -->
  <script src="vendors/js/jquery.dataTables.min.js"></script>
  <script src="vendors/js/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts required by this view -->
  <script src="js/views/tables.js"></script>
  <script type='text/javascript'>//<![CDATA[
   <script type="text/javascript">
  $('.delete').click(function(){
    var id = $(this).attr('data-id');
    
   $msg =  confirm("Are you sure??");
    if ($msg) {
      location.href = '<?php echo base_url(); ?>Fax_inbox/delete/'+id;
    }
  });
</script>
<script type="text/javascript">
  <?php if(isset($_SESSION['inbox'])&& $_SESSION['inbox']=='1'){?>
  toastr.success("Data deleted successfully","Deleted");
  <?php unset($_SESSION['inbox']);} if(isset($_SESSION['inbox'])&& $_SESSION['inbox']=='0'){?>
  toastr.success("Sorry there is an error","Failed");
  <?php unset($_SESSION['inbox']);}  ?>
</script>