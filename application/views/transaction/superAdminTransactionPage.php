<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>
            Transaction List
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
                                    <table id="super_admin_tarnsection_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <!-- <th class="text-center">No.</th> -->
                                                <th class="text-center"> Amount</th>
                                                <th class="text-center"> Purpose</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Admin</th>
                                                <!-- <th class="text-center">Deleted Date</th> -->
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
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

 