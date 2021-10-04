<div class="content-wrapper" style="min-height: 1000px;">
  <section class="content-header">
      <h1> Add Customer</h1>
  </section>
  <section class="content">
    <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
    <form name="addCustomerDetails" method="post" id="addCustomerDetails" action="javascript:void(0);"  enctype="multipart/form-data"> 
      <div class="row">
        <div class="form-group col-sm-3 col-md-3">
          <label class="control-label asterisk">First Name: </label>
          <input type="text" class="form-control" name="first_name"  required="required">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label asterisk">Last Name: </label>
          <input autocomplete="off" type="text" class="form-control"  name="last_name"  required="required" style="padding-top: 0px;">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label asterisk">Parent Name: </label>
          <input autocomplete="off" type="text" class="form-control "  name="parent_name"  required="required" style="padding-top: 0px;">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label asterisk">Gender: </label>
          <input type="text" class="form-control"  name="gender"  required="required">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label ">Email: </label>
          <input type="text" class="form-control"  name="email">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label ">Phone: </label>
          <input type="text" class="form-control"  name="phone">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label ">Whatsapp: </label>
          <input type="text" class="form-control"  name="whatsapp">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label asterisk">City: </label>
          <input type="text" class="form-control"  name="city"  required="required">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label asterisk">State: </label>
          <input type="text" class="form-control"  name="state"  required="required">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label asterisk">Address: </label>
          <input type="text" class="form-control"  name="address"  required="required">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label ">Postal Code: </label>
          <input type="text" class="form-control"  name="postal_code">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label k">Aadhar No: </label>
          <input type="text" class="form-control"  name="aadhar_no">
        </div>
        <div class="form-group col-md-2">
          <label class="control-label k">Choose Profile: </label>
          <input  type="file" name="image" onchange="readURLCustomer(this);">
        </div>
        <div class="form-group col-md-1">
            <img id="customer_preview" src="#" alt="your image" style="display: none;float: left;" />
        </div>
        <div class="form-group col-md-9">
          <label class="control-label ">Description: </label>
          <textarea class="form-control" rows="5" name="description"></textarea>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit"  class="btn btn-primary bg_green">Update</button>
      </div>
    </form>
  </div></div></div></div>
  </section>
</div>