<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>
            Exepend List

            <?php 
                $userSessionData = $this->session->admin_login_data;
                if ($userSessionData['admin_type'] != 'super_admin') {
            ?>
                <a id="loadbasic" href="javascript:void(0);" data-toggle="modal" data-target="#addPersonal_expenses" class="btn btn-primary pull-right">
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
                                    <table id="expend_table" class="table table-bordered table-hover" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <!-- <th class="text-center">No</th> -->
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Paybale Type</th>
                                                <th class="text-center">Chaqe No.</th>
                                                <th class="text-center">Creatde Date</th>
                                                <th class="text-center">Region</th>
                                                <!-- <th class="text-center">Admin</th> -->
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

 <div id="addPersonal_expenses" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class=" font_weight600">PERSONAL EXPENSES</h3>
            </div>
            <form method="post" action="javascript:void(0);" name="amountExpendForm" id="amountExpendForm"> 
                <div class="modal-body">  
                    <div class="row">

                        <div class="form-group col-sm-3 col-md-3">
                            <label class="control-label asterisk">Amount</label>
                            <input class="form-control" type="text" name="amount_expend" id="amount_expend"  placeholder="Enter  amount">
                        </div>
                        <div class="form-group col-sm-3 col-md-3">
                            <label class="control-label asterisk">Created Date</label>
                            <input class="form-control normal_datepicker" type="date" name="created_date" id="created_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Enter loan amount">
                        </div>
                        <div class="form-group col-sm-3 col-md-3">
                            <label class="control-label asterisk">Payable Type: </label>
                            <select class="form-control " id="payable_type" name="payable_type" onchange="expendcheckTrasactionType();">
                                <option value="">Select Amount Type </option>
                                <option value="cash"> CASH</option>
                                <?php foreach ($data['bank_details'] as $bank) { ?>
                                <option value="<?php echo $bank->bank_id;?>" >
                                    <?php echo $bank->bank_name; ?> (<?php echo $bank->account_no; ?>)
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-md-3" style="display: none;" id="cheque_detail">
                            <label class="control-label">Cheque Number</label>
                            <input class="form-control" type="text" name="Cheque_Number" id="Cheque_Number" placeholder="Enter cheque Number">
                        </div>
                        <div class="form-group col-sm-12 col-md-12">
                            <label class="control-label asterisk">Region</label>
                            <textarea class="form-control" name="region" id="region" placeholder="Enter loan details"></textarea>
                        </div>
                    </div>
                </div>        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>    
            </form> 
        </div>
    </div>
</div>



<div id="editPersonal_expenses" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class=" font_weight600">Edit PERSONAL EXPENSES</h3>
            </div>
            <form name="editExpendForm" id="editExpendForm" method="post" action="javascript:void(0);"> 
                <div id="edit_expenses" class="modal-body">  
                     
                </div>         
            </form> 
        </div>
    </div>
</div>