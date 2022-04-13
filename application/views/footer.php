<!-- <footer class="app-footer">

    <span class="left" >Power of  <a href="https://virtuemantra.com" target="_blank" style="margin-left: 5px;">Virtuemantra Technologies</a></span>
    <span class="right"> <a href="<?php echo base_url() ?>/privacy_policy" target="_blank"> Privacy Policy</a></span>

    <span class="ml-auto">Powered by <a href="#">Vm Tech</a></span>

  </footer>
 -->
  <!-- Bootstrap and necessary plugins -->

  <script src="<?php echo base_url(); ?>vendors/js/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/popper.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/bootstrap.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/pace.min.js"></script>



  <!-- Plugins and scripts required by all views -->

  <script src="<?php echo base_url(); ?>vendors/js/Chart.min.js"></script>



  <!-- Clever main scripts -->



  <script src="<?php echo base_url(); ?>js/app.js"></script>



  <!-- Plugins and scripts required by this views -->

  <script src="<?php echo base_url(); ?>vendors/js/toastr.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/gauge.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/moment.min.js"></script>

  <script src="<?php echo base_url(); ?>vendors/js/daterangepicker.min.js"></script>



  <!-- Custom scripts required by this view -->

  <script src="<?php echo base_url(); ?>js/views/main.js"></script>



</body>
<script>
  function delete_all(params) {
    if(confirm('Are You Sure ? This action can\'t be undone')){
     location.href = '<?php echo base_url() ?>Clients/delete_all/'+params;  
    }   
  }
</script>

<!-- Mirrored from genesisui.com/demo/clever/1.8.10/bootstrap4-static/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Nov 2017 10:56:54 GMT -->

</html>
