

<!--
    KARYON SOLUTIONS CONFidENTIAL
    __________________
    
      Author : Sudeep Gandhi
      Url - http://www.karyonsolutions.com  
      [2016] - [2017] Karyon Solutions 
      All Rights Reserved.
    
    NOTICE:  All information contained herein is, and remains
    the property of Karyon Solutions and its suppliers,
    if any.  The intellectual and technical concepts contained
    herein are proprietary to Karyon Solutions
    and its suppliers and may be covered by Indian and Foreign Patents,
    patents in process, and are protected by trade secret or copyright law.
    Dissemination of this information or reproduction of this material
    is strictly forbidden unless prior written permission is obtained
    from Karyon Solutions.
    -->
    <?php $userSessionData = $this->session->admin_login_data; ?>
<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>User Profile</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom" id="accountDivId">
                    <ul class="nav nav-tabs">
                        <li class="<?php if($data['active'] == "basic_info") echo "active"; ?>">
                            <a href="#editBasicInfo" data-toggle="tab" onclick="checkAccountActiveTab('basic_info');">Basic Info</a>
                        </li>
                        <?php if ($userSessionData['admin_type'] != 'super_admin') {?>
                        <li class="<?php if($data['active'] == "intial_investment") echo "active"; ?>">
                            <a href="#edit_intial_investment" data-toggle="tab" onclick="checkAccountActiveTab('intial_investment');">Initial Investment</a>
                        </li>
                        <li class="<?php if($data['active'] == "bank_details") echo "active"; ?>">
                            <a href="#bank_details" data-toggle="tab"  onclick="checkAccountActiveTab('bank_details');">Bank Details</a>
                        </li>
                        <li class="<?php if($data['active'] == "rate_table") echo "active"; ?>">
                            <a href="#editRate" data-toggle="tab"  onclick="checkAccountActiveTab('rate_table');">Rate</a>
                        </li>
                        <?php } ?>
                        <li class="<?php if($data['active'] == "profile_image") echo "active"; ?>">
                            <a href="#editprofile" data-toggle="tab"  onclick="checkAccountActiveTab('profile_image');">Profile Image</a>
                        </li>
                        <li class="<?php if($data['active'] == "change_password") echo "active"; ?>">
                            <a href="#editpassword" data-toggle="tab" onclick="checkAccountActiveTab('change_password');">Change Password</a>
                        </li>
                        <li class="pull-right <?php if($data['active'] == "profile_image") echo "active"; ?>">
                            <button href="javascript:void(0);" data-toggle="modal" data-target="#addBank" class="btn btn-primary" style="display: none;" id="addbankbtn"><i class="fa fa-plus"></i></button>
                        </li>
                        <li class="pull-right <?php if($data['active'] == "rate_table") echo "active"; ?>">
                            <button href="javascript:void(0);" data-toggle="modal" data-target="#editRateBtn" class="btn btn-primary" style="display: none;" id="editratebtn"><i class="fa fa-pencil"></i></button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?php if ($data['active'] == "profile_image") echo "active"; ?>" id="editprofile" enctype="multipart/form-data">
                            <form name="updateprofileimage" class="form-horizontal" action="javascript:void(0);"
                                method="POST" enctype="multipart/form-data" id="updateprofileimage">
                                <input type="hidden" name="admin_id" value="<?php echo $data['admin_id'];?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="profileimage" type="file" name="image" onchange="readURL(this);">
                                        <img id="preview" src="#" alt="your image" style="display: none;" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-prmary-background font_bold">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($data['active'] == "bank_details") echo "active"; ?>" id="bank_details">
                            <div class="box box-primary" style="border: none;">
                                <div class="box-body">
                                    <div class="user_list table-responsive">
                                        <table id="bank_details_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-left">Account Details</th>
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
                        <div class="tab-pane <?php if ($data['active'] == "basic_info") echo "active"; ?>" id="editBasicInfo">
                            <br/>
                            <form name="updatebasicinfo" class="form-horizontal" action="javascript:void(0);"
                                method="POST" id="updatebasicinfo">
                                <input type="hidden" name="admin_id" value="<?php echo $data['admin_id'];?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Email (username)</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo'])) { ?>
                                        <input type="text" class="form-control" name="e_mail"
                                            value="<?php if (!empty($data['adminBasicInfo']->e_mail)) echo $data['adminBasicInfo']->e_mail; ?>" required readonly/>
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="user_login_id" required="required"/>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">First Name</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->f_name)) { ?>
                                        <input type="text" class="form-control" name="f_name"
                                            value="<?php if (!empty($data['adminBasicInfo']->f_name)) echo $data['adminBasicInfo']->f_name; ?>"
                                            required="required" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="f_name" required="required" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Last Name</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->l_name)) { ?>
                                        <input type="text" class="form-control" name="l_name"
                                            value="<?php if (!empty($data['adminBasicInfo']->l_name)) echo $data['adminBasicInfo']->l_name; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="l_name" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Phone</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->phone)) { ?>
                                        <input type="text" class="form-control" name="phone"
                                            value="<?php if (!empty($data['adminBasicInfo']->phone)) echo $data['adminBasicInfo']->phone; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="phone" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Name Of Organisation</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->name_of_organisation)) { ?>
                                        <input type="text" class="form-control" name="name_of_organisation"
                                            value="<?php if (!empty($data['adminBasicInfo']->name_of_organisation)) echo $data['adminBasicInfo']->name_of_organisation; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="name_of_organisation" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Establish Year</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->establish_year)) { ?>
                                        <input type="date" class="form-control" name="establish_year"
                                            value="<?php if (!empty($data['adminBasicInfo']->establish_year)) echo $data['adminBasicInfo']->establish_year; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="date" class="form-control" name="establish_year" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Registration No.</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->registration_no)) { ?>
                                        <input type="text" class="form-control" name="registration_no"
                                            value="<?php if (!empty($data['adminBasicInfo']->registration_no)) echo $data['adminBasicInfo']->registration_no; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="registration_no" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">City</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->city)) { ?>
                                        <input type="text" class="form-control" name="city"
                                            value="<?php if (!empty($data['adminBasicInfo']->city)) echo $data['adminBasicInfo']->city; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="city" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">State</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->state)) { ?>
                                        <input type="text" class="form-control" name="state"
                                            value="<?php if (!empty($data['adminBasicInfo']->state)) echo $data['adminBasicInfo']->state; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="state" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Address</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->address)) { ?>
                                        <input type="text" class="form-control" name="address"
                                            value="<?php if (!empty($data['adminBasicInfo']->address)) echo $data['adminBasicInfo']->address; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="address" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Postal Code</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->postal_code)) { ?>
                                        <input type="text" class="form-control" name="postal_code"
                                            value="<?php if (!empty($data['adminBasicInfo']->postal_code)) echo $data['adminBasicInfo']->postal_code; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="postal_code" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Aadhar No.</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->aadhar_no)) { ?>
                                        <input type="text" class="form-control" name="aadhar_no"
                                            value="<?php if (!empty($data['adminBasicInfo']->aadhar_no)) echo $data['adminBasicInfo']->aadhar_no; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="aadhar_no" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-prmary-background font_bold" value="Update">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($data['active'] == "change_password") echo "active"; ?>" id="editpassword">
                            <br/>
                            <form name="change_password" class="form-horizontal" action="javascript:void(0);" method="POST" id="change_password">
                                <input type="hidden" name="party_id" value="<?php echo $data['admin_id'];?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">New Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="new_password" id="new_password" required="required"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Re-Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="con_new_password" required="required">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-prmary-background font_bold">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($data['active'] == "intial_investment") echo "active"; ?>" id="edit_intial_investment">
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addInitialAmount" style="margin-bottom: 5px;">
                                            <b>Add Initial Investment</b>
                                        </button>
                                    </div>
                                </div>
                            <form name="intial_investment" class="form-horizontal" action="javascript:void(0);" method="POST" id="intial_investment">
                                <input type="hidden" name="admin_id" value="<?php echo $data['admin_id'];?>">
                                
                                 <div class="form-group">    
                                        <label class="col-sm-2 control-label asterisk">Intial Investment</label> 
                                        <div class="col-md-10">   
                                            <input type="text" class="form-control" name="profit_amount" id="profit_amount" disabled="" class="yellow-cir"
                                            value=" ₹ <?php  echo $data['adminBasicInfo']->initial_investment_by_admin?>"  required="required">
                                        </div>
                                 </div> 

                                <div class="form-group">
                                    <label class="col-sm-2 control-label asterisk">Remaining Investment</label>
                                    <div class="col-md-10">
                                        <?php if (isset($data['adminBasicInfo']->intial_investment)) { ?>
                                        <input type="text" class="form-control" name="intial_investment" id="intial_investment" disabled="" class="yellow-cir"
                                            value=" ₹ <?php if (!empty($data['adminBasicInfo']->intial_investment)) echo $data['adminBasicInfo']->intial_investment; ?>" required="required">
                                        <?php } else { ?>
                                        <input type="text" class="form-control" name="intial_investment" id="intial_investment" required="required">
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- <div class="modal-footer">
                                    <button class="btn btn-prmary-background font_bold">Update</button>
                                </div> -->
                                 <?php if (isset($data['adminBasicInfo']->profit_amount) && !empty($data['adminBasicInfo']->profit_amount)){ ?>

                                     <div class="form-group">    
                                        <label class="col-sm-2 control-label asterisk">Profit Amount</label> 
                                        <div class="col-md-10">   
                                            <input type="text" class="form-control" name="profit_amount" id="profit_amount" disabled="" class="yellow-cir"
                                            value=" ₹ <?php  echo $data['adminBasicInfo']->profit_amount?>"  required="required">
                                        </div>
                                     </div> 

                                      <div class="form-group">    
                                        <label class="col-sm-2 control-label asterisk">Total Amount</label> 
                                        <div class="col-md-10">   
                                            <input type="text" class="form-control" name="total_amount" id="total_amount" disabled="" class="yellow-cir"
                                            value=" ₹ <?php
                                                            $total_amount = $data['adminBasicInfo']->intial_investment + $data['adminBasicInfo']->profit_amount;
                                                            echo $total_amount;
                                                   ?>"  required="required">
                                        </div>
                                     </div>        
                                <?php } ?>  
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($data['active'] == "rate_table") echo "active"; ?>" id="editRate">
                            <br/>
                            <section class="container">
                                <div class="row">
                                    <div class="col-md-1 col-sm-1"></div>
                                    <div class="col-md-4 col-sm-3 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-aqua"><i class="fa fa-rupee"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text" style="font-size: 18px;">Gold price</span>
                                                <span class="info-box-number" style="font-size: 38px;">
                                                <i class="fa fa-rupee" style="padding-right: 5px;"></i>
                                                <?php echo $data['rate']->gold;?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2"></div>
                                    <div class="col-md-4 col-sm-3 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-aqua"><i class="fa fa-rupee"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text" style="font-size: 18px;">Silver Price</span>
                                                <span class="info-box-number" style="font-size: 38px;">
                                                <i class="fa fa-rupee" style="padding-right: 5px;"></i>
                                                <?php echo $data['rate']->silver;?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="addInitialAmount" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Add Initial Investment</b></h4>
            </div>
            
            <form method="post" action="javascript:void(0);" name="amountAddForm" id="amountAddForm"> 
                <div class="modal-body">  
                    <div class="row">

                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label asterisk">Amount</label>
                            <input class="form-control" type="text" name="amount_add" id="amount_add"  placeholder="Enter  amount">
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label asterisk">Created Date</label>
                            <input class="form-control normal_datepicker" type="date" name="created_date" id="created_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Enter loan amount">
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label asterisk">Payable Type: </label>
                            <select class="form-control " id="payable_type" name="payable_type" onchange="addcheckTrasactionType();">
                                <option value="">Select Amount By </option>
                                <option value="cash"> CASH</option>
                                <?php foreach ($data['bank_details'] as $bank) { ?>
                                <option value="<?php echo $bank->bank_id;?>" >
                                    <?php echo $bank->bank_name; ?> (<?php echo $bank->account_no; ?>)
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="row">
                         <div class="form-group col-sm-3 col-md-3" style="display: none;" id="cheque_detail">
                            <label class="control-label">Cheque Number</label>
                            <input class="form-control" type="text" name="Cheque_Number" id="Cheque_Number" placeholder="Enter cheque Number">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                            <label class="control-label">Region</label>
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

<div id="editRateBtn" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title font_weight600">Edit Price</h3>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow:scroll;width: 100%;scrollbar-color: #fff #fff;">
                <form name="updateratetable" class="form-horizontal" action="javascript:void(0);" method="POST" id="updateratetable">
                    <div class="form-group">
                        <label class="col-sm-2 control-label asterisk">Gold price</label>
                        <div class="col-md-3">
                            <?php if (isset($data['rate']->gold)) { ?>
                            <input type="text" class="form-control" name="gold"
                                value="<?php if (!empty($data['rate']->gold)) echo $data['rate']->gold; ?>" required="required"/>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="" required="required"/>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label asterisk">Silver Price</label>
                        <div class="col-md-3">
                            <?php if (isset($data['rate']->silver)) { ?>
                            <input type="text" class="form-control" name="silver"
                                value="<?php if (!empty($data['rate']->silver)) echo $data['rate']->silver; ?>"
                                required="required">
                            <?php } else { ?>
                            <input type="text" class="form-control" name=""  required="required">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-prmary-background font_bold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="editBank" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title font_weight600">Edit Bank Details</h3>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow:scroll;width: 100%;scrollbar-color: #fff #fff;">
                <form name="updateBankDetails" method="post" id="updateBankDetails" action="javascript:void(0);"  enctype="multipart/form-data">
                    <div class="updateBank"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary bg_green">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="addBank" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title font_weight600">Add Bank Details</h3>
            </div>
            <div class="modal-body">
                <form name="addBankDetails" method="post" id="addBankDetails" action="javascript:void(0);"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                            <label class="control-label asterisk">Account No: </label>
                            <input type="text" class="form-control" name="account_no"  required="required">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label asterisk">Name: </label>
                            <input autocomplete="off" type="text" class="form-control datemask3" id="edit_event_date_from" name="account_holder_name"  required="required">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label asterisk">Bank Name: </label>
                            <input autocomplete="off" type="text" class="form-control datemask3" id="bank_name" name="bank_name"  required="required">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label asterisk">IFSC Code: </label>
                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code"  required="required">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Type: </label>
                            <select  class="form-control clockpicker"  data-placement="left" data-align="top" data-autoclose="true" id="Type" name="Type">
                                <option value="">Select Account Type</option>
                                <option value="saving"> Saving</option>
                                <option value="current"> Current</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary bg_green">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
