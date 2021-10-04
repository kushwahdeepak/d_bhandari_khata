
<!-- this footer will not be shown on login page -->
<?php if ($inner_view != 'common/login') { ?>
  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Designed and Developed by <a href="http://www.karyonsolutions.com"><strong>Karyon Solutions</strong></a>
    </div>
    <strong>&copy; <?php echo date('Y'); ?></strong> All rights reserved by <strong>Karyon Solutions</strong>
  </footer> -->
<?php } ?>
</div>
      
</body>




<!-- getting this scripts from karyon_config.php file which is under application > config folder -->
<?php
foreach ($scripts['foot'] as $file) {
    echo "<script src='$file'></script>";
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/sweetalert/sweetalert2.css">
<script src="<?php echo base_url();?>plugins/sweetalert/sweetalert2.all.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>plugins/sweetalert/sweetalert2.js" type="text/javascript"></script>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>


<?php
$this->load->view('common/ajaxJs.php');
?>
<script type="text/javascript">
    function expendcheckTrasactionType()
    {
        var type = $("#payable_type").val();
        if (type == "" || type == "cash" ) 
        {
            $("#cheque_detail").css("display", "none");
        }
        else
        {     
            $("#cheque_detail").css("display", "block");
        }   
    }
    function addcheckTrasactionType()
    {
        var type = $("#payable_type").val();
        if (type == "" || type == "cash" ) 
        {
            $("#cheque_detail").css("display", "none");
        }
        else
        {     
            $("#cheque_detail").css("display", "block");
        }   
    }


    function completeTrasactionType()
    {
        var type = $("#recivable_type").val();
        if (type == "" || type == "cash" ) 
        {
            $("#account_no").css("display", "none");
            $("#account_holder_name").css("display", "none");
            $("#bank_name").css("display", "none");
            $("#ifsc_code").css("display", "none");
            $("#cheque_detail").css("display", "none");
        }
        else
        {     
            $("#account_no").css("display", "block");
            $("#account_holder_name").css("display", "block");
            $("#bank_name").css("display", "block");
            $("#ifsc_code").css("display", "block");
            $("#cheque_detail").css("display", "block");
        }
    }
</script>
<script type="text/javascript">

   function submitTagForm()
    {

      var subcat = $('.my_select_box');
        $.ajax({
            url: '<?php echo site_url(); ?>/admin/submitTagForm',
            type: 'POST',
            data: $('#add_tag_form').serialize(), 
            success: function (response) {
                toastr.success('Tag Added');

                $("#addTag").modal('hide');
                   subcat.html(response);
                   subcat.trigger('chosen:updated');

                // $("#tag_section").load(location.href + " #tag_section"); 
            },
            error: function () {
                alert('An error has occurred');
            }
        });

        // location.href = '<?php echo site_url(); ?>/admin/addBlogPage';
    }
</script>
<script>
    //Date range picker
    $('.datepicker').daterangepicker();

    $(document).on('click', '.browse', function(){
        var file = $(this).parent().parent().parent().find('.file');
        file.trigger('click');
    });
    $(document).on('change', '.file', function(){
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
 
</script>
<script>
    $('.normal_datepicker').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd',
            todayHighlight: true,
        });
</script>


<script>
    $(function () {
        $('#blogListTable').DataTable({
            order: [[4, 'desc']],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#example3").DataTable();
    });
</script>



  <!-- Start notification toster -->
<?php if ($this->session->flashdata('message') != ""){ ?>
<script>
    toastr.info('<?php echo $this->session->flashdata('message');?>');
</script>
<?php } ?> 
<!-- End Notification toster -->

<!-- Start notification toster -->
<?php if ($this->session->flashdata('success_msg') != ""){ ?>
<script>
    toastr.success('<?php echo $this->session->flashdata('success_msg');?>');
</script>
<?php } ?> 
<!-- End Notification toster -->

<!-- Start notification toster -->
<?php if ($this->session->flashdata('error_msg') != ""){ ?>
<script>
    toastr.error('<?php echo $this->session->flashdata('error_msg');?>');
</script>
<?php } ?> 
<!-- End Notification toster -->
  
</html>
