
<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1> Loan Overview  
        <a href="<?php echo site_url("/loan"); ?>" class="btn btn-success pull-right">Back</a>
        <!-- <?php  
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
            elseif ($payable_type == 'bank')  
            {
                $loan_bank_data = $this->loanmodel->getbankdetails($loan_id);
                $loan_bank_chaque = $loan_bank_data->chaque;
                $payable_type = $loan_bank_data->bank_name;
                $payable_type .="(".$loan_bank_data->account_no.")" ;
             }
    ?> -->

             <?php if ($completed_date != 0000-00-00) { ?>
                 <h2 style=" background-color: aqua; width: 400px; "><strong> ( This loan Completed )</strong></h2>
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
                                        <th class="" style="width: 223.767px;">Contact Details</th>
                                        <th class="" style="width: 131.767px;">Address</th>
                                        <th class="text-center" style="width: 90.7667px;">No. of Loan</th>
                                        <th class="text-center" style="width: 83.7667px;">Total Loan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <?php 
                                            $customer_name  ="<span class='user_name'>".$customer_data->f_name."</span> S/O ".$customer_data->p_name."<br>";
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

                                        
                                            $no_of_loan = "<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'>".$customer_data->no_of_loan."</span>";
                                            $total_loan = "<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'>".$customer_data->total_loan."</span><br>";
                                            $customer_image = "";
                                            if(!empty($customer_data->usr_img))
                                            {
                                                $customer_image ='<img src='.base_url().'images/profile/'.$customer_data->usr_img.' width="50" height="50" style="border-radius:50px;" onerror="this.onerror=null;this.src='.base_url().'assets/images/profile_img.jpg">';
                                            }
                                            else
                                            {
                                                $customer_image ='<img src='.base_url().'assets/images/profile_img.jpg width="70" height="70" style="border-radius:50px;">';
                                            }
                                         ?> -->
                                       <td class="text-center" ><?php print_r($customer_image); ?></td>
                                       <td class="text-center" > <?php print_r($customer_name); ?></td>
                                       <td class=""> <?php print_r($contacts); ?></td>
                                       <td class=""> <?php print_r($location); ?></td>
                                       <td  class="text-center" ><?php print_r($no_of_loan); ?></td>
                                       <td class="text-center" ><?php print_r($total_loan); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                           <!--  <?php  if ($data['security'] == 'gold') {?>
                                <div class="row">
                                    <div class="form-group col-sm-3 col-md-3">
                                        <label class="control-label asterisk">Select Security Type </label>
                                        <input type="text"  class="form-control" disabled="" value="<?php print_r($data['security_details']); ?>" >
                                    </div>
                                    <div id="appendSecurityTypeInput">
                                        <div class="col-sm-3 col-md-3 input-group input-group-custom">
                                            <label class="control-label asterisk">Gold Price: </label>
                                             <input type="text" disabled="" class="form-control" value="<?php print_r($data['gold_current_rate']); ?>" disable>
                                        </div>
                                     </div>
                                </div>
                                <div id="appendGoldMultipleInputDiv">
                                    <h4><b>Gold Items</b></h4>
                                    <div id="appendGoldMultipleInputField" class="customGold">
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4">
                                                <label class="control-label asterisk">Name: </label>
                                                <input type="text" class="form-control" value="<?php print_r($data['item_name']); ?>" disabled="" >
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label asterisk">Weight(gm): </label>
                                                <input type="number" class="form-control" value="<?php print_r($data['security_item_weight']); ?>" disabled="" >
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label asterisk">Purity(%): </label>
                                                <input type="number" class="form-control" value="<?php print_r($data['security_item_purity']); ?>" disabled="" >
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label">Value: </label>
                                                <input type="number" class="form-control" value="<?php print_r( round($data['item_value']))?>" disabled="" >
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="control-label">Quantity: </label>
                                                <input type="number" class="form-control" value="<?php print_r($data['item_quantity'])?>" disabled="" >
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">Image: </label>
                                                <input type="file" name="gold_item_photo[]" onchange="readURLLoanGold(this);" style="height: 34px;">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <img id="loan_preview_gold" src="#" alt="your image" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                                    <?php if ($data['security'] == 'silver') { ?>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label class="control-label asterisk">Select Security Type </label>
                                                <input type="text"  class="form-control" disabled="" value="<?php print_r($data['security_details']); ?>">
                                            </div>
                                           
                                            <div id="appendSecurityTypeInput">
                                                <div class="col-sm-3 col-md-3 input-group input-group-custom">
                                                    <label class="control-label asterisk">Silver Price: </label>
                                                     <input type="text" disabled="" class="form-control" value="<?php print_r($data['silver_current_rate']); ?>">
                                                </div>
                                             </div>
                                        </div>
                                        <h4><b>Silver Items</b></h4>
                                            <div id="appendSilverMultipleInputField" class="customSilver">
                                                <div class="row col-md-12">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label ">Name: </label>
                                                        <input type="text" class="form-control" value="<?php print_r($data['item_name']); ?>"  disabled="">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label class="control-label ">Weight(gm): </label>
                                                        <input type="number" class="form-control" value="<?php print_r($data['security_item_weight']); ?>" disabled="">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label class="control-label ">Purity()%: </label>
                                                        <input type="number" class="form-control" value="<?php print_r($data['security_item_purity']); ?>" disabled="">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label class="control-label">Value: </label>
                                                        <input type="number" class="form-control" value="<?php print_r( round($data['item_value']))?>"  disabled="">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label class="control-label">Quantity: </label>
                                                        <input type="number" class="form-control" value="<?php print_r($data['item_quantity'])?>" disabled="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label">Image: </label>
                                                        <input type="file" name="silver_item_photo[]" onchange="readURLLoanSilver(this);" style="height: 34px;">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <img id="loan_preview_silver" src="#" alt="your image" style="display: none;" />
                                                    </div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                    <?php if ($data['security'] == 'gold_silver') { ?>
                                         <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label class="control-label asterisk">Select Security Type </label>
                                                <input type="text"  class="form-control" disabled="" value="<?php print_r($data['security_details']); ?>">
                                            </div>

                                             <div id="appendSecurityTypeInput">
                                                <div class="form-group col-sm-3 col-md-3">
                                                    <label class="control-label asterisk">Gold Price: </label>
                                                     <input type="text" disabled="" class="form-control" value="<?php print_r($data['gold_current_rate']); ?>" disable>
                                                </div>
                                             
                                                <div class="form-group col-sm-3 col-md-3">
                                                    <label class="control-label asterisk">Silver Price: </label>
                                                     <input type="text" disabled="" class="form-control" value="<?php print_r($data['silver_current_rate']); ?>">
                                                </div>
                                             </div>
                                        </div>
                                          <div id="appendGoldMultipleInputDiv">
                                                <h4><b>Gold Items</b></h4>
                                                <div id="appendGoldMultipleInputField" class="customGold">
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label asterisk">Name: </label>
                                                            <input type="text" class="form-control" value="<?php print_r($data['item_name']); ?>" disabled="" >
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label asterisk">Weight(gm): </label>
                                                            <input type="number" class="form-control" value="<?php print_r($data['security_item_weight']); ?>" disabled="" >
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label asterisk">Purity(%): </label>
                                                            <input type="number" class="form-control" value="<?php print_r($data['security_item_purity']); ?>" disabled="" >
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label">Value: </label>
                                                            <input type="number" class="form-control" value="<?php print_r( round($data['item_value']))?>" disabled="" >
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label">Quantity: </label>
                                                            <input type="number" class="form-control" value="<?php print_r($data['item_quantity'])?>" disabled="" >
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label">Image: </label>
                                                            <input type="file" name="gold_item_photo[]" onchange="readURLLoanGold(this);" style="height: 34px;">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <img id="loan_preview_gold" src="#" alt="your image" style="display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="appendSilverMultipleInputDiv"> 
                                                <h4><b>Silver Items</b></h4>
                                                <div id="appendSilverMultipleInputField" class="customSilver">
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label ">Name: </label>
                                                            <input type="text" class="form-control" value="<?php print_r($data['item_name']); ?>"  disabled="">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label ">Weight(gm): </label>
                                                            <input type="number" class="form-control" value="<?php print_r($data['security_item_weight']); ?>" disabled="">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label ">Purity()%: </label>
                                                            <input type="number" class="form-control" value="<?php print_r($data['security_item_purity']); ?>" disabled="">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label">Value: </label>
                                                            <input type="number" class="form-control" value="<?php print_r( round($data['item_value']))?>"  disabled="">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label class="control-label">Quantity: </label>
                                                            <input type="number" class="form-control" value="<?php print_r($data['item_quantity'])?>" disabled="">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label">Image: </label>
                                                            <input type="file" name="silver_item_photo[]" onchange="readURLLoanSilver(this);" style="height: 34px;">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <img id="loan_preview_silver" src="#" alt="your image" style="display: none;" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php } ?> -->

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
                                           <h2 style=" background-color: aqua; "><strong> <i class='fa fa-rupee'></i> <?php print_r( round($loan_amount_with_interst) ); ?></strong></h2>
                                        </div>
                                      
                                    </div>
                                    <?php if ($completed_date == 0000-00-00) { ?>
                                     <div class="row">
                                        <div class="form-group col-sm-3 col-md-3">
                                            <form name="CompliteLoan" method="post" id="CompliteLoan" action="javascript:void(0);">
                                                <input type="hidden" name="customer_id" id="customer_id" value="<?php print_r($loan_id); ?>">
                                                <input type="hidden" name="lone_id" id="lone_id" value="<?php print_r($customer_id); ?>">
                                                <input type="hidden" name="amount" id="amount" value="<?php print_r($amount); ?>">
                                                 <input type="hidden" name="completed_date" id="completed_date" value="<?php print_r($completed_date); ?>">
                                                <button type="submit" class="btn btn-primary bg_green">complete</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>