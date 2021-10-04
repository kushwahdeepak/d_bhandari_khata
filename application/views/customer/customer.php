<div id="resultBody">

<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>
            Customer List

            <?php 
                $userSessionData = $this->session->admin_login_data;
                if ($userSessionData['admin_type'] != 'super_admin') {
            ?>
                <a id="loadbasic" href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/customer/addCustomerDetailsPage"; ?>')"  class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i>
                </a>
            <?php } ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="user_list table-responsive">
                                    <table id="customer_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Personal Details</th>
                                                <th class="">Contact Details</th>
                                                <th class="">Address</th>
                                                <th class="text-center">No. of Loan</th>
                                                <th class="text-center">Total Loan</th>
                                                <!-- <th class="text-center">Admin</th> -->
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>






