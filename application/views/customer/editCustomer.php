<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1> Edit Customer

        <?php 
            $userSessionData = $this->session->admin_login_data;
            if ($userSessionData['admin_type'] != 'super_admin') 
            {
        ?>
            <a href="javascript:void(0);"  onclick="loadPageWithoutRefresh('<?php echo site_url()."/customer/index"; ?>')"  class="btn btn-success pull-right">Back</a>
        <?php } else { ?>
            <a href="javascript:void(0);"  onclick="loadPageWithoutRefresh('<?php echo site_url()."/customer/superAdminCustomer"; ?>')"  class="btn btn-success pull-right">Back</a>
        <?php }?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form name="updateCustomerDetails" method="post" id="updateCustomerDetails" action="javascript:void(0);"  enctype="multipart/form-data">
                            <input type="hidden" name="customer_id" value="<?php echo $data['details']->customer_id?>">
                            <h4>Personal Info:</h4>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label class="control-label asterisk">First Name: </label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo $data['details']->f_name;?>"  required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">Last Name: </label>
                                    <input autocomplete="off" type="text" class="form-control"  name="last_name"  value="<?php echo $data['details']->l_name;?>"  required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">Gender: </label>
                                    <select class="form-control" name="gender" required="required"  value="<?php echo $data['details']->gender;?>">
                                        <option value="male"> Male</option>
                                        <option value="female"> Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label asterisk">Parent Name: </label>
                                    <input autocomplete="off" type="text" class="form-control "  name="parent_name"  required="required"  value="<?php echo $data['details']->p_name;?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label k">Aadhar No: </label>
                                    <input type="text" class="form-control" name="aadhar_no"  value="<?php echo $data['details']->aadhar_no;?>">
                                </div>
                            </div>
                            <h4>Contact Info:</h4>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Email: </label>
                                    <input type="text" class="form-control"  name="email"  value="<?php echo $data['details']->e_mail;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Phone: </label>
                                    <input type="text" class="form-control"  name="phone" value="<?php echo $data['details']->phone;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Whatsapp: </label>
                                    <input type="text" class="form-control"  name="whatsapp" value="<?php echo $data['details']->whatsapp;?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label asterisk">Address: </label>
                                    <textarea type="text" class="form-control" name="address" required="required"><?php echo $data['details']->address;?></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">City: </label>
                                    <input type="text" class="form-control" name="city"  required="required" value="<?php echo $data['details']->city;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">State: </label>
                                    <input type="text" class="form-control" name="state"  required="required"  value="<?php echo $data['details']->state;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Pin Code: </label>
                                    <input type="number" class="form-control" name="postal_code" value="<?php echo $data['details']->postal_code;?>">
                                </div>
                            </div>
                            <h4>Other Info:</h4>
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label class="control-label ">Description: </label>
                                    <textarea class="form-control" rows="5" name="description"><?php echo $data['details']->description;?></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Choose Profile: </label>
                                    <input  type="file" name="image" onchange="readURLCustomer(this);">
                                </div>
                                <div class="form-group col-md-1">
                                    <img id="customer_preview" src="<?php echo base_url(); ?>images/profile/<?php echo $data['details']->usr_img; ?>" style="float:left; width:80px; height:80px;" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit"  class="btn btn-primary bg_green">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>