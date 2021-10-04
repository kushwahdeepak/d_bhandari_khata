<style type="text/css">
    label {
        font-weight: 600 !important;
    }
</style>
<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1> Add Customer 

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
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form name="addCustomerDetails" method="post" id="addCustomerDetails" action="javascript:void(0);"  enctype="multipart/form-data">
                            <h4 class="heading_h4">Personal Info:</h4>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label class="control-label asterisk">First Name: </label>
                                    <input type="text" class="form-control" name="first_name"  required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">Last Name: </label>
                                    <input autocomplete="off" type="text" class="form-control"  name="last_name"  required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">Gender: </label>
                                    <select class="form-control" name="gender" required="required">
                                        <option value="male"> Male</option>
                                        <option value="female"> Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label asterisk">Parent Name: </label>
                                    <input autocomplete="off" type="text" class="form-control "  name="parent_name"  required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label k">Aadhar No: </label>
                                    <input type="text" class="form-control" name="aadhar_no">
                                </div>
                            </div>
                            <h4 class="heading_h4">Contact Info:</h4>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Email: </label>
                                    <input type="text" class="form-control"  name="email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Phone: </label>
                                    <input type="text" class="form-control"  name="phone">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Whatsapp: </label>
                                    <input type="text" class="form-control"  name="whatsapp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label asterisk">Address: </label>
                                    <textarea type="text" class="form-control" name="address" required="required"></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">City: </label>
                                    <input type="text" class="form-control" name="city"  required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label asterisk">State: </label>
                                    <input type="text" class="form-control" name="state"  required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label ">Pin Code: </label>
                                    <input type="number" class="form-control" name="postal_code">
                                </div>
                            </div>
                            <h4 class="heading_h4">Other Info:</h4>
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label class="control-label ">Description: </label>
                                    <textarea class="form-control" rows="5" name="description"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Choose Profile: </label>
                                    <input  type="file" name="image" onchange="readURLCustomer(this);">
                                </div>
                                <div class="form-group col-md-1">
                                    <img id="customer_preview" src="#" alt="your image" style="display: none;float: left;" />
                                </div>
                            </div>
                 
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary bg_green" value="Create"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>