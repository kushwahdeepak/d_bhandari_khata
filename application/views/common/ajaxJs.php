<?php if(isset($data['pageName']) && !empty($data['pageName'])) { ?>
<?php if($data['pageName'] == "ACCOUNT") { ?>
<script src="<?php echo base_url();?>assets/js/account/bank.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/account/basic_info.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/account/rate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/account/profile_image.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/account/change_password.js" type="text/javascript"></script>
<?php } else if($data['pageName'] == "SUBADMIN") { ?>
<script src="<?php echo base_url();?>assets/js/account/sub_admin.js" type="text/javascript"></script>
<?php } else if($data['pageName'] == "CUSTOMER") { ?>
<script src="<?php echo base_url();?>assets/js/account/customer.js" type="text/javascript"></script>
<?php } else if($data['pageName'] == "LOAN") { ?>
<script src="<?php echo base_url();?>assets/js/account/loan.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/account/loan_detail.js" type="text/javascript"></script>
<?php } else if($data['pageName'] == "EXPAND") { ?>
<script src="<?php echo base_url();?>assets/js/account/amount_expend.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/account/expend.js" type="text/javascript"></script>
<?php } else if($data['pageName'] == "TRANSECTION") { ?>
<script src="<?php echo base_url();?>assets/js/account/tarnsection.js" type="text/javascript"></script>
<?php } ?>
<?php } else if($pageName == "LOANOVERVIEW") { ?>
	<script src="<?php echo base_url();?>assets/js/account/loan_detail.js" type="text/javascript"></script>
<?php } ?>
<!-- <script src="<?php echo base_url();?>assets/js/account/intial_investment.js" type="text/javascript"></script> -->
<script src="<?php echo base_url();?>assets/js/account/loadPageWithoutRefresh.js" type="text/javascript"></script>



