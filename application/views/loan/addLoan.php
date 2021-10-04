<div class="loan-class content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1> Add Loan Details
        <a href="<?php echo site_url("/loan"); ?>" class="btn btn-success pull-right">Back</a>
        </h1>
        <input type="hidden" id="gold_price_by_system" value="<?php echo $data['rate']->gold; ?>">
        <input type="hidden" id="silver_price_by_system" value="<?php echo $data['rate']->silver; ?>">
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form name="addLoanDetails" method="post" id="addLoanDetails" action="javascript:void(0);" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label class="control-label asterisk">Select Customer: </label>
                                    <select class="form-control pull-left" id="loan_customer_id" name="customer_id" onchange="getCustomerOverviewData();">
                                        <option value="">Select Customer</option>

                                        <?php foreach ($data['details'] as $customer) { ?>
                                            <option value="<?php echo $customer->customer_id;?>">
                                            <?php echo $customer->f_name.' '.$customer->l_name; ?>
                                            </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div id="showSelectedCustomerData"></div>                        

                            <div id="selectSecurityTypeSection" style="display: none; padding-top: 15px;">
                                <div class="row">
                                    <div class="form-group col-sm-3 col-md-3">
                                        <label class="control-label asterisk">Select Security Type </label>
                                        <select class="form-control" id="security" name="security" onchange="checkSecurityType();">
                                            <option value="">Select Security Type</option>
                                            <option value="gold">Gold</option>
                                            <option value="silver">Silver</option>
                                            <option value="gold_silver">Gold and Silver</option>
                                            <option value="none">none</option>
                                        </select>
                                    </div>
                                    <div id="appendSecurityTypeInput"></div>
                                </div>

                                <div id="appendGoldMultipleInputDiv"></div>
                                <div id="appendSilverMultipleInputDiv"></div>

                                <div style="display: none;" id="bankdetail">
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-md-3 ">
                                            <label class="control-label asterisk ">Loan Date</label>
                                            <input class="form-control normal_datepicker " type="date" name="loan_date" value="<?php echo date("Y-m-d"); ?>"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label asterisk">Amount</label>
                                            <input class="form-control" type="text" name="amount" placeholder="Enter loan amount">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label asterisk">Percentage</label>
                                            <input class="form-control" type="text" name="percentage" placeholder="Enter loan percentage">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label asterisk">Payable Type: </label>
                                            <select class="form-control asterisk" id="trasactionType" name="trasactionType" onchange="checkTrasactionType();">
                                                <option value="">Select Amount Type </option>
                                                <option value="cash"> CASH</option>
                                                <?php foreach ($data['bank_details'] as $bank) { ?>
                                                <option value="<?php echo $bank->bank_id;?>" >
                                                    <?php echo $bank->bank_name; ?> (<?php echo $bank->account_no; ?>)
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                         <div class="form-group col-sm-3 col-md-3" style="display: none;" id="cheque_details">
                                            <label class="control-label">Cheque Number</label>
                                            <input class="form-control" type="text" name="cheque" placeholder="Enter cheque Number">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12">
                                            <label class="control-label">Extra Note</label>
                                            <textarea class="form-control" name="note" placeholder="Enter loan details"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary bg_green">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>