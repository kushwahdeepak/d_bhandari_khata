<body id="resultBody" class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo site_url('admin'); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>BK</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"> 
                    Bhandari Khata
                    <!-- <img class="img-responsive" src="<?php echo base_url(); ?>images/logo.png" style="height: 60px;width: 230px;">  -->
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="<?php echo site_url('login/logout'); ?>"> 
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
            $userSessionData = $this->session->admin_login_data;
            $userInfo = $this->adminmodel->getUserBasicInfo($userSessionData['admin_id']);

            if(!isset($data) && empty($data))
            {
                $data['pageName'] = $pageName;
            }

        ?>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" style="height: auto;">
                <div class="user-panel" style="padding-bottom: 15px;">
                    <div class="pull-left image">
                        <?php if (empty($userInfo->admin_img)) { ?>
                            <img class="profile-user-img img-responsive" src="<?php echo base_url(); ?>assets/images/profile_img.jpg">
                        <?php } else { ?>
                            <img id="adminProfilePicture" class="profile-user-img img-responsive" src="<?php echo base_url()."images/profile/".$userInfo->admin_img; ?>" onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/images/profile_img.jpg';">
                        <?php } ?>
                    </div>
                    <div class="pull-left info">
                        <p><?php echo ucfirst($userInfo->f_name)." ".$userInfo->l_name; ?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- Sidebar user panel -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    

                    <?php if ($userSessionData['admin_type'] == 'super_admin') { ?>
                        <?php echo($data['pageName'] == "ACCOUNT" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);"  onclick="loadPageWithoutRefresh('<?php echo site_url()."/admin/index"; ?>')">
                                <i class="fa fa-user"></i> <span>Account</span>
                            </a>
                        </li>

                        <?php echo($data['pageName'] == "SUBADMIN" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);"  onclick="loadPageWithoutRefresh('<?php echo site_url()."/admin/subadmin"; ?>')">
                                <i class="fa fa-user-plus"></i> <span>Users</span>
                            </a>
                        </li>

                        <?php echo($data['pageName'] == "CUSTOMER" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/customer/superAdminCustomer"; ?>')">
                                <i class="fa fa-users"></i> <span>Customer</span>
                            </a>
                        </li>
                        <?php echo($data['pageName'] == "LOAN" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/loan/superAdminLoan"; ?>')">
                                <i class="fa fa-money"></i> <span>Loan</span>
                            </a>
                        </li>
                        <?php echo($data['pageName'] == "EXPAND" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/expend/superAdminExpend"; ?>')">
                                <i class="fa fa-credit-card-alt"></i> <span>Personal Expenses</span>
                            </a>
                        </li>
                        <?php echo($data['pageName'] == "TRANSECTION" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/transaction/superAdminTransactionPage"; ?>')"><i class="fa fa-credit-card"></i> <span>Transaction</span>
                            </a>
                        </li>
                    <?php } else { ?>                        

                        <?php echo($data['pageName'] == "DASHBOARD" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/admin/dashboard"; ?>')">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <?php echo($data['pageName'] == "ACCOUNT" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);"  onclick="loadPageWithoutRefresh('<?php echo site_url()."/admin/index"; ?>')">
                                <i class="fa fa-user"></i> <span>Account</span>
                            </a>
                        </li>

                        <?php echo($data['pageName'] == "CUSTOMER" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/customer/index"; ?>')">
                                <i class="fa fa-users"></i> <span>Customer</span>
                            </a>
                        </li>
                        <?php echo($data['pageName'] == "LOAN" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/loan/index"; ?>')">
                                <i class="fa fa-money"></i> <span>Loan</span>
                            </a>
                        </li>
                        <?php echo($data['pageName'] == "EXPAND" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/expend/index"; ?>')">
                                <i class="fa fa-credit-card-alt"></i> <span>Personal Expenses</span>
                            </a>
                        </li>
                        <?php echo($data['pageName'] == "TRANSECTION" ? "<li class='active'>" : "<li>"); ?>
                            <a href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/transaction/index"; ?>')"><i class="fa fa-credit-card"></i> <span>Transaction</span>
                            </a>
                        </li>
                    <?php }?>
                   
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>