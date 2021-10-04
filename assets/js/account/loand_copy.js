var _bzAppUnique = 0;

$(function () {
    $("#loan_table").DataTable({
        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/loan/fetch_details",  
            type:"POST"  
        }, 
        "order": [[ 1, "asc" ]],
        "columnDefs": [ 
        {
            "targets": 5,
            "orderable": false,
            "class": "white_space",
            "width":"100px",
        },
        {
            "targets": 0,
            "orderable": false,
            "width":"170px",
            "background-color":"aqua",
        },

         {
            "targets": 1,
            "orderable": false,
            "width":"180px",
            "background-color":"aqua",
        },
        {
            "targets": 2,
            "orderable": false,
            "width":"230px",
            "background-color":"aqua",
        },  
        {
            "targets": 4,
            "orderable": false,
            "width":"130px",
        },
        {
            "targets": 3,
            "orderable": true,
            "width":"120px",
        },
         {
            "targets": 6,
            "orderable": false,
            "class": "white_space",
            "width":"100px",
        },
        {
            "targets": 7,
            "orderable": false,
            "class": "white_space",
            "width":"120px",
        },
         {
            "targets": 8,
            "orderable": false,
            "class": "white_space",
            "width":"10px",
        },
        {
            "targets": 9,
            "orderable": false,
            "class": "white_space",
            "width":"10px",
        },
        ],
    });
});


$(function () {
    $("#loan_overview_table").DataTable({
        "pageLength": 10,
        lengthMenu: [
        [ 10, 25, 50, 100, 250, 500 ],
        [ '10', '25', '50', '100', '250', '500']
        ],
        "processing":true,  
        "serverSide":true,  
        "ajax":{  
            url: site_url+"/loan/loan_overview_fetch_details",  
            type:"POST"  
        }, 
        "order": [[ 1, "asc" ]],
        "columnDefs": [ 
        {
            "targets": 5,
            "orderable": false,
            "class": "white_space",
            "width":"50px",
        },
        {
            "targets": 0,
            "orderable": false,
            "width":"200px",
            "background-color":"aqua",
        },

         {
            "targets": 1,
            "orderable": false,
            "width":"180px",
            "background-color":"aqua",
        },
        {
            "targets": 2,
            "orderable": false,
            "width":"180px",
            "background-color":"aqua",
        },  
        {
            "targets": 4,
            "orderable": false,
            "width":"180px",
        },
        {
            "targets": 3,
            "orderable": true,
            "width":"150px",
        },
         {
            "targets": 6,
            "orderable": false,
            "class": "white_space",
            "width":"150px",
        },
        {
            "targets": 7,
            "orderable": false,
            "class": "white_space",
            "width":"30px",
        },
         {
            "targets": 8,
            "orderable": false,
            "class": "white_space",
            "width":"30px",
        },
        {
            "targets": 9,
            "orderable": false,
            "class": "white_space",
            "width":"30px",
        },
        ],
    });
});


function getCustomerOverviewData()
{
    var customer_id=$("#loan_customer_id").val();

    if(customer_id != "")
    {
        $("#showSelectedCustomerData").html("");
        $.ajax({
            url: site_url+"/customer/getSelectedCustomerHtml",
            data:{'customer_id':customer_id},
            type: 'POST',
            datatype:"json",
            success: function(responseHtml)
            {
                if(responseHtml != "")
                {
                    $("#showSelectedCustomerData").html(responseHtml);   
                    $("#selectSecurityTypeSection").css("display", "block");  
                }
                else
                {
                    $("#showSelectedCustomerData").html("");   
                    $("#selectSecurityTypeSection").css("display", "none"); 
                }    
            }
        });
    }
    else
    {
        $("#showSelectedCustomerData").html("");   
        $("#selectSecurityTypeSection").css("display", "none"); 
    }
}


function checkSecurityType()
{

    var type = $("#security").val();
    var gold_price_by_system = $("#gold_price_by_system").val();
    var silver_price_by_system = $("#silver_price_by_system").val();
    
    if(type == "gold")
    {
        $("#appendSilverMultipleInputDiv").html('');
        $("#appendSecurityTypeInput").html('<div class="col-sm-3 col-md-3 input-group input-group-custom"><label class="control-label asterisk">Gold Price: </label><input type="text" name="gold" id="gold" class="form-control" value="'+gold_price_by_system+'"><span class="input-group-btn"><button type="button" class="btn btn-info btn-flat input-group-button" onclick="addGoldItem()"><i class="fa fa-plus"></i></button></span></div>');
        $("#appendGoldMultipleInputDiv").html('<h4><b>Gold Items</b></h4><div id="appendGoldMultipleInputField" class="customGold"><div class="row col-md-12"><div class="form-group col-md-4"><label class="control-label asterisk">Name: </label><input type="text" class="form-control" name="gold_item_name[]" id="gold_item_name" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Weight(gm): </label><input type="number" class="form-control" name="gold_item_weight[]" id="gold_weight" onfocusout="updateGoldValue()" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Purity(%): </label><input type="number" class="form-control" name="gold_item_purity[]" id="gold_purity" onfocusout="updateGoldValue()"></div><div class="form-group col-md-1"><label class="control-label">Value: </label><input type="number" class="form-control" name="gold_item_value[]" id="gold_value"></div><div class="form-group col-md-1"><label class="control-label">Quantity: </label><input type="number" class="form-control" name="gold_item_quantity[]"></div><div class="form-group col-md-3"><label class="control-label">Image: </label><input type="file" name="gold_item_photo[]" onchange="readURLLoanGold(this);" style="height: 34px;"></div><div class="form-group col-md-1"><img id="loan_preview_gold" src="#" alt="your image" style="display: none;" /></div></div>');
        $("#bankdetail").css("display", "block");    
    }
    else if(type == "silver")
    {
        $("#appendGoldMultipleInputDiv").html('');
        $("#appendSecurityTypeInput").html('<div class="col-sm-3 col-md-3 input-group input-group-custom"><label class="control-label asterisk">Silver Price: </label><input type="text" name="silver" id="silver" class="form-control" value="'+silver_price_by_system+'"><span class="input-group-btn"><button type="button" class="btn btn-info btn-flat input-group-button" onclick="addSilverItem()"><i class="fa fa-plus"></i></button></span></div>');
        $("#appendSilverMultipleInputDiv").html('<h4><b>Silver Items</b></h4><div id="appendSilverMultipleInputField" class="customSilver"><div class="row col-md-12"><div class="form-group col-md-4"><label class="control-label asterisk">Name: </label><input type="text" class="form-control" name="silver_item_name[]" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Weight(gm): </label><input type="number" class="form-control" name="silver_item_weight[]" id="silver_weight" onfocusout="updateSilverValue()" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Purity()%: </label><input type="number" class="form-control" name="silver_item_purity[]" id="silver_purity" onfocusout="updateSilverValue()"></div><div class="form-group col-md-1"><label class="control-label">Value: </label><input type="number" class="form-control" name="silver_item_value[]" id="silver_value"   ></div><div class="form-group col-md-1"><label class="control-label">Quantity: </label><input type="number" class="form-control" name="silver_item_quantity[]"></div><div class="form-group col-md-3"><label class="control-label">Image: </label><input type="file" name="silver_item_photo[]" onchange="readURLLoanSilver(this);" style="height: 34px;"></div><div class="form-group col-md-1"><img id="loan_preview_silver" src="#" alt="your image" style="display: none;" /></div></div>');
        $("#bankdetail").css("display", "block");    
    }
    else if(type == "gold_silver")
    {
        $("#appendSecurityTypeInput").html('<div class="col-sm-3 col-md-3 input-group input-group-custom"><label class="control-label asterisk">Gold Price: </label><input type="text" name="gold" id="gold" class="form-control" value="'+gold_price_by_system+'"><span class="input-group-btn"><button type="button" class="btn btn-info btn-flat input-group-button" onclick="addGoldItem()"><i class="fa fa-plus"></i></button></span></div><div class="col-sm-3 col-md-3 input-group input-group-custom"><label class="control-label asterisk">Silver Price: </label><input type="text" name="silver" id="silver" class="form-control" value="'+silver_price_by_system+'"><span class="input-group-btn"><button type="button" class="btn btn-info btn-flat input-group-button" onclick="addSilverItem()"><i class="fa fa-plus"></i></button></span></div>');
        $("#appendGoldMultipleInputDiv").html('<h4><b>Gold Items</b></h4><div id="appendGoldMultipleInputField" class="customGold"><div class="row col-md-12"><div class="form-group col-md-4"><label class="control-label asterisk">Name: </label><input type="text" class="form-control" name="gold_item_name[]" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Weight(gm): </label><input type="number" class="form-control" name="gold_item_weight[]" id="gold_weight" onfocusout="updateGoldValue()" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Purity(%): </label><input type="number" class="form-control" name="gold_item_purity[]" id="gold_purity" onfocusout="updateGoldValue()" ></div><div class="form-group col-md-1"><label class="control-label">Value: </label><input type="number" class="form-control" name="gold_item_value[]" id="gold_value" ></div><div class="form-group col-md-1"><label class="control-label">Quantity: </label><input type="number" class="form-control" name="gold_item_quantity[]"></div><div class="form-group col-md-3"><label class="control-label">Image: </label><input type="file" name="gold_item_photo[]" onchange="readURLLoanGold(this);" style="height: 34px;"></div><div class="form-group col-md-1"><img id="loan_preview_gold" src="#" alt="your image" style="display: none;" /></div></div>');
        $("#appendSilverMultipleInputDiv").html('<h4><b>Silver Items</b></h4><div id="appendSilverMultipleInputField" class="customSilver"><div class="row col-md-12"><div class="form-group col-md-4"><label class="control-label asterisk">Name: </label><input type="text" class="form-control" name="silver_item_name[]" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Weight(gm): </label><input type="number" class="form-control" name="silver_item_weight[]"id="silver_weight" onfocusout="updateSilverValue()" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Purity(%): </label><input type="number" class="form-control" name="silver_item_purity[]"id="silver_purity" onfocusout="updateSilverValue()" ></div><div class="form-group col-md-1"><label class="control-label">Value: </label><input type="number" class="form-control" name="silver_item_value[]" id="silver_value"></div><div class="form-group col-md-1"><label class="control-label">Quantity: </label><input type="number" class="form-control" name="silver_item_quantity[]"></div><div class="form-group col-md-3"><label class="control-label">Image: </label><input type="file" name="silver_item_photo[]" onchange="readURLLoanSilver(this);" style="height: 34px;"></div><div class="form-group col-md-1"><img id="loan_preview_silver" src="#" alt="your image" style="display: none;" /></div></div>');
        $("#bankdetail").css("display", "block");   
        $("#bankdetail").css("display", "block");    
    }
    else if(type == "none")
    {
        $("#bankdetail").css("display", "block");
        $("#appendSecurityTypeInput").html('');
        $("#appendGoldMultipleInputDiv").html('');
        $("#appendSilverMultipleInputDiv").html('');

    }
    else
    {
        $("#appendSecurityTypeInput").html('');
        $("#appendGoldMultipleInputDiv").html('');
        $("#appendSilverMultipleInputDiv").html('');
        $("#bankdetail").css("display", "none"); 
    }
}


function checkTrasactionType()
{
    var type = $("#trasactionType").val();
    if (type == "" || type == "cash" ) 
    {
        $("#cheque_details").css("display", "none");
    }
    else
    {     
        $("#cheque_details").css("display", "block");
    }   
}


function addGoldItem()
{
    var localGoldId = uniqueID();
    $("#appendGoldMultipleInputField").append('<div id="'+localGoldId+'" class="row col-md-12"><div class="col-sm-4 col-md-4 form-group"><label class="control-label asterisk" style="width:100%;">Name: <a href="javascript:void(0);" class="pull-right" style="color:red;" onclick="removeItem('+localGoldId+')"><i class="fa fa-close"></i></a></label><input type="text" id="name_'+localGoldId+'" class="form-control" name="gold_item_name[]" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Weight(gm): </label><input type="number" class="form-control" name="gold_item_weight[]" id="gold_weight'+localGoldId+'" onfocusout="updateGoldValue('+localGoldId+')"></div><div class="form-group col-md-1"><label class="control-label asterisk">Purity(%): </label><input type="number" id="gold_purity'+localGoldId+'" class="form-control" name="gold_item_purity[]" onfocusout="updateGoldValue('+localGoldId+')"></div><div class="form-group col-md-1"><label class="control-label">Value: </label><input type="number" id="gold_value'+localGoldId+'" class="form-control" name="gold_item_value[]"></div><div class="form-group col-md-1"><label class="control-label">Quantity: </label><input type="number" class="form-control" name="gold_item_quantity[]"></div><div class="form-group col-md-4"><label class="control-label">Image: </label><input type="file" name="gold_item_photo[]" style="height: 34px;"></div></div>');
}


function addSilverItem()
{
    var localSilverId = uniqueID();
    $("#appendSilverMultipleInputField").append('<div id="'+localSilverId+'" class="row col-md-12"><div class="col-sm-4 col-md-4 form-group"><label class="control-label asterisk" style="width:100%;">Name: <a href="javascript:void(0);" class="pull-right" style="color:red;" onclick="removeItem('+localSilverId+')"><i class="fa fa-close"></i></a></label><input type="text" id="name_'+localSilverId+'" class="form-control" name="silver_item_name[]" ></div><div class="form-group col-md-1"><label class="control-label asterisk">Weight(gm): </label><input type="number" class="form-control" name="silver_item_weight[]" id="silver_weight'+localSilverId+'" onfocusout="updateSilverValue('+localSilverId+')"></div><div class="form-group col-md-1"><label class="control-label asterisk">Purity(%): </label><input type="number" id="silver_purity'+localSilverId+'" class="form-control" name="silver_item_purity[]" onfocusout="updateSilverValue('+localSilverId+')"></div><div class="form-group col-md-1"><label class="control-label">Value: </label><input type="number" id="silver_value'+localSilverId+'" class="form-control" name="silver_item_value[]"></div><div class="form-group col-md-1"><label class="control-label">Quantity: </label><input type="number" class="form-control" name="silver_item_quantity[]"></div><div class="form-group col-md-4"><label class="control-label">Image: </label><input type="file" name="silver_item_photo[]" style="height: 34px;"></div></div>');
}


function removeItem(id="")
{
    $("#"+id).remove();
}


function uniqueID() 
{
    var d = new Date();
    var u = d.getFullYear() + "," + d.getMonth() + "," + 
            d.getHours() + "," + d.getMinutes() + "," + 
            d.getSeconds() + "," + _bzAppUnique;
    _bzAppUnique++;
    return u.replace(/\,/g, "");
}


function updateGoldValue(item_id="") 
{
    var rate = $("#gold").val();
    var weight = $("#gold_weight"+item_id).val();
    var purity = $("#gold_purity"+item_id).val();

    var orignal_gold_price = (rate * weight);
    var orignal_gold_purity = (orignal_gold_price / purity);
    var orignal_gold = (orignal_gold_price - orignal_gold_purity);
    $("#gold_value"+item_id).val(orignal_gold);
}


function updateSilverValue(item_id="") 
{
    var rate = $("#silver").val();
    var weight = $("#silver_weight"+item_id).val();
    var purity = $("#silver_purity"+item_id).val();

        var orignal_silver_price = (rate * weight);
        var orignal_silver_purity = (orignal_silver_price / purity);
        var orignal_silver = (orignal_silver_price - orignal_silver_purity);
        $("#silver_value"+item_id).val(orignal_silver);
}


function readURLLoanSilver(input)
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#loan_preview_silver')

                .attr('src', e.target.result)
                .width(100)
                .height(100);
        };
        $('#loan_preview_silver').show();
        reader.readAsDataURL(input.files[0]);
    }
}


function readURLLoanGold(input)
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#loan_preview_gold')

                .attr('src', e.target.result)
                .width(100)
                .height(100);
        };
        $('#loan_preview_gold').show();
        reader.readAsDataURL(input.files[0]);
    }
}


// function loanOverView(id) 
// {
//     $.ajax({
//         url: site_url+"/loan/loanOverView",
//         type: 'get',
//         data : {"id" : id},
//         success: function(response)
//         {
            
//         }
//     });
// }