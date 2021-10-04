<style type="text/css">
.btn-primary {
    background-color: #8bbee8;
    border: none;
}
.btn-primary:hover {
    background-color: #8bbee8;
    border: none;
}

</style>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0)"><b>Bhandari Khata</b></a> 
        </div>
       
        <!-- <?php if ($this->session->flashdata('error_msg') != "") { ?>
            <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong> <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
        <?php } ?> -->

        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form method="post" action="<?php echo site_url('login'); ?>" name="loginform">
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="email" required="required"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="password" class="form-control" type="password" name="password" placeholder="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-key"></i>&nbsp;login</button>
                </div>
       
            </form>
        </div>  
    </div>

