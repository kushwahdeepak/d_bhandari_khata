<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>
            Loan Details List
            <?php 
                $userSessionData = $this->session->admin_login_data;
                if ($userSessionData['admin_type'] != 'super_admin') {
            ?>
                <a id="loadbasic" href="javascript:void(0);" onclick="loadPageWithoutRefresh('<?php echo site_url()."/loan/addLoanDetailsPage"; ?>')"  class="btn btn-primary pull-right">
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
                                <select name="search_by_name" id="search_by_name" class="form-control" onchange="onSelectCustomer()" style="width: 15%;margin-bottom: 1%;">
                                    <option value="name">Search By Admin</option>
                                    <?php 
                                        if(isset($data['sub_admins']) && !empty($data['sub_admins']))
                                        {
                                            foreach($data['sub_admins'] as $admin) {
                                    ?>
                                        <option value="<?php echo $admin->admin_id;?>">
                                            <?php echo $admin->f_name; echo(" "); echo $admin->l_name; ?>
                                        </option>
                                    <?php } } ?>
                                </select>
                                <input type="hidden" id="search_name" name="search_name" value="name">
                                <div class="user_list table-responsive">
                                    <table id="loan_super_admin_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Customer Name</th>
                                                <th class="">Customer Contact</th>
                                                <th class="">Address</th>
                                                <th class="text-center">Security Details</th>
                                                <th class="text-center">Loan </th>
                                                <th class="text-center">Date</th>
                                                <!-- <th class="text-center">Note</th> -->
                                                <th class="text-center">Admin</th>
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