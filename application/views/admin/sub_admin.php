<div id="resultBody">

<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>
            Users
            <a id="loadbasic" href="javascript:void(0);" data-toggle="modal" data-target="#addSubAdmin" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i>
            </a>
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
                                    <table id="sub_admin_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Personal Details</th>
                                                <th class="">Contact Details</th>
                                                <th class="">Address</th>
                                                <th class="text-center">Name Of Organisation</th>
                                                <th class="text-center">Registration No.</th>
                                                <th class="text-center">No. Of Loan</th>
                                                <th class="text-center">Total Loan Amount</th>
                                                <th class="text-center">Loan Amount With Interest</th>
                                                <th class="text-center">Completed Loan</th>
                                                <th class="text-center">Recived Loan Amount</th>
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

 <div id="addSubAdmin" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class=" font_weight600" style="margin: 0">Add Sub-Admin<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
            <div class="row">
                 <div class="col-md-12">
                    <div class="box box-primary" style="margin-bottom: 0">
                        <div class="box-body">
                            <form name="addSubAdminDetails" method="post" id="addSubAdminDetails" action="javascript:void(0);"  enctype="multipart/form-data">
                                <h4>Personal Info:</h4>
                                <div class="row">
                                    <div class="form-group col-sm-4 col-md-4">
                                        <label class="control-label asterisk">First Name: </label>
                                        <input type="text" class="form-control" name="first_name"  >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label asterisk">Last Name: </label>
                                        <input autocomplete="off" type="text" class="form-control"  name="last_name"  >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label asterisk">Initial Investment: </label>
                                        <input autocomplete="off" type="text" class="form-control"  name="intial_investment" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label ">Email: </label>
                                        <input type="email" class="form-control"  name="email">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label ">Phone: </label>
                                        <input type="text" class="form-control"  name="phone">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label class="control-label k">Aadhar No: </label>
                                        <input type="text" class="form-control" name="aadhar_no">
                                    </div>
                                  
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label asterisk">Address: </label>
                                        <textarea type="text" class="form-control" name="address" ></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label asterisk">City: </label>
                                        <input type="text" class="form-control" name="city"  >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label asterisk">State: </label>
                                        <input type="text" class="form-control" name="state"  >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label ">Postal Code: </label>
                                        <input type="number" class="form-control" name="postal_code">
                                    </div>
                                </div>
                                <h4>Other Info:</h4>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label ">Name Of Organisation:</label>
                                        <input type="text" class="form-control" name="name_oraganisation">
                                        <!-- <textarea class="form-control" rows="5" name="description"></textarea> -->
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label class="control-label ">Establish Year: </label>
                                        <input type="date" class="form-control" name="establish_year">
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label class="control-label ">Registration No: </label>
                                        <input type="number" class="form-control" name="ragistration_no">
                                    </div>
                                </div>
                                <h4>Create Password:</h4>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label ">Password:</label>
                                        <input type="text" class="form-control" name="password" id="password">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label class="control-label ">Re-Password: </label>
                                        <input type="text" class="form-control" name="re_password">
                                    </div> 
                                </div>
                                <div class="row">
                                     <div class="form-group col-md-3">
                                        <label class="control-label">Choose Profile: </label>
                                        <input  type="file" name="image" onchange="readURLCustomer(this);">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <img id="customer_preview" src="#" alt="your image" style="display: none;float: left;" />
                                    </div>
                                </div>
                     
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="submit" class="btn btn-primary bg_green pull-right" value="Create"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>


 <div id="editSubAdmin" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class=" font_weight600" style="margin: 0">Edit Sub-Admin<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
             <div class="row">
                 <div class="col-md-12">
                    <div class="box box-primary" style="margin-bottom: 0">
                        <div class="box-body">
                            <form name="editSubAdminForm" method="post" id="editSubAdminForm" action="javascript:void(0);"  enctype="multipart/form-data">
                                <div id="editSubAdmindata">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>




