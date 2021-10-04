
<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1> Loan Overview 
        <?php 
            $userSessionData = $this->session->admin_login_data;
            if ($userSessionData['admin_type'] != 'super_admin') 
            {
        ?> 
            <a href="<?php echo site_url("/loan"); ?>" class="btn btn-success pull-right">Back</a>
        <?php } else { ?>
            <a href="<?php echo site_url("/loan/superAdminLoan"); ?>" class="btn btn-success pull-right">Back</a>
        <?php }?>
        <?php  
        $loan_id = $loan->loan_id;
        $completed_date = $loan->completed_date;
        $amount = $loan->amount;
        $percentage = $loan->percentage;
        $payable_type = $loan->payable_type;
        $note = $loan->note;
        $created_date = date('D M d, Y', strtotime($loan->created_date));
        $date = $loan->created_date; 
    // loan intrest 
            $loan_intrest_per_month =  $amount / $percentage;
            $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
            $customer_intrest_day = $this->loanmodel->customer_intrest_day($date);

            if ($customer_intrest_day >= 365) 
            {
                $loan_intrest = 365 * $loan_intrest_per_day;
                $amount_with_interst = $loan_intrest + $amount;

                $loan_intrest_per_month =  $amount_with_interst / $percentage;
                $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                $customer_intrest_day = $customer_intrest_day - 365;
                $loan_intrest = $customer_intrest_day * $loan_intrest_per_day;
                $loan_amount_with_interst = $loan_intrest + $amount_with_interst;
            }
            else
            {
                $loan_intrest_per_month =  $amount / $percentage;
                $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                $loan_intrest = $customer_intrest_day * $loan_intrest_per_day;
                $loan_amount_with_interst = $loan_intrest + $amount;

            }
            if ($payable_type == 'cash')
            {
                $payable_types = 'cash' ;
            }
            else 
            {
                $loan_bank_data = $this->loanmodel->getbankdetails($loan_id);
                $loan_bank_chaque = $loan_bank_data->chaque;
                $payable_type = $loan_bank_data->bank_name;
                $payable_type .="(".$loan_bank_data->account_no.")" ;
            }
            $completed_loan_by_bank = $this->loanmodel->getCompleteLoanBankInfo($loan_id);
    ?> 

             <?php if ($completed_date != 0000-00-00) { ?>
                 <h2 style=" background-color: aqua; width: 100%;text-align: center;border-radius: 10px;padding:5px;">
                    <strong> This loan is completed</strong>
                </h2>
             <?php } ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                            <table class="table table-bordered table-hover dataTable no-footer" style="background: #f4f4f4;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 39.7667px;">Image</th>
                                        <th class="text-center" style="width: 207.767px;">Personal Details</th>
                                        <th class="text-center" style="width: 223.767px;">Contact Details</th>
                                        <th class="text-center" style="width: 131.767px;">Address</th>
                                        <th class="text-center" style="width: 90.7667px;">No. of Loan</th>
                                        <th class="text-center" style="width: 83.7667px;">Total Loan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            $customer_name  ="<span class='user_name'>".$customer_data->f_name." ".$customer_data->l_name."</span> S/O ".$customer_data->p_name."<br>";
                                            $contacts = "";
                                            $contacts.="<strong>Email:</strong> ".$customer_data->e_mail."<br>";
                                            $contacts.="<img src=".base_url()."assets/images/whatsapp.png> ".$customer_data->whatsapp."&nbsp&nbsp";
                                            $contacts.="<img src=".base_url()."assets/images/mobile.png> ".$customer_data->phone;
                                            $contacts.= "<br style='margin-bottom: 10px;'><span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'><strong>Aadhar No: </strong>".$customer_data->aadhar_no."</span><br>";
                                            $location = "";
                                            $location.= $customer_data->address."<br>";
                                            $location.=ucfirst($customer_data->city);
                                            $location.=" (".$customer_data->postal_code.") ";
                                            $location.=strtoupper($customer_data->state);

                                        
                                            $no_of_loan = "<span style='background: #fff300;padding: 2px 8px;color: black;border-radius:50px ;'>".$customer_data->no_of_loan."</span>";
                                            $total_loan = "<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'>₹ ".$customer_data->total_loan."</span><br>";
                                            $customer_image = "";
                                            if(!empty($customer_data->usr_img))
                                            {
                                                $customer_image ='<img src='.base_url().'images/profile/'.$customer_data->usr_img.' width="50" height="50" style="border-radius:50px;" onerror="this.onerror=null;this.src='.base_url().'assets/images/profile_img.jpg">';
                                            }
                                            else
                                            {
                                                $customer_image ='<img src='.base_url().'assets/images/profile_img.jpg width="70" height="70" style="border-radius:50px;">';
                                            }
                                         ?> 
                                       <td class="text-center" ><?php print_r($customer_image); ?></td>
                                       <td class="text-center" > <?php print_r($customer_name); ?></td>
                                       <td class="text-center"> <?php print_r($contacts); ?></td>
                                       <td class="text-center"> <?php print_r($location); ?></td>
                                       <td  class="text-center" ><?php print_r($no_of_loan); ?></td>
                                       <td class="text-center" ><?php print_r($total_loan); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label">Select Security Type </label>
                                            <input type="text"  class="form-control" disabled="" value="<?php print_r($loan->security); ?>" >
                                        </div>
                                        <?php if ($loan->security == 'gold' || $loan->security == 'gold_silver') {?>
                                             <div class="form-group col-sm-3 col-md-3">
                                                <label class="control-label ">Gold Price: </label>
                                                 <input type="text" disabled="" class="form-control" value="<?php print_r($loan->gold_current_rate); ?>" disable>
                                            </div>     
                                        <?php } ?>
                                         <?php if ($loan->security == 'silver' || $loan->security == 'gold_silver') {?>
                                             <div class="form-group col-sm-3 col-md-3">
                                                <label class="control-label ">Silver Price: </label>
                                                 <input type="text" disabled="" class="form-control" value="<?php print_r($loan->silver_current_rate); ?>">
                                            </div>
                                         <?php } ?>
                                    </div>
                                <?php  if ($loan->security == 'gold' || $loan->security == 'gold_silver') {?>
                                        <div id="appendGoldMultipleInputDiv">
                                        <h4><b>Gold Items</b></h4>
                                        <div id="appendGoldMultipleInputField" class="customGold">
                                     <?php $i=1; foreach ($loan_security as $gold ) {  if ($gold->item_type == 'gold') {?>
                                            <div class="row col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label asterisk">Name: </label>
                                                    <input type="text" class="form-control" value="<?php print_r($gold->item_name); ?>" disabled="" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label asterisk">Weight(gm): </label>
                                                    <input type="number" class="form-control" value="<?php print_r($gold->item_weight); ?>" disabled="" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label asterisk">Purity(%): </label>
                                                    <input type="number" class="form-control" value="<?php print_r($gold->item_purity); ?>" disabled="" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Value: </label>
                                                    <input type="number" class="form-control" value="<?php print_r( round($gold->item_value))?>" disabled="" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Quantity: </label>
                                                    <input type="number" class="form-control" value="<?php print_r($gold->item_quantity)?>" disabled="" >
                                                </div>
                                                <div class="form-group col-md-1">
                                                <img src="<?php echo $gold->item_photo;?>" style="width: 50px;height: 50px; border-radius: 50%;margin-top: 5px;">
                                                    <!-- <input type="file" name="gold_item_photo[]" onchange="readURLLoanGold(this, 2, <?php echo $i;?>);" style="height: 34px;"> -->
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <img id="loan_preview_gold_<?php echo $i;?>" src="#" alt="your image" style="display: none;">
                                                </div>
                                            </div>
                                    <?php  $i++; } } ?>
                                    </div>
                                    </div> 
                                <?php  }?>
                               <?php  if ($loan->security == 'silver' || $loan->security == 'gold_silver' ) {?>
                                     <h4><b>Silver Items</b></h4>
                                    <div id="appendSilverMultipleInputField" class="customSilver">
                               <?php $j = 1;  foreach ($loan_security as $silver) {  if ($silver->item_type == 'silver') {?>
                                
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-3">
                                                <label class="control-label ">Name: </label>
                                                <input type="text" class="form-control" value="<?php print_r($silver->item_name); ?>"  disabled="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label ">Weight(gm): </label>
                                                <input type="number" class="form-control" value="<?php print_r($silver->item_weight); ?>" disabled="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label ">Purity()%: </label>
                                                <input type="number" class="form-control" value="<?php print_r($silver->item_purity); ?>" disabled="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">Value: </label>
                                                <input type="number" class="form-control" value="<?php print_r($silver->item_value)?>"  disabled="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">Quantity: </label>
                                                <input type="number" class="form-control" value="<?php print_r($silver->item_quantity)?>" disabled="">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <img src="<?php echo $silver->item_photo;?>" style="width: 50px;height: 50px; border-radius: 50%;margin-top: 5px;">
                                                <!-- <input type="file" name="silver_item_photo[]" onchange="readURLLoanSilver(this, 2, <?php echo $j;?>);" style="height: 34px;"> -->
                                            </div>
                                            <div class="form-group col-md-1">
                                                <img id="loan_preview_silver_<?php echo $j;?>" src="#" alt="your image" style="display: none;" />
                                            </div>
                                        </div>
                                    
                            <?php $j++; } }?> </div>  <?php } ?>


                                    <div class="row">
                                        <div class="form-group col-sm-3 col-md-3 ">
                                            <label class="control-label  ">Loan Date</label>
                                            <input class="form-control" disabled="" value="<?php print_r($created_date); ?>"   > 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label ">Amount</label>
                                            <input class="form-control" disabled="" type="text" value="<?php print_r($amount); ?>"   >
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label ">Percentage</label>
                                            <input class="form-control"  disabled="" type="text" value="<?php print_r($percentage); ?>"  >
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label ">Payable Type: </label>
                                            <input class="form-control" disabled="" value="<?php print_r($payable_type); ?>"  >
                                        </div>
                                        <?php if ($payable_type != 'cash') { ?>
                                         <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label">Cheque Number</label>
                                            <input class="form-control" disabled="" value="<?php print_r($loan_bank_chaque); ?>"  >
                                        </div>
                                      <?php } ?>
                                        <?php if (!empty($note)) {?>
                                        <div class="form-group col-sm-12 col-md-12">
                                            <label class="control-label">Extra Note</label>
                                            <input class="form-control" disabled=""  type="text" value="<?php print_r($note); ?>"  >
                                        </div>
                                        <?php } ?>
                                    </div>
                                     <div class="row">

                                        <div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label "><strong>Amount With Intrest</strong></label>
                                            <input class="form-control" disabled=""  type="text" value="<?php print_r( round($loan_amount_with_interst) ); ?>"  >
                                          <!--  <h2 style=" background-color: aqua; "><strong> <i class='fa fa-rupee'></i> <?php print_r( round($loan_amount_with_interst) ); ?></strong></h2> -->
                                        </div>
                                      
                                    </div>
                                    <?php if ($completed_date == 0000-00-00) { ?>
                                    <?php 
                                        $userSessionData = $this->session->admin_login_data;
                                        if ($userSessionData['admin_type'] != 'super_admin') 
                                        {
                                    ?> 
                                     <div class="row">
                                        <div class="form-group col-sm-3 col-md-3">
                                            <button type="button" data-toggle="modal" id="completeTransactionBtn" data-target="#completeTransactionModal" class="btn btn-primary bg_green">Complete</button>
                                        </div>
                                    </div>
                                <?php } } else if(isset($completed_loan_by_bank) && !empty($completed_loan_by_bank)) { ?>

                                    <h2 style=" background-color: aqua; width: 100%;text-align: center;border-radius: 10px;padding:5px;">
                                        <strong> This loan is completed by bank</strong>
                                    </h2>
                                    <div class="customSilver" style="background-color: #eae7e7 !important">
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4">
                                                <label class="control-label ">Account Holder Name </label>
                                                <input type="text" class="form-control" value="<?php echo $completed_loan_by_bank->account_holder_name;?>" disabled="" style="background-color: #fff !important;">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label ">Bank Name: </label>
                                                <input type="text" class="form-control" value="<?php echo $completed_loan_by_bank->bank_name;?>"  disabled="" style="background-color: #fff !important;">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label ">Account Number </label>
                                                <input type="text" class="form-control" value="<?php echo $completed_loan_by_bank->account_no;?>" disabled="" style="background-color: #fff !important;">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">IFSC Code </label>
                                                <input type="text" class="form-control" value="<?php echo $completed_loan_by_bank->ifsc_code;?>"  disabled="" style="background-color: #fff !important;">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <?php if(isset($completed_loan_by_bank->cheque_number) && !empty($completed_loan_by_bank->cheque_number)) { ?>
                                                <label class="control-label">Cheque Number </label>
                                                <input type="text" class="form-control" value="<?php echo $completed_loan_by_bank->cheque_number;?>" disabled="" style="background-color: #fff !important;">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else if(!isset($completed_loan_by_bank) && empty($completed_loan_by_bank)) { ?>
                                    <h2 style=" background-color: aqua; width: 100%;text-align: center;border-radius: 10px;padding:5px;">
                                        <strong> This loan is completed by cash</strong>
                                    </h2>
                                <?php }?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<div id="completeTransactionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Complete Transaction</b></h4>
            </div>
            
            <form method="post" action="javascript:void(0);" name="completeTransactionForm" id="completeTransactionForm"> 
                <div class="modal-body">  
                    <div class="row">
                        <input type="hidden" name="customer_id" id="customer_id" value="<?php print_r($loan->customer_id); ?>">
                        <input type="hidden" name="loan_id" id="loan_id" value="<?php print_r($loan_id); ?>">
                        <!-- <input type="hidden" name="amount" id="amount" value="<?php print_r($amount); ?>"> -->
                        <input type="hidden" name="completed_date" id="completed_date" value="<?php print_r($completed_date); ?>">
                        <input type="hidden" name="amount" id="amount" value="<?php print_r($amount); ?>">
                        

                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label">Customer Name</label>
                            <input class="form-control" type="text" name="customer_name" value="<?php echo $customer_data->f_name; ?>" readonly>
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label">Amount</label>
                          <input class="form-control" type="text" name="amount_with_interst" value="<?php print_r( round($loan_amount_with_interst) ); ?>" readonly> 
                           <!--  <input class="form-control" type="text" name="amount" value="<?php print_r($amount); ?>" readonly> -->
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label asterisk">Payable Type: </label>
                            <select class="form-control" id="recivable_type" name="recivable_type" onchange="completeTrasactionType();">
                                <option value="cash"> CASH</option>
                                <option value="bank"> BANK</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 col-md-4" style="display: none;" id="account_no">
                            <label class="control-label asterisk">Account Number</label>
                            <input class="form-control" type="number" name="account_no" id="account_no_input" value="">
                            <span class="error" id="account_no_error" style="display: none;">Please enter account number</span>
                        </div>
                        <div class="form-group col-sm-3 col-md-4" style="display: none;" id="account_holder_name">
                            <label class="control-label asterisk">Account Holder Number</label>
                            <input class="form-control" type="text" name="account_holder_name" id="account_holder_name_input" value="">
                            <span class="error" id="account_holder_name_error" style="display: none;">Please enter account holder name</span>
                        </div>
                        <div class="form-group col-sm-3 col-md-4" style="display: none;" id="bank_name">
                            <label class="control-label asterisk">Bank Name</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name_input" value="">
                            <span class="error" id="bank_name_error" style="display: none;">Please enter bank name</span>
                        </div>
                        <div class="form-group col-sm-3 col-md-4" style="display: none;" id="ifsc_code">
                            <label class="control-label asterisk">IFSC Code</label>
                            <input class="form-control" type="text" name="ifsc_code" id="ifsc_code_input" value="">
                            <span class="error" id="ifsc_code_error" style="display: none;">Please enter ifsc code</span>
                        </div>
                         <div class="form-group col-sm-3 col-md-4" style="display: none;" id="cheque_detail">
                            <label class="control-label">Cheque Number</label>
                            <input class="form-control" type="text" name="cheque_number" id="Cheque_Number_input">
                            <span class="error" id="cheque_detail_error" style="display: none;">Please enter cheque number</span>
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